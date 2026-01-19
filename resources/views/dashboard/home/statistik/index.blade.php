@extends('layouts.hal_admin')

@section('content')
<div class="p-4 sm:p-6 space-y-6"
    x-data="{
        open: false,
        loading: false,
        notification: { show: false, message: '' },
        stats: {
            total_pupuk: {{ $homeData?->total_pupuk ?? 0 }},
            jenis_pupuk: {{ $homeData?->jenis_pupuk ?? 0 }},
            petani_terdampak: {{ $homeData?->petani_terdampak ?? 0 }},
            rating: {{ $homeData?->rating ?? 0.0 }},
            updated_at: '{{ $homeData?->updated_at?->translatedFormat('d F Y') ?? '-' }}'
        },
        form: {
            total_pupuk: '{{ $homeData?->total_pupuk ?? 0 }}',
            jenis_pupuk: '{{ $homeData?->jenis_pupuk ?? 0 }}',
            petani_terdampak: '{{ $homeData?->petani_terdampak ?? 0 }}',
            rating: '{{ $homeData?->rating ?? 0.0 }}',
        },
        formatNumber(value) {
            return new Intl.NumberFormat('id-ID').format(value);
        },
        showNotification(message) {
            this.notification.message = message;
            this.notification.show = true;
            setTimeout(() => this.notification.show = false, 3000);
        },
        async submitForm() {
            this.loading = true;
            try {
                const response = await fetch('{{ url('/dashboard/home-statistik') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(this.form)
                });

                const result = await response.json();

                if (!response.ok) {
                    const errorMsg = result.message || 'Terjadi kesalahan saat menyimpan data.';
                    this.showNotification(errorMsg);
                    return;
                }

                this.stats = { ...result.data };
                this.form = { ...result.data };

                this.open = false;
                this.showNotification(result.message || 'Statistik berhasil diperbarui!');

            } catch (error) {
                console.error('Submit error:', error);
                this.showNotification('Gagal terhubung ke server.');
            } finally {
                this.loading = false;
            }
        }
    }"
    x-init="$watch('open', value => { if(value) { document.body.style.overflow = 'hidden' } else { setTimeout(() => { document.body.style.overflow = 'auto' }, 300) } })"
