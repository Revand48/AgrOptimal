@extends('layouts.hal_admin')

@section('title', 'Kelola Tips Irigasi')

@section('content')
    <div class="p-4 sm:p-6 space-y-6" x-data="{
        notification: { show: false, message: '', type: 'success' },
        deleteModal: { show: false, action: '', name: '' },
        showNotification(message, type = 'success') {
            this.notification.message = message;
            this.notification.type = type;
            this.notification.show = true;
            setTimeout(() => this.notification.show = false, 3000);
        },
        openDeleteModal(action, name) {
            this.deleteModal.action = action;
            this.deleteModal.name = name;
            this.deleteModal.show = true;
        },
        closeDeleteModal() {
            this.deleteModal.show = false;
            this.deleteModal.action = '';
            this.deleteModal.name = '';
        },
        confirmDelete() {
            document.getElementById('delete-form').action = this.deleteModal.action;
            document.getElementById('delete-form').submit();
        }
    }" x-init="@if(session('success'))
    showNotification('{{ session('success') }}', 'success')
    @endif
    @if(session('error'))
    showNotification('{{ session('error') }}', 'error')
    @endif">

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
                            <h3 class="text-lg font-bold text-gray-800">Konfirmasi Hapus</h3>
                            <p class="text-sm text-gray-500">Tindakan ini tidak dapat dibatalkan.</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 mb-6">
                        <p class="text-sm text-gray-600">Apakah Anda yakin ingin menghapus tips:</p>
                        <p class="text-sm font-bold text-gray-800 mt-1" x-text="deleteModal.name"></p>
                    </div>

                    <form id="delete-form" method="POST" class="hidden">
                        @csrf
                        @method('DELETE')
                    </form>

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
                <h1 class="text-2xl font-bold text-green-700">Tips Irigasi</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola langkah-langkah irigasi untuk pengguna.</p>
            </div>
        </div>

        {{-- TABLE CARD --}}
        <div class="bg-white rounded-2xl shadow-sm border border-green-100/80 overflow-hidden">
            <div class="h-1.5 bg-gradient-to-r from-green-500 via-green-400 to-green-600"></div>

            <div class="p-6">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-green-50 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-800">Daftar Tips</h2>
                            <p class="text-xs text-gray-500">Semua data tips tersimpan.</p>
                        </div>
                    </div>
                    <a href="{{ route('admin.edukasi.irigasi.create') }}"
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition-all shadow-md hover:shadow-lg hover:shadow-green-600/20 active:scale-95 h-11 whitespace-nowrap">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4">
                            </path>
                        </svg>
                        <span>Tambah Tips</span>
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-green-50/80">
                            <tr>
                                <th class="p-4 text-left text-xs font-semibold text-green-700 uppercase tracking-wider">
                                    Urutan</th>
                                <th class="p-4 text-left text-xs font-semibold text-green-700 uppercase tracking-wider">
                                    Judul</th>
                                <th class="p-4 text-left text-xs font-semibold text-green-700 uppercase tracking-wider">
                                    Deskripsi</th>
                                <th
                                    class="p-4 text-center text-xs font-semibold text-green-700 uppercase tracking-wider w-32">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-green-50">
                            @forelse($tips as $tip)
                                <tr class="hover:bg-green-50/50 transition-colors">
                                    <td class="p-4 font-bold text-gray-700">{{ $tip->step_number }}</td>
                                    <td class="p-4">
                                        <div class="flex items-center gap-3">
                                            @if ($tip->image)
                                                <img src="{{ asset('storage/' . $tip->image) }}"
                                                    class="w-10 h-10 rounded-lg object-cover shadow-sm">
                                            @else
                                                <div
                                                    class="w-10 h-10 rounded-lg bg-gray-100 flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                        </path>
                                                    </svg>
                                                </div>
                                            @endif
                                            <span class="font-medium text-gray-800">{{ $tip->title }}</span>
                                        </div>
                                    </td>
                                    <td class="p-4 text-gray-600 max-w-xs truncate">{{ $tip->description }}</td>
                                    <td class="p-4 text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            @if ($tip->video_url)
                                                <a href="{{ $tip->video_url }}" target="_blank"
                                                    class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                                        </path>
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                    Video
                                                </a>
                                            @endif
                                            <a href="{{ route('admin.edukasi.irigasi.edit', $tip->id) }}"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-green-600 hover:bg-green-50 rounded-lg transition-colors">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                    </path>
                                                </svg>
                                                Edit
                                            </a>
                                            <button type="button"
                                                @click="openDeleteModal('{{ route('admin.edukasi.irigasi.destroy', $tip->id) }}', '{{ $tip->title }}')"
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
                                    <td colspan="4" class="p-8 text-center text-gray-500">
                                        <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01">
                                            </path>
                                        </svg>
                                        <p class="font-medium">Belum ada data tips</p>
                                        <p class="text-sm mt-1">Klik tombol "Tambah Tips" untuk menambah data baru.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-4">
            {{ $tips->links() }}
        </div>
    </div>
@endsection
