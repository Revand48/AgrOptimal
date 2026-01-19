@extends('layouts.hal_admin')

@section('title', 'Tambah Langkah Cek Tanah')

@section('content')
    <div class="p-4 sm:p-6 space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-green-700">Tambah Langkah Cek Tanah</h1>
                <p class="text-sm text-gray-500 mt-1">Tambahkan langkah baru untuk panduan cek tanah tradisional.</p>
            </div>

            <a href="{{ route('admin.edukasi.cek_tanah.index') }}"
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
        <div class="bg-white rounded-2xl shadow-sm border border-green-100/80 overflow-hidden max-w-4xl relative">
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-green-50 rounded-bl-full -mr-6 -mt-6 opacity-50 pointer-events-none">
            </div>

            <div class="h-1.5 bg-gradient-to-r from-green-500 via-green-400 to-green-600"></div>

            <form action="{{ route('admin.edukasi.cek_tanah.store') }}" method="POST" enctype="multipart/form-data"
                class="p-6 space-y-6 relative z-10">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                            Nomor Urutan <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="step_number" required value="{{ old('step_number') }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                        Judul Langkah <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" required value="{{ old('title') }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300"
                        placeholder="Contoh: Amati Warna Tanah">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                        Konten Penjelasan <span class="text-red-500">*</span>
                    </label>
                    <textarea name="content" rows="5" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300"
                        placeholder="Jelaskan langkah cek tanah secara detail...">{{ old('content') }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                        Gambar Ilustrasi (Opsional)
                    </label>
                    <input type="file" name="image" accept="image/*"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-green-100 file:text-green-700 hover:file:bg-green-200 transition-all">
                    <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, GIF. Maksimal 2MB.</p>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.edukasi.cek_tanah.index') }}"
                        class="px-5 py-2.5 rounded-xl border border-gray-200 font-semibold text-gray-600 hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition-all shadow-md hover:shadow-lg hover:shadow-green-600/20 active:scale-95 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan Langkah
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
