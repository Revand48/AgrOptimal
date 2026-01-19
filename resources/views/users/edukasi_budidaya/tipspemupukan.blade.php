@extends('layouts.app')

@section('content')
    <div class="bg-green-50 min-h-screen py-10 px-4" x-data="{ activeCrop: 'padi' }">
        <div class="max-w-5xl mx-auto">

            {{-- Header --}}
            <div class="text-center mb-8">
                <h1 class="text-2xl md:text-3xl font-bold text-green-700">
                    Tips Pemupukan
                </h1>
                <p class="text-gray-600 mt-2">
                    Nutrisi yang tepat untuk hasil panen melimpah
                </p>
            </div>

            {{-- Toggle Komoditas --}}
            <div class="flex flex-wrap justify-center gap-3 mb-12">
                <template
                    x-for="crop in [
                {key:'padi', label:'🌾 Padi'},
                {key:'jagung', label:'🌽 Jagung'},
                {key:'kedelai', label:'🫘 Kedelai'},
                {key:'singkong', label:'🌿 Singkong'},
                {key:'ubi', label:'🍠 Ubi Jalar'}
            ]">
                    <button @click="activeCrop = crop.key"
                        class="px-4 py-2 rounded-full border text-sm font-semibold transition"
                        :class="activeCrop === crop.key ?
                            'bg-green-600 text-white border-green-600' :
                            'bg-white text-green-700 border-green-300 hover:bg-green-100'"
                        x-text="crop.label"></button>
                </template>
            </div>

            {{-- Roadmap --}}
            <div class="relative border-l-4 border-green-400 ml-4">

                @foreach ($tips as $tip)
                    <div class="mb-10 ml-6" x-data="{ open: false }">
                        <span class="absolute -left-3 w-6 h-6 bg-green-600 rounded-full"></span>

                        <div class="bg-white rounded-xl shadow p-5">
                            <h2 class="font-semibold text-green-700 text-lg">
                                {{ $tip->step_number }}. {{ $tip->title }}
                            </h2>
                            <p class="text-sm text-gray-600 mt-1">
                                {{ $tip->description }}
                            </p>

                            <button @click="open = !open" class="mt-3 text-sm text-green-600 font-semibold hover:underline">
                                Lihat Detail
                            </button>

                            <div x-show="open" x-transition class="mt-4 text-gray-700 text-sm space-y-3">

                                @if ($tip->image)
                                    <img src="{{ asset('storage/' . $tip->image) }}" alt="{{ $tip->title }}"
                                        class="w-full h-48 object-cover rounded-lg mb-3">
                                @endif

                                <template x-if="activeCrop === 'padi'">
                                    <div>{!! $tip->content_padi !!}</div>
                                </template>

                                <template x-if="activeCrop === 'jagung'">
                                    <div>{!! $tip->content_jagung !!}</div>
                                </template>

                                <template x-if="activeCrop === 'kedelai'">
                                    <div>{!! $tip->content_kedelai !!}</div>
                                </template>

                                <template x-if="activeCrop === 'singkong'">
                                    <div>{!! $tip->content_singkong !!}</div>
                                </template>

                                <template x-if="activeCrop === 'ubi'">
                                    <div>{!! $tip->content_ubi !!}</div>
                                </template>

                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            {{-- Navigasi --}}
            <div class="flex justify-between mt-12">
                <a href="{{ route('edukasi.lahan') }}" class="text-green-600 font-semibold hover:underline">
                    ← Tips Lahan
                </a>

                <a href="{{ route('edukasi.cek_tanah') }}" class="text-green-600 font-semibold hover:underline">
                    Cek Tanah Tanpa Alat →
                </a>
            </div>

        </div>
    </div>
@endsection
