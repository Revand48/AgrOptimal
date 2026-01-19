<section class="relative py-20 overflow-hidden bg-[#d8ffe5] font-sans" x-data="{ activeTab: 'vision' }">
    <div
        class="absolute top-0 left-0 w-64 h-64 bg-[#2e7d32]/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob">
    </div>
    <div
        class="absolute top-0 right-0 w-64 h-64 bg-[#f4b400]/10 rounded-full mix-blend-multiply filter blur-3xl opacity-70 animate-blob animation-delay-2000">
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <!-- Heading -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-extrabold text-[#2e7d32]">
                Masa Depan <span class="text-[#f4b400]">Pertanian</span> Cerdas
            </h2>
            <p class="mt-3 max-w-2xl mx-auto text-[#2e7d32]/80">
                Menggabungkan kebudayaan lokal dengan presisi teknologi untuk keberlanjutan bertani.
            </p>
        </div>

        <div class="flex flex-col lg:flex-row gap-12 items-center">

            <div class="w-full lg:w-1/2 relative group">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl aspect-[4/3] border-4 border-white">
                    <img src="{{ asset('img/profile/visi_misi/pp1.webp') }}" alt="Vision"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 hover:scale-105"
                        x-show="activeTab === 'vision'" x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
                    <img src="{{ asset('img/profile/visi_misi/pp2.webp') }}" alt="Mission"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 hover:scale-105"
                        x-show="activeTab === 'mission'" x-cloak x-transition:enter="transition ease-out duration-500"
                        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-300"
                        x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">

                    <div class="absolute inset-0 bg-gradient-to-t from-[#2e7d32]/80 to-transparent"></div>

                    <div
                        class="absolute bottom-6 left-6 bg-white/90 backdrop-blur-sm px-4 py-2 rounded-lg shadow-lg border-l-4 border-[#f4b400]">
                        <span class="text-[#2e7d32] font-bold uppercase text-xs tracking-wider"
                            x-text="activeTab === 'vision' ? 'Our Vision' : 'Our Mission'"></span>
                    </div>
                </div>

                <div class="absolute -z-10 -bottom-6 -right-6 w-full h-full border-2 border-[#2e7d32]/20 rounded-2xl">
                </div>
            </div>

            <div class="w-full lg:w-1/2 space-y-8 font-sans">

                <div class="flex space-x-2 bg-[#2e7d32]/5 p-1 rounded-xl w-fit">
                    <button @click="activeTab = 'vision'"
                        :class="activeTab === 'vision' ? 'bg-[#2e7d32] text-white shadow-md' :
                            'text-[#2e7d32] hover:bg-[#2e7d32]/10'"
                        class="px-6 py-2.5 rounded-lg text-sm font-semibold transition-all duration-300 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Visi Kami
                    </button>
                    <button @click="activeTab = 'mission'"
                        :class="activeTab === 'mission' ? 'bg-[#f4b400] text-[#2e7d32] shadow-md' :
                            'text-[#2e7d32] hover:bg-[#2e7d32]/10'"
                        class="px-6 py-2.5 rounded-lg text-sm font-semibold transition-all duration-300 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Misi Kami
                    </button>
                </div>

                <div class="relative min-h-[200px]">
                    <div x-show="activeTab === 'vision'" x-transition:enter="transition ease-out duration-300 delay-100"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0" class="absolute inset-0">
                        <h3 class="text-2xl font-bold text-[#2e7d32] mb-4">Mewujudkan Potensi Pertanian Berbasis
                            Teknologi dan Data</h3>
                        <p class="text-[#2e7d32]/80 leading-relaxed mb-6">
                            AgrOptimal bercita-cita menjadi platform pendukung pertanian yang membantu memaksimalkan
                            potensi petani mengambil keputusan secara lebih yakin melalui data, edukasi, dan teknologi
                            yang mudah diakses.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <span
                                    class="flex-shrink-0 w-6 h-6 bg-[#f4b400]/10 text-[#f4b400] rounded-full flex items-center justify-center mr-3 mt-0.5">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                                <span class="text-[#2e7d32]">Menumbuhkan ekosistem pertanian yang adaptif</span>
                            </li>
                            <li class="flex items-start">
                                <span
                                    class="flex-shrink-0 w-6 h-6 bg-[#f4b400]/10 text-[#f4b400] rounded-full flex items-center justify-center mr-3 mt-0.5">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                                <span class="text-[#2e7d32]">Mendorong pertanian modern</span>
                            </li>
                        </ul>
                    </div>

                    <div x-show="activeTab === 'mission'" x-cloak
                        x-transition:enter="transition ease-out duration-300 delay-100"
                        x-transition:enter-start="opacity-0 translate-y-4"
                        x-transition:enter-end="opacity-100 translate-y-0" class="absolute inset-0">
                        <h3 class="text-2xl font-bold text-[#2e7d32] mb-4">Menghadirkan kemudahan bertani melalui data
                            dan edukasi.</h3>
                        <p class="text-[#2e7d32]/80 leading-relaxed mb-6">
                            AgrOptimal berkomitmen menyediakan informasi pupuk, panduan komoditas pokok, serta analisis
                            lahan dan simulasi panen yang sederhana dan mudah dipahami oleh semua kalangan dengan
                            memberikan data yang akurat.
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-start">
                                <span
                                    class="flex-shrink-0 w-6 h-6 bg-[#f4b400]/10 text-[#f4b400] rounded-full flex items-center justify-center mr-3 mt-0.5">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                                <span class="text-[#2e7d32]">Menyajikan pendataan pupuk dan edukasi pertanian yang
                                    relevan</span>
                            </li>
                            <li class="flex items-start">
                                <span
                                    class="flex-shrink-0 w-6 h-6 bg-[#f4b400]/10 text-[#f4b400] rounded-full flex items-center justify-center mr-3 mt-0.5">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                </span>
                                <span class="text-[#2e7d32]">Membantu petani dengan panduan praktis</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    [x-cloak] {
        display: none !important;
    }

    @keyframes blob {
        0% {
            transform: translate(0px, 0px) scale(1);
        }

        33% {
            transform: translate(30px, -50px) scale(1.1);
        }

        66% {
            transform: translate(-20px, 20px) scale(0.9);
        }

        100% {
            transform: translate(0px, 0px) scale(1);
        }
    }

    .animate-blob {
        animation: blob 7s infinite;
    }

    .animation-delay-2000 {
        animation-delay: 2s;
    }
</style>
