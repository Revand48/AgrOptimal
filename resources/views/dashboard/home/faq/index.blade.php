@extends('layouts.hal_admin')

@section('content')
    <div class="p-4 sm:p-6 space-y-6" x-data="{
        notification: { show: false, message: '', type: 'success' },
        deleteModal: { show: false, id: null, question: '' },
        showNotification(message, type = 'success') {
            this.notification.message = message;
            this.notification.type = type;
            this.notification.show = true;
            setTimeout(() => this.notification.show = false, 3000);
        },
        openDeleteModal(id, question) {
            this.deleteModal.id = id;
            this.deleteModal.question = question;
            this.deleteModal.show = true;
        },
        closeDeleteModal() {
            this.deleteModal.show = false;
            this.deleteModal.id = null;
            this.deleteModal.question = '';
        },
        confirmDelete() {
            document.getElementById('delete-form-' + this.deleteModal.id).submit();
        }
    }" x-init="@if(session('success'))
    showNotification('{{ session('success') }}', 'success')
    @endif"
        @open-delete-modal="openDeleteModal($event.detail.id, $event.detail.question)">

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
                            <h3 class="text-lg font-bold text-gray-800">Hapus FAQ?</h3>
                            <p class="text-sm text-gray-500">Tindakan ini tidak dapat dibatalkan.</p>
                        </div>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 mb-6">
                        <p class="text-sm text-gray-600 font-medium" x-text="deleteModal.question"></p>
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
                <h1 class="text-2xl font-bold text-green-700">FAQ Halaman Beranda</h1>
                <p class="text-sm text-gray-500 mt-1">Kelola FAQ yang tampil di halaman utama website.</p>
            </div>

            <a href="{{ route('admin.faq.create') }}"
                class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-green-600 text-white font-semibold rounded-xl hover:bg-green-700 transition-all shadow-md hover:shadow-lg hover:shadow-green-600/20 active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                </svg>
                <span>Tambah FAQ</span>
            </a>
        </div>

        {{-- TABLE --}}
        <div class="bg-white rounded-2xl shadow-sm border border-green-100/80 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-green-50/80">
                        <tr>
                            <th class="p-4 text-left text-xs font-semibold text-green-700 uppercase tracking-wider">Urutan
                            </th>
                            <th class="p-4 text-left text-xs font-semibold text-green-700 uppercase tracking-wider">
                                Pertanyaan</th>
                            <th class="p-4 text-center text-xs font-semibold text-green-700 uppercase tracking-wider">Aktif
                            </th>
                            <th class="p-4 text-center text-xs font-semibold text-green-700 uppercase tracking-wider">
                                Terverifikasi</th>
                            <th class="p-4 text-center text-xs font-semibold text-green-700 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-green-50">
                        @foreach ($faqs as $faq)
                            <tr x-data="faqToggle({{ $faq->id }}, {{ $faq->is_active ? 'true' : 'false' }}, {{ $faq->is_verified ? 'true' : 'false' }})" class="hover:bg-green-50/50 transition-colors">
                                <td class="p-4">
                                    <span
                                        class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-green-100 text-green-700 font-bold text-sm">
                                        {{ $faq->sort_order }}
                                    </span>
                                </td>
                                <td class="p-4 text-gray-700 font-medium max-w-md">
                                    <span class="line-clamp-2">{{ $faq->question }}</span>
                                </td>

                                <td class="p-4 text-center">
                                    <button @click="toggleAktif" :class="aktif ? 'bg-green-500' : 'bg-gray-300'"
                                        class="w-12 h-6 rounded-full relative transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-green-500/20">
                                        <span :class="aktif ? 'translate-x-6' : 'translate-x-1'"
                                            class="absolute top-1 w-4 h-4 bg-white rounded-full shadow-sm transition-transform duration-200">
                                        </span>
                                    </button>
                                </td>

                                <td class="p-4 text-center">
                                    <button @click="toggleVerifikasi" :class="verifikasi ? 'bg-yellow-400' : 'bg-gray-300'"
                                        class="w-12 h-6 rounded-full relative transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-yellow-400/20">
                                        <span :class="verifikasi ? 'translate-x-6' : 'translate-x-1'"
                                            class="absolute top-1 w-4 h-4 bg-white rounded-full shadow-sm transition-transform duration-200">
                                        </span>
                                    </button>
                                </td>

                                <td class="p-4 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <a href="{{ route('admin.faq.edit', $faq) }}"
                                            class="inline-flex items-center gap-1 px-3 py-1.5 text-sm font-medium text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                            Edit
                                        </a>

                                        <form id="delete-form-{{ $faq->id }}" method="POST"
                                            action="{{ route('admin.faq.destroy', $faq) }}" class="hidden">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        <button type="button"
                                            @click="$dispatch('open-delete-modal', { id: {{ $faq->id }}, question: {{ json_encode($faq->question) }} })"
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
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($faqs->isEmpty())
                <div class="p-8 text-center text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                        </path>
                    </svg>
                    <p class="font-medium">Belum ada FAQ</p>
                    <p class="text-sm mt-1">Klik tombol "Tambah FAQ" untuk menambahkan FAQ baru.</p>
                </div>
            @endif
        </div>

        {{-- PREVIEW SECTION --}}
        <div class="pt-4">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 rounded-xl bg-green-100 flex items-center justify-center">
                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-green-700">Preview FAQ di Beranda</h2>
                    <p class="text-sm text-gray-500">Tampilan FAQ yang aktif di halaman utama</p>
                </div>
            </div>

            {{-- Preview Container --}}
            <div class="bg-white rounded-2xl border border-green-100/80 shadow-sm overflow-hidden">
                <div class="p-6" x-data="{
                    activeIdx: null,
                    faqs: @js($faqs->where('is_active', true)->map(fn($f) => ['id' => $f->id, 'q' => $f->question, 'a' => $f->answer, 'verified' => $f->is_verified])->values())
                }">
                    {{-- Preview Header --}}
                    <div class="text-center mb-8">
                        <h3 class="text-2xl font-extrabold text-green-700">
                            FAQ <span class="text-yellow-500">Agroptimal</span>
                        </h3>
                        <p class="mt-2 text-gray-500 text-sm max-w-xl mx-auto">
                            Temukan jawaban atas pertanyaan yang paling sering diajukan seputar layanan digital kami.
                        </p>
                    </div>

                    {{-- FAQ List --}}
                    <div class="grid gap-4 max-w-3xl mx-auto">
                        <template x-for="(faq, index) in faqs" :key="faq.id">
                            <div @click="activeIdx === index ? activeIdx = null : activeIdx = index"
                                class="group relative p-5 rounded-xl transition-all duration-300 cursor-pointer border"
                                :class="activeIdx === index ?
                                    'bg-white shadow-lg border-green-200 ring-1 ring-green-500/10' :
                                    'bg-gray-50/50 border-gray-100 hover:bg-white hover:border-green-100 hover:shadow-md'">

                                <div class="flex items-center justify-between gap-4">
                                    <div class="flex items-center gap-4">
                                        <div :class="activeIdx === index ?
                                            'bg-green-600 text-white scale-105' :
                                            'bg-yellow-400 text-green-900'"
                                            class="w-10 h-10 rounded-lg flex items-center justify-center font-bold text-sm transition-all duration-300 shadow-sm"
                                            x-text="String(index + 1).padStart(2, '0')">
                                        </div>

                                        <h4 class="font-semibold text-gray-800 group-hover:text-green-700 transition-colors text-sm sm:text-base"
                                            x-text="faq.q">
                                        </h4>
                                    </div>

                                    <div class="flex-shrink-0 w-7 h-7 rounded-full flex items-center justify-center transition-all duration-300"
                                        :class="activeIdx === index ?
                                            'bg-green-100 text-green-600 rotate-180' :
                                            'bg-gray-100 text-gray-400'">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </div>
                                </div>

                                <div x-show="activeIdx === index" x-collapse x-cloak>
                                    <div class="mt-4 pt-4 border-t border-green-50 text-gray-600 text-sm leading-relaxed">
                                        <span x-text="faq.a"></span>

                                        <div x-show="faq.verified"
                                            class="mt-3 flex items-center gap-2 text-green-600 text-xs font-semibold">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z">
                                                </path>
                                            </svg>
                                            Terverifikasi oleh Tim Agronom Agroptimal
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <template x-if="faqs.length === 0">
                            <div class="text-center py-8 text-gray-400">
                                <svg class="w-10 h-10 mx-auto mb-2" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                    </path>
                                </svg>
                                <p class="text-sm">Belum ada FAQ yang aktif</p>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script>
        function faqToggle(id, initialAktif, initialVerifikasi) {
            return {
                aktif: initialAktif,
                verifikasi: initialVerifikasi,

                toggleAktif() {
                    fetch(`/dashboard/home-faq/${id}/toggle-aktif`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                        }
                    }).then(() => this.aktif = !this.aktif)
                },

                toggleVerifikasi() {
                    fetch(`/dashboard/home-faq/${id}/toggle-verifikasi`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content
                        }
                    }).then(() => this.verifikasi = !this.verifikasi)
                }
            }
        }
    </script>

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>
@endsection
