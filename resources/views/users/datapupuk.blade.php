@extends('layouts.app')
@section('title', 'Monitoring Stok Pupuk Desa')

@section('content')

    <div x-data="pupukDashboard()" class="max-w-7xl mx-auto px-4 py-8 space-y-8 font-sans text-slate-800">
        {{-- Header Section --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl md:text-3xl font-bold text-slate-900 tracking-tight">Monitoring Stok Pupuk</h1>
                <p class="text-slate-500 mt-1">Pantau ketersediaan pupuk bersubsidi dan non-subsidi di wilayah Anda.</p>
            </div>
            <div
                class="flex items-center gap-2 text-sm text-slate-500 bg-white px-4 py-2 rounded-full shadow-sm border border-slate-200">
                <img src="{{ asset('img/data_pupuk/jam.webp') }}" class="h-4 w-4" alt="Update Icon">
              
            </div>
        </div>

        {{-- ===================================================== --}}
        {{-- SECTION 1 : FILTER WILAYAH & DATA --}}
        {{-- ===================================================== --}}
        <section class="bg-white border border-slate-200 rounded-3xl shadow-lg shadow-slate-200/50 p-6 md:p-8 relative">
            <!-- Decorative background element -->
            <div class="absolute inset-0 overflow-hidden rounded-3xl pointer-events-none">
                <div class="absolute top-0 right-0 w-32 h-32 bg-green-500/5 rounded-bl-full -mr-10 -mt-10"></div>
            </div>

            <div class="relative">
                <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <img src="{{ asset('img/data_pupuk/search.webp') }}" class="h-6 w-6" alt="Filter Icon">
                    Filter Wilayah & Data
                </h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    {{-- Kecamatan --}}
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Kecamatan</label>
                        <div class="relative">
                            <button @click="openKecamatan = !openKecamatan; openDesa = openJenis = openKategori = false"
                                @click.outside="openKecamatan = false" type="button"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm flex items-center justify-between gap-2 transition-all hover:border-green-300 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-500 group">
                                <span x-text="selectedKecamatan" class="text-slate-700 font-medium truncate"></span>
                                <svg class="w-4 h-4 text-slate-400 transition-transform duration-200 group-hover:text-green-500"
                                    :class="openKecamatan ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="openKecamatan" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-2"
                                class="absolute left-0 mt-2 w-full bg-white rounded-xl shadow-xl border border-slate-100 z-50 overflow-hidden"
                                x-cloak>
                                <ul class="py-1 max-h-60 overflow-y-auto">
                                    <template x-for="kec in kecamatan" :key="kec">
                                        <li>
                                            <button type="button" @click="selectedKecamatan = kec; openKecamatan = false"
                                                class="w-full px-4 py-2.5 text-sm text-left hover:bg-green-50 transition-colors flex items-center justify-between group"
                                                :class="selectedKecamatan === kec ? 'bg-green-50 text-green-700 font-semibold' :
                                                    'text-slate-600'">
                                                <span x-text="kec"></span>
                                                <svg x-show="selectedKecamatan === kec" class="w-4 h-4 text-green-600"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </button>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Desa --}}
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Desa</label>
                        <div class="relative">
                            <button @click="openDesa = !openDesa; openKecamatan = openJenis = openKategori = false"
                                @click.outside="openDesa = false" type="button"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm flex items-center justify-between gap-2 transition-all hover:border-green-300 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-500 group">
                                <span x-text="selectedDesa" class="text-slate-700 font-medium truncate"></span>
                                <svg class="w-4 h-4 text-slate-400 transition-transform duration-200 group-hover:text-green-500"
                                    :class="openDesa ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="openDesa" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-2"
                                class="absolute left-0 mt-2 w-full bg-white rounded-xl shadow-xl border border-slate-100 z-50 overflow-hidden"
                                x-cloak>
                                <ul class="py-1 max-h-60 overflow-y-auto">
                                    <template x-for="desa in desaByKecamatan[selectedKecamatan]" :key="desa">
                                        <li>
                                            <button type="button" @click="selectedDesa = desa; openDesa = false"
                                                class="w-full px-4 py-2.5 text-sm text-left hover:bg-green-50 transition-colors flex items-center justify-between group"
                                                :class="selectedDesa === desa ? 'bg-green-50 text-green-700 font-semibold' :
                                                    'text-slate-600'">
                                                <span x-text="desa"></span>
                                                <svg x-show="selectedDesa === desa" class="w-4 h-4 text-green-600"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </button>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Jenis Pupuk --}}
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Jenis Pupuk</label>
                        <div class="relative">
                            <button @click="openJenis = !openJenis; openKecamatan = openDesa = openKategori = false"
                                @click.outside="openJenis = false" type="button"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm flex items-center justify-between gap-2 transition-all hover:border-green-300 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-500 group">
                                <span x-text="filterJenis || 'Semua Jenis'"
                                    class="text-slate-700 font-medium truncate"></span>
                                <svg class="w-4 h-4 text-slate-400 transition-transform duration-200 group-hover:text-green-500"
                                    :class="openJenis ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="openJenis" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-2"
                                class="absolute left-0 mt-2 w-full bg-white rounded-xl shadow-xl border border-slate-100 z-50 overflow-hidden"
                                x-cloak>
                                <ul class="py-1 max-h-60 overflow-y-auto">
                                    <li>
                                        <button type="button" @click="filterJenis = ''; openJenis = false"
                                            class="w-full px-4 py-2.5 text-sm text-left hover:bg-green-50 transition-colors flex items-center justify-between group"
                                            :class="filterJenis === '' ? 'bg-green-50 text-green-700 font-semibold' :
                                                'text-slate-600'">
                                            <span>Semua Jenis</span>
                                            <svg x-show="filterJenis === ''" class="w-4 h-4 text-green-600"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </button>
                                    </li>
                                    <template x-for="j in jenisPupuk" :key="j">
                                        <li>
                                            <button type="button" @click="filterJenis = j; openJenis = false"
                                                class="w-full px-4 py-2.5 text-sm text-left hover:bg-green-50 transition-colors flex items-center justify-between group"
                                                :class="filterJenis === j ? 'bg-green-50 text-green-700 font-semibold' :
                                                    'text-slate-600'">
                                                <span x-text="j"></span>
                                                <svg x-show="filterJenis === j" class="w-4 h-4 text-green-600"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </button>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                    </div>

                    {{-- Kategori --}}
                    <div class="space-y-1.5">
                        <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Kategori</label>
                        <div class="relative">
                            <button @click="openKategori = !openKategori; openKecamatan = openDesa = openJenis = false"
                                @click.outside="openKategori = false" type="button"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm flex items-center justify-between gap-2 transition-all hover:border-green-300 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-500 group">
                                <span x-text="filterKategori || 'Semua Kategori'"
                                    class="text-slate-700 font-medium truncate"></span>
                                <svg class="w-4 h-4 text-slate-400 transition-transform duration-200 group-hover:text-green-500"
                                    :class="openKategori ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="openKategori" x-transition:enter="transition ease-out duration-200"
                                x-transition:enter-start="opacity-0 translate-y-2"
                                x-transition:enter-end="opacity-100 translate-y-0"
                                x-transition:leave="transition ease-in duration-150"
                                x-transition:leave-start="opacity-100 translate-y-0"
                                x-transition:leave-end="opacity-0 translate-y-2"
                                class="absolute left-0 mt-2 w-full bg-white rounded-xl shadow-xl border border-slate-100 z-50 overflow-hidden"
                                x-cloak>
                                <ul class="py-1">
                                    <li>
                                        <button type="button" @click="filterKategori = ''; openKategori = false"
                                            class="w-full px-4 py-2.5 text-sm text-left hover:bg-green-50 transition-colors flex items-center justify-between group"
                                            :class="filterKategori === '' ?
                                                'bg-green-50 text-green-700 font-semibold' : 'text-slate-600'">
                                            <span>Semua Kategori</span>
                                            <svg x-show="filterKategori === ''" class="w-4 h-4 text-green-600"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" @click="filterKategori = 'Subsidi'; openKategori = false"
                                            class="w-full px-4 py-2.5 text-sm text-left hover:bg-green-50 transition-colors flex items-center justify-between group"
                                            :class="filterKategori === 'Subsidi' ?
                                                'bg-green-50 text-green-700 font-semibold' : 'text-slate-600'">
                                            <span>Subsidi</span>
                                            <svg x-show="filterKategori === 'Subsidi'" class="w-4 h-4 text-green-600"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button"
                                            @click="filterKategori = 'Non Subsidi'; openKategori = false"
                                            class="w-full px-4 py-2.5 text-sm text-left hover:bg-green-50 transition-colors flex items-center justify-between group"
                                            :class="filterKategori === 'Non Subsidi' ?
                                                'bg-green-50 text-green-700 font-semibold' : 'text-slate-600'">
                                            <span>Non Subsidi</span>
                                            <svg x-show="filterKategori === 'Non Subsidi'" class="w-4 h-4 text-green-600"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- ===================================================== --}}
        {{-- SECTION 2 : RANGKUMAN DESA --}}
        {{-- ===================================================== --}}
        <section class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Card 1 -->
            <div
                class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300 flex items-center justify-between group">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Total Stok Pupuk</p>
                    <p class="text-3xl font-extrabold text-slate-800 group-hover:text-green-600 transition-colors"
                        x-text="totalKg.toLocaleString('id-ID')"></p>
                    <span class="text-xs font-semibold text-slate-400">Kilogram (kg)</span>
                </div>
                <div
                    class="w-12 h-12 bg-green-50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <img src="{{ asset('img/data_pupuk/pupuk.webp') }}" class="h-6 w-6" alt="Total Stok">
                </div>
            </div>

            <!-- Card 2 -->
            <div
                class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300 flex items-center justify-between group">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Varian Tersedia</p>
                    <p class="text-3xl font-extrabold text-slate-800 group-hover:text-emerald-600 transition-colors"
                        x-text="jenisAktif.length"></p>
                    <span class="text-xs font-semibold text-slate-400">Jenis Pupuk</span>
                </div>
                <div
                    class="w-12 h-12 bg-emerald-50 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform">
                    <img src="{{ asset('img/data_pupuk/krisis.webp') }}" class="h-6 w-6" alt="Varian Tersedia">
                </div>
            </div>

            <!-- Card 3 -->
            <div
                class="bg-white border border-slate-100 rounded-2xl p-6 shadow-sm hover:shadow-md transition-shadow duration-300 flex items-center justify-between group">
                <div>
                    <p class="text-sm font-medium text-slate-500 mb-1">Status Wilayah</p>
                    <p class="text-3xl font-extrabold" :class="statusWarna" x-text="statusDesa"></p>
                    <span class="text-xs font-semibold text-slate-400">Indikator Ketersediaan</span>
                </div>
                <div class="w-12 h-12 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform"
                    :class="{
                        'bg-green-50': statusDesa === 'Aman',
                        'bg-yellow-50': statusDesa === 'Menipis',
                        'bg-red-50': statusDesa === 'Kritis'
                    }">
                    <img src="{{ asset('img/data_pupuk/lokasi.webp') }}" class="h-6 w-6" alt="Status Wilayah">
                </div>
            </div>
        </section>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            {{-- SECTION 3 : DIAGRAM --}}
            <section class="lg:col-span-1 bg-white border border-slate-200 rounded-3xl shadow-lg shadow-slate-200/50 p-6">
                <h2 class="text-lg font-bold text-slate-800 mb-6">Diagram Stok</h2>
                <div class="space-y-6">
                    <template x-for="item in filteredData">
                        <div class="group">
                            <div class="flex justify-between text-sm mb-2">
                                <span class="font-medium text-slate-700" x-text="item.jenis"></span>
                                <span class="font-bold text-slate-900"
                                    x-text="item.kg.toLocaleString('id-ID') + ' kg'"></span>
                            </div>
                            <div class="w-full bg-slate-100 rounded-full h-3 overflow-hidden">
                                <div class="h-3 rounded-full transition-all duration-1000 ease-out relative"
                                    :class="warnaBar(item)" :style="'width:' + item.persen + '%'">
                                    <div class="absolute inset-0 bg-white/20"></div>
                                </div>
                            </div>
                            <p class="text-xs text-slate-400 mt-1 text-right"
                                x-text="item.persen.toFixed(0) + '% dari kapasitas'"></p>
                        </div>
                    </template>
                    <div x-show="filteredData.length === 0" class="text-center py-8 text-slate-400">
                        <p>Tidak ada data untuk filter ini.</p>
                    </div>
                </div>
            </section>

            {{-- SECTION 4 : TABEL --}}
            <section
                class="lg:col-span-2 bg-white border border-slate-200 rounded-3xl shadow-lg shadow-slate-200/50 overflow-hidden flex flex-col">
                <div class="p-6 border-b border-slate-100">
                    <h2 class="text-lg font-bold text-slate-800">Rincian Data Pupuk</h2>
                </div>
                <div class="overflow-x-auto flex-1">
                    <table class="w-full text-sm text-left">
                        <thead class="bg-slate-50 text-slate-500 font-semibold uppercase tracking-wider text-xs">
                            <tr>
                                <th class="p-4 pl-6">Jenis Pupuk</th>
                                <th class="p-4">Kategori</th>
                                <th class="p-4 text-center">Stok (Sak)</th>
                                <th class="p-4 text-center">Konversi (Kg)</th>
                                <th class="p-4">Lokasi Gudang</th>
                                <th class="p-4 text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
                            <template x-for="item in filteredData">
                                <tr class="hover:bg-slate-50/50 transition-colors">
                                    <td class="p-4 pl-6 font-medium text-slate-800" x-text="item.jenis"></td>
                                    <td class="p-4">
                                        <span class="px-2.5 py-0.5 rounded-md text-xs font-medium border"
                                            :class="item.kategori === 'Subsidi' ?
                                                'bg-green-50 text-green-700 border-green-100' :
                                                'bg-slate-100 text-slate-600 border-slate-200'"
                                            x-text="item.kategori">
                                        </span>
                                    </td>
                                    <td class="p-4 text-center font-mono text-slate-600" x-text="item.sak"></td>
                                    <td class="p-4 text-center text-slate-500">
                                        <div class="flex flex-col items-center">
                                            <span class="font-bold text-slate-700"
                                                x-text="item.kg.toLocaleString('id-ID')"></span>
                                            <span class="text-[10px] text-slate-400"
                                                x-text="'@ ' + item.kg_per_sak + 'kg'"></span>
                                        </div>
                                    </td>
                                    <td class="p-4 text-slate-600 flex items-center gap-2">

                                        <span x-text="item.lokasi"></span>
                                    </td>
                                    <td class="p-4 text-center">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold shadow-sm"
                                            :class="badgeStatus(item)" x-text="item.status"></span>
                                    </td>
                                </tr>
                            </template>
                            <tr x-show="filteredData.length === 0">
                                <td colspan="6" class="p-8 text-center text-slate-400">
                                    Data tidak ditemukan untuk filter yang dipilih.
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>

        {{-- ===================================================== --}}
        {{-- SECTION 5 : INFO VALIDASI DATA --}}
        {{-- ===================================================== --}}
        <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-4 flex items-start gap-3">
            <img src="{{ asset('img/data_pupuk/notif.webp') }}" class="h-5 w-5 mt-0.5 flex-shrink-0" alt="Info">
            <p class="text-sm text-emerald-800 leading-relaxed">
                <strong>Catatan Penting:</strong> Data stok diperbarui secara berkala oleh admin desa/kecamatan.
                Jika status pembaruan lebih dari <strong>7 hari</strong>, mohon verifikasi langsung ke kios atau gudang
                terkait sebelum melakukan pengambilan.
            </p>
        </div>

    </div>

    {{-- ===================================================== --}}
    {{-- ALPINE DATA & LOGIC --}}
    {{-- Semua dummy data & perhitungan ada di sini --}}
    {{-- ===================================================== --}}
    <script>
        function pupukDashboard() {
            return {
                kecamatan: @json($listKecamatan->pluck('nama')),
                desaByKecamatan: @json($listKecamatan->pluck('desas', 'nama')->map(fn($d) => $d->pluck('nama'))),

                selectedKecamatan: @json($listKecamatan->first()?->nama ?? ''),
                selectedDesa: @json($listKecamatan->first()?->desas->first()?->nama ?? ''),
                filterJenis: '',
                filterKategori: '',

                // Dropdown States
                openKecamatan: false,
                openDesa: false,
                openJenis: false,
                openKategori: false,

                lastUpdate: '{{ now()->locale('id')->diffForHumans() }}',

                jenisPupuk: @json($listJenisPupuk),

                init() {
                    // Re-sync desa when kecamatan changes
                    this.$watch('selectedKecamatan', (value) => {
                        const desas = this.desaByKecamatan[value];
                        if (desas && desas.length > 0) {
                            this.selectedDesa = desas[0];
                        } else {
                            this.selectedDesa = '';
                        }
                    });
                },

                data: @json($dataPupuk),

                get filteredData() {
                    return this.data
                        .filter(d => !this.selectedKecamatan || d.kecamatan === this.selectedKecamatan)
                        .filter(d => !this.selectedDesa || d.desa === this.selectedDesa)
                        .filter(d => !this.filterJenis || d.jenis === this.filterJenis)
                        .filter(d => !this.filterKategori || d.kategori === this.filterKategori)
                        .map(d => ({
                            ...d,
                            kg: d.sak * d.kg_per_sak,
                            persen: Math.min((d.sak / 120) * 100, 100)
                        }))
                },

                get totalKg() {
                    return this.filteredData.reduce((t, d) => t + d.kg, 0)
                },

                get jenisAktif() {
                    return [...new Set(this.filteredData.map(d => d.jenis))]
                },

                get statusDesa() {
                    if (this.filteredData.some(d => d.status === 'Kritis')) return 'Kritis'
                    if (this.filteredData.some(d => d.status === 'Menipis')) return 'Menipis'
                    return 'Aman'
                },

                get statusWarna() {
                    return {
                        'text-green-600': this.statusDesa === 'Aman',
                        'text-yellow-600': this.statusDesa === 'Menipis',
                        'text-red-600': this.statusDesa === 'Kritis',
                    }
                },

                warnaBar(item) {
                    if (item.status === 'Kritis') return 'bg-red-500'
                    if (item.status === 'Menipis') return 'bg-yellow-400'
                    return 'bg-green-500'
                },

                badgeStatus(item) {
                    if (item.status === 'Kritis') return 'bg-red-50 text-red-600 border border-red-100'
                    if (item.status === 'Menipis') return 'bg-yellow-50 text-yellow-600 border border-yellow-100'
                    return 'bg-green-50 text-green-600 border border-green-100'
                }
            }
        }
    </script>

@endsection
