@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gradient-to-b overflow-hidden font-sans text-gray-800" x-data="{ activeCrop: 'padi' }">

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
                    Fondasi Pertanian Sukses
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-slate-900 tracking-tight leading-tight">
                    Pengolahan <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-emerald-600 to-teal-500">Lahan</span>
                    Optimal
                </h1>
                <p class="text-lg text-slate-600 leading-relaxed max-w-2xl mx-auto">
                    Persiapkan media tanam terbaik untuk hasil panen maksimal. Teknik pengolahan lahan yang tepat untuk
                    setiap
                    jenis tanaman.
                </p>

                {{-- Toggle Komoditas --}}
                <div class="flex flex-wrap justify-center gap-3 mt-8">
                    <template
                        x-for="crop in [
                        {key:'padi', label:'🌾 Padi'},
                        {key:'jagung', label:'🌽 Jagung'},
                        {key:'kedelai', label:'🫘 Kedelai'},
                        {key:'singkong', label:'🌿 Singkong'},
                        {key:'ubi', label:'🍠 Ubi Jalar'}
                    ]">
                        <button @click="activeCrop = crop.key"
                            class="px-5 py-2.5 rounded-full text-sm font-bold transition-all duration-300 shadow-sm hover:shadow-md border"
                            :class="activeCrop === crop.key ?
                                'bg-emerald-600 text-white border-emerald-600 scale-105 ring-2 ring-emerald-200' :
                                'bg-white text-gray-600 border-gray-200 hover:border-emerald-300 hover:text-emerald-700'">
                            <span x-text="crop.label"></span>
                        </button>
                    </template>
                </div>
            </div>

            {{-- SECTION: ROADMAP --}}
            <section class="relative max-w-6xl mx-auto">
                <!-- Vertical Line (Roadmap Axis) -->
                <div
                    class="absolute left-8 md:left-1/2 top-0 bottom-0 w-1 bg-gradient-to-b from-emerald-200 via-emerald-400 to-emerald-100 md:-translate-x-1/2 rounded-full">
                </div>

                @foreach ($tips as $tip)
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

                                        @if ($tip->image)
                                            <div
                                                class="mb-6 rounded-2xl overflow-hidden shadow-sm aspect-video relative group-hover:shadow-md transition-all">
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity z-10">
                                                </div>
                                                <img src="{{ asset('storage/' . $tip->image) }}" alt="{{ $tip->title }}"
                                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                                            </div>
                                        @endif

                                        <div class="space-y-3 relative z-10">
                                            <h3
                                                class="text-xl font-bold text-slate-800 group-hover:text-emerald-600 transition-colors">
                                                {{ $tip->title }}
                                            </h3>
                                            <p class="text-slate-600 leading-relaxed text-sm font-medium">
                                                {{ $tip->description }}
                                            </p>

                                            <!-- Dynamic Content -->
                                            <div class="mt-4 pt-4 border-t border-dashed border-emerald-100 text-gray-600 text-sm leading-relaxed"
                                                x-transition:enter="transition ease-out duration-300"
                                                x-transition:enter-start="opacity-0 translate-y-2"
                                                x-transition:enter-end="opacity-100 translate-y-0">
                                                <template x-if="activeCrop === 'padi'">
                                                    <div class="prose-sm prose-emerald">{!! $tip->content_padi !!}</div>
                                                </template>
                                                <template x-if="activeCrop === 'jagung'">
                                                    <div class="prose-sm prose-emerald">{!! $tip->content_jagung !!}</div>
                                                </template>
                                                <template x-if="activeCrop === 'kedelai'">
                                                    <div class="prose-sm prose-emerald">{!! $tip->content_kedelai !!}</div>
                                                </template>
                                                <template x-if="activeCrop === 'singkong'">
                                                    <div class="prose-sm prose-emerald">{!! $tip->content_singkong !!}</div>
                                                </template>
                                                <template x-if="activeCrop === 'ubi'">
                                                    <div class="prose-sm prose-emerald">{!! $tip->content_ubi !!}</div>
                                                </template>
                                            </div>
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
                                    class="relative text-emerald-600 font-black text-xl group-hover:text-emerald-700">{{ $tip->step_number }}</span>
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

                                        @if ($tip->image)
                                            <div
                                                class="mb-6 rounded-2xl overflow-hidden shadow-sm aspect-video relative group-hover:shadow-md transition-all">
                                                <div
                                                    class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity z-10">
                                                </div>
                                                <img src="{{ asset('storage/' . $tip->image) }}" alt="{{ $tip->title }}"
                                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                                            </div>
                                        @endif

                                        <div class="space-y-3 relative z-10">
                                            <h3
                                                class="text-xl font-bold text-slate-800 group-hover:text-emerald-600 transition-colors">
                                                {{ $tip->title }}
                                            </h3>
                                            <p class="text-slate-600 leading-relaxed text-sm font-medium">
                                                {{ $tip->description }}
                                            </p>

                                            <!-- Dynamic Content -->
                                            <div class="mt-4 pt-4 border-t border-dashed border-emerald-100 text-gray-600 text-sm leading-relaxed"
                                                x-transition:enter="transition ease-out duration-300"
                                                x-transition:enter-start="opacity-0 translate-y-2"
                                                x-transition:enter-end="opacity-100 translate-y-0">
                                                <template x-if="activeCrop === 'padi'">
                                                    <div class="prose-sm prose-emerald">{!! $tip->content_padi !!}</div>
                                                </template>
                                                <template x-if="activeCrop === 'jagung'">
                                                    <div class="prose-sm prose-emerald">{!! $tip->content_jagung !!}</div>
                                                </template>
                                                <template x-if="activeCrop === 'kedelai'">
                                                    <div class="prose-sm prose-emerald">{!! $tip->content_kedelai !!}</div>
                                                </template>
                                                <template x-if="activeCrop === 'singkong'">
                                                    <div class="prose-sm prose-emerald">{!! $tip->content_singkong !!}</div>
                                                </template>
                                                <template x-if="activeCrop === 'ubi'">
                                                    <div class="prose-sm prose-emerald">{!! $tip->content_ubi !!}</div>
                                                </template>
                                            </div>
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
                @endforeach
            </section>

            {{-- Navigasi --}}
            <div class="flex justify-between mt-12 mb-20 max-w-6xl mx-auto">
                <a href="{{ route('edukasi.tips_bibit') }}"
                    class="px-6 py-3 rounded-xl bg-white border border-slate-200 text-slate-600 font-bold hover:bg-slate-50 hover:border-emerald-200 transition-all shadow-sm">
                    ← Tips Bibit
                </a>

                <a href="{{ route('edukasi.pemupukan') }}"
                    class="px-6 py-3 rounded-xl bg-emerald-600 text-white font-bold hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-600/20">
                    Lanjut: Tips Pemupukan →
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
