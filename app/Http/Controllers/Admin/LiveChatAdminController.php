<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminChatSetting;
use App\Models\ChatMessage;
use App\Models\LiveChat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LiveChatAdminController extends Controller
{
    /**
     * Dashboard live chat admin.
     */
    public function index(): View
    {
        $settings = AdminChatSetting::getSettings();
        $activeChats = LiveChat::active()
            ->withCount('messages')
            ->orderBy('started_at', 'asc')
            ->get();

        $waitingChats = LiveChat::waiting()
            ->orderBy('created_at', 'asc')
            ->get();

        $doneChats = LiveChat::done()
            ->withCount('messages')
            ->orderBy('ended_at', 'desc')
            ->limit(20)
            ->get();

        return view('dashboard.livechat.index', compact(
            'settings',
            'activeChats',
            'waitingChats',
            'doneChats'
        ));
    }

    /**
     * Detail chat + list pesan.
     */
    public function show(LiveChat $liveChat): View
    {
        $liveChat->load('messages');
        $settings = AdminChatSetting::getSettings();

        return view('dashboard.livechat.show', compact('liveChat', 'settings'));
    }

    /**
     * Admin mengirim balasan.
     */
    public function reply(Request $request, LiveChat $liveChat): JsonResponse
    {
        $request->validate([
            'message' => 'required|string|max:2000',
        ]);

        if ($liveChat->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Chat ini tidak dalam status aktif.',
            ], 422);
        }

        $msg = ChatMessage::create([
            'live_chat_id' => $liveChat->id,
            'sender' => 'admin',
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
     * Akhiri chat → status done, promosikan antrian.
     */
    public function endChat(LiveChat $liveChat): JsonResponse
    {
        if ($liveChat->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Chat ini tidak dalam status aktif.',
            ], 422);
        }

        // Pesan penutup
        ChatMessage::create([
            'live_chat_id' => $liveChat->id,
            'sender' => 'admin',
            'message' => 'Terima kasih telah menghubungi AgroOptimal! Semoga informasi yang diberikan bermanfaat. Jangan ragu untuk berkonsultasi kembali ya!',
        ]);

        $liveChat->update([
            'status' => 'done',
            'ended_at' => now(),
        ]);

        // Auto-promote waiting terlama
        $this->promoteNextWaiting();

        return response()->json([
            'success' => true,
            'message' => 'Chat berhasil diakhiri.',
        ]);
    }

    /**
     * Toggle status online/offline admin.
     */
    public function toggleOnline(): JsonResponse
    {
        $settings = AdminChatSetting::getSettings();
        $settings->update([
            'is_online' => ! $settings->is_online,
        ]);

        return response()->json([
            'success' => true,
            'is_online' => $settings->is_online,
        ]);
    }

    /**
     * Polling admin: data terkini.
     */
    public function pollAdmin(): JsonResponse
    {
        $settings = AdminChatSetting::getSettings();

        $activeChats = LiveChat::active()
            ->with(['messages' => fn ($q) => $q->latest()->limit(1)])
            ->withCount('messages')
            ->orderBy('started_at', 'asc')
            ->get()
            ->map(fn (LiveChat $c) => [
                'id' => $c->id,
                'visitor_name' => $c->visitor_name,
                'visitor_topic' => $c->visitor_topic,
                'messages_count' => $c->messages_count,
                'started_at' => $c->started_at?->format('H:i'),
                'last_message' => $c->messages->first()?->message ?? '-',
                'last_message_sender' => $c->messages->first()?->sender ?? '-',
            ]);

        $waitingChats = LiveChat::waiting()
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(fn (LiveChat $c, int $i) => [
                'id' => $c->id,
                'visitor_name' => $c->visitor_name,
                'visitor_topic' => $c->visitor_topic,
                'queue_position' => $i + 1,
                'waiting_since' => $c->created_at->diffForHumans(),
            ]);

        return response()->json([
            'is_online' => $settings->is_online,
            'active_chats' => $activeChats,
            'waiting_chats' => $waitingChats,
            'active_count' => $activeChats->count(),
            'waiting_count' => $waitingChats->count(),
        ]);
    }

    /**
     * Poll pesan untuk chat tertentu (admin side).
     */
    public function pollMessages(LiveChat $liveChat, Request $request): JsonResponse
    {
        $lastId = (int) $request->query('last_id', 0);

        $messages = $liveChat->messages()
            ->when($lastId > 0, fn ($q) => $q->where('id', '>', $lastId))
            ->orderBy('id')
            ->get()
            ->map(fn (ChatMessage $m) => [
                'id' => $m->id,
                'sender' => $m->sender,
                'message' => $m->message,
                'time' => $m->created_at->format('H:i'),
            ]);

        return response()->json([
            'success' => true,
            'messages' => $messages,
            'chat_status' => $liveChat->status,
        ]);
    }

    /**
     * Hapus riwayat chat.
     */
    public function destroy(LiveChat $liveChat): JsonResponse
    {
        // Hapus semua pesan terkait (cascade manually if not in DB)
        $liveChat->messages()->delete();
        $liveChat->delete();

        return response()->json([
            'success' => true,
            'message' => 'Riwayat chat berhasil dihapus.',
        ]);
    }

    /**
     * Promosikan chat waiting terlama ke active.
     */
    private function promoteNextWaiting(): void
    {
        $settings = AdminChatSetting::getSettings();
        $activeCount = LiveChat::active()->count();
        $availableSlots = $settings->max_active_chats - $activeCount;

        if ($availableSlots <= 0) {
            return;
        }

        $nextChat = LiveChat::waiting()
            ->orderBy('created_at', 'asc')
            ->first();

        if ($nextChat) {
            $nextChat->update([
                'status' => 'active',
                'started_at' => now(),
                'queue_number' => 0,
            ]);

            ChatMessage::create([
                'live_chat_id' => $nextChat->id,
                'sender' => 'admin',
                'message' => 'Halo ' . $nextChat->visitor_name . '! Giliran Anda sudah tiba! Selamat datang di layanan konsultasi AgroOptimal. Admin akan segera merespons. Silakan sampaikan pertanyaan Anda!',
            ]);
        }
    }
}
