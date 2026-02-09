@extends('layouts.hal_admin')

@section('title', 'Edit Langkah Cek Tanah')

@section('content')
    <div class="p-4 sm:p-6 space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-green-700">Edit Langkah Cek Tanah</h1>
                <p class="text-sm text-gray-500 mt-1">Perbarui data langkah cek tanah tradisional.</p>
            </div>

            <a href="{{ route('admin.edukasi.cek_tanah.index') }}"
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

            <form action="{{ route('admin.edukasi.cek_tanah.update', $cekTanah->id) }}" method="POST"
                enctype="multipart/form-data" class="p-6 space-y-6 relative z-10">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="step_number" class="block text-sm font-medium text-gray-700">Nomor Langkah</label>
                    <input type="number" name="step_number" id="step_number"
                        value="{{ old('step_number', $cekTanah->step_number) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                        required>
                </div>

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Judul</label>
                    <input type="text" name="title" id="title" value="{{ old('title', $cekTanah->title) }}"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                        required>
                </div>

                <div class="mb-4">
                    <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi Singkat</label>
                    <textarea name="description" id="description" rows="3"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-emerald-500 focus:ring-emerald-500 sm:text-sm"
                        required>{{ old('description', $cekTanah->description) }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="image" class="block text-sm font-medium text-gray-700">Gambar</label>
                    @if ($cekTanah->image)
                        <div class="mb-2">
                            <img src="{{ asset('storage/' . $cekTanah->image) }}" alt="Current Image"
                                class="h-32 w-auto object-cover rounded">
                        </div>
                    @endif
                    <input type="file" name="image" id="image"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-emerald-50 file:text-emerald-700 hover:file:bg-emerald-100">
                </div>

                {{-- Crop Specific Content Tabs --}}
                <div x-data="{ activeTab: 'padi' }" class="mb-6">
                    <div class="border-b border-gray-200">
                        <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                            <template x-for="crop in ['padi', 'jagung', 'kedelai', 'singkong', 'ubi']">
                                <button type="button" @click="activeTab = crop"
                                    :class="activeTab === crop ?
                                        'border-emerald-500 text-emerald-600' :
                                        'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                                    class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm capitalize"
                                    x-text="crop">
                                </button>
                            </template>
                        </nav>
                    </div>

                    <div class="mt-4">
                        <div x-show="activeTab === 'padi'">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Konten Padi</label>
                            <input id="content_padi" type="hidden" name="content_padi"
                                value="{{ old('content_padi', $cekTanah->content_padi) }}">
                            <trix-editor input="content_padi"></trix-editor>
                        </div>
                        <div x-show="activeTab === 'jagung'">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Konten Jagung</label>
                            <input id="content_jagung" type="hidden" name="content_jagung"
                                value="{{ old('content_jagung', $cekTanah->content_jagung) }}">
                            <trix-editor input="content_jagung"></trix-editor>
                        </div>
                        <div x-show="activeTab === 'kedelai'">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Konten Kedelai</label>
                            <input id="content_kedelai" type="hidden" name="content_kedelai"
                                value="{{ old('content_kedelai', $cekTanah->content_kedelai) }}">
                            <trix-editor input="content_kedelai"></trix-editor>
                        </div>
                        <div x-show="activeTab === 'singkong'">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Konten Singkong</label>
                            <input id="content_singkong" type="hidden" name="content_singkong"
                                value="{{ old('content_singkong', $cekTanah->content_singkong) }}">
                            <trix-editor input="content_singkong"></trix-editor>
                        </div>
                        <div x-show="activeTab === 'ubi'">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Konten Ubi Jalar</label>
                            <input id="content_ubi" type="hidden" name="content_ubi"
                                value="{{ old('content_ubi', $cekTanah->content_ubi) }}">
                            <trix-editor input="content_ubi"></trix-editor>
                        </div>
                    </div>
                </div>

                <!-- Fallback content field for backward compatibility -->
                <input type="hidden" name="content" value="{{ old('content', $cekTanah->content ?? '-') }}">
                <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin
                    mengubah gambar.</p>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="{{ route('admin.edukasi.cek_tanah.index') }}"
                        class="px-5 py-2.5 rounded-xl border border-gray-200 font-semibold text-gray-600 hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition-all shadow-md hover:shadow-lg hover:shadow-green-600/20 active:scale-95 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Perbarui Langkah
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection
