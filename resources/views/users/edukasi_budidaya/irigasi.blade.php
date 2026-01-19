@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-green-50/30 to-white relative overflow-hidden font-sans text-gray-800">

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-20">

            {{-- HEADER --}}
            <div class="text-center max-w-3xl mx-auto space-y-6">
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-green-100/60 border border-green-200 text-green-800 text-sm font-bold backdrop-blur-sm shadow-sm">
                    <span class="relative flex h-3 w-3">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-green-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-green-500"></span>
                    </span>
                    Teknologi Irigasi Cerdas
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 tracking-tight leading-tight">
                    Panduan <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-yellow-500">Irigasi</span>
                    Tanaman
                </h1>
                <p class="text-lg text-gray-600 leading-relaxed max-w-2xl mx-auto">
                    Pelajari langkah-langkah irigasi yang tepat untuk setiap jenis tanaman Anda. Air adalah sumber
                    kehidupan, gunakan dengan bijak untuk hasil maksimal.
                </p>
            </div>

            {{-- SECTION: ROADMAP TIPS --}}
            <section id="roadmap" class="scroll-mt-24">

                <div class="relative max-w-6xl mx-auto">
                    <!-- Vertical Line (Roadmap Axis) -->
                    <div
                        class="absolute left-8 md:left-1/2 top-0 bottom-0 w-1 bg-gradient-to-b from-green-200 via-green-400 to-green-100 md:-translate-x-1/2 rounded-full">
                    </div>

                    @forelse ($tips as $tip)
                        <div class="relative z-10 mb-12 md:mb-24 group">
                            <div class="flex flex-col md:flex-row items-center w-full">

                                <!-- LEFT SIDE (Content for ODD, Spacer for EVEN) -->
                                <div
                                    class="w-full md:w-1/2 pl-20 md:pl-0 md:pr-16 {{ $loop->even ? 'hidden md:block md:invisible' : '' }}">
                                    @if ($loop->odd)
                                        @include('users.edukasi_budidaya.partials.irigasi_card', [
                                            'tip' => $tip,
                                        ])
                                    @endif
                                </div>

                                <!-- CENTER MARKER -->
                                <div
                                    class="absolute left-8 md:left-1/2 -translate-x-1/2 flex items-center justify-center w-14 h-14 rounded-full bg-white border-4 border-green-50 shadow-xl z-20 group-hover:scale-110 group-hover:border-green-200 transition-all duration-300">
                                    <div
                                        class="absolute inset-0 bg-green-50 rounded-full scale-0 group-hover:scale-100 transition-transform duration-300">
                                    </div>
                                    <span
                                        class="relative text-green-600 font-black text-xl group-hover:text-green-700">{{ $tip->step_number }}</span>
                                </div>

                                <!-- RIGHT SIDE (Content for EVEN, Spacer for ODD) -->
                                <div
                                    class="w-full md:w-1/2 pl-20 md:pl-16 {{ $loop->odd ? 'hidden md:block md:invisible' : '' }}">
                                    @if ($loop->even)
                                        @include('users.edukasi_budidaya.partials.irigasi_card', [
                                            'tip' => $tip,
                                        ])
                                    @endif
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12 ml-16 md:ml-0">
                            <div
                                class="bg-white rounded-[2rem] p-12 shadow-sm border border-dashed border-green-200 text-center">
                                <p class="text-green-600/50 text-lg">Belum ada tips irigasi yang tersedia.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </section>

            {{-- Navigasi --}}
            <div class="flex justify-between mt-12 mb-20 max-w-6xl mx-auto">
                <a href="{{ route('edukasi.cek_tanah') }}"
                    class="px-6 py-3 rounded-xl bg-white border border-green-200 text-green-700 font-bold hover:bg-green-50 transition-all shadow-sm">
                    ← Cek Tanah
                </a>

                <a href="{{ url('/') }}"
                    class="px-6 py-3 rounded-xl bg-green-600 text-white font-bold hover:bg-green-700 transition-all shadow-lg shadow-green-600/20">
                    Selesai: Kembali ke Beranda →
                </a>
            </div>

        </div>
    </div>

    <style>
        .aspect-video {
            aspect-ratio: 16 / 9;
        }
    </style>
@endsection
