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
                            <h3 class="text-lg font-bold text-gray-800">Hapus Komoditas?</h3>
                            <p class="text-sm text-gray-500">Tindakan ini tidak dapat dibatalkan.</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 mb-6">
                        <p class="text-sm text-gray-600">Apakah Anda yakin ingin menghapus data:</p>
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
                <h1 class="text-2xl font-bold text-green-700">Manajemen Komoditas & Tanaman</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola data teknis tanaman untuk fitur simulasi.</p>
            </div>

            <a href="{{ route('admin.komoditas.create') }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition-all shadow-md hover:shadow-lg hover:shadow-green-600/20 active:scale-95 h-11 whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Tambah Komoditas</span>
            </a>
        </div>

        {{-- TABLE --}}
        <div class="bg-white rounded-2xl shadow-sm border border-green-100/80 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-green-50/80">
                        <tr>
                            <th class="p-4 text-left text-xs font-semibold text-green-700 uppercase tracking-wider">Nama
                                Tanaman (Slug)</th>
                            <th class="p-4 text-left text-xs font-semibold text-green-700 uppercase tracking-wider">Masa
                                Panen</th>
                            <th class="p-4 text-left text-xs font-semibold text-green-700 uppercase tracking-wider">Hasil
                                (Ton/Ha)</th>
                            <th class="p-4 text-left text-xs font-semibold text-green-700 uppercase tracking-wider">Harga
                                (Rp/Kg)</th>
                            <th class="p-4 text-center text-xs font-semibold text-green-700 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-green-50">
                        @forelse($komoditas as $item)
                            <tr class="hover:bg-green-50/50 transition-colors">
                                <td class="p-4 font-bold text-gray-700">
                                    {{ $item->nama }} <br>
                                    <span class="text-xs font-normal text-gray-400">{{ $item->slug }}</span>
                                </td>
                                <td class="p-4 text-gray-600">
                                    {{ $item->duration_days }} Hari
                                </td>
                                <td class="p-4 text-gray-600">
                                    {{ $item->yield_per_ha }} Ton
                                </td>
                                <td class="p-4 text-gray-600">
                                    Rp {{ number_format($item->price_per_kg, 0, ',', '.') }}
                                </td>
                                <td class="p-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.komoditas.edit', $item->id) }}"
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
                                            action="{{ route('admin.komoditas.destroy', $item->id) }}" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button type="button"
                                            @click="$dispatch('open-delete-modal', { id: {{ $item->id }}, title: {{ json_encode($item->nama) }} })"
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
                                    Belum ada data komoditas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4">
            {{ $komoditas->links() }}
        </div>

        <style>
            [x-cloak] {
                display: none !important;
            }
        </style>
    </div>
@endsection
