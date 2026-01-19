@extends('layouts.app')

@section('content')
    <div class=" min-h-screen pb-20">

        <section class="relative py-16 px-4 overflow-hidden" x-data="{
            progress: 0,
            animationId: null,
            init() {
                // Menggunakan requestAnimationFrame untuk animasi yang smooth
                const animate = () => {
                    this.progress = (this.progress + 0.2) % 100;
                    this.animationId = requestAnimationFrame(animate.bind(this));
                };
                this.animationId = requestAnimationFrame(animate.bind(this));
            },
            get gradientPosition() {
                // Perhitungan sederhana untuk animasi gradient
                return `${this.progress}% 50%`;
            },
            get leafRotation() {
                // Rotasi daun yang sangat halus
                return `rotate(${Math.sin(this.progress * 0.005) * 2}deg)`;
            },
            get waveOffset() {
                // Offset gelombang yang halus
                return `${Math.sin(this.progress * 0.02) * 10}px`;
            }
        }" x-init="init()"
            x-on:destroy="if (animationId) cancelAnimationFrame(animationId)">
            <!-- Background gradient statis dengan lapisan halus -->
            <div class="absolute inset-0 bg-gradient-to-br from-green-50/30 via-transparent to-teal-50/20"></div>

            <!-- Pola titik-titik halus dengan opacity rendah -->
            <div class="absolute inset-0 opacity-5"
                style="background-image: radial-gradient(#2d5a27 0.5px, transparent 0.5px); background-size: 40px 40px;">
            </div>

            <!-- Gradient animasi halus di background -->
            <div class="absolute top-0 left-0 right-0 h-1/2 opacity-10 overflow-hidden">
                <div class="absolute -top-1/2 -left-1/4 w-[150%] h-[200%] bg-gradient-to-r from-green-200/20 via-teal-200/10 to-emerald-200/20"
                    :style="`transform: translateX(${Math.sin(progress * 0.01) * 5}%) translateY(${Math.cos(progress * 0.01) * 5}%) rotate(${progress * 0.1}deg);`"
                    class="transition-transform duration-5000 ease-in-out"></div>
            </div>

            <div class="max-w-4xl mx-auto relative">
                <div class="text-center">
                    <!-- Dekorasi daun dengan animasi halus -->
                    <div class="absolute left-4 top-1/2 -translate-y-1/2 hidden lg:block transition-transform duration-3000 ease-in-out"
                        :style="{ transform: `translateY(${waveOffset}) ${leafRotation}` }">
                        <svg class="w-14 h-14 text-green-300/30" viewBox="0 0 100 100">
                            <path d="M50,20 C60,25 65,35 60,45 C55,55 45,60 35,55 C25,50 20,40 25,30 C30,20 40,15 50,20 Z"
                                fill="currentColor" />
                        </svg>
                    </div>

                    <div class="absolute right-4 top-1/2 -translate-y-1/2 hidden lg:block transition-transform duration-3000 ease-in-out delay-500"
                        :style="{ transform: `translateY(${waveOffset}) scaleX(-1) ${leafRotation}` }">
                        <svg class="w-14 h-14 text-green-300/30" viewBox="0 0 100 100">
                            <path d="M50,20 C60,25 65,35 60,45 C55,55 45,60 35,55 C25,50 20,40 25,30 C30,20 40,15 50,20 Z"
                                fill="currentColor" />
                        </svg>
                    </div>

                    <!-- Judul utama dengan animasi halus -->
                    <h1
                        class="text-3xl md:text-4xl lg:text-5xl font-bold text-[#2e7d32] tracking-tight leading-snug transition-all duration-1000">
                        SISTEM
                        <span class="relative inline-block mx-2">
                            <!-- Gradient animasi dengan transisi halus -->
                            <span
                                class="relative z-10 text-transparent bg-clip-text bg-gradient-to-r from-green-600 via-teal-500 to-emerald-600 transition-all duration-3000 ease-in-out"
                                :style="{ backgroundPosition: gradientPosition, backgroundSize: '200% 100%' }">
                                IRIGASI
                            </span>

                            <!-- Garis bawah animasi halus -->
                            <div
                                class="absolute -bottom-1 left-0 right-0 h-0.5 overflow-hidden transition-all duration-1000">
                                <div class="absolute inset-0 bg-gradient-to-r from-green-400 via-teal-400 to-emerald-400 transition-all duration-3000 ease-in-out"
                                    :style="{ backgroundPosition: gradientPosition, backgroundSize: '200% 100%' }">
                                </div>
                            </div>
                        </span>
                        PINTAR
                    </h1>
                </div>
            </div>

            <!-- Background gelombang irigasi dengan animasi halus -->
            <div class="absolute bottom-0 left-0 right-0 h-24 opacity-10 overflow-hidden transition-all duration-3000">
                <svg class="absolute bottom-0 w-full h-full transition-all duration-3000 ease-in-out" viewBox="0 0 1200 120"
                    preserveAspectRatio="none" :style="{ transform: `translateY(${waveOffset})` }">
                    <path :d="`M0,40 Q300,${40 + Math.sin(progress * 0.01) * 5} 600,40 T1200,40 L1200,120 L0,120 Z`"
                        class="fill-green-400/20 transition-all duration-3000" />
                    <path :d="`M0,60 Q300,${60 + Math.sin(progress * 0.015) * 4} 600,60 T1200,60 L1200,120 L0,120 Z`"
                        class="fill-green-500/15 transition-all duration-3000 delay-100" />
                </svg>
            </div>

            <!-- Titik-titik air dengan animasi sangat halus -->
            <div class="absolute inset-0 pointer-events-none">
                <template x-for="i in 3" :key="i">
                    <div class="absolute transition-all duration-3000 ease-in-out"
                        :style="`left: ${20 + (i * 30)}%;
                                                                                                                         top: ${30 + Math.sin(progress * 0.005 + i) * 3}%;
                                                                                                                         transform: scale(${0.7 + Math.sin(progress * 0.01 + i) * 0.1})`">
                        <svg class="w-4 h-4 text-green-400/20 transition-all duration-3000" viewBox="0 0 24 24">
                            <path d="M12,2 C8,2 4,6 4,10 C4,14 8,22 12,22 C16,22 20,14 20,10 C20,6 16,2 12,2 Z"
                                fill="currentColor" />
                        </svg>
                    </div>
                </template>
            </div>

            <!-- Background blur gradient dengan animasi halus -->
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] opacity-10 pointer-events-none transition-all duration-5000 ease-in-out"
                :style="{ transform: `translateY(${waveOffset})` }">
                <div
                    class="w-full h-full bg-gradient-to-r from-green-200/10 via-teal-200/5 to-emerald-200/10 blur-3xl transition-all duration-5000">
                </div>
            </div>

            <!-- Efek partikel tambahan yang sangat halus -->
            <div class="absolute inset-0 pointer-events-none">
                <template x-for="i in 2" :key="i">
                    <div class="absolute w-1 h-1 rounded-full bg-green-300/10 transition-all duration-4000 ease-in-out"
                        :style="`left: ${15 + (i * 70)}%;
                                                                                                                         top: ${20 + Math.sin(progress * 0.003 + i) * 2}%;
                                                                                                                         transform: translateX(${Math.cos(progress * 0.01 + i) * 5}px) scale(${0.5 + Math.sin(progress * 0.008 + i) * 0.2})`">
                    </div>
                </template>
            </div>
        </section>

        <div class="container mx-auto px-6" id="eksplorasi">
            <div class="flex flex-col lg:flex-row lg:items-end justify-between mb-12 gap-8">
                <div class="max-w-md">
                    <div class="flex items-center gap-3 mb-2">
                        <span class="h-1 w-12 bg-[#f4b400] rounded-full"></span>
                        <span class="text-[#f4b400] font-bold uppercase tracking-wider text-sm">Update Terbaru</span>
                    </div>
                    <h2 class="text-4xl font-black text-[#2e7d32]">Berita Utama</h2>
                </div>

                <div class="flex flex-wrap gap-2 bg-white p-2 rounded-2xl shadow-sm border border-emerald-100">
                    @php
                        $kategoris = ['Semua', 'Teknologi', 'Pupuk', 'Hama', 'Pasar'];
                        $currentKategori = request('kategori', 'Semua');
                    @endphp

                    @foreach ($kategoris as $kat)
                        <a href="{{ route('berita.index', ['kategori' => $kat === 'Semua' ? null : $kat]) }}"
                            class="px-6 py-3 rounded-xl text-sm font-bold transition-all duration-300 {{ $currentKategori === $kat ? 'bg-emerald-600 text-white shadow-lg' : 'bg-transparent text-emerald-700 hover:bg-emerald-50' }}">
                            {{ $kat }}
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                @forelse($daftarBerita as $berita)
                    <article
                        class="flex flex-col bg-white rounded-[2.5rem] overflow-hidden border border-emerald-50 shadow-xs hover:shadow-2xl hover:-translate-y-2 transition-all duration-500 group">
                        {{-- Area Foto --}}
                        <div class="relative h-72 overflow-hidden">
                            @if (Str::startsWith($berita->foto, 'http'))
                                <img src="{{ $berita->foto }}" alt="{{ $berita->judul }}"
                                    class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                            @else
                                <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}"
                                    class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                            @endif

                            {{-- Overlay Gradient --}}
                            <div
                                class="absolute inset-0 bg-linear-to-t from-emerald-950/80 via-transparent to-transparent opacity-60">
                            </div>

                            {{-- Badge Kategori --}}
                            <div class="absolute top-6 left-6">
                                <span
                                    class="bg-[#f4b400] text-emerald-950 text-[10px] font-black uppercase px-4 py-1.5 rounded-full shadow-lg">
                                    {{ $berita->kategori }}
                                </span>
                            </div>
                        </div>

                        {{-- Konten --}}
                        <div class="p-10 flex-1 flex flex-col">
                            <div class="flex items-center gap-4 mb-6 text-sm font-semibold text-emerald-600/60">
                                <span class="flex items-center gap-2">
                                    <svg class="w-5 h-5 text-[#f4b400]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    {{ $berita->created_at->translatedFormat('d M Y') }}
                                </span>
                            </div>

                            <h3
                                class="text-2xl font-extrabold text-[#2e7d32] leading-tight mb-5 group-hover:text-emerald-600 transition-colors">
                                <a href="{{ route('berita.show', $berita->slug) }}">{{ $berita->judul }}</a>
                            </h3>

                            <p class="text-slate-500 leading-relaxed mb-10 flex-1">
                                {{ Str::limit($berita->ringkasan, 120) }}
                            </p>

                            <div class="pt-6 border-t border-emerald-50">
                                <a href="{{ route('berita.show', $berita->slug) }}"
                                    class="inline-flex items-center gap-3 font-black text-[#2e7d32] hover:text-[#f4b400] transition-all group/link">
                                    BACA BERITA
                                    <span
                                        class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center group-hover/link:bg-[#f4b400] group-hover/link:text-emerald-950 transition-all">
                                        <svg class="w-5 h-5 transform group-hover/link:translate-x-1 transition-transform"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </article>
                @empty
                    <div
                        class="col-span-full py-32 text-center bg-white rounded-[3rem] border-2 border-dashed border-emerald-100">
                        <div class="inline-flex p-6 rounded-full bg-emerald-50 text-emerald-600 mb-4">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#2e7d32]">Belum Ada Berita</h3>
                        <p class="text-emerald-600/60 mt-2">Maaf, saat ini belum ada artikel yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>

            @if ($daftarBerita->hasPages())
                <div class="mt-20 flex justify-center">
                    <nav
                        class="inline-flex items-center bg-white p-3 rounded-[2rem] shadow-xl shadow-emerald-900/5 border border-emerald-50 gap-2">
                        {{-- Tombol Sebelumnya --}}
                        @if ($daftarBerita->onFirstPage())
                            <span
                                class="px-6 py-3 rounded-2xl text-slate-300 cursor-not-allowed font-bold text-sm">Kembali</span>
                        @else
                            <a href="{{ $daftarBerita->previousPageUrl() }}"
                                class="px-6 py-3 rounded-2xl text-emerald-700 hover:bg-emerald-50 transition-colors font-bold text-sm">Kembali</a>
                        @endif

                        {{-- Nomor Halaman (Ringkasan) --}}
                        <div class="flex items-center px-4 border-x border-emerald-100 mx-2">
                            <span class="text-[#2e7d32] font-black">{{ $daftarBerita->currentPage() }}</span>
                            <span class="mx-2 text-emerald-200">/</span>
                            <span class="text-emerald-400 font-medium">{{ $daftarBerita->lastPage() }}</span>
                        </div>

                        {{-- Tombol Selanjutnya --}}
                        @if ($daftarBerita->hasMorePages())
                            <a href="{{ $daftarBerita->nextPageUrl() }}"
                                class="px-6 py-3 bg-[#2e7d32] text-white rounded-2xl hover:bg-emerald-800 transition-all font-bold text-sm shadow-lg shadow-emerald-700/20">Selanjutnya</a>
                        @else
                            <span
                                class="px-6 py-3 bg-slate-100 text-slate-400 rounded-2xl cursor-not-allowed font-bold text-sm">Selanjutnya</span>
                        @endif
                    </nav>
                </div>
            @endif
        </div>
    </div>

    <style>
        /* Halus scroll ke konten saat klik Jelajahi */
        html {
            scroll-behavior: smooth;
        }

        /* Menghilangkan scrollbar pada filter kategori mobile */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
@endsection
