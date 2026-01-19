@props(['homeData'])

@php
    // Fallback biar aman kalau data kosong
    $homeData = $homeData ?? (object) [
        'total_pupuk' => 0,
        'jenis_pupuk' => 0,
        'petani_terdampak' => 0,
        'rating' => 0,
        'updated_at' => now(),
    ];
@endphp

<!-- Data Statistik – Agroptimal Sidoarjo -->
<div class="relative py-20 overflow-hidden bg-[#d8ffe5] font-sans">

    <!-- ===== Background Decorative Elements ===== -->
    <div class="absolute inset-0 pointer-events-none">
        <!-- blob kiri
        <div
            class="absolute -top-32 -left-32 w-[420px] h-[420px] bg-green-300/30 rounded-full blur-3xl">
        </div>-->

        <!-- blob kanan
        <div
            class="absolute -bottom-32 -right-32 w-[420px] h-[420px] bg-yellow-300/30 rounded-full blur-3xl">
        </div>-->

        <!-- garis horizontal -->
        <div
            class="absolute top-3/4 left-0 w-full h-16 bg-green-900/10 -translate-y-1/2">
        </div>
    </div>
    <!-- ===== End Background ===== -->

    <div class="container relative z-10 mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Heading -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-extrabold text-[#2e7d32]">
                Statistik <span class="text-[#f4b400]">Agroptimal</span> Saat Ini
            </h2>
            <p class="mt-3 max-w-2xl mx-auto text-[#2e7d32]/80">
                Diperbarui secara berkala berdasarkan data dari petani & penyuluh di Sidoarjo.
            </p>
        </div>

        <!-- Cards -->
        <div
            x-data="{
                stats: {
                    total_pupuk: '{{ number_format($homeData->total_pupuk, 0, ',', '.') }} kg',
                    jenis_pupuk: {{ (int) $homeData->jenis_pupuk }},
                    petani_terdampak: {{ (int) $homeData->petani_terdampak }},
                    rating: {{ (float) $homeData->rating }},
                    updated_at: '{{ $homeData->updated_at->translatedFormat('d F Y, H:i') }}'
                }
            }"
            class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-5 lg:gap-6"
        >

            <!-- ================= TOTAL PUPUK ================= -->
            <div class="group relative bg-white rounded-2xl p-6 transition-all duration-500 hover:-translate-y-1.5 hover:shadow-[0_10px_25px_-5px_rgba(46,125,50,0.15)] border border-transparent hover:border-[#2e7d32]/20 overflow-hidden">
                <div class="w-12 h-12 rounded-xl bg-[#d8ffe5] flex items-center justify-center mb-4 transition-all duration-300 group-hover:bg-[#2e7d32]">
                    <img src="{{ asset('img/beranda/data/pupuk-1.webp') }}" class="w-7 h-7 group-hover:scale-110 transition-transform" alt="Total Pupuk">
                </div>
                <h3 class="text-sm font-semibold text-[#2e7d32]/80 mb-1">Total Pupuk</h3>
                <p class="text-2xl font-bold text-[#2e7d32]" x-text="stats.total_pupuk"></p>
                <svg class="absolute bottom-0 left-0 w-full h-12 fill-white/70 group-hover:fill-[#d8ffe5] transition-all" viewBox="0 0 1200 120">
                    <path d="M0 0 L0 120 L1200 120 L1200 0 Q600 170 0 0 Z" />
                </svg>
            </div>

            <!-- ================= JENIS PUPUK ================= -->
            <div class="group relative bg-white rounded-2xl p-6 transition-all duration-500 hover:-translate-y-1.5 hover:shadow-[0_10px_25px_-5px_rgba(244,180,0,0.15)] border border-transparent hover:border-[#f4b400]/30 overflow-hidden">
                <div class="w-12 h-12 rounded-xl bg-[#d8ffe5] flex items-center justify-center mb-4 transition-all duration-300 group-hover:bg-[#f4b400]">
                    <img src="{{ asset('img/beranda/data/pupuk-2.webp') }}" class="w-7 h-7 group-hover:scale-110 transition-transform" alt="Jenis Pupuk">
                </div>
                <h3 class="text-sm font-semibold text-[#2e7d32]/80 mb-1">Jenis Pupuk</h3>
                <p class="text-2xl font-bold text-[#2e7d32]" x-text="stats.jenis_pupuk"></p>
                <svg class="absolute bottom-0 left-0 w-full h-12 fill-white/70 group-hover:fill-[#d8ffe5] transition-all" viewBox="0 0 1200 120">
                    <path d="M0 0 L0 120 L1200 120 L1200 0 Q600 170 0 0 Z" />
                </svg>
            </div>

            <!-- ================= PETANI ================= -->
            <div class="group relative bg-white rounded-2xl p-6 transition-all duration-500 hover:-translate-y-1.5 hover:shadow-[0_10px_25px_-5px_rgba(46,125,50,0.15)] border border-transparent hover:border-[#2e7d32]/20 overflow-hidden">
                <div class="w-12 h-12 rounded-xl bg-[#d8ffe5] flex items-center justify-center mb-4 transition-all duration-300 group-hover:bg-[#2e7d32]">
                    <img src="{{ asset('img/beranda/data/u-petani.webp') }}" class="w-7 h-7 group-hover:scale-110 transition-transform" alt="Petani">
                </div>
                <h3 class="text-sm font-semibold text-[#2e7d32]/80 mb-1">Petani Terdampak</h3>
                <p class="text-2xl font-bold text-[#2e7d32]" x-text="stats.petani_terdampak"></p>
                <svg class="absolute bottom-0 left-0 w-full h-12 fill-white/70 group-hover:fill-[#d8ffe5] transition-all" viewBox="0 0 1200 120">
                    <path d="M0 0 L0 120 L1200 120 L1200 0 Q600 170 0 0 Z" />
                </svg>
            </div>

            <!-- ================= RATING ================= -->
            <div class="group relative bg-white rounded-2xl p-6 transition-all duration-500 hover:-translate-y-1.5 hover:shadow-[0_10px_25px_-5px_rgba(244,180,0,0.2)] border border-transparent hover:border-[#f4b400]/30 overflow-hidden">
                <div class="w-12 h-12 rounded-xl bg-[#d8ffe5] flex items-center justify-center mb-4 transition-all duration-300 group-hover:bg-[#f4b400]">
                    <img src="{{ asset('img/beranda/data/rating.webp') }}" class="w-7 h-7 group-hover:scale-110 transition-transform" alt="Rating">
                </div>
                <h3 class="text-sm font-semibold text-[#2e7d32]/80 mb-1">Rating Pengguna</h3>
                <p class="text-2xl font-bold text-[#f4b400]" x-text="stats.rating"></p>
                <svg class="absolute bottom-0 left-0 w-full h-12 fill-white/70 group-hover:fill-[#d8ffe5] transition-all" viewBox="0 0 1200 120">
                    <path d="M0 0 L0 120 L1200 120 L1200 0 Q600 170 0 0 Z" />
                </svg>
            </div>

            <!-- ================= UPDATE ================= -->
            <div class="group relative bg-white rounded-2xl p-6 transition-all duration-500 hover:-translate-y-1.5 hover:shadow-[0_10px_25px_-5px_rgba(46,125,50,0.1)] border border-transparent hover:border-[#2e7d32]/20 overflow-hidden">
                <div class="w-12 h-12 rounded-xl bg-[#d8ffe5] flex items-center justify-center mb-4 transition-all duration-300 group-hover:bg-[#2e7d32]">
                    <img src="{{ asset('img/beranda/data/update.webp') }}" class="w-7 h-7 group-hover:scale-110 transition-transform" alt="Update">
                </div>
                <h3 class="text-sm font-semibold text-[#2e7d32]/80 mb-2">Terakhir Diperbarui</h3>
                <p class="text-base font-bold text-[#2e7d32] leading-tight" x-text="stats.updated_at"></p>
                <svg class="absolute bottom-0 left-0 w-full h-12 fill-white/70 group-hover:fill-[#d8ffe5] transition-all" viewBox="0 0 1200 120">
                    <path d="M0 0 L0 120 L1200 120 L1200 0 Q600 170 0 0 Z" />
                </svg>
            </div>

        </div>
    </div>
</div>
