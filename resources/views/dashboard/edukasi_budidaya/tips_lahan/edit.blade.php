@extends('layouts.hal_admin')

@section('title', 'Edit Tips Lahan')

@section('content')
    <div class="p-4 sm:p-6 space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-green-700">Edit Tips Lahan</h1>
                <p class="text-sm text-gray-500 mt-1">Perbarui langkah panduan lahan.</p>
            </div>

            <a href="{{ route('admin.edukasi.tips_lahan.index') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 text-gray-600 font-medium rounded-xl border border-gray-200 hover:bg-gray-50 transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                <span>Kembali</span>
            </a>
        </div>

        {{-- ALERT ERROR --}}
        @if ($errors->any())
            <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                <ul class="list-disc ml-5 text-sm">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- FORM CARD --}}
        <div class="bg-white rounded-2xl shadow-sm border border-green-100/80 overflow-hidden max-w-4xl relative">
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-green-50 rounded-bl-full -mr-6 -mt-6 opacity-50 pointer-events-none">
            </div>

            <div class="h-1.5 bg-gradient-to-r from-green-500 via-green-400 to-green-600"></div>

            <form action="{{ route('admin.edukasi.tips_lahan.update', $tip->id) }}" method="POST"
                enctype="multipart/form-data" class="p-6 space-y-6 relative z-10">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                            Step Number <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="step_number" value="{{ old('step_number', $tip->step_number) }}"
                            required
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                        Judul <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="title" value="{{ old('title', $tip->title) }}" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                        Deskripsi Singkat <span class="text-red-500">*</span>
                    </label>
                    <textarea name="description" rows="3" required
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300">{{ old('description', $tip->description) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                        Gambar (Opsional)
                    </label>
                    @if ($tip->image)
                        <div class="mb-3">
                            <img src="{{ asset('storage/' . $tip->image) }}"
                                class="h-24 w-24 object-cover rounded-xl border border-gray-200 shadow-sm">
                        </div>
                    @endif
                    <input type="file" name="image"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-green-100 file:text-green-700 hover:file:bg-green-200 transition-all">
                </div>

                <div class="border-t border-gray-100 pt-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Konten Detail per Komoditas</h3>

                    <div x-data="{ tab: 'padi' }" class="bg-gray-50 p-4 rounded-xl border border-gray-200">
                        <div class="flex gap-2 mb-4 overflow-x-auto pb-2 scrollbar-thin scrollbar-thumb-gray-300">
                            <template x-for="item in ['padi', 'jagung', 'kedelai', 'singkong', 'ubi']">
                                <button type="button" @click="tab = item"
                                    class="px-4 py-2 rounded-lg text-sm font-semibold capitalize whitespace-nowrap transition-all"
                                    :class="tab === item ? 'bg-green-600 text-white shadow-md' :
                                        'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200'"
                                    x-text="item">
                                </button>
                            </template>
                        </div>

                        <div x-show="tab === 'padi'" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0">
                            <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">Konten
                                Padi</label>
                            <textarea name="content_padi" rows="5"
                                class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 outline-none">{{ old('content_padi', $tip->content_padi) }}</textarea>
                        </div>
                        <div x-show="tab === 'jagung'" style="display: none;"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0">
                            <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">Konten
                                Jagung</label>
                            <textarea name="content_jagung" rows="5"
                                class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 outline-none">{{ old('content_jagung', $tip->content_jagung) }}</textarea>
                        </div>
                        <div x-show="tab === 'kedelai'" style="display: none;"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0">
                            <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">Konten
                                Kedelai</label>
                            <textarea name="content_kedelai" rows="5"
                                class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 outline-none">{{ old('content_kedelai', $tip->content_kedelai) }}</textarea>
                        </div>
                        <div x-show="tab === 'singkong'" style="display: none;"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0">
                            <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">Konten
                                Singkong</label>
                            <textarea name="content_singkong" rows="5"
                                class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 outline-none">{{ old('content_singkong', $tip->content_singkong) }}</textarea>
                        </div>
                        <div x-show="tab === 'ubi'" style="display: none;"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0">
                            <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">Konten
                                Ubi Jalar</label>
                            <textarea name="content_ubi" rows="5"
                                class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 outline-none">{{ old('content_ubi', $tip->content_ubi) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.edukasi.tips_lahan.index') }}"
                        class="px-5 py-2.5 rounded-xl border border-gray-200 font-semibold text-gray-600 hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition-all shadow-md hover:shadow-lg hover:shadow-green-600/20 active:scale-95 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Update Tips
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
