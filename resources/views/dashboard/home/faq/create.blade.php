@extends('layouts.hal_admin')

@section('content')
    <div class="p-4 sm:p-6 space-y-6" x-data="{
        notification: { show: false, message: '', type: 'success' },
        showNotification(message, type = 'success') {
            this.notification.message = message;
            this.notification.type = type;
            this.notification.show = true;
            setTimeout(() => this.notification.show = false, 3000);
        }
    }">

        {{-- TOAST NOTIFICATION --}}
        <div x-show="notification.show" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-4"
            x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform translate-x-4"
            :class="notification.type === 'success' ? 'bg-green-600' : 'bg-red-600'"
            class="fixed top-5 right-5 text-white px-6 py-3 rounded-xl shadow-lg z-[60] flex items-center gap-3" x-cloak>
            <svg x-show="notification.type === 'success'" class="w-5 h-5" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <svg x-show="notification.type === 'error'" class="w-5 h-5" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            <span x-text="notification.message"></span>
        </div>

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-green-700">Tambah FAQ Baru</h1>
                <p class="text-sm text-gray-500 mt-1">Buat pertanyaan dan jawaban baru untuk halaman utama.</p>
            </div>

            <a href="{{ route('admin.faq.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 text-gray-600 font-medium rounded-xl border border-gray-200 hover:bg-gray-50 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                <span>Kembali</span>
            </a>
        </div>

        {{-- ALERT ERROR --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                <ul class="list-disc ml-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM CARD --}}
        <div class="bg-white rounded-2xl shadow-sm border border-green-100/80 overflow-hidden max-w-2xl">
            <div class="h-1.5 bg-gradient-to-r from-green-500 via-yellow-400 to-green-600"></div>

            <form method="POST" action="{{ route('admin.faq.store') }}" class="p-6 space-y-5">
                @csrf

                <div>
                    <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                        Pertanyaan <span class="text-red-500">*</span>
                    </label>
                    <textarea name="question" rows="3" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300 resize-none"
                        placeholder="Contoh: Bagaimana cara memesan pupuk organik?">{{ old('question') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                        Jawaban <span class="text-red-500">*</span>
                    </label>
                    <textarea name="answer" rows="6" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300 resize-none"
                        placeholder="Tulis jawaban lengkap untuk pertanyaan di atas...">{{ old('answer') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                        Urutan Tampil
                    </label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300"
                        placeholder="0">
                    <p class="text-xs text-gray-400 mt-1">Semakin kecil angka, semakin atas posisinya.</p>
                </div>

                <div class="flex flex-wrap gap-6 pt-2">
                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', true) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer-checked:bg-green-500 transition-colors">
                            </div>
                            <div
                                class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow-sm peer-checked:translate-x-5 transition-transform">
                            </div>
                        </div>
                        <span
                            class="text-sm font-medium text-gray-700 group-hover:text-green-700 transition-colors">Aktif</span>
                    </label>

                    <label class="flex items-center gap-3 cursor-pointer group">
                        <div class="relative">
                            <input type="checkbox" name="is_verified" value="1"
                                {{ old('is_verified', true) ? 'checked' : '' }} class="sr-only peer">
                            <div class="w-11 h-6 bg-gray-200 rounded-full peer-checked:bg-yellow-400 transition-colors">
                            </div>
                            <div
                                class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow-sm peer-checked:translate-x-5 transition-transform">
                            </div>
                        </div>
                        <span
                            class="text-sm font-medium text-gray-700 group-hover:text-yellow-600 transition-colors">Terverifikasi</span>
                    </label>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.faq.index') }}"
                        class="px-5 py-2.5 rounded-xl border border-gray-200 font-semibold text-gray-600 hover:bg-gray-50 transition-colors">
                        Batal
                    </a>

                    <button type="submit"
                        class="px-6 py-2.5 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition-all shadow-md hover:shadow-lg hover:shadow-green-600/20 active:scale-95 inline-flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan FAQ
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
@endsection
