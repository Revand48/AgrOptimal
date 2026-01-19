@extends('layouts.hal_admin')
@section('title', 'Tambah Kecamatan')

@section('content')
    <div class="p-4 sm:p-6 space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-green-700">Tambah Kecamatan</h1>
                <p class="text-sm text-gray-500 mt-1">Tambahkan data kecamatan baru untuk distribusi pupuk.</p>
            </div>

            <a href="/dashboard/data_pupuk/wilayah"
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
        <div class="bg-white rounded-2xl shadow-sm border border-green-100/80 overflow-hidden max-w-xl relative">
            {{-- Decorative bg --}}
            <div class="absolute top-0 right-0 w-24 h-24 bg-green-50 rounded-bl-full -mr-4 -mt-4 opacity-50 pointer-events-none"></div>

            <div class="h-1.5 bg-gradient-to-r from-green-500 via-green-400 to-green-600"></div>

            <form action="/dashboard/data_pupuk/wilayah/kecamatan" method="POST" class="p-6 space-y-6 relative z-10">
                @csrf

                {{-- Nama Kecamatan --}}
                <div>
                    <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                        Nama Kecamatan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" required value="{{ old('nama') }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300"
                        placeholder="Contoh: Kecamatan Sukamaju">
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="/dashboard/data_pupuk/wilayah"
                        class="px-5 py-2.5 rounded-xl border border-gray-200 font-semibold text-gray-600 hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition-all shadow-md hover:shadow-lg hover:shadow-green-600/20 active:scale-95 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan Kecamatan
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
