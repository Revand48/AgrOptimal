{{-- 
    Komponen Live Chat Floating Widget
    Digunakan di layout app.blade.php untuk semua halaman user.
    Menggunakan Alpine.js + AJAX polling + localStorage.
--}}

<div x-data="liveChatWidget()" x-init="init()" class="fixed bottom-6 right-6 z-[9999]" x-cloak>

    {{-- Floating Button --}}
    <button @click="toggleChat()"
        class="group relative flex items-center justify-center w-16 h-16 rounded-full shadow-2xl transition-all duration-300 hover:scale-110 active:scale-95"
        :class="isOpen ? 'bg-gray-600 rotate-90' : 'bg-gradient-to-br from-[#2e7d32] to-emerald-600 hover:shadow-emerald-500/40'">

        {{-- Ikon Chat --}}
        <svg x-show="!isOpen" class="w-7 h-7 text-white drop-shadow" fill="none" stroke="currentColor"
            viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
            </path>
        </svg>
        <svg x-show="isOpen" class="w-7 h-7 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>

        {{-- Status Indicator Badge --}}
        <span x-show="!isOpen" class="absolute -top-1 -right-1 flex h-5 w-5">
            <span class="absolute inline-flex h-full w-full rounded-full opacity-75 animate-ping"
                :class="adminStatus === 'online' ? 'bg-green-400' : (adminStatus === 'queue' ? 'bg-yellow-400' :
                    'bg-red-400')"></span>
            <span class="relative inline-flex rounded-full h-5 w-5 border-2 border-white"
                :class="adminStatus === 'online' ? 'bg-green-500' : (adminStatus === 'queue' ? 'bg-yellow-500' :
                    'bg-red-500')"></span>
        </span>

        {{-- Tooltip --}}
        <span x-show="!isOpen"
            class="absolute right-20 bg-white text-gray-700 text-sm font-medium px-4 py-2 rounded-xl shadow-lg border border-gray-100 whitespace-nowrap opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none">
            <span
                x-text="adminStatus === 'online' ? 'Chat dengan kami!' : (adminStatus === 'queue' ? 'Admin sedang sibuk' : 'Offline')"></span>
            <span
                class="absolute right-[-6px] top-1/2 -translate-y-1/2 w-3 h-3 bg-white border-r border-b border-gray-100 rotate-[-45deg]"></span>
        </span>
    </button>

    {{-- Chat Modal --}}
    <div x-show="isOpen" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-4 scale-95"
        class="absolute bottom-20 right-0 w-[380px] h-[460px] bg-white rounded-3xl shadow-2xl shadow-black/20 border border-emerald-200 overflow-hidden flex flex-col"
        style="max-width: calc(100vw - 2rem);">

        {{-- Header --}}
        <div class="bg-gradient-to-r from-[#2e7d32] to-emerald-600 px-5 py-4 text-white relative overflow-hidden">
            <div class="absolute top-0 right-0 w-24 h-24 bg-white/10 rounded-full -mr-8 -mt-8 blur-xl"></div>
            <div class="relative z-10">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                        <img src="{{ asset('img/core/logogo.webp') }}" alt="AgroOptimal" class="w-7 h-7 object-contain">
                    </div>
                    <div>
                        <h3 class="font-bold text-base tracking-tight">AgroOptimal</h3>
                        <div class="flex items-center gap-1.5 text-xs">
                            <span class="w-2 h-2 rounded-full"
                                :class="adminStatus === 'online' ? 'bg-green-300 animate-pulse' : (
                                    adminStatus === 'queue' ? 'bg-yellow-300' : 'bg-red-400')"></span>
                            <span
                                x-text="adminStatus === 'online' ? 'Admin Online' : (adminStatus === 'queue' ? 'Admin Sibuk · Antrian Tersedia' : 'Offline')"></span>
                        </div>
                    </div>
                </div>

                {{-- Akhiri Chat Button --}}
                <button x-show="chatActive && chatStatus !== 'done'" @click="endChat()"
                    class="absolute top-1/2 -translate-y-1/2 right-4 px-3 py-1.5 bg-red-500 hover:bg-red-600 rounded-xl shadow-lg shadow-red-950/20 transition-all text-[9.5px] font-black uppercase tracking-widest text-white border border-red-400/50"
                    title="Akhiri Sesi Chat">
                    Akhiri Sesi Chat Live
                </button>
            </div>
        </div>

        {{-- Content Area --}}
        <div class="flex-1 overflow-hidden flex flex-col">

            {{-- State: Offline --}}
            <template x-if="adminStatus === 'offline' && !chatActive">
                <div class="flex-1 flex flex-col items-center justify-center p-6 text-center">
                    <div class="w-16 h-16 bg-red-50 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="font-bold text-gray-800 text-lg mb-2">Mohon Maaf</h4>
                    <p class="text-gray-500 text-sm leading-relaxed mb-5">
                        Saat ini admin tidak sedang bertugas. Silakan kirimkan pertanyaan Anda melalui halaman
                        pengaduan, kami akan segera merespons!
                    </p>
                    <a href="/#pengaduan"
                        class="inline-flex items-center gap-2 bg-gradient-to-r from-[#2e7d32] to-emerald-600 text-white px-6 py-3 rounded-xl text-sm font-semibold hover:shadow-lg hover:shadow-emerald-200 transition-all duration-200 hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                            </path>
                        </svg>
                        Kirim Pengaduan
                    </a>
                </div>
            </template>

            {{-- State: Form Mulai Chat --}}
            <template x-if="!chatActive && adminStatus !== 'offline'">
                <div class="flex-1 p-5">
                    <div class="mb-5">
                        <div class="flex items-center gap-2 mb-3">
                            <h4 class="font-bold text-gray-800">Mulai Konsultasi</h4>
                        </div>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            Konsultasikan kebutuhan pertanian Anda secara langsung. Isi data di bawah untuk memulai.
                        </p>
                    </div>

                    <div class="space-y-3">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Anda</label>
                            <input type="text" x-model="visitorName" placeholder="Masukkan nama Anda..."
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition-all placeholder:text-gray-400 bg-gray-50 focus:bg-white">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Topik Pertanyaan <span
                                    class="text-gray-400 font-normal">(opsional)</span></label>
                            <select x-model="visitorTopic"
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 text-sm focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent transition-all bg-gray-50 focus:bg-white">
                                <option value="">Pilih topik...</option>
                                <option value="Pupuk & Pemupukan">Pupuk & Pemupukan</option>
                                <option value="Bibit & Penanaman">Bibit & Penanaman</option>
                                <option value="Hama & Penyakit">Hama & Penyakit</option>
                                <option value="Irigasi & Pengairan">Irigasi & Pengairan</option>
                                <option value="Pengelolaan Lahan">Pengelolaan Lahan</option>
                                <option value="Lainnya">Lainnya</option>
                            </select>
                        </div>

                        <button @click="startChat()" :disabled="!visitorName.trim() || isLoading"
                            class="w-full mt-2 bg-gradient-to-r from-[#2e7d32] to-emerald-600 text-white py-3 rounded-xl text-sm font-bold hover:shadow-lg hover:shadow-emerald-200 transition-all duration-200 disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                            <svg x-show="isLoading" class="animate-spin w-4 h-4" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor"
                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4z"></path>
                            </svg>
                            <span x-text="isLoading ? 'Memulai...' : 'Mulai Chat'"></span>
                        </button>
                    </div>
                </div>
            </template>

            {{-- State: Waiting in Queue --}}
            <template x-if="chatActive && chatStatus === 'waiting'">
                <div class="flex-1 flex flex-col items-center justify-center p-6 text-center">
                    <div class="w-20 h-20 bg-yellow-50 rounded-full flex items-center justify-center mb-4 relative">
                        <svg class="w-10 h-10 text-[#f4b400]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="absolute inset-0 rounded-full border-4 border-yellow-200 animate-ping opacity-30">
                        </div>
                    </div>
                    <h4 class="font-bold text-gray-800 text-lg mb-1">Anda Dalam Antrian</h4>
                    <div
                        class="bg-gradient-to-r from-yellow-50 to-amber-50 rounded-2xl p-4 mb-3 w-full border border-yellow-100">
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Posisi Antrian</span>
                            <span class="text-2xl font-black text-[#f4b400]" x-text="'#' + queuePosition"></span>
                        </div>
                        <div class="h-px bg-yellow-200 my-2"></div>
                        <div class="flex justify-between items-center">
                            <span class="text-sm text-gray-600">Estimasi Waktu</span>
                            <span class="text-sm font-bold text-gray-700"
                                x-text="'~' + estimatedWait + ' menit'"></span>
                        </div>
                    </div>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Mohon tunggu sebentar, admin akan segera melayani Anda. Halaman ini bisa di-refresh tanpa
                        kehilangan posisi antrian.
                    </p>
                    <div class="flex gap-1 mt-4">
                        <div class="w-2 h-2 bg-[#f4b400] rounded-full animate-bounce" style="animation-delay: 0s">
                        </div>
                        <div class="w-2 h-2 bg-[#f4b400] rounded-full animate-bounce" style="animation-delay: 0.15s">
                        </div>
                        <div class="w-2 h-2 bg-[#f4b400] rounded-full animate-bounce" style="animation-delay: 0.3s">
                        </div>
                    </div>
                </div>
            </template>

            {{-- State: Active Chat --}}
            <template x-if="chatActive && (chatStatus === 'active' || chatStatus === 'done')">
                <div class="flex-1 flex flex-col overflow-hidden">
                    {{-- Messages --}}
                    <div class="flex-1 overflow-y-auto p-4 space-y-3" id="chat-messages-area" x-ref="messagesArea">
                        <template x-for="msg in messages" :key="msg.id">
                            <div class="flex" :class="msg.sender === 'user' ? 'justify-end' : 'justify-start'">
                                <div class="max-w-[80%] px-4 py-2.5 rounded-2xl text-sm leading-relaxed shadow-sm"
                                    :class="msg.sender === 'user' ?
                                        'bg-gradient-to-br from-[#2e7d32] to-emerald-600 text-white rounded-br-md' :
                                        'bg-gray-100 text-gray-800 rounded-bl-md'">
                                    <p x-text="msg.message" class="whitespace-pre-wrap"></p>
                                    <p class="text-[10px] mt-1 opacity-60" x-text="msg.time"></p>
                                </div>
                            </div>
                        </template>

                        {{-- Chat ended message --}}
                        <template x-if="chatStatus === 'done'">
                            <div class="text-center py-3">
                                <span class="inline-block bg-gray-100 text-gray-500 text-xs px-4 py-2 rounded-full">
                                    Chat telah berakhir · Terima kasih!
                                </span>
                            </div>
                        </template>
                    </div>

                    {{-- Input Area --}}
                    <div class="border-t border-gray-100 p-3 bg-gray-50/50" x-show="chatStatus === 'active'">
                        <div class="flex items-end gap-2">
                            <textarea x-model="newMessage" @keydown.enter.prevent="sendMessage()" rows="1"
                                placeholder="Ketik pesan Anda..."
                                class="flex-1 px-4 py-2.5 rounded-xl border border-gray-200 text-sm resize-none focus:outline-none focus:ring-2 focus:ring-emerald-400 focus:border-transparent bg-white max-h-24 placeholder:text-gray-400"
                                style="field-sizing: content;"></textarea>
                            <button @click="sendMessage()" :disabled="!newMessage.trim()"
                                class="p-2.5 bg-gradient-to-r from-[#2e7d32] to-emerald-600 text-white rounded-xl hover:shadow-lg hover:shadow-emerald-200 transition-all duration-200 disabled:opacity-40 disabled:cursor-not-allowed flex-shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- New Chat Button (when done) --}}
                    <div class="border-t border-gray-100 p-3 bg-gray-50/50" x-show="chatStatus === 'done'">
                        <button @click="resetChat()"
                            class="w-full bg-gradient-to-r from-[#2e7d32] to-emerald-600 text-white py-2.5 rounded-xl text-sm font-semibold hover:shadow-lg transition-all">
                            Mulai Chat Baru
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>