>

    {{-- AJAX NOTIFICATION --}}
    <div x-show="notification.show" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform -translate-y-2" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform -translate-y-2" x-text="notification.message" class="fixed top-5 right-5 bg-green-600 text-white px-6 py-3 rounded-xl shadow-lg z-[60]" x-cloak></div>

    {{-- ALERT SUCCESS --}}
    @if (session('success'))
        <div
            x-data="{ show: true }"
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform -translate-y-2"
            x-transition:enter-end="opacity-100 transform translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            class="bg-green-100/80 border border-green-200 text-green-800 px-4 py-3 rounded-xl flex justify-between items-center shadow-sm"
        >
            <span>{{ session('success') }}</span>
            <button @click="show = false" class="font-bold">&times;</button>
        </div>
    @endif

    {{-- ALERT ERROR --}}
    @if ($errors->any())
        <div class="bg-red-100/80 border border-red-200 text-red-800 px-4 py-3 rounded-xl shadow-sm">
            <ul class="list-disc ml-5 text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- HEADER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-green-700">
                Statistik Halaman Beranda
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Data ini akan tampil secara publik di halaman utama website.
            </p>
        </div>

        <button
            @click="open = true"
            class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition-all shadow-md hover:shadow-lg hover:shadow-green-600/20 active:scale-95"
        >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
            <span>Edit Statistik</span>
        </button>
    </div>

    {{-- STAT CARDS --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

        {{-- TOTAL PUPUK --}}
        <div class="bg-white rounded-2xl p-5 border border-green-100/80 shadow-sm hover:shadow-lg hover:shadow-green-500/10 hover:-translate-y-1 transition-all duration-300 flex items-start gap-5">
            <div class="w-12 h-12 rounded-xl bg-green-100/70 flex-shrink-0 flex items-center justify-center">
                <img src="{{ asset('img/beranda/data/pupuk-1.webp') }}" class="w-7 h-7" alt="Total Pupuk">
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Pupuk (kg)</p>
                <h2 class="text-3xl font-bold text-green-700 mt-1" x-text="formatNumber(stats.total_pupuk)">
                    {{-- Populated by Alpine.js --}}
                </h2>
            </div>
        </div>

        {{-- JENIS PUPUK --}}
        <div class="bg-white rounded-2xl p-5 border border-green-100/80 shadow-sm hover:shadow-lg hover:shadow-yellow-500/10 hover:-translate-y-1 transition-all duration-300 flex items-start gap-5">
            <div class="w-12 h-12 rounded-xl bg-yellow-100/70 flex-shrink-0 flex items-center justify-center">
                <img src="{{ asset('img/beranda/data/pupuk-2.webp') }}" class="w-7 h-7" alt="Jenis Pupuk">
            </div>
            <div>
                <p class="text-sm text-gray-500">Jenis Pupuk</p>
                <h2 class="text-3xl font-bold text-yellow-600 mt-1" x-text="stats.jenis_pupuk">
                    {{-- Populated by Alpine.js --}}
                </h2>
            </div>
        </div>

        {{-- PETANI --}}
        <div class="bg-white rounded-2xl p-5 border border-green-100/80 shadow-sm hover:shadow-lg hover:shadow-green-500/10 hover:-translate-y-1 transition-all duration-300 flex items-start gap-5">
            <div class="w-12 h-12 rounded-xl bg-green-100/70 flex-shrink-0 flex items-center justify-center">
                <img src="{{ asset('img/beranda/data/u-petani.webp') }}" class="w-7 h-7" alt="Petani">
            </div>
            <div>
                <p class="text-sm text-gray-500">Petani Terdampak</p>
                <h2 class="text-3xl font-bold text-green-700 mt-1" x-text="formatNumber(stats.petani_terdampak)">
                    {{-- Populated by Alpine.js --}}
                </h2>
            </div>
        </div>

        {{-- RATING --}}
        <div class="bg-white rounded-2xl p-5 border border-green-100/80 shadow-sm hover:shadow-lg hover:shadow-yellow-500/10 hover:-translate-y-1 transition-all duration-300 flex items-start gap-5">
            <div class="w-12 h-12 rounded-xl bg-yellow-100/70 flex-shrink-0 flex items-center justify-center">
                <img src="{{ asset('img/beranda/data/rating.webp') }}" class="w-7 h-7" alt="Rating">
            </div>
            <div>
                <p class="text-sm text-gray-500">Rating Pengguna</p>
                <h2 class="text-3xl font-bold text-yellow-600 mt-1" x-text="stats.rating">
                    {{-- Populated by Alpine.js --}}
                </h2>
            </div>
        </div>
    </div>

    {{-- UPDATE INFO --}}
    <div class="bg-green-50/80 border border-green-200/80 rounded-xl p-4 text-green-800">
        <div class="flex items-start gap-3">
            <svg class="w-5 h-5 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <div class="flex-1 min-w-0">
                <p class="text-sm font-medium mb-1">Terakhir diperbarui:</p>
                <p class="text-base font-semibold" x-text="stats.updated_at">
                    {{-- Populated by Alpine.js --}}
                </p>
            </div>
        </div>
    </div>

    {{-- MODAL --}}
    <div
        x-show="open"
        x-transition.opacity.duration.300ms
        class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4"
        x-cloak
    >
        <div
            @click.outside="open = false"
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform scale-90"
            x-transition:enter-end="opacity-100 transform scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform scale-100"
            x-transition:leave-end="opacity-0 transform scale-90"
            class="bg-white w-full max-w-lg rounded-2xl shadow-2xl relative overflow-hidden"
        >
            <div class="absolute top-0 left-0 w-full h-1.5 bg-gradient-to-r from-green-500 via-yellow-400 to-green-600"></div>

            <form @submit.prevent="submitForm" class="p-6 space-y-4">
                @csrf

                <h2 class="text-xl font-bold text-slate-800">
                    Edit Statistik Beranda
                </h2>

                <div class="space-y-4 pt-2">
                    <div>
                        <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-1 ml-1">Total Pupuk (Kg)</label>
                        <input type="number" name="total_pupuk" x-model="form.total_pupuk" placeholder="Contoh: 15000"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-1 ml-1">Jumlah Jenis Pupuk</label>
                        <input type="number" name="jenis_pupuk" x-model="form.jenis_pupuk" placeholder="Contoh: 25"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-1 ml-1">Petani Terdampak</label>
                        <input type="number" name="petani_terdampak" x-model="form.petani_terdampak" placeholder="Contoh: 500"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300">
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-green-700 uppercase tracking-wider mb-1 ml-1">Rating Pengguna</label>
                        <input type="number" step="0.1" name="rating" x-model="form.rating" placeholder="Contoh: 4.8"
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-green-500/20 focus:border-green-500 focus:bg-white outline-none transition-all duration-300">
                    </div>
                </div>

                <div class="flex justify-end gap-3 pt-4">
                    <button type="button" @click="open = false"
                        class="px-5 py-2.5 rounded-xl border font-semibold text-gray-600 hover:bg-gray-100 transition-colors" :disabled="loading">
                        Batal
                    </button>

                    <input
                        type="submit"
                        class="px-5 py-2.5 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition-all shadow-md hover:shadow-lg hover:shadow-green-600/20 active:scale-95 disabled:opacity-75 disabled:cursor-wait"
                        :value="loading ? 'Menyimpan...' : 'Simpan Perubahan'"
                        :disabled="loading"
                    >
                </div>
            </form>
        </div>
    </div>

</div>
@endsection
