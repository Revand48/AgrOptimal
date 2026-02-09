@push('styles')
    <style>
        /* Animasi Float (Gerakan Internal) */
        @keyframes float-random {
            0% {
                transform: translate(0, 0) rotate(0deg);
            }

            33% {
                transform: translate(5px, -10px) rotate(5deg);
            }

            /* Gerakan diperhalus agar tidak nabrak */
            66% {
                transform: translate(-5px, -5px) rotate(-3deg);
            }

            100% {
                transform: translate(0, 0) rotate(0deg);
            }
        }

        .animate-float-random {
            animation: float-random infinite ease-in-out;
        }

        .bg-grid-pattern {
            background-image: radial-gradient(#2e7d32 1px, transparent 1px);
            background-size: 20px 20px;
            opacity: 0.05;
        }
    </style>
@endpush

<section class="relative w-full min-h-[90vh] flex items-center justify-center overflow-hidden bg-[#d8ffe5]"
    x-data="{
        mouseX: 0,
        mouseY: 0,
        width: window.innerWidth,
        height: window.innerHeight,
        icons: [],

        // Definisi Zona Aman (Agar tidak nabrak konten tengah)
        // Koordinat dalam Persen (%)
        zones: [
            { id: 1, minTop: 5, maxTop: 20, minLeft: 2, maxLeft: 15 }, // Kiri Atas
            { id: 2, minTop: 5, maxTop: 20, minLeft: 85, maxLeft: 95 }, // Kanan Atas
            { id: 3, minTop: 40, maxTop: 60, minLeft: 1, maxLeft: 8 }, // Kiri Tengah (Samping)
            { id: 4, minTop: 35, maxTop: 55, minLeft: 92, maxLeft: 98 }, // Kanan Tengah (Samping)
            { id: 5, minTop: 80, maxTop: 95, minLeft: 2, maxLeft: 15 }, // Kiri Bawah
            { id: 6, minTop: 80, maxTop: 95, minLeft: 85, maxLeft: 95 }, // Kanan Bawah
            { id: 7, minTop: 88, maxTop: 95, minLeft: 40, maxLeft: 60 } // Tengah Bawah (Di bawah konten)
        ],

        init() {
            // Generate icon berdasarkan Zona
            this.icons = this.zones.map(zone => {
                return {
                    id: zone.id,
                    // Random posisi HANYA di dalam batas zona masing-masing
                    top: Math.random() * (zone.maxTop - zone.minTop) + zone.minTop,
                    left: Math.random() * (zone.maxLeft - zone.minLeft) + zone.minLeft,

                    // Variasi ukuran & kecepatan
                    size: Math.random() * (4.5 - 2.5) + 2.5, // 2.5rem - 4.5rem
                    speed: (Math.random() - 0.5) * 0.04, // Kecepatan parallax
                    animDuration: Math.random() * 5 + 8 + 's',
                    animDelay: Math.random() * 2 + 's'
                };
            });

            window.addEventListener('resize', () => {
                this.width = window.innerWidth;
                this.height = window.innerHeight;
            });
        },

        handleMouseMove(e) {
            this.mouseX = e.clientX;
            this.mouseY = e.clientY;
        },

        getParallaxStyle(icon) {
            const xOffset = (this.mouseX - (this.width / 2)) * icon.speed;
            const yOffset = (this.mouseY - (this.height / 2)) * icon.speed;
            return `transform: translate(${xOffset}px, ${yOffset}px); transition: transform 0.1s linear;`;
        }
    }" @mousemove.window="handleMouseMove">

    {{-- 1. BACKGROUND LAYER --}}
    <div class="absolute inset-0 w-full h-full pointer-events-none z-0">
        {{-- Dekorasi Blur (Gradient) --}}
        {{-- <div class="absolute -top-20 -right-20 w-96 h-96 bg-[#f4b400] opacity-10 rounded-full blur-[120px]"></div> --}}
        {{-- <div class="absolute -bottom-20 -left-20 w-80 h-80 bg-[#2e7d32] opacity-10 rounded-full blur-[120px]"></div> --}}

        {{-- Loop Icons --}}
        <template x-for="icon in icons" :key="icon.id">
            <div class="absolute will-change-transform"
                :style="`
                                    top: ${icon.top}%;
                                    left: ${icon.left}%;
                                    width: ${icon.size}rem;
                                    ${getParallaxStyle(icon)}
                                `">
                <img :src="`/img/beranda/hero/icon-${icon.id}.webp`"
                    class="w-full h-full opacity-30 grayscale hover:scale-110 transition-transform duration-300 animate-float-random hover:grayscale-0 hover:opacity-80"
                    :style="`
                                            animation-duration: ${icon.animDuration};
                                            animation-delay: ${icon.animDelay};
                                        `"
                    alt="Icon Dekorasi">
            </div>
        </template>
    </div>

    {{-- 2. CONTENT LAYER (Z-INDEX Tinggi agar di atas icon) --}}
    <div class="container mx-auto px-6 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            {{-- KIRI: Konten Teks --}}
            <div
                class="space-y-6 text-center lg:text-left bg-[#d8ffe5]/80 lg:bg-transparent backdrop-blur-sm lg:backdrop-blur-none rounded-2xl p-4 lg:p-0">
                <div
                    class="inline-flex items-center px-4 py-2 bg-[#f4b400] text-[#5e4001] rounded-full text-sm font-bold shadow-sm mb-2">
                    <span class="w-2 h-2 rounded-full bg-white mr-2 animate-pulse"></span>
                    Sistem Monitoring & Edukasi Pertanian Sidoarjo
                </div>
                <h1 class="text-4xl lg:text-5xl font-extrabold text-[#1a1a1a] leading-[1.2]">
                    Optimalkan <span class="text-[#2e7d32]">lahan & pupuk</span> dengan data real-time.
                </h1>
                <p class="text-lg text-gray-600 leading-relaxed max-w-lg mx-auto lg:mx-0">
                    AgrOptimal membantu petani, penyuluh, dan pemerintah Sidoarjo memantau distribusi pupuk, budidaya,
                    dan laporan lapangan dalam satu website.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 pt-4 justify-center lg:justify-start">
                </div>
                <div class="pt-2">
                    <p class="text-sm font-medium text-gray-500">
                        <span class="inline-block px-2 py-1 bg-[#f4b400] text-white rounded text-xs mr-2">Kabupaten
                            Sidoarjo</span>
                        Terhubung dengan data kelompok tani
                    </p>
                </div>
            </div>

            {{-- KANAN: Widget Cuaca --}}
            <div class="relative w-full max-w-md mx-auto lg:max-w-full" x-data="{
                weatherData: {
                    temp: 29,
                    condition: 'Cerah Berawan',
                    humidity: 75,
                    commodity: 'Padi IR-64',
                    suitability: 92
                }
            }">

                {{-- Kartu Utama --}}
                <div
                    class="bg-white rounded-[2rem] p-6 shadow-xl shadow-green-900/20 border-4 border-white relative overflow-hidden group hover:scale-[1.02] transition-transform duration-500">
                    <div class="absolute inset-0 bg-grid-pattern z-0"></div>

                    {{-- Header --}}
                    <div class="flex justify-between items-start relative z-10 mb-6">
                        <div>
                            <p class="text-sm text-gray-500 font-semibold uppercase tracking-wider">Prediksi Tanam</p>
                            <h3 class="text-2xl font-bold text-[#2e7d32]">{{ now()->translatedFormat('F Y') }}</h3>
                        </div>
                        <div class="bg-[#d8ffe5] px-3 py-1 rounded-lg text-[#2e7d32] text-xs font-bold">Sidoarjo, Jatim
                        </div>
                    </div>

                    {{-- Konten Cuaca --}}
                    <div class="flex items-center gap-6 relative z-10 mb-8">
                        <div
                            class="w-24 h-24 bg-gradient-to-br from-[#f4b400] via-amber-500 to-orange-400 rounded-full flex items-center justify-center shadow-lg animate-pulse-slow">
                            <img src="img/beranda/hero/cuaca.webp" alt="Cuaca"
                                class="w-14 h-14 invert brightness-0">
                        </div>
                        <div>
                            <span class="text-5xl font-bold text-gray-800" x-text="weatherData.temp + '°'"></span>
                            <p class="text-gray-500 font-medium" x-text="weatherData.condition"></p>
                            <div class="flex items-center gap-2 mt-2 text-xs text-gray-400">
                                <img src="img/beranda/hero/kelembaban.webp" alt="Humidity"
                                    class="w-4 h-4 opacity-60">
                                Kelembaban: <span x-text="weatherData.humidity + '%'"></span>
                            </div>
                        </div>
                    </div>

                    <div class="h-px w-full bg-gray-100 mb-6"></div>

                    {{-- Rekomendasi --}}
                    <div class="relative z-10">
                        <div class="flex justify-between items-end mb-2">
                            <div>
                                <p class="text-xs text-gray-400">Rekomendasi Komoditas</p>
                                <p class="text-lg font-bold text-[#2e7d32]" x-text="weatherData.commodity"></p>
                            </div>
                            <div class="text-right">
                                <span class="text-3xl font-bold text-[#2e7d32]"
                                    x-text="weatherData.suitability + '%'"></span>
                            </div>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-4 overflow-hidden">
                            <div class="bg-[#2e7d32] h-4 rounded-full" style="width: 92%">
                                <div
                                    class="w-full h-full opacity-20 bg-[url('data:image/webp;base64,iVBORw0KGgoAAAANSUhEUgAAAAQAAAAECAYAAACp8Z5+AAAAIklEQVQIW2NkQAKrVq36zwjjgzhhYWGMYAEYB8RmROaABADeOQ8CXl/xfgAAAABJRU5ErkJggg==')]">
                                </div>
                            </div>
                        </div>
                        <div
                            class="mt-4 flex items-center gap-2 p-3 bg-[#d8ffe5]/50 rounded-lg border border-[#2e7d32]/10">
                            <div class="w-6 h-6 rounded-full bg-[#2e7d32] flex items-center justify-center text-white">
                                <img src="img/beranda/hero/lokasi.webp" alt="Check"
                                    class="w-3.5 h-3.5 invert brightness-0">
                            </div>
                            <span class="text-sm font-bold text-[#2e7d32]">Sangat Cocok Tanam</span>
                        </div>
                    </div>
                </div>

                {{-- Floating Card Kecil --}}
                <div class="absolute -right-4 top-1/3 transform -translate-y-1/2 bg-[#2e7d32] text-white p-4 rounded-xl shadow-lg shadow-green-900/20 max-w-[150px] hidden lg:block animate-float-random"
                    style="animation-delay: 1s;">
                    <div class="flex flex-col items-center text-center">
                        <img src="img/beranda/hero/hujan.webp" alt="kalender"
                            class="w-8 h-8 mb-2 invert brightness-0 opacity-90">
                        <span class="font-bold text-lg">67%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
