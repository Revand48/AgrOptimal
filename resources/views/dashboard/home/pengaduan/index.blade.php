@extends('layouts.hal_admin')

@section('content')
    <div class="p-4 sm:p-6 space-y-6" x-data="{
        notification: { show: false, message: '', type: 'success' },
        deleteModal: { show: false, id: null, nama: '' },
        showNotification(message, type = 'success') {
            this.notification.message = message;
            this.notification.type = type;
            this.notification.show = true;
            setTimeout(() => this.notification.show = false, 3000);
        },
        openDeleteModal(id, nama) {
            this.deleteModal.id = id;
            this.deleteModal.nama = nama;
            this.deleteModal.show = true;
        },
        closeDeleteModal() {
            this.deleteModal.show = false;
            this.deleteModal.id = null;
            this.deleteModal.nama = '';
        },
        confirmDelete() {
            document.getElementById('delete-form-' + this.deleteModal.id).submit();
        }
    }" x-init="@if(session('success'))
    showNotification('{{ session('success') }}', 'success')
    @endif"
        @open-delete-modal="openDeleteModal($event.detail.id, $event.detail.nama)">

        {{-- TOAST NOTIFICATION --}}
        <div x-show="notification.show" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 transform translate-x-4"
            x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 transform translate-x-0"
            x-transition:leave-end="opacity-0 transform translate-x-4"
            :class="notification.type === 'success' ? 'bg-green-600' : 'bg-red-600'"
            class="fixed top-5 right-5 text-white px-6 py-3 rounded-xl shadow-lg z-[60] flex items-center gap-3" x-cloak>
            <svg x-show="notification.type === 'success'" class="w-5 h-5" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
            <svg x-show="notification.type === 'error'" class="w-5 h-5" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
            <span x-text="notification.message"></span>
        </div>

        {{-- DELETE CONFIRMATION MODAL --}}
        <div x-show="deleteModal.show" x-transition.opacity.duration.200ms
            class="fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center z-50 p-4" x-cloak>
            <div @click.outside="closeDeleteModal()" x-show="deleteModal.show"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 transform scale-90"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-150"
                x-transition:leave-start="opacity-100 transform scale-100"
                x-transition:leave-end="opacity-0 transform scale-90"
                class="bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden">

                <div class="h-1.5 bg-gradient-to-r from-red-500 via-red-400 to-red-600"></div>

                <div class="p-6">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Hapus Pengaduan?</h3>
                            <p class="text-sm text-gray-500">Tindakan ini tidak dapat dibatalkan.</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 mb-6">
                        <p class="text-sm text-gray-600 font-medium">Pengaduan dari: <span x-text="deleteModal.nama"
                                class="font-bold text-gray-800"></span></p>
                    </div>

                    <div class="flex justify-end gap-3">
                        <button @click="closeDeleteModal()"
                            class="px-5 py-2.5 rounded-xl border border-gray-200 font-semibold text-gray-600 hover:bg-gray-50 transition-colors">
                            Batal
                        </button>
                        <button @click="confirmDelete()"
                            class="px-5 py-2.5 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition-all shadow-md hover:shadow-lg active:scale-95 inline-flex items-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                </path>
                            </svg>
                            Ya, Hapus
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-green-700">Data Pengaduan</h1>
                <p class="text-sm text-gray-500 mt-1">Daftar laporan yang masuk dari pengguna.</p>
            </div>
        </div>

        {{-- FILTER --}}
        <div class="flex flex-wrap items-center gap-3">
            {{-- FORM HIDDEN --}}
            <form id="filterForm" method="GET" action="{{ request()->url() }}" class="hidden">
                <input type="text" name="kategori" id="kategoriInput" value="{{ request('kategori') }}">
                <input type="text" name="status" id="statusInput" value="{{ request('status') }}">
            </form>

            {{-- DROPDOWN KATEGORI --}}
            <div x-data="{
                open: false,
                selected: '{{ request('kategori') ?? '' }}',
                options: [
                    { value: '', label: 'Semua Kategori' },
                    { value: 'Kendala Website', label: 'Kendala Website' },
                    { value: 'Pertanyaan', label: 'Pertanyaan' },
                    { value: 'Saran & Masukan', label: 'Saran & Masukan' },
                    { value: 'Hal Lainnya', label: 'Hal Lainnya' }
                ],
                init() {
                    if (!this.selected) this.selected = '';
                },
                select(value) {
                    this.selected = value;
                    this.open = false;
                    document.getElementById('kategoriInput').value = value;
                    document.getElementById('filterForm').submit();
                },
                getLabel() {
                    const option = this.options.find(o => o.value === this.selected);
                    return option ? option.label : 'Semua Kategori';
                }
            }" class="relative h-11 min-w-[200px]">
                <button @click="open = !open" @click.outside="open = false" type="button"
                    class="w-full h-full px-4 bg-white border border-gray-200 rounded-xl text-sm flex items-center justify-between gap-2 shadow-sm transition-all hover:border-green-300 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-500 group">
                    <span x-text="getLabel()" class="text-gray-700 font-medium truncate"></span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-hover:text-green-500"
                        :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
                    class="absolute left-0 mt-2 w-full sm:w-56 bg-white rounded-xl shadow-xl border border-gray-100 z-50 overflow-hidden"
                    x-cloak>
                    <ul class="py-1">
                        <template x-for="option in options" :key="option.value">
                            <li>
                                <button type="button" @click="select(option.value)"
                                    class="w-full px-4 py-2.5 text-sm text-left hover:bg-green-50 transition-colors flex items-center justify-between group"
                                    :class="selected === option.value ? 'bg-green-50 text-green-700 font-semibold' :
                                        'text-gray-600'">
                                    <span x-text="option.label"></span>
                                    <svg x-show="selected === option.value" class="w-4 h-4 text-green-600" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </button>
                            </li>
                        </template>
                    </ul>
                </div>
            </div>

            {{-- DROPDOWN STATUS --}}
            <div x-data="{
                open: false,
                selected: '{{ request('status') ?? '' }}',
                options: [
                    { value: '', label: 'Semua Status' },
                    { value: 'baru', label: 'Baru' },
                    { value: 'dibaca', label: 'Dibaca' }
                ],
                init() {
                    if (!this.selected) this.selected = '';
                },
                select(value) {
                    this.selected = value;
                    this.open = false;
                    document.getElementById('statusInput').value = value;
                    document.getElementById('filterForm').submit();
                },
                getLabel() {
                    const option = this.options.find(o => o.value === this.selected);
                    return option ? option.label : 'Semua Status';
                }
            }" class="relative h-11 min-w-[200px]">
                <button @click="open = !open" @click.outside="open = false" type="button"
                    class="w-full h-full px-4 bg-white border border-gray-200 rounded-xl text-sm flex items-center justify-between gap-2 shadow-sm transition-all hover:border-green-300 hover:shadow-md focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-500 group">
                    <span x-text="getLabel()" class="text-gray-700 font-medium truncate"></span>
                    <svg class="w-4 h-4 text-gray-400 transition-transform duration-200 group-hover:text-green-500"
                        :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
                    class="absolute left-0 mt-2 w-full sm:w-56 bg-white rounded-xl shadow-xl border border-gray-100 z-50 overflow-hidden"
                    x-cloak>
                    <ul class="py-1">
                        <template x-for="option in options" :key="option.value">
                            <li>
                                <button type="button" @click="select(option.value)"
                                    class="w-full px-4 py-2.5 text-sm text-left hover:bg-green-50 transition-colors flex items-center justify-between group"
                                    :class="selected === option.value ? 'bg-green-50 text-green-700 font-semibold' :
                                        'text-gray-600'">
                                    <span x-text="option.label"></span>
                                    <svg x-show="selected === option.value" class="w-4 h-4 text-green-600" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
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

        {{-- TABLE --}}
        <div class="bg-white rounded-2xl shadow-sm border border-green-100/80 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-green-50/80">
                        <tr>
                            <th class="p-4 text-left text-xs font-semibold text-green-700 uppercase tracking-wider">Pelapor
                            </th>
                            <th class="p-4 text-left text-xs font-semibold text-green-700 uppercase tracking-wider">
                                Kategori</th>
                            <th class="p-4 text-left text-xs font-semibold text-green-700 uppercase tracking-wider">
                                Pesan</th>
                            <th class="p-4 text-center text-xs font-semibold text-green-700 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="p-4 text-center text-xs font-semibold text-green-700 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-green-50">
                        @forelse ($pengaduan as $item)
                            <tr class="hover:bg-green-50/50 transition-colors">
                                <td class="p-4 align-top">
                                    <p class="font-semibold text-gray-800">{{ $item->nama }}</p>
                                    <p class="text-xs text-gray-500">{{ $item->created_at->format('d M Y, H:i') }}</p>
                                </td>
                                <td class="p-4 text-gray-700 font-medium align-top">
                                    {{ $item->kategori }}
                                </td>
                                <td class="p-4 text-gray-600 max-w-md align-top">
                                    <p class="line-clamp-2">{{ $item->pesan }}</p>
                                </td>
                                <td class="p-4 text-center align-top">
                                    <span
                                        class="text-xs font-semibold px-3 py-1 rounded-full
                                    {{ $item->status === 'baru' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-600' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td class="p-4 text-center align-top">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.pengaduan.show', $item->id) }}"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                                </path>
                                            </svg>
                                            Lihat
                                        </a>

                                        <form id="delete-form-{{ $item->id }}" method="POST"
                                            action="{{ route('admin.pengaduan.destroy', $item) }}" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button type="button"
                                            @click="$dispatch('open-delete-modal', { id: {{ $item->id }}, nama: {{ json_encode($item->nama) }} })"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                </path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="p-8 text-center text-gray-500">
                                    <p class="font-medium">Belum ada pengaduan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-6">
            {{ $pengaduan->links() }}
        </div>
    </div>
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
@endsection
