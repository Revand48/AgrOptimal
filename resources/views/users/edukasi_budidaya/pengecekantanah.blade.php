@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-b relative overflow-hidden font-sans text-slate-800">

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 space-y-20">

            {{-- HEADER --}}
            <div class="text-center max-w-3xl mx-auto space-y-6">
                <div
                    class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-emerald-100/60 border border-emerald-200 text-emerald-800 text-sm font-bold backdrop-blur-sm shadow-sm">
                    <span class="relative flex h-3 w-3">
                        <span
                            class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                    </span>
                    Teknologi Pertanian Cerdas
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-tight">
                    Cek Kondisi <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500">Tanah</span>
                    Anda
                </h1>
                <p class="text-lg text-slate-600 leading-relaxed max-w-2xl mx-auto">
                    Ikuti panduan langkah demi langkah pengecekan tanah secara tradisional untuk memastikan lahan Anda dalam
                    kondisi optimal. Tanah sehat adalah kunci panen melimpah.
                </p>
            </div>



            {{-- SECTION 2: CEK TANAH TRADISIONAL --}}
            <section id="tradisional" class="scroll-mt-24">
                <div class="mb-16 flex flex-col md:flex-row md:items-end justify-between gap-4 text-center md:text-left">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <div
                                class="w-10 h-10 rounded-xl bg-emerald-600 flex items-center justify-center shadow-lg shadow-emerald-600/20">
                                <span class="text-white font-black text-sm">01</span>
                            </div>
                            <h2 class="text-3xl font-bold text-slate-800">Cek Tanah Tradisional</h2>
                        </div>
                        <p class="text-slate-500 md:ml-13 text-lg">Panduan langkah demi langkah mengecek tanah secara
                            manual.</p>
                    </div>
                </div>

                @php
                    // $steps is passed from the EdukasiController
                @endphp

                <div class="relative max-w-6xl mx-auto">
                    <!-- Vertical Line (Roadmap Axis) -->
                    <div
                        class="absolute left-8 md:left-1/2 top-0 bottom-0 w-1 bg-gradient-to-b from-emerald-200 via-emerald-400 to-emerald-100 md:-translate-x-1/2 rounded-full">
                    </div>

                    @forelse ($steps as $step)
                        <div class="relative z-10 mb-12 md:mb-24 group">
                            <div class="flex flex-col md:flex-row items-center w-full">

                                <!-- LEFT SIDE (Content for ODD, Spacer for EVEN) -->
                                <div
                                    class="w-full md:w-1/2 pl-20 md:pl-0 md:pr-16 {{ $loop->even ? 'hidden md:block md:invisible' : '' }}">
                                    @if ($loop->odd)
                                        <div
                                            class="bg-white rounded-[2rem] p-6 md:p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 relative overflow-hidden hover:-translate-y-2 hover:shadow-emerald-500/20 transition-all duration-500 group-hover:border-emerald-500/30">

                                            <!-- Decorative Blob -->
                                            <div
                                                class="absolute -top-12 -right-12 w-40 h-40 bg-gradient-to-br from-emerald-50 to-teal-50 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
                                            </div>

                                            @if ($step->image)
                                                <div
                                                    class="mb-6 rounded-2xl overflow-hidden shadow-sm aspect-video relative group-hover:shadow-md transition-all">
                                                    <div
                                                        class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity z-10">
                                                    </div>
                                                    <img src="{{ asset('storage/' . $step->image) }}"
                                                        alt="{{ $step->title }}"
                                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                                                </div>
                                            @endif

                                            <div class="space-y-3 relative z-10">
                                                <div class="flex items-start gap-3">
                                                    <h3
                                                        class="text-xl font-bold text-slate-800 group-hover:text-emerald-600 transition-colors">
                                                        {{ $step->title }}
                                                    </h3>
                                                </div>
                                                <p class="text-slate-600 leading-relaxed text-sm">
                                                    {{ $step->content }}
                                                </p>
                                            </div>

                                            <!-- Arrow Desktop -->
                                            <div
                                                class="hidden md:block absolute top-1/2 -right-3 w-6 h-6 bg-white border-t border-r border-slate-100 transform rotate-45 group-hover:border-emerald-200 transition-colors">
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <!-- CENTER MARKER -->
                                <div
                                    class="absolute left-8 md:left-1/2 -translate-x-1/2 flex items-center justify-center w-14 h-14 rounded-full bg-white border-4 border-emerald-50 shadow-xl z-20 group-hover:scale-110 group-hover:border-emerald-200 transition-all duration-300">
                                    <div
                                        class="absolute inset-0 bg-emerald-50 rounded-full scale-0 group-hover:scale-100 transition-transform duration-300">
                                    </div>
                                    <span
                                        class="relative text-emerald-600 font-black text-xl group-hover:text-emerald-700">{{ $step->step_number }}</span>
                                </div>

                                <!-- RIGHT SIDE (Content for EVEN, Spacer for ODD) -->
                                <div
                                    class="w-full md:w-1/2 pl-20 md:pl-16 {{ $loop->odd ? 'hidden md:block md:invisible' : '' }}">
                                    @if ($loop->even)
                                        <div
                                            class="bg-white rounded-[2rem] p-6 md:p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-slate-100 relative overflow-hidden hover:-translate-y-2 hover:shadow-emerald-500/20 transition-all duration-500 group-hover:border-emerald-500/30">

                                            <!-- Decorative Blob -->
                                            <div
                                                class="absolute -top-12 -left-12 w-40 h-40 bg-gradient-to-bl from-emerald-50 to-teal-50 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
                                            </div>

                                            @if ($step->image)
                                                <div
                                                    class="mb-6 rounded-2xl overflow-hidden shadow-sm aspect-video relative group-hover:shadow-md transition-all">
                                                    <div
                                                        class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity z-10">
                                                    </div>
                                                    <img src="{{ asset('storage/' . $step->image) }}"
                                                        alt="{{ $step->title }}"
                                                        class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                                                </div>
                                            @endif

                                            <div class="space-y-3 relative z-10">
                                                <div class="flex items-start gap-3">
                                                    <h3
                                                        class="text-xl font-bold text-slate-800 group-hover:text-emerald-600 transition-colors">
                                                        {{ $step->title }}
                                                    </h3>
                                                </div>
                                                <p class="text-slate-600 leading-relaxed text-sm">
                                                    {{ $step->content }}
                                                </p>
                                            </div>

                                            <!-- Arrow Desktop -->
                                            <div
                                                class="hidden md:block absolute top-1/2 -left-3 w-6 h-6 bg-white border-b border-l border-slate-100 transform rotate-45 group-hover:border-emerald-200 transition-colors">
                                            </div>
                                        </div>
                                    @endif
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="text-center py-12">
                            <div
                                class="bg-white rounded-[2rem] p-12 shadow-sm border border-dashed border-slate-300 text-center">
                                <p class="text-slate-400 text-lg">Belum ada langkah cek tanah tradisional yang tersedia.
                                </p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </section>

            {{-- Navigasi --}}
            <div class="flex justify-between mt-12 mb-20">
                <a href="{{ route('edukasi.pemupukan') }}"
                    class="px-6 py-3 rounded-xl bg-white border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 hover:border-emerald-200 transition-all shadow-sm">
                    ← Tips Pemupukan
                </a>

                <a href="{{ route('edukasi.irigasi') }}"
                    class="px-6 py-3 rounded-xl bg-emerald-600 text-white font-bold hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-600/20">
                    Lanjut: Irigasi Efisien →
                </a>
            </div>

        </div>
    </div>

    <style>
        [x-cloak] {
            display: none !important;
        }

        .aspect-video {
            aspect-ratio: 16 / 9;
        }
    </style>
@endsection
