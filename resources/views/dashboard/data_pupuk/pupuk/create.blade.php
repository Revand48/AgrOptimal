@extends('layouts.hal_admin')
@section('title', 'Tambah Pupuk')

@section('content')
    <div class="p-4 sm:p-6 space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-green-700">Tambah Pupuk</h1>
                <p class="text-sm text-gray-500 mt-1">Tambahkan data pupuk baru untuk distribusi.</p>
            </div>

            <a href="/dashboard/data_pupuk/pupuk"
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
            <div
                class="absolute top-0 right-0 w-24 h-24 bg-green-50 rounded-bl-full -mr-4 -mt-4 opacity-50 pointer-events-none">
            </div>

            <div class="h-1.5 bg-gradient-to-r from-green-500 via-green-400 to-green-600"></div>

            <form action="/dashboard/data_pupuk/pupuk" method="POST" class="p-6 space-y-6 relative z-10">
                @csrf

                {{-- Nama Pupuk --}}
                <div>
                    <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                        Nama Pupuk <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" required value="{{ old('nama') }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300"
                        placeholder="Contoh: Urea">
                </div>

                {{-- Kategori --}}
                <div x-data="{ open: false, selected: '{{ old('kategori', '') }}' }">
                    <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <input type="hidden" name="kategori" :value="selected" required>
                    <div class="relative">
                        <button type="button" @click="open = !open"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300 text-left flex items-center justify-between">
                            <span :class="selected ? 'text-gray-800' : 'text-gray-400'"
                                x-text="selected || '-- Pilih Kategori --'"></span>
                            <svg class="w-5 h-5 text-gray-400 transition-transform" :class="{ 'rotate-180': open }"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>
                        <div x-show="open" @click.outside="open = false"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-2"
                            class="absolute z-20 mt-2 w-full bg-white border border-gray-200 rounded-xl shadow-lg overflow-hidden"
                            x-cloak>
                            <div @click="selected = 'Subsidi'; open = false"
                                class="px-4 py-3 hover:bg-green-50 cursor-pointer transition-colors"
                                :class="{ 'bg-green-50 text-green-700 font-medium': selected === 'Subsidi' }">
                                Subsidi
                            </div>
                            <div @click="selected = 'Non Subsidi'; open = false"
                                class="px-4 py-3 hover:bg-green-50 cursor-pointer transition-colors"
                                :class="{ 'bg-green-50 text-green-700 font-medium': selected === 'Non Subsidi' }">
                                Non Subsidi
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Kg per sak --}}
                <div>
                    <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                        Berat per Sak (kg) <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="kg_per_sak" required value="{{ old('kg_per_sak') }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300"
                        placeholder="Contoh: 50">
                </div>

                {{-- Jumlah sak --}}
                <div>
                    <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                        Jumlah Sak <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="jumlah_sak" required value="{{ old('jumlah_sak') }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300"
                        placeholder="Contoh: 120">
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="/dashboard/data_pupuk/pupuk"
                        class="px-5 py-2.5 rounded-xl border border-gray-200 font-semibold text-gray-600 hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition-all shadow-md hover:shadow-lg hover:shadow-green-600/20 active:scale-95 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Simpan Pupuk
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
