<section class="bg-[#d8ffe5] py-20 relative overflow-hidden" x-data="agroptimalData()" @click.outside="reset()">

    <div class="absolute top-0 left-0 w-full h-full overflow-hidden pointer-events-none">
        <div class="absolute top-0 -left-36 w-[500px] h-[500px] bg-emerald-100/50 rounded-full filter blur-3xl opacity-50 animate-blob"></div>
        <div class="absolute -bottom-36 -right-36 w-[500px] h-[500px] bg-teal-100/50 rounded-full filter blur-3xl opacity-50 animate-blob animation-delay-2000"></div>
    </div>

    <div class="container relative z-10 mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-extrabold text-[#2e7d32]">
                Mengapa Ada<span class="text-[#f4b400]"> Agroptimal</span> ?
            </h2>
            <p class="mt-3 max-w-2xl mx-auto text-[#2e7d32]/80">
                Solusi berbasis teknologi AI untuk memaksimalkan potensi pertanian daerah.
            </p>
        </div>

        <div class="max-w-7xl w-full mx-auto px-4 sm:px-6 relative z-10">
            <div class="bg-green-50/60 backdrop-blur-xl rounded-3xl overflow-hidden flex flex-col md:flex-row relative ring-1 ring-black/5 shadow-[0_0_50px_rgba(0,0,0,0.15)]">

                <div class="absolute top-10 left-10 w-32 h-32 rounded-full bg-emerald-400/10 pointer-events-none"></div>
                <div class="absolute bottom-16 right-12 w-24 h-24 rounded-full bg-teal-400/10 pointer-events-none"></div>

                <div class="md:w-1/2 p-8 md:p-12 border-r border-black/5 flex flex-col justify-between relative transition-colors duration-500 cursor-pointer" x-on:click="reset()">
                    <div class="flex-grow">
                        <div class="flex justify-center mb-6">
                            <div class="inline-block text-center">
                                <h3 class="text-2xl font-bold text-gray-800 flex items-center justify-center gap-2">
                                    <span class="fas fa-bullseye text-emerald-600"></span> Tujuan Kami
                                </h3>
                                <div class="h-1 w-16 bg-emerald-400 rounded-full mt-2 mx-auto"></div>
                            </div>
                        </div>

                        <div class="relative min-h-[160px]">
                            <p x-text="currentText" x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform translate-y-2"
                                x-transition:enter-end="opacity-100 transform translate-y-0"
                                class="text-gray-600 leading-relaxed text-base md:text-lg" :key="activeIdx"></p>

                            <div class="flex flex-wrap gap-2 pt-6">
                                <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold uppercase tracking-wide rounded-full flex items-center border border-green-200">
                                    <span class="fas fa-leaf mr-1.5"></span> Kemudahan
                                </span>
                                <span class="px-3 py-1 bg-teal-100 text-teal-700 text-xs font-bold uppercase tracking-wide rounded-full flex items-center border border-teal-200">
                                    <span class="fas fa-robot mr-1.5"></span> IoT & AI
                                </span>
                                <span class="px-3 py-1 bg-emerald-100 text-emerald-700 text-xs font-bold uppercase tracking-wide rounded-full flex items-center border border-emerald-200">
                                    <span class="fas fa-chart-line mr-1.5"></span> Flexibilitas
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="text-center text-xs text-gray-500 mt-6 transition-opacity duration-300" :class="activeIdx !== null ? 'opacity-100' : 'opacity-0'">
                        (Klik di luar area untuk kembali ke tujuan utama.)
                    </div>
                </div>

                <div class="md:w-1/2 p-8 md:p-12 flex flex-col justify-between">
                    <div class="flex-grow">
                        <div class="flex justify-center mb-6">
                            <div class="inline-block text-center">
                                <h3 class="text-2xl font-bold text-gray-800">Manfaat untuk Kamu</h3>
                                <div class="h-1 w-16 bg-emerald-400 rounded-full mt-2 mx-auto"></div>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div @click.stop="activeIdx === 0 ? reset() : setActive(0)"
                                class="group p-5 rounded-xl transition-all duration-300 cursor-pointer relative overflow-hidden hover:scale-[1.02] hover:shadow-lg"
                                :class="activeIdx === 0 ? 'shadow-md ring-2 ring-emerald-200' : 'bg-white/50'">
                                <div class="flex items-start relative z-10">
                                    <div class="flex-shrink-0 mr-4 mt-1 w-12 h-12 rounded-xl flex items-center justify-center transition-colors duration-300 bg-emerald-100">
                                        <img src="{{ asset('img/beranda/mengapa/icon-1.webp') }}" class="w-6 h-6">
                                    </div>
                                    <div class="flex-grow">
                                        <h4 class="text-lg font-bold text-gray-800 transition-colors" :class="activeIdx === 0 ? 'text-emerald-800' : ''">Data pupuk lebih transparan</h4>
                                        <p class="text-gray-500 text-sm mt-1 leading-snug">Mengetahui ketersediaan pupuk subsidi dan nonsubsidi di daerah Sidoarjo.</p>
                                    </div>
                                </div>
                            </div>

                            <div @click.stop="activeIdx === 1 ? reset() : setActive(1)"
                                class="group p-5 rounded-xl transition-all duration-300 cursor-pointer relative overflow-hidden hover:scale-[1.02] hover:shadow-lg"
                                :class="activeIdx === 1 ? 'shadow-md ring-2 ring-teal-200' : 'bg-white/50'">
                                <div class="flex items-start relative z-10">
                                    <div class="flex-shrink-0 mr-4 mt-1 w-12 h-12 rounded-xl flex items-center justify-center transition-colors duration-300 bg-teal-100">
                                        <img src="{{ asset('img/beranda/mengapa/icon-2.webp') }}" class="w-6 h-6">
                                    </div>
                                    <div class="flex-grow">
                                        <h4 class="text-lg font-bold text-gray-800 transition-colors" :class="activeIdx === 1 ? 'text-teal-800' : ''">Meningkatkan percaya diri dalam bertani.</h4>
                                        <p class="text-gray-500 text-sm mt-1 leading-snug">Keputusan diambil berdasarkan data dan pembelajaran, bukan sekadar pengalaman semata.</p>
                                    </div>
                                </div>
                            </div>

                            <div @click.stop="activeIdx === 2 ? reset() : setActive(2)"
                                class="group p-5 rounded-xl transition-all duration-300 cursor-pointer relative overflow-hidden hover:scale-[1.02] hover:shadow-lg"
                                :class="activeIdx === 2 ? 'shadow-md ring-2 ring-green-200' : 'bg-white/50'">
                                <div class="flex items-start relative z-10">
                                    <div class="flex-shrink-0 mr-4 mt-1 w-12 h-12 rounded-xl flex items-center justify-center transition-colors duration-300 bg-green-100">
                                        <img src="{{ asset('img/beranda/mengapa/icon-3.webp') }}" class="w-6 h-6">
                                    </div>
                                    <div class="flex-grow">
                                        <h4 class="text-lg font-bold text-gray-800 transition-colors" :class="activeIdx === 2 ? 'text-green-800' : ''">Mendapat panduan menanam.</h4>
                                        <p class="text-gray-500 text-sm mt-1 leading-snug">Edukasi praktis komoditas utama dan perpupukan tanpa harus menguasai istilah teknis.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @once
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('agroptimalData', () => ({
                activeIdx: null,
                defaultText: "AgrOptimal hadir untuk menjawab keresahan masyarakat terhadap kelangkaan kebutuhan pokok dengan membangun sistem pertanian yang lebih terdata, terarah, dan mudah dipahami mulai dari pendataan pupuk di wilayah Sidoarjo, edukasi pembuatan pupuk, simulasi panen, analisis kondisi lahan, hingga platform pembelajaran komoditas pokok yang bisa diakses siapa saja.",
                details: [
                    "AgrOptimal membantu petani mengetahui ketersediaan pupuk di daerah Sidoarjo secara lebih jelas dan akurat. Hal ini memudahkan perencanaan tanam tanpa kebingungan atau ketidakpastian ketersediaan pupuk.",
                    "Dengan dukungan data yang akurat, edukasi, dan simulasi, petani dapat mengambil keputusan dengan lebih yakin. Proses bertani tidak lagi sekadar perkiraan yang tidak pasti, tetapi berdasarkan informasi terpercaya.",
                    "AgrOptimal menyediakan panduan menanam komoditas pokok yang disusun secara sederhana dan mudah dipahami. Panduan ini membantu petani memulai tanam tanpa takut kehilangan terarah."
                ],
                get currentText() {
                    if (this.activeIdx === null) return this.defaultText;
                    return this.details[this.activeIdx];
                },
                setActive(index) {
                    if (this.activeIdx === index) return;
                    this.activeIdx = index;
                },
                reset() {
                    this.activeIdx = null;
                }
            }))
        })
    </script>
    @endonce
</section>
