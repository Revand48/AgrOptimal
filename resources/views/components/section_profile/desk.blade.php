<section id="about-agroptimal"
         class="relative overflow-hidden bg-[#d8ffe5] py-8 lg:py-16 font-sans"
         x-data="{ loaded: false }"
         x-init="setTimeout(() => loaded = true, 200)">

    <div class="absolute -top-24 -left-24 h-80 w-80 rounded-full bg-[#2e7d32]/5 blur-3xl"></div>
    <div class="absolute top-1/2 -right-20 h-56 w-56 rounded-full bg-[#f4b400]/5 blur-3xl"></div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="flex flex-col lg:flex-row items-center gap-10 lg:gap-16">

            <div class="w-full lg:w-7/12"
                 x-show="loaded"
                 x-transition:enter="transition ease-out duration-1000"
                 x-transition:enter-start="opacity-0 -translate-x-12"
                 x-transition:enter-end="opacity-100 translate-x-0">

                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#2e7d32]/10 text-[#2e7d32] text-sm font-semibold mb-4">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-[#2e7d32] opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-[#2e7d32]"></span>
                    </span>
                    Platform Pertanian Lokal Sidoarjo
                </div>

                <h2 class="text-3xl lg:text-4xl font-extrabold text-[#2e7d32] leading-tight mb-5">
                    Bertani Lebih Yakin Tanpa Ragu dengan <span class="text-[#f4b400]">AgrOptimal</span>
                </h2>

                <p class="text-base text-[#2e7d32]/80 leading-relaxed mb-6">
                    Kami hadir di Sidoarjo untuk membantu petani dan generasi muda memulai pertanian tanpa kebingungan. AgrOptimal menyajikan informasi yang mudah dipahami, mulai dari ketersediaan pupuk (subsidi & nonsubsidi) hingga panduan awal penanaman padi dan jagung. Jadikan kami partner digital Anda dalam mengambil keputusan yang tepat di lapangan.
                </p>

                <div class="space-y-3 mb-8">
                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 bg-[#f4b400] p-1 rounded-md shadow-sm">
                            <svg class="w-4 h-4 text-[#2e7d32]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#2e7d32] text-base">Akses Informasi Pupuk & Panduan</h4>
                            <p class="text-[#2e7d32]/70 text-sm">Cek ketersediaan pupuk dan panduan komoditas utama dengan mudah.</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3">
                        <div class="mt-0.5 bg-[#f4b400] p-1 rounded-md shadow-sm">
                            <svg class="w-4 h-4 text-[#2e7d32]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-[#2e7d32] text-base">Mudah untuk Pemula & Petani</h4>
                            <p class="text-[#2e7d32]/70 text-sm">Pendekatan sederhana untuk pengguna awam hingga semi-paham.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full lg:w-5/12 relative mt-8 lg:mt-0"
                 x-show="loaded"
                 x-transition:enter="transition ease-out duration-1000 delay-300"
                 x-transition:enter-start="opacity-0 translate-y-12"
                 x-transition:enter-end="opacity-100 translate-y-0">

                <div class="absolute inset-0 bg-[#2e7d32]/5 rounded-3xl transform translate-x-3 translate-y-3"></div>

                <div class="relative rounded-3xl overflow-hidden border-4 border-white shadow-lg">
                    <img src="{{ asset('img/profile/hero_desk/desk.webp') }}"
                         alt="AgrOptimal Dashboard Sidoarjo"
                         class="w-full h-auto object-cover transform hover:scale-105 transition-transform duration-500">

                    <div class="absolute bottom-4 left-4 right-4 bg-white/95 backdrop-blur-sm p-3 rounded-xl shadow-md flex items-center justify-between border border-[#2e7d32]/10">
                        <div class="flex items-center gap-3">
                            <div class="h-8 w-8 bg-[#2e7d32] rounded-full flex items-center justify-center text-white">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                            <div>
                                <p class="text-[10px] text-[#2e7d32]/70 font-medium uppercase tracking-wider">Fokus Kami</p>
                                <p class="text-sm font-bold text-[#2e7d32]">Edukasi & Kepastian Data</p>
                            </div>
                        </div>
                        <div class="text-[#f4b400] bg-[#f4b400]/10 p-1.5 rounded-lg">
                             <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
