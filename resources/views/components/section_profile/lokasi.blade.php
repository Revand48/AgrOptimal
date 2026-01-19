<section class="relative w-full py-16 bg-[#d8ffe5] overflow-hidden font-sans">
    <div class="absolute top-0 left-0 w-64 h-64 bg-[#2e7d32]/10 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob"></div>
    <div class="absolute top-0 right-0 w-64 h-64 bg-[#f4b400]/10 rounded-full mix-blend-multiply filter blur-3xl opacity-30 animate-blob animation-delay-2000"></div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Heading -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-extrabold text-[#2e7d32]">
                Pusat Operasional <span class="text-[#f4b400]">AgrOptimal</span>
            </h2>
            <p class="mt-3 max-w-2xl mx-auto text-[#2e7d32]/80">
                Pusat koordinasi Agroptimal yang siap melayani langsung dari lapangan.
        </div>

        <div class="max-w-5xl mx-auto bg-white rounded-tl-[3rem] rounded-br-[3rem] rounded-tr-lg rounded-bl-lg shadow-2xl overflow-hidden border border-[#2e7d32]/20 relative">

            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-[#2e7d32] to-[#f4b400] z-20"></div>

            <div class="grid grid-cols-1 lg:grid-cols-3">

                <div class="p-8 lg:col-span-1 bg-white flex flex-col justify-center space-y-6 relative z-10">

                    <div>
                        <h3 class="text-lg font-bold text-[#2e7d32] uppercase tracking-wide border-l-4 border-[#f4b400] pl-3">
                            Kantor Kami
                        </h3>
                        <p class="mt-2 text-[#2e7d32]/60 text-sm leading-relaxed">
                            Pusat data agrikultur dan layanan teknis 24/7.
                        </p>
                    </div>

                    <div x-data="{
                            copied: false,
                            address: 'Pringgodani, Bakungpringgondani, Kec. BalongBendo, Kabupaten Sidoarjo, Jawa Timur 61263',
                            copyToClipboard() {
                                navigator.clipboard.writeText(this.address);
                                this.copied = true;
                                setTimeout(() => this.copied = false, 2000);
                            }
                        }"
                        class="bg-[#2e7d32]/5 p-4 rounded-xl border border-[#2e7d32]/10 relative group hover:border-[#2e7d32]/30 transition-colors">

                        <div class="text-[10px] text-[#2e7d32] font-bold mb-1 uppercase tracking-wider">Lokasi Kami</div>
                        <p class="text-[#2e7d32] font-medium text-sm leading-snug" x-text="address"></p>

                        <button
                            @click="copyToClipboard()"
                            class="mt-3 w-full py-2 px-3 rounded-lg text-xs font-bold transition-all duration-300 flex items-center justify-center gap-2 border"
                            :class="copied ? 'bg-[#2e7d32] text-white border-[#2e7d32]' : 'bg-white text-[#2e7d32] border-[#2e7d32]/20 hover:bg-[#2e7d32]/10'"
                        >
                            <span x-show="!copied">Salin Alamat</span>
                            <span x-show="copied" style="display: none;">Tersalin!</span>
                        </button>
                    </div>

                    <div class="space-y-3 pt-2 border-t border-[#2e7d32]/10">

                        <a href="mailto:agroptimal@gmail.com" class="flex items-center p-3 rounded-xl border border-[#2e7d32]/10 bg-white hover:border-[#2e7d32]/40 hover:shadow-md transition-all group">
                            <div class="w-8 h-8 rounded-full bg-[#2e7d32]/10 text-[#2e7d32] flex items-center justify-center group-hover:bg-[#2e7d32] group-hover:text-white transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            </div>
                            <div class="ml-3">
                                <span class="block text-[10px] text-[#2e7d32]/40 font-bold uppercase">Email</span>
                                <span class="text-sm font-semibold text-[#2e7d32] group-hover:text-[#2e7d32]">agroptimal@gmail.com</span>
                            </div>
                        </a>

                        <a href="tel:+62895347139758" class="flex items-center p-3 rounded-xl border border-[#2e7d32]/10 bg-white hover:border-[#f4b400]/40 hover:shadow-md transition-all group">
                            <div class="w-8 h-8 rounded-full bg-[#f4b400]/10 text-[#f4b400] flex items-center justify-center group-hover:bg-[#f4b400] group-hover:text-white transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            </div>
                            <div class="ml-3">
                                <span class="block text-[10px] text-[#2e7d32]/40 font-bold uppercase">Call Center</span>
                                <span class="text-sm font-semibold text-[#2e7d32] group-hover:text-[#f4b400]">+62 895 3471 39758</span>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-2 h-80 lg:h-auto bg-slate-200 relative group overflow-hidden">

                    <div class="absolute inset-0 bg-gradient-to-t from-[#2e7d32]/10 to-transparent pointer-events-none z-10"></div>

                    <iframe

                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3075.5587401205794!2d112.49695064399295!3d-7.410038751822348!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e780fc021299f85%3A0x918fbb7e6944ab08!2sPetilasan%20Eyang%20Gatot%20Koco!5e1!3m2!1sid!2sid!4v1767666792481!5m2!1sid!2sid"
                        class="w-full h-full border-0 filter grayscale-[10%] contrast-[1.05]"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                    <div class="absolute bottom-4 right-70 z-20">
                        <button class="bg-[#2e7d32] hover:bg-[#1b5e20] text-white text-xs font-bold py-2 px-4 rounded-lg shadow-lg transition-transform hover:-translate-y-1 flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                            Buka Peta
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
