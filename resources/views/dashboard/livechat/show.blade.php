@extends('layouts.hal_admin')

@section('content')
    <div class="space-y-6" x-data="chatDetail()" x-init="init()">

        {{-- Back + Header --}}
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.livechat.index') }}"
                class="flex items-center justify-center w-10 h-10 bg-white border border-gray-200 rounded-xl hover:bg-gray-50 transition-colors">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </a>
            <div class="flex-1">
                <h2 class="text-xl font-bold text-gray-800">{{ $liveChat->visitor_name }}</h2>
                <p class="text-sm text-gray-500">{{ $liveChat->visitor_topic ?? 'Tanpa topik' }} ·
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full text-xs font-bold"
                        :class="chatStatus === 'active' ? 'bg-green-50 text-green-700' : (chatStatus === 'waiting' ?
                            'bg-yellow-50 text-yellow-700' : 'bg-gray-100 text-gray-500')"
                        x-text="chatStatus === 'active' ? 'Active' : (chatStatus === 'waiting' ? 'Waiting' : 'Done')"></span>
                </p>
            </div>

            <div class="flex items-center gap-2">
                {{-- Delete Button --}}
                <button x-show="chatStatus === 'done'" @click="deleteChat()"
                    class="px-5 py-2.5 bg-gray-50 text-gray-600 rounded-xl hover:bg-red-50 hover:text-red-600 text-sm font-semibold transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                        </path>
                    </svg>
                    Hapus
                </button>

                {{-- End Chat Button --}}
                <button x-show="chatStatus === 'active'" @click="endChat()"
                    class="px-5 py-2.5 bg-red-50 text-red-600 rounded-xl hover:bg-red-100 text-sm font-semibold transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                    Akhiri Chat
                </button>
            </div>
        </div>

        {{-- Chat Area --}}
        <div class="bg-white rounded-[2rem] border border-gray-100 shadow-sm overflow-hidden flex flex-col"
            style="height: calc(100vh - 16rem);">

            {{-- Messages Area --}}
            <div class="flex-1 overflow-y-auto p-6 space-y-4" x-ref="messagesArea" id="admin-messages-area">
                <template x-for="msg in messages" :key="msg.id">
                    <div class="flex" :class="msg.sender === 'admin' ? 'justify-end' : 'justify-start'">
                        <div class="max-w-[70%] px-5 py-3 rounded-2xl text-sm leading-relaxed shadow-sm"
                            :class="msg.sender === 'admin' ?
                                'bg-gradient-to-br from-[#2e7d32] to-emerald-600 text-white rounded-br-md' :
                                'bg-gray-100 text-gray-800 rounded-bl-md'">
                            <p x-text="msg.message" class="whitespace-pre-wrap"></p>
                            <p class="text-[10px] mt-1 opacity-60 flex items-center gap-1">
                                <span x-text="msg.sender === 'admin' ? 'Admin' : '{{ $liveChat->visitor_name }}'"></span>
                                ·
                                <span x-text="msg.time"></span>
                            </p>
                        </div>
                    </div>
                </template>

                <template x-if="chatStatus === 'done'">
                    <div class="text-center py-3">
                        <span class="inline-block bg-gray-100 text-gray-500 text-xs px-4 py-2 rounded-full">
                            Chat telah berakhir
                        </span>
                    </div>
                </template>
            </div>

            {{-- Reply Form --}}
            <div class="border-t border-gray-100 p-4 bg-gray-50/50" x-show="chatStatus === 'active'">
                <div class="flex items-end gap-3">
                    <textarea x-model="replyMessage" @keydown.enter.prevent="sendReply()" rows="1" placeholder="Ketik balasan Anda..."
                        class="flex-1 px-5 py-3 rounded-xl border border-gray-200 text-sm resize-none focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent bg-white max-h-28 placeholder:text-gray-400"
                        style="field-sizing: content;"></textarea>
                    <button @click="sendReply()" :disabled="!replyMessage.trim() || isSending"
                        class="px-6 py-3 bg-gradient-to-r from-[#2e7d32] to-emerald-600 text-white rounded-xl hover:shadow-lg hover:shadow-emerald-200 transition-all duration-200 disabled:opacity-40 disabled:cursor-not-allowed text-sm font-semibold flex items-center gap-2">
                        <svg x-show="isSending" class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                                stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z">
                            </path>
                        </svg>
                        <svg x-show="!isSending" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Kirim
                    </button>
                </div>
            </div>

            {{-- Done state --}}
            <div class="border-t border-gray-100 p-4 bg-gray-50/50 text-center" x-show="chatStatus === 'done'">
                <p class="text-gray-400 text-sm">Chat ini sudah selesai</p>
            </div>
        </div>
    </div>

    <script>
        function chatDetail() {
            return {
                chatId: {{ $liveChat->id }},
                chatStatus: '{{ $liveChat->status }}',
                messages: {!! json_encode(
                    $liveChat->messages->map(
                        fn($m) => [
                            'id' => $m->id,
                            'sender' => $m->sender,
                            'message' => $m->message,
                            'time' => $m->created_at->format('H:i'),
                        ],
                    ),
                ) !!},
                replyMessage: '',
                isSending: false,
                lastMessageId: {{ $liveChat->messages->last()?->id ?? 0 }},
                pollInterval: null,

                init() {
                    this.$nextTick(() => this.scrollToBottom());

                    if (this.chatStatus !== 'done') {
                        this.pollInterval = setInterval(() => this.pollMessages(), 3000);
                    }
                },

                async sendReply() {
                    if (!this.replyMessage.trim() || this.isSending) return;
                    this.isSending = true;

                    try {
                        const res = await fetch(`/dashboard/livechat/${this.chatId}/reply`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                message: this.replyMessage.trim()
                            }),
                        });

                        const data = await res.json();
                        if (data.success) {
                            this.messages.push(data.message);
                            this.lastMessageId = data.message.id;
                            this.replyMessage = '';
                            this.$nextTick(() => this.scrollToBottom());
                        }
                    } catch (e) {
                        console.error('Reply failed:', e);
                    }

                    this.isSending = false;
                },

                async endChat() {
                    if (!confirm('Yakin ingin mengakhiri chat ini?')) return;

                    try {
                        const res = await fetch(`/dashboard/livechat/${this.chatId}/end`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            },
                        });

                        const data = await res.json();
                        if (data.success) {
                            this.chatStatus = 'done';
                            if (this.pollInterval) clearInterval(this.pollInterval);
                            // Reload to get closing message
                            setTimeout(() => location.reload(), 500);
                        }
                    } catch (e) {
                        console.error('End chat failed:', e);
                    }
                },

                async deleteChat() {
                    if (!confirm('Apakah Anda yakin ingin menghapus riwayat chat ini secara permanen?')) return;

                    try {
                        const res = await fetch(`/dashboard/livechat/${this.chatId}`, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            },
                        });

                        const data = await res.json();
                        if (data.success) {
                            window.location.href = '{{ route('admin.livechat.index') }}';
                        }
                    } catch (e) {
                        console.error('Delete failed:', e);
                        alert('Gagal menghapus riwayat chat.');
                    }
                },

                async pollMessages() {
                    try {
                        const res = await fetch(
                            `/dashboard/livechat/${this.chatId}/messages?last_id=${this.lastMessageId}`);
                        const data = await res.json();

                        if (data.success && data.messages.length > 0) {
                            data.messages.forEach(msg => {
                                if (!this.messages.find(m => m.id === msg.id)) {
                                    this.messages.push(msg);
                                }
                            });
                            this.lastMessageId = data.messages[data.messages.length - 1].id;
                            this.$nextTick(() => this.scrollToBottom());
                        }

                        if (data.chat_status === 'done') {
                            this.chatStatus = 'done';
                            if (this.pollInterval) clearInterval(this.pollInterval);
                        }
                    } catch (e) {
                        console.error('Poll failed:', e);
                    }
                },

                scrollToBottom() {
                    const area = this.$refs.messagesArea;
                    if (area) area.scrollTop = area.scrollHeight;
                },

                destroy() {
                    if (this.pollInterval) clearInterval(this.pollInterval);
                }
            };
        }
    </script>
@endsection
