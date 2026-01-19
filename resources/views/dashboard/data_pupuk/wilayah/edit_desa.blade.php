@extends('layouts.hal_admin')
@section('title', 'Edit Desa')

@section('content')
    <div class="p-4 sm:p-6 space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-green-700">Edit Desa</h1>
                <p class="text-sm text-gray-500 mt-1">Perubahan desa akan memengaruhi data publikasi pupuk.</p>
            </div>

            <a href="/dashboard/data_pupuk/wilayah"
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
        <div class="bg-white rounded-2xl shadow-sm border border-green-100/80 overflow-hidden max-w-xl">
            <div class="h-1.5 bg-gradient-to-r from-green-500 via-yellow-400 to-green-600"></div>

            <form action="/dashboard/data_pupuk/wilayah/desa/{{ $desa->id }}" method="POST" class="p-6 space-y-6">
                @csrf
                @method('PUT')

                {{-- Pilih Kecamatan --}}
                <div>
                    <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                        Kecamatan <span class="text-red-500">*</span>
                    </label>
                    <input type="hidden" name="kecamatan_id" id="kecamatanInput" value="{{ $desa->kecamatan_id }}">

                    <div x-data="{
                        open: false,
                        selected: '{{ $desa->kecamatan_id }}',
                        selectedLabel: '{{ $desa->kecamatan->nama }}',
                        options: [
                            @foreach ($kecamatans as $kec)
                                { value: '{{ $kec->id }}', label: '{{ $kec->nama }}' }, @endforeach
                        ],
                        select(value, label) {
                            this.selected = value;
                            this.selectedLabel = label;
                            this.open = false;
                            document.getElementById('kecamatanInput').value = value;
                        },
                        getLabel() {
                            return this.selectedLabel || 'Pilih Kecamatan';
                        }
                    }" class="relative">
                        <button type="button" @click="open = !open" @click.outside="open = false"
                            class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl text-left flex items-center justify-between focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300">
                            <span x-text="getLabel()" :class="selected ? 'text-gray-900' : 'text-gray-500'"></span>
                            <svg class="w-5 h-5 text-gray-400 transition-transform duration-200"
                                :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                                </path>
                            </svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-2"
                            class="absolute left-0 mt-2 w-full bg-white rounded-xl shadow-xl border border-gray-100 z-50 overflow-hidden max-h-60 overflow-y-auto"
                            x-cloak>
                            <ul class="py-1">
                                <template x-for="option in options" :key="option.value">
                                    <li>
                                        <button type="button" @click="select(option.value, option.label)"
                                            class="w-full px-4 py-2.5 text-sm text-left hover:bg-green-50 transition-colors flex items-center justify-between group"
                                            :class="selected === option.value ?
                                                'bg-green-50 text-green-700 font-semibold' : 'text-gray-600'">
                                            <span x-text="option.label"></span>
                                            <svg x-show="selected === option.value" class="w-4 h-4 text-green-600"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </button>
                                    </li>
                                </template>
                            </ul>
                        </div>
                    </div>
                </div>

                {{-- Nama Desa --}}
                <div>
                    <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-2">
                        Nama Desa <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama" required value="{{ old('nama', $desa->nama) }}"
                        class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300"
                        placeholder="Contoh: Desa Sukamaju">
                </div>

                <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                    <a href="/dashboard/data_pupuk/wilayah"
                        class="px-5 py-2.5 rounded-xl border border-gray-200 font-semibold text-gray-600 hover:bg-gray-50 transition-colors">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2.5 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition-all shadow-md hover:shadow-lg hover:shadow-green-600/20 active:scale-95 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Update Desa
                    </button>
                </div>
            </form>
        </div>

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
    </div>
@endsection
