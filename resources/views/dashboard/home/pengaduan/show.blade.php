@extends('layouts.hal_admin')

@section('content')
    <div class="p-4 sm:p-6 space-y-6">

        {{-- HEADER --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-green-700">Detail Pengaduan</h1>
                <p class="text-sm text-gray-500 mt-1">Rincian laporan yang masuk dari pengguna.</p>
            </div>
            {{-- BACK BUTTON --}}
            <a href="{{ route('admin.pengaduan.index') }}"
                class="inline-flex items-center gap-2 px-6 py-2.5 text-gray-600 font-medium rounded-xl border border-gray-200 bg-white hover:bg-gray-50 transition-all shadow-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                <span>Kembali ke Daftar</span>
            </a>
        </div>

        {{-- CONTENT CARD --}}
        <div class="bg-white rounded-2xl shadow-sm border border-green-100/80 overflow-hidden max-w-4xl">
            <div class="h-1.5 bg-gradient-to-r from-green-500 via-yellow-400 to-green-600"></div>

            <div class="p-6 space-y-6">
                {{-- HEADER --}}
                <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 mb-1">
                            {{ $pengaduan->kategori }}
                        </h2>
                        <p class="text-sm text-gray-500">
                            Dikirim pada {{ $pengaduan->created_at->translatedFormat('d F Y, H:i') }}
                        </p>
                    </div>
                    <span
                        class="text-xs font-semibold px-3 py-1 rounded-full self-start
                        {{ $pengaduan->status === 'baru' ? 'bg-emerald-100 text-emerald-700' : 'bg-gray-100 text-gray-600' }}">
                        {{ ucfirst($pengaduan->status) }}
                    </span>
                </div>

                {{-- DETAILS --}}
                <div class="grid sm:grid-cols-2 gap-5 text-sm border-t border-b border-gray-100 py-5">
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Nama Pelapor</p>
                        <p class="font-medium text-gray-800 mt-1">{{ $pengaduan->nama }}</p>
                    </div>
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold">Nomor WhatsApp</p>
                        <p class="font-medium text-gray-800 mt-1">{{ $pengaduan->no_whatsapp }}</p>
                    </div>
                </div>

                <div>
                    <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold mb-2">Isi Pesan</p>
                    <p class="text-gray-700 leading-relaxed bg-gray-50/80 p-4 rounded-xl border">
                        {{ $pengaduan->pesan }}
                    </p>
                </div>

                @if ($pengaduan->lampiran)
                    <div>
                        <p class="text-xs text-gray-500 uppercase tracking-wider font-semibold mb-2">Lampiran</p>
                        <a href="{{ asset('storage/' . $pengaduan->lampiran) }}" target="_blank" rel="noopener noreferrer">
                            <img src="{{ asset('storage/' . $pengaduan->lampiran) }}" alt="Lampiran Pengaduan"
                                class="rounded-lg border border-gray-200 max-w-md hover:shadow-lg transition-shadow">
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
