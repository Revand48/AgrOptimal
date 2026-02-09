@extends('layouts.app')

@section('title', 'Simulasi Panen & Kalender Tanam')

@section('content')
    <div class="min-h-screen py-30 px-4 md:px-6 font-sans">

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
        <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-8 " x-data="simulasiApp()">

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
            <div class="lg:col-span-5 self-start lg:sticky lg:top-24 z-10">
                <div
                    class="bg-white rounded-3xl shadow-xl shadow-green-100/50 border border-green-50 p-6 md:p-8 relative transition-all hover:shadow-green-200/50">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-green-500/5 rounded-bl-[100px] -mr-8 -mt-8 pointer-events-none">
                    </div>

                    <h2 class="font-bold text-2xl text-green-900 mb-6 flex items-center gap-3">
                        <span class="bg-green-100 p-2 rounded-lg text-green-700">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                </path>
                            </svg>
                        </span>
                        Parameter Simulasi
                    </h2>

                    <div class="space-y-6 pr-2">

                        {{-- SECTION 1: IDENTITAS --}}
                        <div class="space-y-4">
                            <h3 class="text-sm font-bold text-green-700 uppercase tracking-wider flex items-center gap-2">
                                <span
                                    class="w-6 h-6 bg-green-600 text-white rounded-full flex items-center justify-center text-xs">1</span>
                                Identitas Lahan
                            </h3>

                            {{-- Luas Lahan --}}
                            <div class="group">
                                <label
                                    class="block text-sm font-bold text-gray-600 mb-1.5 group-focus-within:text-green-600 transition-colors">
                                    Luas Lahan
                                </label>
                                <p class="text-xs text-gray-400 mb-2">Total area yang akan ditanami dalam satuan Hektar</p>
                                <div class="relative">
                                    <input x-model="form.luas_lahan" type="number" step="0.01" placeholder="Contoh: 1.5"
                                        class="w-full pl-4 pr-12 py-3 bg-gray-50 border border-gray-200 rounded-xl text-base font-bold text-gray-800 focus:ring-4 focus:ring-green-500/20 focus:border-green-500 outline-none transition-all placeholder-gray-400">
                                    <span
                                        class="absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 font-medium text-sm">Ha</span>
                                </div>
                            </div>

                            {{-- Jenis Tanaman --}}
                            <div class="relative group">
                                <label
                                    class="block text-sm font-bold text-gray-600 mb-1.5 group-focus-within:text-green-600 transition-colors">
                                    Komoditas Tanaman
                                </label>
                                <p class="text-xs text-gray-400 mb-2">Pilih jenis tanaman yang akan dibudidayakan</p>
                                <button @click="toggleDropdown('Tanaman')" @click.outside="closeDropdown('Tanaman')"
                                    type="button"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-left flex items-center justify-between transition-all hover:bg-white hover:border-green-300 focus:ring-4 focus:ring-green-500/20 focus:border-green-500">
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
                                    class="absolute top-full mt-2 w-full bg-white rounded-xl shadow-xl shadow-gray-200/50 border border-gray-100 z-50 max-h-64 overflow-y-auto custom-scrollbar"
                                    x-cloak>
                                    <template x-for="item in config.tanamanList" :key="item">
                                        <button type="button" @click="form.jenis_tanaman = item; closeDropdown('Tanaman')"
                                            class="w-full px-4 py-3 text-left hover:bg-green-50 text-gray-700 font-medium transition-colors border-b border-gray-50 last:border-0">
                                            <span x-text="item"></span>
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <hr class="border-gray-100">

                        {{-- SECTION 2: KONDISI LINGKUNGAN --}}
                        <div class="space-y-4">
                            <h3 class="text-sm font-bold text-blue-700 uppercase tracking-wider flex items-center gap-2">
                                <span
                                    class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs">2</span>
                                Kondisi Lingkungan
                            </h3>

                            {{-- Musim Tanam --}}
                            <div class="relative group">
                                <label class="block text-sm font-bold text-gray-600 mb-1.5">Musim Tanam</label>
                                <p class="text-xs text-gray-400 mb-2">Kondisi cuaca saat periode tanam berlangsung</p>
                                <button @click="toggleDropdown('Musim')" @click.outside="closeDropdown('Musim')"
                                    type="button"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-left flex items-center justify-between transition-all hover:bg-white hover:border-green-300 focus:ring-4 focus:ring-green-500/20 focus:border-green-500">
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
                                    class="absolute top-full mt-2 w-full bg-white rounded-xl shadow-xl shadow-gray-200/50 border border-gray-100 z-50 overflow-hidden"
                                    x-cloak>
                                    <template x-for="opt in config.musimOptions" :key="opt.value">
                                        <button type="button"
                                            @click="form.musim_tanam = opt.value; closeDropdown('Musim')"
                                            class="w-full px-4 py-3 text-left hover:bg-green-50 transition-colors border-b border-gray-50 last:border-0">
                                            <span class="font-medium text-gray-800" x-text="opt.value"></span>
                                            <p class="text-xs text-gray-400 mt-0.5" x-text="opt.desc"></p>
                                        </button>
                                    </template>
                                </div>
                            </div>

                            {{-- Kondisi Air --}}
                            <div class="relative group">
                                <label class="block text-sm font-bold text-gray-600 mb-1.5">Kondisi Ketersediaan
                                    Air</label>
                                <p class="text-xs text-gray-400 mb-2">Sumber irigasi dan stabilitas pasokan air</p>
                                <button @click="toggleDropdown('Air')" @click.outside="closeDropdown('Air')"
                                    type="button"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-left flex items-center justify-between transition-all hover:bg-white hover:border-green-300 focus:ring-4 focus:ring-green-500/20 focus:border-green-500">
                                    <span x-text="form.kondisi_air || 'Pilih Kondisi Air'"
                                        :class="form.kondisi_air ? 'text-gray-800 font-bold' : 'text-gray-400 font-medium'"></span>
                                    <svg class="w-5 h-5 text-gray-400 transition-transform duration-300"
                                        :class="openAir ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-show="openAir" x-transition.origin.top.duration.200ms
                                    class="absolute top-full mt-2 w-full bg-white rounded-xl shadow-xl shadow-gray-200/50 border border-gray-100 z-50 overflow-hidden"
                                    x-cloak>
                                    <template x-for="opt in config.airOptions" :key="opt.value">
                                        <button type="button" @click="form.kondisi_air = opt.value; closeDropdown('Air')"
                                            class="w-full px-4 py-3 text-left hover:bg-green-50 transition-colors border-b border-gray-50 last:border-0">
                                            <span class="font-medium text-gray-800" x-text="opt.value"></span>
                                            <p class="text-xs text-gray-400 mt-0.5" x-text="opt.desc"></p>
                                        </button>
                                    </template>
                                </div>
                            </div>

                            {{-- Kondisi Tanah --}}
                            <div class="relative group">
                                <label class="block text-sm font-bold text-gray-600 mb-1.5">Kondisi Kesuburan Tanah</label>
                                <p class="text-xs text-gray-400 mb-2">Kualitas tanah berdasarkan tekstur dan pH</p>
                                <button @click="toggleDropdown('Tanah')" @click.outside="closeDropdown('Tanah')"
                                    type="button"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-left flex items-center justify-between transition-all hover:bg-white hover:border-green-300 focus:ring-4 focus:ring-green-500/20 focus:border-green-500">
                                    <span x-text="form.kondisi_tanah || 'Pilih Kondisi Tanah'"
                                        :class="form.kondisi_tanah ? 'text-gray-800 font-bold' : 'text-gray-400 font-medium'"></span>
                                    <svg class="w-5 h-5 text-gray-400 transition-transform duration-300"
                                        :class="openTanah ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-show="openTanah" x-transition.origin.top.duration.200ms
                                    class="absolute top-full mt-2 w-full bg-white rounded-xl shadow-xl shadow-gray-200/50 border border-gray-100 z-50 overflow-hidden"
                                    x-cloak>
                                    <template x-for="opt in config.tanahOptions" :key="opt.value">
                                        <button type="button"
                                            @click="form.kondisi_tanah = opt.value; closeDropdown('Tanah')"
                                            class="w-full px-4 py-3 text-left hover:bg-green-50 transition-colors border-b border-gray-50 last:border-0">
                                            <span class="font-medium text-gray-800" x-text="opt.value"></span>
                                            <p class="text-xs text-gray-400 mt-0.5" x-text="opt.desc"></p>
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>

                        <hr class="border-gray-100">

                        {{-- SECTION 3: PRAKTIK BUDIDAYA --}}
                        <div class="space-y-4">
                            <h3 class="text-sm font-bold text-amber-700 uppercase tracking-wider flex items-center gap-2">
                                <span
                                    class="w-6 h-6 bg-amber-600 text-white rounded-full flex items-center justify-center text-xs">3</span>
                                Praktik Budidaya
                            </h3>

                            {{-- Pemupukan --}}
                            <div class="relative group">
                                <label class="block text-sm font-bold text-gray-600 mb-1.5">Strategi Pemupukan</label>
                                <p class="text-xs text-gray-400 mb-2">Jenis dan dosis pupuk yang akan digunakan</p>
                                <button @click="toggleDropdown('Pupuk')" @click.outside="closeDropdown('Pupuk')"
                                    type="button"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-left flex items-center justify-between transition-all hover:bg-white hover:border-green-300 focus:ring-4 focus:ring-green-500/20 focus:border-green-500">
                                    <span x-text="form.pemupukan || 'Pilih Strategi Pupuk'"
                                        :class="form.pemupukan ? 'text-gray-800 font-bold' : 'text-gray-400 font-medium'"></span>
                                    <svg class="w-5 h-5 text-gray-400 transition-transform duration-300"
                                        :class="openPupuk ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-show="openPupuk" x-transition.origin.top.duration.200ms
                                    class="absolute top-full mt-2 w-full bg-white rounded-xl shadow-xl shadow-gray-200/50 border border-gray-100 z-50 max-h-64 overflow-y-auto custom-scrollbar"
                                    x-cloak>
                                    <template x-for="opt in config.pupukOptions" :key="opt.value">
                                        <button type="button" @click="form.pemupukan = opt.value; closeDropdown('Pupuk')"
                                            class="w-full px-4 py-3 text-left hover:bg-green-50 transition-colors border-b border-gray-50 last:border-0">
                                            <span class="font-medium text-gray-800" x-text="opt.value"></span>
                                            <p class="text-xs text-gray-400 mt-0.5" x-text="opt.desc"></p>
                                        </button>
                                    </template>
                                </div>
                            </div>

                            {{-- Varietas --}}
                            <div class="relative group">
                                <label class="block text-sm font-bold text-gray-600 mb-1.5">Jenis Varietas Bibit</label>
                                <p class="text-xs text-gray-400 mb-2">Kualitas dan kesesuaian bibit dengan wilayah</p>
                                <button @click="toggleDropdown('Varietas')" @click.outside="closeDropdown('Varietas')"
                                    type="button"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-left flex items-center justify-between transition-all hover:bg-white hover:border-green-300 focus:ring-4 focus:ring-green-500/20 focus:border-green-500">
                                    <span x-text="form.varietas || 'Pilih Jenis Varietas'"
                                        :class="form.varietas ? 'text-gray-800 font-bold' : 'text-gray-400 font-medium'"></span>
                                    <svg class="w-5 h-5 text-gray-400 transition-transform duration-300"
                                        :class="openVarietas ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-show="openVarietas" x-transition.origin.top.duration.200ms
                                    class="absolute top-full mt-2 w-full bg-white rounded-xl shadow-xl shadow-gray-200/50 border border-gray-100 z-50 overflow-hidden"
                                    x-cloak>
                                    <template x-for="opt in config.varietasOptions" :key="opt.value">
                                        <button type="button"
                                            @click="form.varietas = opt.value; closeDropdown('Varietas')"
                                            class="w-full px-4 py-3 text-left hover:bg-green-50 transition-colors border-b border-gray-50 last:border-0">
                                            <span class="font-medium text-gray-800" x-text="opt.value"></span>
                                            <p class="text-xs text-gray-400 mt-0.5" x-text="opt.desc"></p>
                                        </button>
                                    </template>
                                </div>
                            </div>

                            {{-- Kepadatan Tanam --}}
                            <div class="relative group">
                                <label class="block text-sm font-bold text-gray-600 mb-1.5">Jarak/Kepadatan Tanam</label>
                                <p class="text-xs text-gray-400 mb-2">Pengaturan populasi tanaman per area</p>
                                <button @click="toggleDropdown('Kepadatan')" @click.outside="closeDropdown('Kepadatan')"
                                    type="button"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-left flex items-center justify-between transition-all hover:bg-white hover:border-green-300 focus:ring-4 focus:ring-green-500/20 focus:border-green-500">
                                    <span x-text="form.kepadatan || 'Pilih Kepadatan'"
                                        :class="form.kepadatan ? 'text-gray-800 font-bold' : 'text-gray-400 font-medium'"></span>
                                    <svg class="w-5 h-5 text-gray-400 transition-transform duration-300"
                                        :class="openKepadatan ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-show="openKepadatan" x-transition.origin.top.duration.200ms
                                    class="absolute top-full mt-2 w-full bg-white rounded-xl shadow-xl shadow-gray-200/50 border border-gray-100 z-50 overflow-hidden"
                                    x-cloak>
                                    <template x-for="opt in config.kepadatanOptions" :key="opt.value">
                                        <button type="button"
                                            @click="form.kepadatan = opt.value; closeDropdown('Kepadatan')"
                                            class="w-full px-4 py-3 text-left hover:bg-green-50 transition-colors border-b border-gray-50 last:border-0">
                                            <span class="font-medium text-gray-800" x-text="opt.value"></span>
                                            <p class="text-xs text-gray-400 mt-0.5" x-text="opt.desc"></p>
                                        </button>
                                    </template>
                                </div>
                            </div>

                            {{-- Hama & Penyakit --}}
                            <div class="relative group">
                                <label class="block text-sm font-bold text-gray-600 mb-1.5">Kondisi Hama & Penyakit</label>
                                <p class="text-xs text-gray-400 mb-2">Tingkat serangan OPT (Organisme Pengganggu Tanaman)
                                </p>
                                <button @click="toggleDropdown('Hama')" @click.outside="closeDropdown('Hama')"
                                    type="button"
                                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-left flex items-center justify-between transition-all hover:bg-white hover:border-green-300 focus:ring-4 focus:ring-green-500/20 focus:border-green-500">
                                    <span x-text="form.hama_penyakit || 'Pilih Kondisi'"
                                        :class="form.hama_penyakit ? 'text-gray-800 font-bold' : 'text-gray-400 font-medium'"></span>
                                    <svg class="w-5 h-5 text-gray-400 transition-transform duration-300"
                                        :class="openHama ? 'rotate-180' : ''" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </button>
                                <div x-show="openHama" x-transition.origin.top.duration.200ms
                                    class="absolute top-full mt-2 w-full bg-white rounded-xl shadow-xl shadow-gray-200/50 border border-gray-100 z-50 overflow-hidden"
                                    x-cloak>
                                    <template x-for="opt in config.hamaOptions" :key="opt.value">
                                        <button type="button"
                                            @click="form.hama_penyakit = opt.value; closeDropdown('Hama')"
                                            class="w-full px-4 py-3 text-left hover:bg-green-50 transition-colors border-b border-gray-50 last:border-0">
                                            <span class="font-medium text-gray-800" x-text="opt.value"></span>
                                            <p class="text-xs text-gray-400 mt-0.5" x-text="opt.desc"></p>
                                        </button>
                                    </template>
                                </div>
                            </div>
                        </div>

                        {{-- SUBMIT BUTTON --}}
                        <button @click="jalankanLocalSimulasi" :disabled="loading.local"
                            class="w-full mt-4 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white font-bold py-4 rounded-xl shadow-lg shadow-green-600/20 transform hover:-translate-y-1 transition-all text-lg flex items-center justify-center gap-3 disabled:opacity-70 disabled:cursor-not-allowed">
                            <span x-show="loading.local"
                                class="animate-spin rounded-full h-5 w-5 border-b-2 border-white"></span>
                            <span x-text="loading.local ? 'Menghitung...' : 'HITUNG POTENSI PANEN'"></span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- RIGHT PANEL: RESULT --}}
            <div class="lg:col-span-7 space-y-8">

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
                    <p class="text-gray-500 max-w-sm">Lengkapi semua parameter di panel kiri untuk melihat perhitungan
                        potensi hasil dan analisis risiko.</p>
                </div>

                {{-- LOADING STATE --}}
                <div x-show="loading.local"
                    class="bg-white rounded-3xl p-12 text-center flex flex-col items-center justify-center min-h-[500px]">
                    <div class="w-16 h-16 border-4 border-green-200 border-t-green-600 rounded-full animate-spin mb-6">
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Menghitung Simulasi...</h3>
                    <p class="text-gray-500">Menganalisis 7 faktor agronomi untuk estimasi presisi</p>
                </div>

                {{-- LOCAL RESULT DASHBOARD --}}
                <div x-show="hasResult.local && !loading.local" x-transition.opacity.duration.500ms class="space-y-6"
                    x-cloak>

                    {{-- HEADER --}}
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl font-bold text-gray-900">Dashboard Analisis</h3>
                        <span
                            class="text-sm font-medium text-gray-500 bg-white px-3 py-1 rounded-full border border-gray-200">
                            AgrOptimal Engine
                        </span>
                    </div>

                    {{-- METRIC CARDS --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        {{-- Est Produksi --}}
                        <div
                            class="bg-white p-5 rounded-2xl border border-gray-100 shadow-lg shadow-gray-100/50 relative overflow-hidden">
                            <p class="text-gray-500 font-medium mb-1 text-xs uppercase tracking-wider">Potensi Panen</p>
                            <h4 class="text-3xl font-extrabold text-green-700 font-mono tracking-tight">
                                <span x-text="localResult.tonase"></span> <span class="text-base text-gray-400">Ton</span>
                            </h4>
                        </div>

                        {{-- Est Nilai --}}
                        <div
                            class="bg-white p-5 rounded-2xl border border-gray-100 shadow-lg shadow-gray-100/50 relative overflow-hidden">
                            <p class="text-gray-500 font-medium mb-1 text-xs uppercase tracking-wider">Estimasi Nilai</p>
                            <h4 class="text-2xl font-extrabold text-yellow-600 font-mono tracking-tight"
                                x-text="localResult.estimasi_nilai"></h4>
                        </div>

                        {{-- Skor --}}
                        <div
                            class="bg-white p-5 rounded-2xl border border-gray-100 shadow-lg shadow-gray-100/50 relative overflow-hidden">
                            <p class="text-gray-500 font-medium mb-1 text-xs uppercase tracking-wider">Skor Kelayakan</p>
                            <div class="flex items-end gap-2">
                                <h4 class="text-3xl font-extrabold font-mono"
                                    :class="'text-' + localResult.status_color + '-600'">
                                    <span x-text="localResult.skor"></span><span
                                        class="text-base text-gray-400">/100</span>
                                </h4>
                                <span class="mb-1 px-2 py-0.5 rounded text-xs font-bold uppercase"
                                    :class="'bg-' + localResult.status_color + '-100 text-' + localResult.status_color + '-700'"
                                    x-text="localResult.status_label"></span>
                            </div>
                        </div>
                    </div>

                    {{-- STATUS MESSAGE --}}
                    <div class="bg-gray-50 rounded-xl p-4 border border-gray-100">
                        <p class="text-gray-700" x-text="localResult.status_message"></p>
                    </div>

                    {{-- RISKS & RECOMMENDATIONS --}}
                    <div class="grid md:grid-cols-2 gap-4">
                        {{-- Risks --}}
                        <div class="bg-red-50 rounded-2xl p-5 border border-red-100">
                            <h4
                                class="font-bold text-red-700 mb-3 flex items-center gap-2 text-sm uppercase tracking-wider">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                    </path>
                                </svg>
                                Risiko Teridentifikasi
                            </h4>
                            <ul class="space-y-2">
                                <template x-for="(risk, idx) in localResult.risks" :key="idx">
                                    <li class="text-gray-700 text-sm flex items-start gap-2">
                                        <span class="text-red-400 mt-0.5">•</span>
                                        <span x-text="risk"></span>
                                    </li>
                                </template>
                            </ul>
                        </div>

                        {{-- Recommendations --}}
                        <div class="bg-green-50 rounded-2xl p-5 border border-green-100">
                            <h4
                                class="font-bold text-green-700 mb-3 flex items-center gap-2 text-sm uppercase tracking-wider">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Rekomendasi Perbaikan
                            </h4>
                            <ul class="space-y-2">
                                <template x-for="(rec, idx) in localResult.daftar_rekomendasi" :key="idx">
                                    <li class="text-gray-700 text-sm flex items-start gap-2">
                                        <span class="text-green-500 mt-0.5">✓</span>
                                        <span x-text="rec"></span>
                                    </li>
                                </template>
                                <li x-show="!localResult.daftar_rekomendasi || localResult.daftar_rekomendasi.length === 0"
                                    class="text-gray-600 text-sm">
                                    Pertahankan praktik budidaya Anda saat ini.
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- TIMELINE & PEST INFO --}}
                    <div class="bg-white rounded-2xl p-6 border border-gray-100 shadow-lg">
                        <h4 class="font-bold text-gray-800 mb-4 flex items-center gap-2">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                            Proyeksi Waktu Panen
                        </h4>

                        <div class="relative pt-4 pb-2">
                            <div class="h-3 bg-gray-100 rounded-full overflow-hidden">
                                <div class="h-full bg-gradient-to-r from-green-400 to-green-600 rounded-full"
                                    style="width: 100%"></div>
                            </div>
                            <div class="flex justify-between mt-3 text-sm font-medium text-gray-600">
                                <span>Hari Ini</span>
                                <span class="text-green-700 font-bold" x-text="localResult.waktu_panen"></span>
                                <span x-text="localResult.target_panen"></span>
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-100">
                            <p class="text-gray-400 text-xs font-semibold uppercase mb-1">Hama Utama yang Perlu Diwaspadai
                            </p>
                            <p class="text-gray-800 font-medium"
                                x-text="localResult.hama_utama || 'Hama umum tanaman ini'"></p>
                        </div>
                    </div>



                    {{-- Schedule --}}
                    <div class="bg-white rounded-xl border border-gray-200 overflow-hidden mt-6"
                        x-show="localResult.schedule && localResult.schedule.length > 0">
                        <div class="bg-gray-50 px-5 py-3 border-b border-gray-200">
                            <h4 class="font-bold text-gray-800 text-sm">Detail Jadwal Kegiatan</h4>
                        </div>
                        <div class="divide-y divide-gray-100">
                            <template x-for="(item, index) in localResult.schedule" :key="index">
                                <div class="p-4 hover:bg-gray-50 transition-colors flex gap-4">
                                    <span
                                        class="shrink-0 w-28 text-xs font-bold text-teal-600 uppercase tracking-wide pt-0.5"
                                        x-text="item.minggu"></span>
                                    <p class="text-gray-700 text-sm" x-text="item.kegiatan"></p>
                                </div>
                            </template>
                        </div>
                    </div>

                </div>

            </div>

        </div>

        <script>
            function simulasiApp() {
                return {
                    // Dropdown states
                    openTanaman: false,
                    openMusim: false,
                    openAir: false,
                    openTanah: false,
                    openPupuk: false,
                    openVarietas: false,
                    openKepadatan: false,
                    openHama: false,

                    // Configuration with descriptions
                    config: {
                        tanamanList: @json(array_keys($tanamanList ?? [])),
                        musimOptions: [{
                                value: 'Musim Hujan',
                                desc: 'Curah hujan tinggi (>200mm/bulan), cocok untuk padi'
                            },
                            {
                                value: 'Peralihan',
                                desc: 'Masa transisi, curah hujan sedang dan tidak menentu'
                            },
                            {
                                value: 'Musim Kemarau',
                                desc: 'Curah hujan rendah, cocok untuk cabai/bawang'
                            }
                        ],
                        airOptions: [{
                                value: 'Cukup & Stabil',
                                desc: 'Irigasi teknis atau sumber air permanen tersedia'
                            },
                            {
                                value: 'Cukup tapi Tidak Stabil',
                                desc: 'Air tersedia tapi debit tidak konsisten'
                            },
                            {
                                value: 'Kurang',
                                desc: 'Mengandalkan hujan atau sumber air terbatas'
                            }
                        ],
                        tanahOptions: [{
                                value: 'Subur (Tekstur baik, pH sesuai)',
                                desc: 'Tanah gembur, kaya humus, pH 6-7'
                            },
                            {
                                value: 'Sedang',
                                desc: 'Tanah cukup baik tapi perlu perbaikan minor'
                            },
                            {
                                value: 'Kurang Subur',
                                desc: 'Tanah keras/liat, miskin unsur hara, pH ekstrim'
                            }
                        ],
                        pupukOptions: [{
                                value: 'Organik + NPK Seimbang',
                                desc: 'Kombinasi pupuk kandang/kompos dengan NPK berimbang'
                            },
                            {
                                value: 'NPK Sesuai Dosis',
                                desc: 'Pupuk anorganik sesuai rekomendasi dinas pertanian'
                            },
                            {
                                value: 'NPK Kurang / Tidak Seimbang',
                                desc: 'Dosis tidak sesuai atau rasio NPK tidak tepat'
                            },
                            {
                                value: 'Tanpa Pupuk',
                                desc: 'Tidak menggunakan pupuk tambahan'
                            }
                        ],
                        varietasOptions: [{
                                value: 'Unggul & Sesuai Wilayah',
                                desc: 'Benih bersertifikat, tahan hama lokal'
                            },
                            {
                                value: 'Lokal Biasa',
                                desc: 'Benih turunan atau dari petani lokal'
                            },
                            {
                                value: 'Tidak Sesuai Agroklimat',
                                desc: 'Varietas dari daerah lain, belum teruji'
                            }
                        ],
                        kepadatanOptions: [{
                                value: 'Sesuai Rekomendasi',
                                desc: 'Jarak tanam mengikuti SOP (misal: jajar legowo)'
                            },
                            {
                                value: 'Terlalu Rapat',
                                desc: 'Populasi melebihi kapasitas, risiko penyakit tinggi'
                            },
                            {
                                value: 'Terlalu Jarang',
                                desc: 'Populasi kurang, lahan tidak optimal'
                            }
                        ],
                        hamaOptions: [{
                                value: 'Terkontrol Baik',
                                desc: 'PHT aktif, monitoring rutin, serangan minimal'
                            },
                            {
                                value: 'Ada Gangguan Ringan',
                                desc: 'Serangan sporadis, masih bisa dikendalikan'
                            },
                            {
                                value: 'Parah',
                                desc: 'Ledakan hama/penyakit, kerugian >50% tanaman'
                            }
                        ]
                    },

                    // Form data - matches controller requirements
                    form: {
                        luas_lahan: '',
                        jenis_tanaman: '',
                        musim_tanam: '',
                        kondisi_air: '',
                        pemupukan: '',
                        kondisi_tanah: '',
                        kepadatan: '',
                        varietas: '',
                        hama_penyakit: ''
                    },

                    loading: {
                        local: false
                    },
                    hasResult: {
                        local: false
                    },

                    localResult: {
                        tonase: 0,
                        waktu_panen: '',
                        target_panen: '',
                        skor: 0,
                        status_label: '',
                        status_color: 'gray',
                        status_message: '',
                        risks: [],
                        daftar_rekomendasi: [],
                        estimasi_nilai: '',
                        rekomendasi_singkat: '',
                        hama_utama: ''
                    },


                    notification: {
                        show: false,
                        message: '',
                        type: 'success'
                    },

                    toggleDropdown(name) {
                        const dropdowns = ['Tanaman', 'Musim', 'Air', 'Tanah', 'Pupuk', 'Varietas', 'Kepadatan', 'Hama'];
                        this['open' + name] = !this['open' + name];
                        dropdowns.filter(n => n !== name).forEach(n => this['open' + n] = false);
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

                    validateForm() {
                        const required = ['luas_lahan', 'jenis_tanaman', 'musim_tanam', 'kondisi_air', 'pemupukan',
                            'kondisi_tanah', 'kepadatan', 'varietas', 'hama_penyakit'
                        ];
                        const missing = required.filter(field => !this.form[field]);

                        if (missing.length > 0) {
                            const fieldNames = {
                                luas_lahan: 'Luas Lahan',
                                jenis_tanaman: 'Komoditas',
                                musim_tanam: 'Musim Tanam',
                                kondisi_air: 'Kondisi Air',
                                pemupukan: 'Pemupukan',
                                kondisi_tanah: 'Kondisi Tanah',
                                kepadatan: 'Kepadatan Tanam',
                                varietas: 'Varietas',
                                hama_penyakit: 'Kondisi Hama'
                            };
                            const missingNames = missing.map(f => fieldNames[f]).join(', ');
                            this.showNotification(`Harap lengkapi: ${missingNames}`, 'error');
                            return false;
                        }
                        return true;
                    },

                    async jalankanLocalSimulasi() {
                        if (!this.validateForm()) return;

                        this.loading.local = true;
                        this.hasResult.local = false;

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

                                // Auto scroll to results
                                setTimeout(() => {
                                    document.querySelector('.lg\\:col-span-7')?.scrollIntoView({
                                        behavior: 'smooth',
                                        block: 'start'
                                    });
                                }, 200);

                            } else {
                                this.showNotification(data.message || 'Terjadi kesalahan', 'error');
                            }
                        } catch (e) {
                            this.showNotification('Gagal menghubungi server.', 'error');
                            console.error(e);
                        } finally {
                            this.loading.local = false;
                        }
                    },


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
                background: transparent;
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
