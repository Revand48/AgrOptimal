@extends('layouts.app')

@section('content')
@section('content')
    <div class="min-h-screen bg-gradient-to-b overflow-hidden font-sans text-gray-800" x-data="{ activeCrop: 'padi' }">

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
                    Panduan Budidaya
                </div>
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-black text-gray-900 tracking-tight leading-tight">
                    Tips Pemupukan <span
                        class="text-transparent bg-clip-text bg-gradient-to-r from-green-600 to-yellow-500">Berimbang</span>
                </h1>
                <p class="text-lg text-gray-600 leading-relaxed max-w-2xl mx-auto">
                    Nutrisi yang tepat adalah kunci pertumbuhan optimal. Pelajari dosis dan waktu pemupukan yang tepat untuk
                    setiap tanaman.
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
                                'bg-green-600 text-white border-green-600 scale-105 ring-2 ring-green-200' :
                                'bg-white text-gray-600 border-gray-200 hover:border-green-300 hover:text-green-700'">
                            <span x-text="crop.label"></span>
                        </button>
                    </template>
                </div>
            </div>

            {{-- SECTION: ROADMAP --}}
            <section class="relative max-w-6xl mx-auto">
                <!-- Vertical Line (Roadmap Axis) -->
                <div
                    class="absolute left-8 md:left-1/2 top-0 bottom-0 w-1 bg-gradient-to-b from-green-200 via-green-400 to-green-100 md:-translate-x-1/2 rounded-full">
                </div>

                @foreach ($tips as $tip)
                    <div class="relative z-10 mb-12 md:mb-24 group">
                        <div class="flex flex-col md:flex-row items-center w-full">

                            <!-- LEFT SIDE (Content for ODD, Spacer for EVEN) -->
                            <div
                                class="w-full md:w-1/2 pl-20 md:pl-0 md:pr-16 {{ $loop->even ? 'hidden md:block md:invisible' : '' }}">
                                @if ($loop->odd)
                                    <div
                                        class="bg-white rounded-[2rem] p-6 md:p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-green-100 relative overflow-hidden hover:-translate-y-2 hover:shadow-green-500/20 transition-all duration-500 group-hover:border-green-500/30">

                                        <!-- Decorative Blob -->
                                        <div
                                            class="absolute -top-12 -right-12 w-40 h-40 bg-gradient-to-br from-green-50 to-yellow-50 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
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
                                                class="text-xl font-bold text-gray-900 group-hover:text-green-600 transition-colors">
                                                {{ $tip->title }}
                                            </h3>
                                            <p class="text-gray-600 leading-relaxed text-sm font-medium">
                                                {{ $tip->description }}
                                            </p>

                                            <!-- Dynamic Content -->
                                            <div class="mt-4 pt-4 border-t border-dashed border-green-100 text-gray-600 text-sm leading-relaxed"
                                                x-transition:enter="transition ease-out duration-300"
                                                x-transition:enter-start="opacity-0 translate-y-2"
                                                x-transition:enter-end="opacity-100 translate-y-0">
                                                <template x-if="activeCrop === 'padi'">
                                                    <div class="prose-sm prose-green">{!! $tip->content_padi !!}</div>
                                                </template>
                                                <template x-if="activeCrop === 'jagung'">
                                                    <div class="prose-sm prose-green">{!! $tip->content_jagung !!}</div>
                                                </template>
                                                <template x-if="activeCrop === 'kedelai'">
                                                    <div class="prose-sm prose-green">{!! $tip->content_kedelai !!}</div>
                                                </template>
                                                <template x-if="activeCrop === 'singkong'">
                                                    <div class="prose-sm prose-green">{!! $tip->content_singkong !!}</div>
                                                </template>
                                                <template x-if="activeCrop === 'ubi'">
                                                    <div class="prose-sm prose-green">{!! $tip->content_ubi !!}</div>
                                                </template>
                                            </div>
                                        </div>

                                        <!-- Arrow Desktop -->
                                        <div
                                            class="hidden md:block absolute top-1/2 -right-3 w-6 h-6 bg-white border-t border-r border-green-100 transform rotate-45 group-hover:border-green-200 transition-colors">
                                        </div>
                                    </div>
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
                                    <div
                                        class="bg-white rounded-[2rem] p-6 md:p-8 shadow-[0_8px_30px_rgb(0,0,0,0.04)] border border-green-100 relative overflow-hidden hover:-translate-y-2 hover:shadow-green-500/20 transition-all duration-500 group-hover:border-green-500/30">

                                        <!-- Decorative Blob -->
                                        <div
                                            class="absolute -top-12 -left-12 w-40 h-40 bg-gradient-to-bl from-green-50 to-yellow-50 rounded-full blur-3xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
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
                                                class="text-xl font-bold text-gray-900 group-hover:text-green-600 transition-colors">
                                                {{ $tip->title }}
                                            </h3>
                                            <p class="text-gray-600 leading-relaxed text-sm font-medium">
                                                {{ $tip->description }}
                                            </p>

                                            <!-- Dynamic Content -->
                                            <div class="mt-4 pt-4 border-t border-dashed border-green-100 text-gray-600 text-sm leading-relaxed"
                                                x-transition:enter="transition ease-out duration-300"
                                                x-transition:enter-start="opacity-0 translate-y-2"
                                                x-transition:enter-end="opacity-100 translate-y-0">
                                                <template x-if="activeCrop === 'padi'">
                                                    <div class="prose-sm prose-green">{!! $tip->content_padi !!}</div>
                                                </template>
                                                <template x-if="activeCrop === 'jagung'">
                                                    <div class="prose-sm prose-green">{!! $tip->content_jagung !!}</div>
                                                </template>
                                                <template x-if="activeCrop === 'kedelai'">
                                                    <div class="prose-sm prose-green">{!! $tip->content_kedelai !!}</div>
                                                </template>
                                                <template x-if="activeCrop === 'singkong'">
                                                    <div class="prose-sm prose-green">{!! $tip->content_singkong !!}</div>
                                                </template>
                                                <template x-if="activeCrop === 'ubi'">
                                                    <div class="prose-sm prose-green">{!! $tip->content_ubi !!}</div>
                                                </template>
                                            </div>
                                        </div>

                                        <!-- Arrow Desktop -->
                                        <div
                                            class="hidden md:block absolute top-1/2 -left-3 w-6 h-6 bg-white border-b border-l border-green-100 transform rotate-45 group-hover:border-green-200 transition-colors">
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
                <a href="{{ route('edukasi.lahan') }}"
                    class="px-6 py-3 rounded-xl bg-white border border-green-200 text-green-700 font-bold hover:bg-green-50 transition-all shadow-sm">
                    ← Tips Lahan
                </a>

                <a href="{{ route('edukasi.cek_tanah') }}"
                    class="px-6 py-3 rounded-xl bg-emerald-600 text-white font-bold hover:bg-green-700 transition-all shadow-lg shadow-green-600/20">
                    Lanjut: Cek Tanah →
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
