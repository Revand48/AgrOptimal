@extends('layouts.hal_admin')
@section('title', 'Tambah Publikasi')

@section('content')
    <div class="p-4 sm:p-6 space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-green-700">Tambah Publikasi</h1>
                <p class="text-sm text-gray-500 mt-1">Publikasikan alokasi pupuk untuk diketahui masyarakat.</p>
            </div>

            <a href="/dashboard/data_pupuk/publikasi"
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
        <div class="bg-white rounded-2xl shadow-sm border border-green-100/80 overflow-hidden max-w-2xl relative">
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-green-50 rounded-bl-full -mr-6 -mt-6 opacity-50 pointer-events-none">
            </div>

            <div class="h-1.5 bg-gradient-to-r from-green-500 via-green-400 to-green-600"></div>

            <form action="/dashboard/data_pupuk/publikasi" method="POST" class="p-6 space-y-6 relative z-10">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Kecamatan --}}
                    <div>
                        <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                            Kecamatan <span class="text-red-500">*</span>
                        </label>
                        <select name="kecamatan_id" required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300">
                            <option value="">-- Pilih Kecamatan --</option>
                            @foreach ($kecamatans as $kec)
                                <option value="{{ $kec->id }}">{{ $kec->nama }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Desa --}}
                    <div>
                        <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                            Desa <span class="text-red-500">*</span>
                        </label>
                        <select name="desa_id" required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300">
                            <option value="">-- Pilih Desa --</option>
                            @foreach ($desas as $desa)
                                <option value="{{ $desa->id }}">{{ $desa->nama }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                {{-- Pupuk --}}
                <div>
                    <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                        Jenis Pupuk <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <select name="pupuk_id" required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300 appearance-none">
                            <option value="">-- Pilih Jenis Pupuk --</option>
                            @foreach ($pupuks as $pupuk)
                                <option value="{{ $pupuk->id }}">
                                    {{ $pupuk->nama }} ({{ $pupuk->kg_per_sak }} kg/sak)
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Jumlah sak --}}
                    <div>
                        <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                            Jumlah Sak <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="jumlah_sak" required placeholder="0" min="1"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300">
                    </div>

                    {{-- Status --}}
                    <div>
                        <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                            Status Publikasi
                        </label>
                        <div class="relative">
                            <select name="is_publish"
                                class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300 appearance-none">
                                <option value="1">Publish</option>
                                <option value="0">Draft</option>
                            </select>
                            <div
                                class="absolute inset-y-0 right-0 flex items-center px-4 pointer-events-none text-gray-500">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="/dashboard/data_pupuk/publikasi"
                        class="px-5 py-2.5 rounded-xl border border-gray-200 font-semibold text-gray-600 hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition-all shadow-md hover:shadow-lg hover:shadow-green-600/20 active:scale-95 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan Publikasi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
