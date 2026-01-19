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
                <h1 class="text-2xl font-bold text-green-700">Edit Berita</h1>
                <p class="text-sm text-gray-500 mt-1">Perbarui informasi berita yang sudah ada.</p>
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

            <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data"
                class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    {{-- Judul --}}
                    <div>
                        <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                            Judul Berita <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="judul" value="{{ old('judul', $berita->judul) }}" required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300"
                            placeholder="Masukkan judul berita...">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Kategori --}}
                        <div>
                            <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                                Kategori <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select name="kategori"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300 appearance-none cursor-pointer">
                                    @foreach (['Teknologi', 'Pupuk', 'Hama', 'Pasar'] as $kat)
                                        <option value="{{ $kat }}"
                                            {{ $berita->kategori == $kat ? 'selected' : '' }}>
                                            {{ $kat }}
                                        </option>
                                    @endforeach
                                </select>
                                <svg class="w-5 h-5 text-gray-500 absolute right-4 top-3.5 pointer-events-none"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </div>
                        </div>

                        {{-- Status --}}
                        <div>
                            <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                                Status Publikasi
                            </label>
                            <div class="relative">
                                <select name="status"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300 appearance-none cursor-pointer">
                                    <option value="draft" {{ $berita->status == 'draft' ? 'selected' : '' }}>Draft (Simpan
                                        Sementara)</option>
                                    <option value="publish" {{ $berita->status == 'publish' ? 'selected' : '' }}>Publish
                                        (Tampilkan)</option>
                                </select>
                                <svg class="w-5 h-5 text-gray-500 absolute right-4 top-3.5 pointer-events-none"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7">
                                    </path>
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- Gambar --}}
                    <div x-data="{ fileName: '' }">
                        <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                            Gambar Utama
                        </label>

                        @if ($berita->foto)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $berita->foto) }}"
                                    class="h-32 rounded-lg object-cover border border-gray-200 shadow-sm"
                                    alt="Current Image">
                                <p class="text-xs text-gray-400 mt-1">Gambar saat ini</p>
                            </div>
                        @endif

                        <div class="flex items-center gap-4">
                            <label class="flex-1 cursor-pointer">
                                <div
                                    class="flex items-center justify-center w-full px-4 py-3 bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl hover:border-green-500 hover:bg-green-50/30 transition-all group">
                                    <div class="space-y-1 text-center">
                                        <div
                                            class="flex items-center justify-center gap-2 text-gray-500 group-hover:text-green-600">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <span class="text-sm font-medium"
                                                x-text="fileName || 'Ganti Gambar (Opsional)'"></span>
                                        </div>
                                        <p class="text-xs text-gray-400" x-show="!fileName">
                                            Biarkan kosong jika tidak ingin mengubah gambar
                                        </p>
                                    </div>
                                    <input type="file" name="foto" class="hidden"
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
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all min-h-[300px] prose max-w-none prose-sm sm:prose-base focus:shadow-inner"
                            @input="$refs.konten.value = $el.innerHTML">
                            {!! $berita->konten !!}
                        </div>
                        <input type="hidden" name="konten" x-ref="konten" value="{{ $berita->konten }}">
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.berita.index') }}"
                        class="px-5 py-2.5 rounded-xl border border-gray-200 font-semibold text-gray-600 hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition-all shadow-md hover:shadow-lg active:scale-95 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15">
                            </path>
                        </svg>
                        Update Berita
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
