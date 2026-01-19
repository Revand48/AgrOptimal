@extends('layouts.hal_admin')

@section('content')
    <div class="p-4 sm:p-6 space-y-6">
        {{-- HEADER --}}
        <div class="flex items-center justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.berita.index') }}"
                    class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-green-100/50 text-green-600 hover:bg-green-50 shadow-sm transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </a>
                <div>
                    <h1 class="text-2xl font-bold text-green-700">Detail Berita</h1>
                    <div class="flex items-center gap-2 mt-1">
                        <span class="text-sm text-gray-500">{{ $berita->created_at->format('d F Y') }}</span>
                        <span class="text-gray-300">•</span>
                        <span
                            class="px-2 py-0.5 rounded-full text-xs font-medium {{ $berita->status == 'publish' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ ucfirst($berita->status) }}
                        </span>
                    </div>
                </div>
            </div>

            <a href="{{ route('admin.berita.edit', $berita->id) }}"
                class="px-4 py-2 bg-blue-600 text-white text-sm font-semibold rounded-xl hover:bg-blue-700 transition-all shadow-md hover:shadow-lg hover:shadow-blue-600/20 active:scale-95 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                    </path>
                </svg>
                <span>Edit Berita</span>
            </a>
        </div>

        {{-- CONTENT CARD --}}
        <div class="bg-white rounded-2xl shadow-sm border border-green-100/80 overflow-hidden max-w-5xl">
            @if ($berita->foto)
                <div class="h-64 sm:h-96 w-full relative group">
                    <img src="{{ asset('storage/' . $berita->foto) }}" class="w-full h-full object-cover"
                        alt="{{ $berita->judul }}">
                    <div class="absolute inset-0 bg-linear-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-0 left-0 p-6 sm:p-8">
                        <span
                            class="inline-block px-3 py-1 bg-green-600 text-white text-xs font-bold rounded-lg mb-3 shadow-lg">
                            {{ $berita->kategori }}
                        </span>
                        <h2 class="text-2xl sm:text-4xl font-bold text-white leading-tight shadow-black drop-shadow-md">
                            {{ $berita->judul }}
                        </h2>
                    </div>
                </div>
            @else
                <div class="p-8 border-b border-gray-100">
                    <span class="inline-block px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-lg mb-3">
                        {{ $berita->kategori }}
                    </span>
                    <h2 class="text-3xl font-bold text-gray-800 leading-tight">
                        {{ $berita->judul }}
                    </h2>
                </div>
            @endif

            <div class="p-6 sm:p-10">
                <div
                    class="prose prose-lg max-w-none prose-headings:text-green-800 prose-a:text-green-600 hover:prose-a:text-green-500">
                    {!! $berita->konten !!}
                </div>
            </div>
        </div>
    </div>
@endsection
