@extends('layouts.hal_admin')

@section('content')
    <div class="p-4 sm:p-6 space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-green-700">Edit Komoditas</h1>
                <p class="text-sm text-gray-500 mt-1">Perbarui data tanaman {{ $komoditas->nama }}.</p>
            </div>

            <a href="{{ route('admin.komoditas.index') }}"
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

            <form action="{{ route('admin.komoditas.update', $komoditas->id) }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                <div class="space-y-6">
                    {{-- Nama --}}
                    <div>
                        <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                            Nama Tanaman <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" required value="{{ old('nama', $komoditas->nama) }}"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 outline-none"
                            placeholder="Contoh: Padi IR64">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Duration --}}
                        <div>
                            <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                                Masa Panen (Hari) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="duration_days" required min="1"
                                value="{{ old('duration_days', $komoditas->duration_days) }}"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 outline-none"
                                placeholder="90">
                        </div>
                        {{-- Yield --}}
                        <div>
                            <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                                Est. Hasil (Ton/Ha) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" step="0.1" name="yield_per_ha" required min="0"
                                value="{{ old('yield_per_ha', $komoditas->yield_per_ha) }}"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 outline-none"
                                placeholder="6.5">
                        </div>
                        {{-- Price --}}
                        <div>
                            <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                                Est. Harga (Rp/Kg) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="price_per_kg" required min="0"
                                value="{{ old('price_per_kg', $komoditas->price_per_kg) }}"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 outline-none"
                                placeholder="5000">
                        </div>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                            Deskripsi Singkat <span class="text-red-500">*</span>
                        </label>
                        <textarea name="description" required rows="3"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 outline-none"
                            placeholder="Penjelasan singkat tentang tanaman ini...">{{ old('description', $komoditas->description) }}</textarea>
                    </div>

                    {{-- Risks --}}
                    <div>
                        <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                            Daftar Risiko / Hama (Pisahkan dengan koma)
                        </label>
                        <textarea name="risks" rows="2"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 outline-none"
                            placeholder="Wereng, Tikus, Burung, Kekeringan...">{{ old('risks', is_array($komoditas->risks) ? implode(', ', $komoditas->risks) : $komoditas->risks) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Contoh: Wereng, Tikus, Burung</p>
                    </div>

                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.komoditas.index') }}"
                        class="px-5 py-2.5 rounded-xl border border-gray-200 font-semibold text-gray-600 hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition-all shadow-md hover:shadow-lg active:scale-95 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
