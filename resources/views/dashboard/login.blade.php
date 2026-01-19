<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Dashboard | Agroptimal</title> @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* Grid blueprint minimalis untuk latar belakang */
        .bg-engineering-grid {
            background-image: radial-gradient(#e2e8f0 1px, transparent 1px);
            background-size: 32px 32px;
        }
    </style>
</head>

<!-- Body dengan inisialisasi Alpine.js untuk efek mouse -->

<body class="bg-slate-50 font-sans text-slate-900 overflow-hidden" x-data="{
    mouseX: 0,
    mouseY: 0
}"
    @mousemove="mouseX = $event.clientX; mouseY = $event.clientY">

    <!-- Efek Cahaya Mengikuti Mouse -->
    <div class="fixed inset-0 pointer-events-none z-0 opacity-60"
        :style="`background: radial-gradient(400px circle at ${mouseX}px ${mouseY}px, rgba(34, 197, 94, 0.1), transparent 80%)`">
    </div>

    <!-- Latar Belakang Grid -->
    <div class="fixed inset-0 bg-engineering-grid z-0"></div>

    <!-- Container Utama (Tengah Layar) -->
    <div class="relative z-10 min-h-screen flex items-center justify-center p-6">
        <div class="w-full max-w-[400px]">
            <!-- Kartu Login (Glassmorphism) -->
            <div
                class="bg-white/80 backdrop-blur-md border border-slate-200 rounded-3xl shadow-xl shadow-slate-200/50 p-8 relative overflow-hidden">

                <!-- Dekorasi Sudut Kanan Atas -->
                <div
                    class="absolute top-0 right-0 w-16 h-16 bg-yellow-400/10 rounded-bl-full border-t border-r border-yellow-400/30">
                </div>
                <!-- Bagian Logo & Judul -->
                <div class="flex flex-col items-center mb-10">
                    <img src="{{ asset('img/core/logo.webp') }}" alt="Logo Agroptimal"
                        class="h-20 mb-4 object-contain drop-shadow-sm hover:scale-105 transition-transform duration-300">
                    <p class="text-lg text-slate-500 font-medium mt-2">Login Dashboard</p>
                </div>

                <!-- Notifikasi / Alert -->
                @if (session('success'))
                    <div
                        class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-700 text-sm flex items-center gap-3 animate-fade-in-down">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div
                        class="mb-6 p-4 rounded-xl bg-red-50 border border-red-200 text-red-700 text-sm flex items-start gap-3 animate-fade-in-down">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0 mt-0.5" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Form Login -->
                <form action="{{ route('admin.login.store') }}" method="POST" class="space-y-5">
                    @csrf
                    <!-- Input Username -->
                    <div class="relative group">
                        <label
                            class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1 mb-1.5 block">Username</label>
                        <input type="text" name="username" placeholder="Admin ID" value="{{ old('username') }}"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300 text-sm placeholder:text-slate-300">
                        <div
                            class="absolute bottom-0 left-1/2 w-0 h-[2px] bg-green-500 transition-all duration-300 group-focus-within:w-full group-focus-within:left-0">
                        </div>
                    </div>
                    <!-- Input Password dengan Toggle Visibility -->
                    <div class="relative group" x-data="{ show: false }">
                        <label
                            class="text-[11px] font-bold text-slate-500 uppercase tracking-widest ml-1 mb-1.5 block">Password</label>
                        <div class="relative">
                            <!-- Input Field (Tipe berubah berdasarkan state 'show') -->
                            <input type="password" :type="show ? 'text' : 'password'" name="password"
                                placeholder="••••••••"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300 text-sm placeholder:text-slate-300 pr-12">
                            <!-- Tombol Mata (Show/Hide Password) -->
                            <button type="button" @click="show = !show"
                                class="absolute right-3 top-1/2 -translate-y-1/2 text-slate-400 hover:text-green-600 transition-colors p-1">
                                <!-- Icon Mata Tertutup (Password Tersembunyi) -->
                                <svg x-show="!show" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <!-- Icon Mata Terbuka (Password Terlihat) -->
                                <svg x-show="show" style="display: none;" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <!-- Tombol Login -->
                    <button type="submit"
                        class="w-full py-4 bg-green-700 text-white text-base font-bold rounded-xl shadow-lg shadow-green-700/30 hover:bg-green-800 hover:shadow-green-900/40 transition-all duration-300 transform active:scale-[0.98] group flex items-center justify-center gap-2">
                        <span>Login</span>
                        <svg class="w-4 h-4 text-yellow-400 group-hover:translate-x-1 transition-transform"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </button>
                </form>
                <!-- Footer Copyright -->
                <p class="mt-6 text-center text-[11px] text-slate-400 font-medium tracking-wide">
                    &copy; 2026 PT. AgrOptimal tbk. All rights reserved.
                </p>
            </div>
        </div>
    </div>
</body>

</html>
