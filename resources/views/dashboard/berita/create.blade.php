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

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-green-700">Tambah Berita Baru</h1>
                <p class="text-sm text-gray-500 mt-1">Buat artikel atau pengumuman baru untuk dipublikasikan.</p>
            </div>

            <a href="{{ route('admin.berita.index') }}"
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
        <div class="bg-white rounded-2xl shadow-sm border border-green-100/80 overflow-hidden max-w-4xl">
            <div class="h-1.5 bg-gradient-to-r from-green-500 via-yellow-400 to-green-600"></div>

            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data"
                class="p-6 space-y-6">
                @csrf

                <div class="space-y-6">
                    {{-- Judul --}}
                    <div>
                        <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                            Judul Berita <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="judul" required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300"
                            placeholder="Masukkan judul berita yang menarik...">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Kategori --}}
                        <div>
                            <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <input type="hidden" name="kategori" id="kategoriInput">

                            <div x-data="{
                                open: false,
                                selected: '',
                                options: [
                                    { value: 'Teknologi', label: 'Teknologi' },
                                    { value: 'Pupuk', label: 'Pupuk' },
                                    { value: 'Hama', label: 'Hama' },
                                    { value: 'Pasar', label: 'Pasar' }
                                ],
                                select(value) {
                                    this.selected = value;
                                    this.open = false;
                                    document.getElementById('kategoriInput').value = value;
                                },
                                getLabel() {
                                    const option = this.options.find(o => o.value === this.selected);
                                    return option ? option.label : 'Pilih Kategori';
                                }
                            }" class="relative">
                                <button type="button" @click="open = !open" @click.outside="open = false"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-left flex items-center justify-between focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300">
                                    <span x-text="getLabel()" :class="selected ? 'text-gray-900' : 'text-gray-500'"></span>
                                    <svg class="w-5 h-5 text-gray-400 transition-transform duration-200"
                                        :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 translate-y-2"
                                    class="absolute left-0 mt-2 w-full bg-white rounded-xl shadow-xl border border-gray-100 z-50 overflow-hidden"
                                    x-cloak>
                                    <ul class="py-1">
                                        <template x-for="option in options" :key="option.value">
                                            <li>
                                                <button type="button" @click="select(option.value)"
                                                    class="w-full px-4 py-2.5 text-sm text-left hover:bg-green-50 transition-colors flex items-center justify-between group"
                                                    :class="selected === option.value ?
                                                        'bg-green-50 text-green-700 font-semibold' : 'text-gray-600'">
                                                    <span x-text="option.label"></span>
                                                    <svg x-show="selected === option.value" class="w-4 h-4 text-green-600"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </button>
                                            </li>
                                        </template>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                                Status Publikasi
                            </label>
                            <input type="hidden" name="status" id="statusInput" value="draft">

                            <div x-data="{
                                open: false,
                                selected: 'draft',
                                options: [
                                    { value: 'draft', label: 'Draft (Simpan Sementara)' },
                                    { value: 'publish', label: 'Publish (Tampilkan)' }
                                ],
                                select(value) {
                                    this.selected = value;
                                    this.open = false;
                                    document.getElementById('statusInput').value = value;
                                },
                                getLabel() {
                                    const option = this.options.find(o => o.value === this.selected);
                                    return option ? option.label : 'Pilih Status';
                                }
                            }" class="relative">
                                <button type="button" @click="open = !open" @click.outside="open = false"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-left flex items-center justify-between focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300">
                                    <span x-text="getLabel()" :class="selected ? 'text-gray-900' : 'text-gray-500'"></span>
                                    <svg class="w-5 h-5 text-gray-400 transition-transform duration-200"
                                        :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>

                                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 translate-y-2"
                                    x-transition:enter-end="opacity-100 translate-y-0"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 translate-y-0"
                                    x-transition:leave-end="opacity-0 translate-y-2"
                                    class="absolute left-0 mt-2 w-full bg-white rounded-xl shadow-xl border border-gray-100 z-50 overflow-hidden"
                                    x-cloak>
                                    <ul class="py-1">
                                        <template x-for="option in options" :key="option.value">
                                            <li>
                                                <button type="button" @click="select(option.value)"
                                                    class="w-full px-4 py-2.5 text-sm text-left hover:bg-green-50 transition-colors flex items-center justify-between group"
                                                    :class="selected === option.value ?
                                                        'bg-green-50 text-green-700 font-semibold' : 'text-gray-600'">
                                                    <span x-text="option.label"></span>
                                                    <svg x-show="selected === option.value" class="w-4 h-4 text-green-600"
                                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                    </svg>
                                                </button>
                                            </li>
                                        </template>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Gambar --}}
                    <div x-data="{ fileName: '' }">
                        <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                            Gambar Utama <span class="text-red-500">*</span>
                        </label>
                        <div class="flex items-center gap-4">
                            <label class="flex-1 cursor-pointer">
                                <div
                                    class="flex items-center justify-center w-full px-4 py-3 bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl hover:border-green-500 hover:bg-green-50/30 transition-all group">
                                    <div class="space-y-1 text-center">
                                        <div
                                            class="flex items-center justify-center gap-2 text-gray-500 group-hover:text-green-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <span class="text-sm font-medium" x-text="fileName || 'Upload Gambar'"></span>
                                        </div>
                                        <p class="text-xs text-gray-400" x-show="!fileName">PNG, JPG, JPEG max 2MB
                                        </p>
                                    </div>
                                    <input type="file" name="foto" required class="hidden"
                                        @change="fileName = $event.target.files[0].name">
                                </div>
                            </label>
                        </div>
                    </div>

                    {{-- Konten --}}
                    <div x-data class="mb-4">
                        <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                            Konten Berita
                        </label>
                        <div contenteditable
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300 min-h-[300px] prose max-w-none prose-sm sm:prose-base focus:shadow-inner"
                            @input="$refs.konten.value = $el.innerHTML" placeholder="Tulis konten berita disini...">
                        </div>
                        <input type="hidden" name="konten" x-ref="konten">
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.berita.index') }}"
                        class="px-5 py-2.5 rounded-xl border border-gray-200 font-semibold text-gray-600 hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition-all shadow-md hover:shadow-lg hover:shadow-green-600/20 active:scale-95 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan Berita
                    </button>
                </div>
            </form>
        </div>
        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
    </div>
@endsection