{{-- CSRF Token --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

<script>
    function liveChatWidget() {
        return {
            // UI State
            isOpen: false,
            isLoading: false,

            // Admin Status: 'online' | 'queue' | 'offline'
            adminStatus: 'offline',

            // Chat State
            chatActive: false,
            chatStatus: '', // 'waiting' | 'active' | 'done'
            sessionId: '',
            visitorName: '',
            visitorTopic: '',
            messages: [],
            newMessage: '',
            lastMessageId: 0,
            queuePosition: 0,
            estimatedWait: 0,

            // Polling
            statusInterval: null,
            chatInterval: null,

            init() {
                // Restore dari localStorage
                const saved = localStorage.getItem('agroptimal_chat');
                if (saved) {
                    try {
                        const data = JSON.parse(saved);
                        this.sessionId = data.session_id || '';
                        this.visitorName = data.visitor_name || '';
                        this.chatActive = data.chat_active || false;
                        this.chatStatus = data.chat_status || '';
                    } catch (e) {
                        localStorage.removeItem('agroptimal_chat');
                    }
                }

                // Check admin status awal
                this.checkAdminStatus();

                // Status polling setiap 10 detik
                this.statusInterval = setInterval(() => this.checkAdminStatus(), 10000);

                // Resume chat polling jika ada sesi aktif
                if (this.chatActive && this.sessionId && this.chatStatus !== 'done') {
                    this.startPolling();
                }
            },

            saveState() {
                localStorage.setItem('agroptimal_chat', JSON.stringify({
                    session_id: this.sessionId,
                    visitor_name: this.visitorName,
                    chat_active: this.chatActive,
                    chat_status: this.chatStatus,
                }));
            },

            toggleChat() {
                this.isOpen = !this.isOpen;
            },

            async checkAdminStatus() {
                try {
                    const res = await fetch('/api/livechat/status');
                    const data = await res.json();

                    if (!data.is_online) {
                        this.adminStatus = 'offline';
                    } else if (data.active_count >= data.max_active) {
                        this.adminStatus = 'queue';
                    } else {
                        this.adminStatus = 'online';
                    }
                } catch (e) {
                    console.error('Status check failed:', e);
                }
            },

            async startChat() {
                if (!this.visitorName.trim()) return;
                this.isLoading = true;

                try {
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const sessionId = this.sessionId || this.generateUUID();

                    const res = await fetch('/api/livechat/start', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            visitor_name: this.visitorName.trim(),
                            visitor_topic: this.visitorTopic || null,
                            session_id: sessionId,
                        }),
                    });

                    const data = await res.json();

                    if (data.success) {
                        this.sessionId = data.chat.session_id;
                        this.chatStatus = data.chat.status;
                        this.chatActive = true;
                        this.queuePosition = data.chat.queue_position;
                        this.estimatedWait = data.chat.estimated_wait;
                        this.saveState();
                        this.startPolling();
                    } else if (data.reason === 'offline') {
                        this.adminStatus = 'offline';
                    }
                } catch (e) {
                    console.error('Start chat failed:', e);
                }

                this.isLoading = false;
            },

            async sendMessage() {
                if (!this.newMessage.trim() || this.chatStatus !== 'active') return;

                const messageText = this.newMessage.trim();
                this.newMessage = '';

                try {
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                    const res = await fetch('/api/livechat/send', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            session_id: this.sessionId,
                            message: messageText,
                        }),
                    });

                    const data = await res.json();
                    if (data.success) {
                        this.messages.push(data.message);
                        this.lastMessageId = data.message.id;
                        this.$nextTick(() => this.scrollToBottom());
                    }
                } catch (e) {
                    console.error('Send failed:', e);
                    this.newMessage = messageText; // Restore jika gagal
                }
            },

            async endChat() {
                if (!confirm('Apakah Anda yakin ingin mengakhiri sesi konsultasi ini?')) return;

                try {
                    const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                    const res = await fetch('/api/livechat/end', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token,
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            session_id: this.sessionId,
                        }),
                    });

                    const data = await res.json();
                    if (data.success) {
                        this.chatStatus = 'done';
                        this.saveState();
                        if (this.chatInterval) {
                            clearInterval(this.chatInterval);
                            this.chatInterval = null;
                        }
                    }
                } catch (e) {
                    console.error('End chat failed:', e);
                }
            },

            startPolling() {
                if (this.chatInterval) clearInterval(this.chatInterval);
                this.pollChat(); // Initial poll
                this.chatInterval = setInterval(() => this.pollChat(), 3000);
            },

            async pollChat() {
                if (!this.sessionId) return;

                try {
                    const res = await fetch(`/api/livechat/poll/${this.sessionId}?last_id=${this.lastMessageId}`);
                    const data = await res.json();

                    if (data.success) {
                        // Update status
                        const oldStatus = this.chatStatus;
                        this.chatStatus = data.chat.status;
                        this.queuePosition = data.chat.queue_position;
                        this.estimatedWait = data.chat.estimated_wait;

                        // Append pesan baru
                        if (data.messages && data.messages.length > 0) {
                            data.messages.forEach(msg => {
                                if (!this.messages.find(m => m.id === msg.id)) {
                                    this.messages.push(msg);
                                }
                            });
                            this.lastMessageId = data.messages[data.messages.length - 1].id;
                            this.$nextTick(() => this.scrollToBottom());
                        }

                        // Update admin status
                        this.adminStatus = data.is_online ? 'online' : 'offline';

                        // Jika chat done, stop polling
                        if (data.chat.status === 'done') {
                            clearInterval(this.chatInterval);
                            this.chatInterval = null;
                        }

                        this.saveState();
                    }
                } catch (e) {
                    console.error('Poll failed:', e);
                }
            },

            scrollToBottom() {
                const area = this.$refs.messagesArea;
                if (area) {
                    area.scrollTop = area.scrollHeight;
                }
            },

            resetChat() {
                this.chatActive = false;
                this.chatStatus = '';
                this.sessionId = '';
                this.messages = [];
                this.lastMessageId = 0;
                this.newMessage = '';
                this.queuePosition = 0;
                this.estimatedWait = 0;
                localStorage.removeItem('agroptimal_chat');
                if (this.chatInterval) {
                    clearInterval(this.chatInterval);
                    this.chatInterval = null;
                }
            },

            generateUUID() {
                return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function(c) {
                    const r = Math.random() * 16 | 0;
                    const v = c === 'x' ? r : (r & 0x3 | 0x8);
                    return v.toString(16);
                });
            },

            // Cleanup
            destroy() {
                if (this.statusInterval) clearInterval(this.statusInterval);
                if (this.chatInterval) clearInterval(this.chatInterval);
            }
        };
    }
</script>
