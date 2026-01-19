@extends('layouts.hal_admin')

@section('content')
    <div class="p-4 sm:p-6 space-y-6" x-data="{
        notification: { show: false, message: '', type: 'success' },
        deleteModal: { show: false, id: null, title: '' },
        showNotification(message, type = 'success') {
            this.notification.message = message;
            this.notification.type = type;
            this.notification.show = true;
            setTimeout(() => this.notification.show = false, 3000);
        },
        openDeleteModal(id, title) {
            this.deleteModal.id = id;
            this.deleteModal.title = title;
            this.deleteModal.show = true;
        },
        closeDeleteModal() {
            this.deleteModal.show = false;
            this.deleteModal.id = null;
            this.deleteModal.title = '';
        },
        confirmDelete() {
            document.getElementById('delete-form-' + this.deleteModal.id).submit();
        }
    }" x-init="@if(session('success'))
    showNotification('{{ session('success') }}', 'success')
    @endif
    @if(session('error'))
    showNotification('{{ session('error') }}', 'error')
    @endif"
        @open-delete-modal="openDeleteModal($event.detail.id, $event.detail.title)">

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
                        <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-800">Hapus Berita?</h3>
                            <p class="text-sm text-gray-500">Tindakan ini tidak dapat dibatalkan.</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 mb-6">
                        <p class="text-sm text-gray-600">Apakah Anda yakin ingin menghapus berita:</p>
                        <p class="text-sm font-bold text-gray-800 mt-1" x-text="deleteModal.title"></p>
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

        {{-- HEADER & ACTIONS --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-green-700">Manajemen Berita</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola berita, artikel, dan informasi untuk pengguna.</p>
            </div>

            <a href="{{ route('admin.berita.create') }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition-all shadow-md hover:shadow-lg hover:shadow-green-600/20 active:scale-95 h-11 whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Tambah Berita</span>
            </a>
        </div>

        {{-- FILTERS --}}
        <div class="flex flex-col sm:flex-row gap-3">
            {{-- SEARCH --}}
            <div class="relative group h-11 w-full sm:w-64 md:w-72 lg:w-80">
                <input type="text" value="{{ request('search') }}" placeholder="Cari judul..."
                    class="pl-10 pr-4 h-full bg-white border border-gray-200 rounded-xl text-sm text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-green-500/20 focus:border-green-500 w-full transition-all shadow-sm group-hover:border-green-300 group-hover:shadow-md"
                    onchange="document.getElementById('searchField').value = this.value; document.getElementById('searchForm').submit()">
                <svg class="w-5 h-5 text-gray-400 absolute left-3 top-1/2 -translate-y-1/2 transition-colors group-hover:text-green-500"
                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            {{-- CUSTOM DROPDOWN FILTER --}}
            <div x-data="{
                open: false,
                selected: '{{ request('kategori') ?: '' }}',
                options: [
                    { value: '', label: 'Semua Kategori' },
                    @foreach ($kategoriList as $kat)
                        { value: '{{ $kat }}', label: '{{ $kat }}' }, @endforeach
                ],
                select(value) {
                    this.selected = value;
                    this.open = false;
                    document.getElementById('kategoriField').value = value;
                    document.getElementById('searchForm').submit();
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7">
                        </path>
                    </svg>
                </button>

                <div x-show="open" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 translate-y-2"
                    class="absolute right-0 mt-2 w-full sm:w-56 bg-white rounded-xl shadow-xl border border-gray-100 z-50 overflow-hidden"
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

        <form id="searchForm" method="GET" action="{{ route('admin.berita.index') }}" class="hidden">
            <input type="hidden" name="search" id="searchField" value="{{ request('search') }}">
            <input type="hidden" name="kategori" id="kategoriField" value="{{ request('kategori') }}">
        </form>

        {{-- TABLE --}}
        <div class="bg-white rounded-2xl shadow-sm border border-green-100/80 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-green-50/80">
                        <tr>
                            <th class="p-4 text-left text-xs font-semibold text-green-700 uppercase tracking-wider">Judul
                            </th>
                            <th class="p-4 text-left text-xs font-semibold text-green-700 uppercase tracking-wider">
                                Kategori</th>
                            <th class="p-4 text-center text-xs font-semibold text-green-700 uppercase tracking-wider">
                                Status</th>
                            <th class="p-4 text-left text-xs font-semibold text-green-700 uppercase tracking-wider">Tanggal
                            </th>
                            <th class="p-4 text-center text-xs font-semibold text-green-700 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-green-50">
                        @forelse($beritas as $item)
                            <tr class="hover:bg-green-50/50 transition-colors">
                                <td class="p-4 text-gray-700 font-medium max-w-md">
                                    <div class="flex items-center gap-3">
                                        @if ($item->foto)
                                            <img src="{{ asset('storage/' . $item->foto) }}"
                                                class="w-10 h-10 rounded-lg object-cover bg-gray-100" alt="Thumbnail">
                                        @else
                                            <div
                                                class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center text-green-600">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                            </div>
                                        @endif
                                        <span class="line-clamp-2">{{ $item->judul }}</span>
                                    </div>
                                </td>
                                <td class="p-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $item->kategori }}
                                    </span>
                                </td>
                                <td class="p-4 text-center">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $item->status === 'publish' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td class="p-4 text-gray-500 whitespace-nowrap">
                                    {{ $item->created_at->format('d M Y') }}
                                </td>
                                <td class="p-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.berita.show', $item->id) }}"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-green-600 hover:bg-green-50 rounded-lg transition-colors">
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

                                        <a href="{{ route('admin.berita.edit', $item->id) }}"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                            Edit
                                        </a>

                                        <form id="delete-form-{{ $item->id }}" method="POST"
                                            action="{{ route('admin.berita.destroy', $item->id) }}" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button type="button"
                                            @click="$dispatch('open-delete-modal', { id: {{ $item->id }}, title: {{ json_encode($item->judul) }} })"
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
                                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                        </path>
                                    </svg>
                                    <p class="font-medium">Belum ada berita</p>
                                    <p class="text-sm mt-1">Klik tombol "Tambah Berita" untuk membuat artikel baru.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $beritas->links() }}
        </div>

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
    </div>
@endsection
