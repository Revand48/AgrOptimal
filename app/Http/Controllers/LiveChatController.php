<?php

namespace App\Http\Controllers;

use App\Models\AdminChatSetting;
use App\Models\ChatMessage;
use App\Models\LiveChat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LiveChatController extends Controller
{
    /**
     * Cek status admin (online/offline) + info antrian.
     */
    public function status(): JsonResponse
    {
        $settings = AdminChatSetting::getSettings();
        $activeCount = LiveChat::active()->count();
        $waitingCount = LiveChat::waiting()->count();

        return response()->json([
            'is_online' => $settings->is_online,
            'active_count' => $activeCount,
            'waiting_count' => $waitingCount,
            'max_active' => $settings->max_active_chats,
        ]);
    }

    /**
     * Mulai sesi chat baru / masuk antrian.
     */
    public function start(Request $request): JsonResponse
    {
        $request->validate([
            'visitor_name' => 'required|string|max:100',
            'visitor_topic' => 'nullable|string|max:255',
            'session_id' => 'nullable|string|max:64',
        ]);

        $settings = AdminChatSetting::getSettings();

        // Jika admin offline, tolak
        if (! $settings->is_online) {
            return response()->json([
                'success' => false,
                'reason' => 'offline',
                'message' => 'Mohon maaf, admin sedang tidak tersedia. Silakan kirim pertanyaan melalui halaman pengaduan.',
            ]);
        }

        // Cek apakah sudah ada sesi aktif dengan session_id ini
        $sessionId = $request->input('session_id', Str::uuid()->toString());
        $existingChat = LiveChat::where('session_id', $sessionId)
            ->whereIn('status', ['active', 'waiting'])
            ->first();

        if ($existingChat) {
            return response()->json([
                'success' => true,
                'chat' => $this->formatChatResponse($existingChat),
            ]);
        }

        // Tentukan status: active atau waiting
        $activeCount = LiveChat::active()->count();
        $status = $activeCount < $settings->max_active_chats ? 'active' : 'waiting';

        // Hitung nomor antrian
        $queueNumber = 0;
        if ($status === 'waiting') {
            $queueNumber = LiveChat::waiting()->count() + 1;
        }

        $chat = LiveChat::create([
            'session_id' => $sessionId,
            'visitor_name' => $request->input('visitor_name'),
            'visitor_topic' => $request->input('visitor_topic'),
            'status' => $status,
            'queue_number' => $queueNumber,
            'started_at' => $status === 'active' ? now() : null,
        ]);

        // Pesan sambutan otomatis jika langsung aktif
        if ($status === 'active') {
            ChatMessage::create([
                'live_chat_id' => $chat->id,
                'sender' => 'admin',
                'message' => 'Halo ' . $chat->visitor_name . '! Selamat datang di layanan konsultasi AgroOptimal. Admin akan segera merespons pertanyaan Anda. Silakan tunggu sebentar ya!',
            ]);
        }

        return response()->json([
            'success' => true,
            'chat' => $this->formatChatResponse($chat),
        ]);
    }

    /**
     * Kirim pesan dari user.
     */
    public function send(Request $request): JsonResponse
    {
        $request->validate([
            'session_id' => 'required|string|max:64',
            'message' => 'required|string|max:2000',
        ]);

        $chat = LiveChat::where('session_id', $request->input('session_id'))
            ->where('status', 'active')
            ->first();

        if (! $chat) {
            return response()->json([
                'success' => false,
                'message' => 'Sesi chat tidak ditemukan atau belum aktif.',
            ], 404);
        }

        $msg = ChatMessage::create([
            'live_chat_id' => $chat->id,
            'sender' => 'user',
            'message' => $request->input('message'),
        ]);

        return response()->json([
            'success' => true,
            'message' => [
                'id' => $msg->id,
                'sender' => $msg->sender,
                'message' => $msg->message,
                'time' => $msg->created_at->format('H:i'),
            ],
        ]);
    }

    /**
     * Poll pesan baru + status terkini.
     */
    public function poll(string $sessionId, Request $request): JsonResponse
    {
        $chat = LiveChat::where('session_id', $sessionId)
            ->whereIn('status', ['active', 'waiting', 'done'])
            ->first();

        if (! $chat) {
            return response()->json([
                'success' => false,
                'message' => 'Sesi chat tidak ditemukan.',
            ], 404);
        }

        // Auto-promote: jika chat ini waiting, cek apakah ada slot
        if ($chat->status === 'waiting') {
            $this->tryPromoteWaiting();
            $chat->refresh();
        }

        // Ambil pesan setelah last_message_id (untuk delta polling)
        $lastId = (int) $request->query('last_id', 0);
        $messages = $chat->messages()
            ->when($lastId > 0, fn ($q) => $q->where('id', '>', $lastId))
            ->orderBy('id')
            ->get()
            ->map(fn (ChatMessage $m) => [
                'id' => $m->id,
                'sender' => $m->sender,
                'message' => $m->message,
                'time' => $m->created_at->format('H:i'),
            ]);

        // Hitung posisi antrian terkini
        $queuePosition = 0;
        $estimatedWait = 0;
        if ($chat->status === 'waiting') {
            $queuePosition = LiveChat::waiting()
                ->where('created_at', '<', $chat->created_at)
                ->count() + 1;
            $estimatedWait = $queuePosition * 5; // 5 menit per posisi
        }

        $settings = AdminChatSetting::getSettings();

        return response()->json([
            'success' => true,
            'chat' => [
                'status' => $chat->status,
                'queue_position' => $queuePosition,
                'estimated_wait' => $estimatedWait,
            ],
            'messages' => $messages,
            'is_online' => $settings->is_online,
        ]);
    }

    /**
     * Akhiri chat dari sisi user.
     */
    public function endChat(Request $request): JsonResponse
    {
        $request->validate([
            'session_id' => 'required|string|max:64',
        ]);

        $chat = LiveChat::where('session_id', $request->input('session_id'))
            ->whereIn('status', ['active', 'waiting'])
            ->first();

        if (! $chat) {
            return response()->json([
                'success' => false,
                'message' => 'Sesi chat tidak ditemukan atau sudah berakhir.',
            ], 404);
        }

        $chat->update([
            'status' => 'done',
            'ended_at' => now(),
        ]);

        // Jika chat aktif yang diakhiri, coba promosikan antrian
        if ($chat->status === 'active') {
            $this->tryPromoteWaiting();
        }

        return response()->json([
            'success' => true,
            'message' => 'Sesi chat telah diakhiri.',
        ]);
    }

    /**
     * Promosikan chat waiting terlama ke active jika ada slot.
     */
    private function tryPromoteWaiting(): void
    {
        $settings = AdminChatSetting::getSettings();
        $activeCount = LiveChat::active()->count();
        $availableSlots = $settings->max_active_chats - $activeCount;

        if ($availableSlots <= 0) {
            return;
        }

        $waitingChats = LiveChat::waiting()
            ->orderBy('created_at', 'asc')
            ->limit($availableSlots)
            ->get();

        foreach ($waitingChats as $waitingChat) {
            $waitingChat->update([
                'status' => 'active',
                'started_at' => now(),
                'queue_number' => 0,
            ]);

            ChatMessage::create([
                'live_chat_id' => $waitingChat->id,
                'sender' => 'admin',
                'message' => 'Halo ' . $waitingChat->visitor_name . '! Giliran Anda sudah tiba! Selamat datang di layanan konsultasi AgroOptimal. Admin akan segera merespons. Silakan sampaikan pertanyaan Anda!',
            ]);
        }
    }

    /**
     * Format response data chat.
     *
     * @return array<string, mixed>
     */
    private function formatChatResponse(LiveChat $chat): array
    {
        $queuePosition = 0;
        $estimatedWait = 0;

        if ($chat->status === 'waiting') {
            $queuePosition = LiveChat::waiting()
                ->where('created_at', '<', $chat->created_at)
                ->count() + 1;
            $estimatedWait = $queuePosition * 5;
        }

        return [
            'id' => $chat->id,
            'session_id' => $chat->session_id,
            'status' => $chat->status,
            'queue_position' => $queuePosition,
            'estimated_wait' => $estimatedWait,
            'visitor_name' => $chat->visitor_name,
            'visitor_topic' => $chat->visitor_topic,
        ];
    }
}
