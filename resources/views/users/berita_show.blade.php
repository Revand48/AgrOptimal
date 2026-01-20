@extends('layouts.app')

@section('content')
    {{-- Progress Bar Reading Indicator --}}
    <div class="fixed top-0 left-0 h-1 bg-green-600 z-50" id="progress-bar" style="width: 0%"></div>

    <div class="min-h-screen font-sans text-gray-900">
    <div class="min-h-screen  font-sans text-gray-900">

        {{-- Breadcrumb --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 pb-4">
            <nav class="flex text-sm text-gray-500 space-x-2">
                <a href="{{ url('/') }}" class="hover:text-green-600 transition-colors">Beranda</a>
                <span>/</span>
                <a href="{{ route('berita.index') }}" class="hover:text-green-600 transition-colors">Berita</a>
                <span>/</span>
                <span class="text-gray-800 font-medium truncate">{{ Str::limit($berita->judul, 40) }}</span>
            </nav>
        </div>

        <article class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">

            {{-- Header --}}
            <header class="mb-10 text-center max-w-5xl mx-auto">
                <div class="mb-4">
                    <span
                        class="inline-block py-1 px-3 rounded-full bg-green-100 text-green-700 text-xs font-bold tracking-wider uppercase">
                        {{ $berita->kategori }}
                    </span>
                </div>
                <h1 class="text-3xl md:text-5xl font-bold text-gray-900 leading-tight mb-6">
                    {{ $berita->judul }}
                </h1>

                <div class="flex items-center justify-center space-x-4 text-sm text-gray-500 border-y border-gray-100 py-4">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        <span class="font-medium text-gray-900">Admin AgrOptimal</span>
                    </div>
                    <span>&bull;</span>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                        <time datetime="{{ $berita->created_at->format('Y-m-d') }}">
                            {{ $berita->created_at->translatedFormat('d F Y') }}
                        </time>
                    </div>
                    <span>&bull;</span>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span>{{ ceil(str_word_count(strip_tags($berita->konten)) / 200) }} menit baca</span>
                    </div>
                </div>
            </header>


            {{-- Content --}}
            <div class="w-full">
                {{-- Main Text --}}
                <div class="max-w-5xl mx-auto bg-white p-8 md:p-12 rounded-3xl shadow-sm">
                    {{-- Featured Image --}}
                    <figure class="mb-8 relative rounded-2xl overflow-hidden aspect-video">
                        @if (Str::startsWith($berita->foto, 'http'))
                            <img src="{{ $berita->foto }}" alt="{{ $berita->judul }}"
                                class="w-full h-full object-cover">
                        @else
                            <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}"
                                class="w-full h-full object-cover">
                        @endif
                    </figure>

                    <div
                        class="prose prose-lg prose-green max-w-none text-gray-700 leading-relaxed first-letter:text-5xl first-letter:font-bold first-letter:text-green-600 first-letter:mr-3 first-letter:float-left">
                        {!! $berita->konten !!}
                    </div>

                    {{-- Share Section --}}
                    <div class="mt-12 pt-8 border-t border-gray-200">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Bagikan artikel ini:</h3>
                        <div class="flex gap-3">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                target="_blank"
                                class="p-3 rounded-full bg-blue-600 text-white hover:bg-blue-700 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                </svg>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($berita->judul) }}"
                                target="_blank"
                                class="p-3 rounded-full bg-sky-500 text-white hover:bg-sky-600 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                </svg>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($berita->judul . ' ' . url()->current()) }}"
                                target="_blank"
                                class="p-3 rounded-full bg-green-500 text-white hover:bg-green-600 transition">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.017-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Navigation Section --}}
            <div class="mt-12 max-w-5xl mx-auto">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <a href="{{ route('berita.index') }}"
                        class="px-6 py-3 bg-white border border-gray-200 rounded-xl text-gray-700 font-medium hover:border-green-500 hover:text-green-600 transition-all shadow-sm">
                        &larr; Semua Berita
                    </a>
                    <a href="{{ url('/') }}"
                        class="px-6 py-3 bg-green-600 text-white rounded-xl font-bold hover:bg-green-700 transition-all shadow-lg shadow-green-600/20">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </article>
    </div>

    <script>
        // Simple Reading Progress Bar
        window.onscroll = function() {
            let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
            let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
            let scrolled = (winScroll / height) * 100;
            document.getElementById("progress-bar").style.width = scrolled + "%";
        };
    </script>
@endsection
