@extends('layouts.app')

@section('title', 'Simulasi Panen & Kalender Tanam')

@section('content')
    <div class="min-h-screen py-10 px-4 md:px-6 font-sans ">

        {{-- HEADER --}}
        <div class="max-w-6xl mx-auto mb-12 text-center">
            <h1
                class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-green-700 to-emerald-600 tracking-tight leading-tight">
                Simulasi Tani Cerdas
            </h1>
            <p class="text-lg md:text-xl text-gray-600 mt-4 max-w-3xl mx-auto">
                Dapatkan estimasi panen presisi dan wawasan agronomi mendalam untuk hasil maksimal.
            </p>
        </div>

        {{-- MAIN GRID --}}
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8" x-data="simulasiApp()">

            {{-- NOTIFICATION --}}
            <div x-show="notification.show" x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 transform translate-x-4"
                x-transition:enter-end="opacity-100 transform translate-x-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 transform translate-x-0"
                x-transition:leave-end="opacity-0 transform translate-x-4"
                :class="notification.type === 'success' ? 'bg-green-600' : 'bg-red-600'"
                class="fixed top-24 right-5 text-white px-6 py-4 rounded-xl shadow-2xl z-[100] flex items-center gap-4 max-w-md"
                x-cloak>
                <div class="bg-white/20 p-2 rounded-full shrink-0">
                    <svg x-show="notification.type === 'success'" class="w-6 h-6" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <svg x-show="notification.type === 'error'" class="w-6 h-6" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </div>
                <div>
                    <h4 class="font-bold text-lg" x-text="notification.type === 'success' ? 'Berhasil' : 'Gagal'"></h4>
                    <p class="text-sm opacity-90 leading-tight" x-text="notification.message"></p>
                </div>
                <button @click="notification.show = false"
                    class="ml-auto hover:bg-white/20 rounded-full p-1 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            {{-- LEFT PANEL: INPUT --}}
            <div class="lg:col-span-4 self-start sticky top-24 z-10">
                <div
                    class="bg-white rounded-3xl shadow-xl shadow-green-100/50 border border-green-50 p-6 md:p-8 relative overflow-hidden transition-all hover:shadow-green-200/50">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-green-500/5 rounded-bl-[100px] -mr-8 -mt-8 pointer-events-none">
                    </div>

                    <h2 class="font-bold text-2xl text-green-900 mb-8 flex items-center gap-3">
                        <span class="bg-green-100 p-2 rounded-lg text-green-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                        </span>
                        Parameter Lahan
                    </h2>

                    <div class="space-y-6">
                        {{-- Luas Lahan --}}
                        <div class="group">
                            <label
                                class="block text-sm font-bold text-gray-600 mb-2 group-focus-within:text-green-600 transition-colors">Luas
                                Lahan (Hektar)</label>
                            <div class="relative">
                                <input x-model="form.luas_lahan" type="number" step="0.01" placeholder="Contoh: 1.5"
                                    class="w-full pl-4 pr-4 py-4 bg-gray-50 border border-gray-200 rounded-2xl text-lg font-bold text-gray-800 focus:ring-4 focus:ring-green-500/20 focus:border-green-500 outline-none transition-all placeholder-gray-400">
                                <span class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 font-medium">Ha</span>
                            </div>
                        </div>

                        {{-- Jenis Tanaman --}}
                        <div class="relative group">
                            <label
                                class="block text-sm font-bold text-gray-600 mb-2 group-focus-within:text-green-600 transition-colors">Komoditas</label>
                            <button @click="toggleDropdown('Tanaman')" @click.outside="closeDropdown('Tanaman')"
                                type="button"
                                class="w-full px-4 py-4 bg-gray-50 border border-gray-200 rounded-2xl text-left flex items-center justify-between transition-all hover:bg-white hover:border-green-300 focus:ring-4 focus:ring-green-500/20 focus:border-green-500">
                                <span x-text="form.jenis_tanaman || 'Pilih Tanaman'"
                                    :class="form.jenis_tanaman ? 'text-gray-800 font-bold' : 'text-gray-400 font-medium'"></span>
                                <svg class="w-5 h-5 text-gray-400 transition-transform duration-300"
                                    :class="openTanaman ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="openTanaman" x-transition.origin.top.duration.200ms
                                class="absolute top-full mt-2 w-full bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 z-50 max-h-64 overflow-y-auto custom-scrollbar"
                                x-cloak>
                                <template x-for="item in config.tanamanList" :key="item">
                                    <button type="button" @click="form.jenis_tanaman = item; closeDropdown('Tanaman')"
                                        class="w-full px-5 py-3 text-left hover:bg-green-50 text-gray-700 font-medium transition-colors border-b border-gray-50 last:border-0 first:rounded-t-2xl last:rounded-b-2xl">
                                        <span x-text="item"></span>
                                    </button>
                                </template>
                            </div>
                        </div>

                        {{-- Musim Tanam --}}
                        <div class="relative group">
                            <label
                                class="block text-sm font-bold text-gray-600 mb-2 group-focus-within:text-green-600 transition-colors">Musim
                                Tanam</label>
                            <button @click="toggleDropdown('Musim')" @click.outside="closeDropdown('Musim')" type="button"
                                class="w-full px-4 py-4 bg-gray-50 border border-gray-200 rounded-2xl text-left flex items-center justify-between transition-all hover:bg-white hover:border-green-300 focus:ring-4 focus:ring-green-500/20 focus:border-green-500">
                                <span x-text="form.musim_tanam || 'Pilih Musim'"
                                    :class="form.musim_tanam ? 'text-gray-800 font-bold' : 'text-gray-400 font-medium'"></span>
                                <svg class="w-5 h-5 text-gray-400 transition-transform duration-300"
                                    :class="openMusim ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="openMusim" x-transition.origin.top.duration.200ms
                                class="absolute top-full mt-2 w-full bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 z-50 overflow-hidden"
                                x-cloak>
                                <button type="button" @click="form.musim_tanam = 'Musim Hujan'; closeDropdown('Musim')"
                                    class="w-full px-5 py-3 text-left hover:bg-green-50 text-gray-700 font-medium transition-colors border-b border-gray-50">Musim
                                    Hujan</button>
                                <button type="button" @click="form.musim_tanam = 'Musim Kemarau'; closeDropdown('Musim')"
                                    class="w-full px-5 py-3 text-left hover:bg-green-50 text-gray-700 font-medium transition-colors">Musim
                                    Kemarau</button>
                            </div>
                        </div>

                        {{-- Pupuk --}}
                        <div class="relative group">
                            <label
                                class="block text-sm font-bold text-gray-600 mb-2 group-focus-within:text-green-600 transition-colors">Pupuk
                                Utama</label>
                            <button @click="toggleDropdown('Pupuk')" @click.outside="closeDropdown('Pupuk')"
                                type="button"
                                class="w-full px-4 py-4 bg-gray-50 border border-gray-200 rounded-2xl text-left flex items-center justify-between transition-all hover:bg-white hover:border-green-300 focus:ring-4 focus:ring-green-500/20 focus:border-green-500">
                                <span x-text="form.jenis_pupuk || 'Pilih Pupuk'"
                                    :class="form.jenis_pupuk ? 'text-gray-800 font-bold' : 'text-gray-400 font-medium'"></span>
                                <svg class="w-5 h-5 text-gray-400 transition-transform duration-300"
                                    :class="openPupuk ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </button>
                            <div x-show="openPupuk" x-transition.origin.top.duration.200ms
                                class="absolute top-full mt-2 w-full bg-white rounded-2xl shadow-xl shadow-gray-200/50 border border-gray-100 z-50 max-h-64 overflow-y-auto custom-scrollbar"
                                x-cloak>
                                @foreach ($pupuks as $id => $nama)
                                    <button type="button"
                                        @click="form.jenis_pupuk = '{{ $nama }}'; closeDropdown('Pupuk')"
                                        class="w-full px-5 py-3 text-left hover:bg-green-50 text-gray-700 font-medium transition-colors border-b border-gray-50 last:border-0">
                                        {{ $nama }}
                                    </button>
                                @endforeach
                            </div>
                        </div>

                        <button @click="jalankanLocalSimulasi" :disabled="loading.local"
                            class="w-full mt-6 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold py-4 rounded-2xl shadow-lg shadow-green-600/20 transform hover:-translate-y-1 transition-all text-lg flex items-center justify-center gap-3 disabled:opacity-70 disabled:cursor-not-allowed">
                            <span x-show="loading.local"
                                class="animate-spin rounded-full h-5 w-5 border-b-2 border-white"></span>
                            <span x-text="loading.local ? 'Menghitung...' : 'HITUNG POTENSI'"></span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- RIGHT PANEL: RESULT --}}
            <div class="lg:col-span-8 space-y-8">

                {{-- EMPTY STATE --}}
                <div x-show="!hasResult.local && !loading.local"
                    class="bg-white/60 border-2 border-dashed border-gray-200 rounded-3xl p-12 text-center flex flex-col items-center justify-center h-full min-h-[500px] transition-all">
                    <div
                        class="w-24 h-24 bg-gradient-to-br from-green-100 to-green-50 rounded-full flex items-center justify-center mb-6 shadow-inner ring-4 ring-white">
                        <svg class="w-10 h-10 text-green-600 opacity-80" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Simulasi Belum Dimulai</h3>
                    <p class="text-gray-500 max-w-sm">Masukkan parameter lahan Anda di panel kiri untuk melihat perhitungan
                        potensi hasil dan analisis risiko.</p>
                </div>

                {{-- LOCAL RESULT DASHBOARD --}}
                <div x-show="hasResult.local" x-transition.opacity.duration.500ms class="space-y-8" x-cloak>

                    {{-- HEADER --}}
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl font-bold text-gray-900">Dashboard Analisis Awal</h3>
                        <span
                            class="text-sm font-medium text-gray-500 bg-white px-3 py-1 rounded-full border border-gray-200">
                            Generated by AgrOptimal Engine
                        </span>
                    </div>

                    {{-- METRIC CARDS --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        {{-- Est Produksi --}}
                        <div
                            class="bg-white p-6 rounded-3xl border border-gray-100 shadow-xl shadow-gray-100/50 relative overflow-hidden group h-full flex flex-col justify-between">
                            <div>
                                <p class="text-gray-500 font-medium mb-1 text-sm uppercase tracking-wider">Potensi Panen</p>
                                <h4 class="text-3xl font-extrabold text-green-700 font-mono tracking-tight">
                                    <span x-text="localResult.tonase"></span> <span class="text-lg text-gray-400">Ton</span>
                                </h4>
                            </div>
                        </div>

                        {{-- Est Nilai --}}
                        <div
                            class="bg-white p-6 rounded-3xl border border-gray-100 shadow-xl shadow-gray-100/50 relative overflow-hidden group h-full flex flex-col justify-between">
                            <div>
                                <p class="text-gray-500 font-medium mb-1 text-sm uppercase tracking-wider">Estimasi Nilai</p>
                                <h4 class="text-3xl font-extrabold text-yellow-600 font-mono tracking-tight"
                                    x-text="localResult.estimasi_nilai"></h4>
                            </div>
                        </div>

                        {{-- Skor --}}
                        <div
                            class="bg-white p-6 rounded-3xl border border-gray-100 shadow-xl shadow-gray-100/50 relative overflow-hidden group h-full flex flex-col justify-between">
                            <div>
                                <div class="flex items-center gap-3 mb-2">
                                    <p class="text-gray-500 font-medium text-sm uppercase tracking-wider">Skor Kelayakan</p>
                                </div>
                                <h4 class="text-3xl font-extrabold font-mono flex items-end gap-2"
                                    :class="'text-' + localResult.status_color + '-600'">
                                    <span x-text="localResult.skor"></span><span
                                        class="text-base mb-1 text-gray-400">/100</span>
                                </h4>
                                <span
                                    class="inline-block mt-1 px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wide border"
                                    :class="'bg-' + localResult.status_color + '-50 text-' + localResult.status_color +
                                        '-700 border-' + localResult.status_color + '-100'"
                                    x-text="localResult.status_label"></span>
                            </div>
                        </div>
                    </div>

                    {{-- ALERTS --}}
                    <template x-for="alert in localResult.alerts" :key="alert.msg">
                        <div class="rounded-2xl p-4 flex items-start gap-4"
                            :class="alert.type === 'danger' ? 'bg-red-50 border border-red-100 text-red-800' :
                                'bg-yellow-50 border border-yellow-100 text-yellow-800'">
                            <svg class="w-6 h-6 shrink-0 mt-0.5" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                            <p x-text="alert.msg" class="font-medium"></p>
                        </div>
                    </template>

                    {{-- TIMELINE & RECS --}}
                    <div class="bg-white rounded-3xl p-8 border border-gray-100 shadow-lg">
                        <h4 class="font-bold text-gray-800 mb-6 flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Proyeksi Waktu
                        </h4>

                        <div class="relative pt-6 pb-2">
                            <div class="h-4 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-green-400 to-green-600 rounded-full relative"
                                    style="width: 100%">
                                    {{-- Animation bar can go here --}}
                                </div>
                            </div>
                            <div class="flex justify-between mt-3 font-medium text-gray-600">
                                <span>Hari Ini</span>
                                <span class="text-green-700 font-bold" x-text="localResult.waktu_panen"></span>
                                <span x-text="localResult.target_panen"></span>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-gray-100 grid md:grid-cols-2 gap-8">
                            <div>
                                <p class="text-gray-400 text-sm font-semibold uppercase mb-2">Hama Utama</p>
                                <p class="text-gray-800 font-medium" x-text="localResult.hama_utama"></p>
                            </div>
                            <div>
                                <p class="text-gray-400 text-sm font-semibold uppercase mb-2">Rekomendasi Cepat</p>
                                <p class="text-gray-800 font-medium" x-text="localResult.rekomendasi_singkat"></p>
                            </div>
                        </div>
                    </div>

                    {{-- CTA AI --}}
                    <div class="relative group cursor-pointer" @click="jalankanAiSimulasi">
                        <div
                            class="absolute -inset-1 bg-gradient-to-r from-teal-500 to-emerald-500 rounded-2xl blur opacity-25 group-hover:opacity-50 transition duration-1000 group-hover:duration-200">
                        </div>
                        <div
                            class="relative bg-white ring-1 ring-gray-900/5 rounded-2xl leading-none flex items-top justify-start space-x-6 p-8">
                            <div class="bg-teal-50 p-4 rounded-xl shrink-0">
                                <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div class="space-y-2">
                                <p class="text-slate-800 font-bold text-lg">Butuh Analisis Mendalam?</p>
                                <p class="text-slate-600">Tanyakan pada <span class="text-teal-600 font-bold">Profesor
                                        AI</span> untuk strategi mitigasi risiko silent killer, SOP detail, dan solusi
                                    pencegahan kegagalan.</p>
                                <button
                                    class="mt-4 bg-teal-600 text-white px-6 py-2 rounded-lg font-bold text-sm hover:bg-teal-700 transition-colors inline-flex items-center gap-2">
                                    <span x-show="!loading.ai">Tambahkan Analisis Gemini API</span>
                                    <span x-show="loading.ai">Menghubungi Profesor AI...</span>
                                    <svg x-show="!loading.ai" class="w-4 h-4" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>

                    {{-- AI RESULT --}}
                    <div x-show="hasResult.ai" x-transition.origin.top
                        class="bg-teal-50/50 border border-teal-100 rounded-3xl p-8 space-y-6">
                        <div class="flex items-center gap-3 mb-6">
                            <div
                                class="w-10 h-10 bg-teal-600 rounded-full flex items-center justify-center text-white shadow-lg shadow-teal-200">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                                    </path>
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-teal-900">Analisis Laboratorium AI</h3>
                        </div>

                        {{-- AI Content --}}
                        <div
                            class="prose max-w-none text-gray-700 bg-white p-6 rounded-2xl shadow-sm border border-teal-50/50">
                            <h4 class="text-teal-600 font-bold mb-2">Evaluasi Kritis</h4>
                            <p class="whitespace-pre-line leading-relaxed" x-text="aiResult.analysis"></p>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div class="bg-red-50 p-6 rounded-2xl border border-red-100">
                                <h4 class="text-red-700 font-bold mb-3 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                        </path>
                                    </svg>
                                    Silent Killers (Risiko)
                                </h4>
                                <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-line"
                                    x-text="aiResult.risks"></p>
                            </div>
                            <div class="bg-green-50 p-6 rounded-2xl border border-green-100">
                                <h4 class="text-green-700 font-bold mb-3 flex items-center gap-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Solusi & SOP
                                </h4>
                                <p class="text-gray-700 text-sm leading-relaxed whitespace-pre-line"
                                    x-text="aiResult.solutions"></p>
                            </div>
                        </div>

                        {{-- Schedule --}}
                        <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
                            <div class="bg-gray-50 px-6 py-4 border-b border-gray-200">
                                <h4 class="font-bold text-gray-800">Detail Jadwal Kegiatan</h4>
                            </div>
                            <div class="divide-y divide-gray-100">
                                <template x-for="(item, index) in aiResult.schedule" :key="index">
                                    <div class="p-4 hover:bg-gray-50 transition-colors flex gap-4">
                                        <span
                                            class="shrink-0 w-24 text-xs font-bold text-teal-600 uppercase tracking-wide pt-1"
                                            x-text="item.minggu"></span>
                                        <p class="text-gray-700 text-sm" x-text="item.kegiatan"></p>
                                    </div>
                                </template>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script>
        function simulasiApp() {
            return {
                openTanaman: false,
                openMusim: false,
                openPupuk: false,
                config: {
                    tanamanList: @json(array_keys($tanamanList ?? []))
                },
                form: {
                    luas_lahan: '',
                    jenis_tanaman: '',
                    musim_tanam: '',
                    jenis_pupuk: ''
                },
                loading: {
                    local: false,
                    ai: false
                },
                hasResult: {
                    local: false,
                    ai: false
                },

                localResult: {
                    tonase: 0,
                    waktu_panen: '',
                    target_panen: '',
                    skor: 0,
                    status_label: '',
                    status_color: 'gray',
                    risks: [],
                    alerts: [],
                    estimasi_nilai: '',
                    recommendation: '',
                    hama_utama: ''
                },
                aiResult: {
                    analysis: '',
                    risks: '',
                    solutions: '',
                    schedule: []
                },

                notification: {
                    show: false,
                    message: '',
                    type: 'success'
                },

                toggleDropdown(name) {
                    this['open' + name] = !this['open' + name];
                    ['Tanaman', 'Musim', 'Pupuk'].filter(n => n !== name).forEach(n => this['open' + n] = false);
                },
                closeDropdown(name) {
                    this['open' + name] = false;
                },

                showNotification(msg, type = 'success') {
                    this.notification = {
                        show: true,
                        message: msg,
                        type: type
                    };
                    setTimeout(() => this.notification.show = false, 5000);
                },

                async jalankanLocalSimulasi() {
                    if (!this.form.luas_lahan || !this.form.jenis_tanaman || !this.form.musim_tanam || !this.form
                        .jenis_pupuk) {
                        return this.showNotification('Harap lengkapi semua data formulir.', 'error');
                    }

                    this.loading.local = true;
                    this.hasResult.local = false;
                    this.hasResult.ai = false; // Reset AI if Recalculating

                    try {
                        const response = await fetch('{{ route('simulasi.calculate') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(this.form)
                        });
                        const data = await response.json();

                        if (data.status === 'success') {
                            this.localResult = data.data;
                            this.hasResult.local = true;
                            // Scroll to result properly
                            setTimeout(() => {
                                window.scrollTo({
                                    top: 400,
                                    behavior: 'smooth'
                                });
                            }, 200);
                        } else {
                            this.showNotification(data.message, 'error');
                        }
                    } catch (e) {
                        this.showNotification('Gagal menghubungi server.', 'error');
                        console.error(e);
                    } finally {
                        this.loading.local = false;
                    }
                },

                async jalankanAiSimulasi() {
                    this.loading.ai = true;
                    try {
                        const response = await fetch('{{ route('simulasi.analyze') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(this.form) // Send same data
                        });
                        const data = await response.json();

                        if (data.status === 'success') {
                            this.aiResult = data.data;
                            this.hasResult.ai = true;
                            setTimeout(() => {
                                window.scrollTo({
                                    top: document.body.scrollHeight,
                                    behavior: 'smooth'
                                });
                            }, 200);
                        } else {
                            this.showNotification(data.message || 'Gagal analisis AI', 'error');
                        }
                    } catch (e) {
                        this.showNotification('Terjadi kesalahan koneksi saat analisis AI.', 'error');
                    } finally {
                        this.loading.ai = false;
                    }
                }
            }
        }
    </script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        .custom-scrollbar::-webkit-scrollbar {
            width: 6px;
        }

        .custom-scrollbar::-webkit-scrollbar-track {
            bg-transparent;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb {
            background-color: #d1d5db;
            border-radius: 20px;
        }

        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background-color: #9ca3af;
        }
    </style>
@endsection
