@extends('layouts.hal_admin')

@section('content')
    <div class="space-y-6" x-data="liveChatAdmin()" x-init="init()">

        {{-- Header --}}
        <div
            class="relative overflow-hidden bg-gradient-to-br from-[#2e7d32] to-emerald-600 rounded-[2rem] p-8 shadow-lg shadow-emerald-900/20 text-white">
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-yellow-400/20 rounded-full blur-2xl"></div>

            <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="text-3xl font-black tracking-tight flex items-center gap-3">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                        Live Chat
                    </h2>
                    <p class="text-emerald-100 mt-1 text-sm">Kelola konsultasi langsung dengan pengunjung website</p>
                </div>

                {{-- Toggle Online/Offline --}}
                <div class="flex items-center gap-4">
                    <div class="bg-white/10 backdrop-blur-sm px-5 py-3 rounded-2xl border border-white/20">
                        <div class="flex items-center gap-3">
                            <span class="text-sm font-medium" x-text="isOnline ? 'Online' : 'Offline'"></span>
                            <button @click="toggleOnline()"
                                class="relative inline-flex h-7 w-13 rounded-full transition-colors duration-300 focus:outline-none"
                                :class="isOnline ? 'bg-green-400' : 'bg-gray-400'">
                                <span
                                    class="inline-block h-5 w-5 transform rounded-full bg-white shadow-md transition-transform duration-300 mt-1 ml-1"
                                    :class="isOnline ? 'translate-x-6' : 'translate-x-0'"></span>
                            </button>
                        </div>
                    </div>

                    <div class="flex gap-3 text-center">
                        <div class="bg-white/10 backdrop-blur-sm px-4 py-2 rounded-xl border border-white/20">
                            <p class="text-2xl font-black" x-text="activeCount">{{ $activeChats->count() }}</p>
                            <p class="text-[10px] uppercase tracking-wider text-emerald-200">Aktif</p>
                        </div>
                        <div class="bg-white/10 backdrop-blur-sm px-4 py-2 rounded-xl border border-white/20">
                            <p class="text-2xl font-black" x-text="waitingCount">{{ $waitingChats->count() }}</p>
                            <p class="text-[10px] uppercase tracking-wider text-emerald-200">Antrian</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Content Grid --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Chat Aktif --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-[2rem] border border-emerald-50 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2">
                        <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                        <h3 class="font-bold text-gray-800">Chat Aktif</h3>
                        <span class="ml-auto text-xs bg-green-50 text-green-700 px-2 py-1 rounded-lg font-bold"
                            x-text="activeCount"></span>
                    </div>

                    <div class="divide-y divide-gray-50 max-h-[400px] overflow-y-auto" id="active-chats-list">
                        @forelse ($activeChats as $chat)
                            <a href="{{ route('admin.livechat.show', $chat) }}"
                                class="block px-6 py-4 hover:bg-emerald-50/50 transition-colors group">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="font-bold text-gray-800 group-hover:text-emerald-700 transition-colors">
                                            {{ $chat->visitor_name }}</p>
                                        <p class="text-xs text-gray-500 mt-0.5">{{ $chat->visitor_topic ?? 'Tanpa topik' }}
                                        </p>
                                    </div>
                                    <span class="text-[10px] text-gray-400">{{ $chat->started_at?->format('H:i') }}</span>
                                </div>
                                <div class="flex items-center gap-2 mt-2">
                                    <span
                                        class="text-xs bg-emerald-50 text-emerald-600 px-2 py-0.5 rounded-full">{{ $chat->messages_count }}
                                        pesan</span>
                                </div>
                            </a>
                        @empty
                            <div class="px-6 py-8 text-center">
                                <p class="text-gray-400 text-sm">Belum ada chat aktif</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Antrian Waiting --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-[2rem] border border-yellow-50 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2">
                        <span class="w-2 h-2 bg-yellow-500 rounded-full"></span>
                        <h3 class="font-bold text-gray-800">Antrian</h3>
                        <span class="ml-auto text-xs bg-yellow-50 text-yellow-700 px-2 py-1 rounded-lg font-bold"
                            x-text="waitingCount"></span>
                    </div>

                    <div class="divide-y divide-gray-50 max-h-[400px] overflow-y-auto" id="waiting-chats-list">
                        @forelse ($waitingChats as $index => $chat)
                            <div class="px-6 py-4">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="font-bold text-gray-800">{{ $chat->visitor_name }}</p>
                                        <p class="text-xs text-gray-500 mt-0.5">{{ $chat->visitor_topic ?? 'Tanpa topik' }}
                                        </p>
                                    </div>
                                    <span class="text-lg font-black text-yellow-500">#{{ $index + 1 }}</span>
                                </div>
                                <p class="text-[11px] text-gray-400 mt-1">Menunggu sejak
                                    {{ $chat->created_at->diffForHumans() }}</p>
                            </div>
                        @empty
                            <div class="px-6 py-8 text-center">
                                <p class="text-gray-400 text-sm">Tidak ada antrian</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            {{-- Riwayat Chat Selesai --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 flex items-center gap-2">
                        <span class="w-2 h-2 bg-gray-400 rounded-full"></span>
                        <h3 class="font-bold text-gray-800">Riwayat</h3>
                    </div>

                    <div class="divide-y divide-gray-50 max-h-[400px] overflow-y-auto">
                        @forelse ($doneChats as $chat)
                            <a href="{{ route('admin.livechat.show', $chat) }}"
                                class="block px-6 py-4 hover:bg-gray-50 transition-colors group">
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="font-semibold text-gray-700 group-hover:text-gray-900">
                                            {{ $chat->visitor_name }}</p>
                                        <p class="text-xs text-gray-400">{{ $chat->visitor_topic ?? 'Tanpa topik' }}</p>
                                    </div>
                                    <span
                                        class="text-[10px] text-gray-400">{{ $chat->ended_at?->format('d/m H:i') }}</span>
                                </div>
                                <div class="flex items-center justify-between mt-2">
                                    <span class="text-xs text-gray-400 block">{{ $chat->messages_count }} pesan</span>
                                    <button @click.prevent="deleteChat({{ $chat->id }})"
                                        class="p-1.5 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all"
                                        title="Hapus Riwayat">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            </a>
                        @empty
                            <div class="px-6 py-8 text-center">
                                <p class="text-gray-400 text-sm">Belum ada riwayat chat</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function liveChatAdmin() {
            return {
                isOnline: @json($settings->is_online),
                activeCount: {{ $activeChats->count() }},
                waitingCount: {{ $waitingChats->count() }},
                pollInterval: null,

                init() {
                    // Polling setiap 4 detik
                    this.pollInterval = setInterval(() => this.pollData(), 4000);
                },

                async toggleOnline() {
                    try {
                        const res = await fetch('{{ route('admin.livechat.toggle') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            },
                        });
                        const data = await res.json();
                        if (data.success) {
                            this.isOnline = data.is_online;
                        }
                    } catch (e) {
                        console.error('Toggle failed:', e);
                    }
                },

                async pollData() {
                    try {
                        const res = await fetch('{{ route('admin.livechat.poll') }}');
                        const data = await res.json();

                        this.isOnline = data.is_online;
                        this.activeCount = data.active_count;
                        this.waitingCount = data.waiting_count;

                        // Reload halaman jika ada perubahan untuk update list
                        // (Sederhana: count berubah → reload)
                    } catch (e) {
                        console.error('Poll failed:', e);
                    }
                },

                async deleteChat(id) {
                    if (!confirm('Apakah Anda yakin ingin menghapus riwayat chat ini? Data tidak dapat dikembalikan.'))
                        return;

                    try {
                        const res = await fetch(`/dashboard/livechat/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            },
                        });
                        const data = await res.json();
                        if (data.success) {
                            location.reload();
                        }
                    } catch (e) {
                        console.error('Delete failed:', e);
                        alert('Gagal menghapus riwayat chat.');
                    }
                },

                destroy() {
                    if (this.pollInterval) clearInterval(this.pollInterval);
                }
            };
        }
    </script>
@endsection
