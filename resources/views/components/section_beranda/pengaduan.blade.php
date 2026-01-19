<section class="min-h-screen bg-[#d8ffe5] py-12 px-4" x-data="{
    subject: 'Kendala Website',
    imagePreview: null,
    isLoading: false,
    successOpen: {{ session('success') ? 'true' : 'false' }},
    errorOpen: {{ session('error') ? 'true' : 'false' }},
    fileChosen(event) {
        const file = event.target.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = (e) => { this.imagePreview = e.target.result; };
    }
}">
    <div class="max-w-6xl mx-auto">
        {{-- HEADER --}}
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-extrabold text-[#2e7d32]">
                Pengaduan & Bantuan<span class="text-[#f4b400]"> Agroptimal</span>
            </h2>
            <p class="mt-3 max-w-2xl mx-auto text-[#2e7d32]/80">
                Laporkan kendala atau sampaikan saran melalui fitur ini dengan cara yang mudah dan cepat.
            </p>
        </div>

        <div class="grid lg:grid-cols-12 gap-8 items-stretch">

            <div class="lg:col-span-4">
                <div
                    class="bg-emerald-900 rounded-[2.5rem] p-8 text-white relative overflow-hidden h-full flex flex-col ring-1 ring-black/5 shadow-[0_0_50px_rgba(0,0,0,0.15)]">
                    <div class="absolute -top-10 -right-10 w-32 h-32 bg-yellow-400/10 rounded-full"></div>

                    <h3 class="text-xl font-bold mb-6 flex items-center gap-2">
                        <span class="w-2 h-8 bg-yellow-400 rounded-full"></span>
                        Pilih Kategori
                    </h3>

                    <div class="space-y-4 flex-grow">
                        <button @click="subject = 'Kendala Website'"
                            :class="subject === 'Kendala Website' ? 'bg-yellow-400 text-emerald-900' :
                                'bg-emerald-800 text-emerald-100 hover:bg-emerald-700'"
                            class="w-full flex items-center justify-between p-5 rounded-2xl font-bold transition-all transform active:scale-95">
                            <span class="flex items-center gap-3">
                                <img src="{{ asset('img/beranda/pengaduan/kendala.webp') }}" class="w-6 h-6"
                                    alt="icon"> Kendala Website
                            </span>
                            <svg x-show="subject === 'Kendala Website'" xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <button @click="subject = 'Pertanyaan'"
                            :class="subject === 'Pertanyaan' ? 'bg-yellow-400 text-emerald-900' :
                                'bg-emerald-800 text-emerald-100 hover:bg-emerald-700'"
                            class="w-full flex items-center justify-between p-5 rounded-2xl font-bold transition-all transform active:scale-95">
                            <span class="flex items-center gap-3">
                                <img src="{{ asset('img/beranda/pengaduan/pertanyaan.webp') }}" class="w-6 h-6"
                                    alt="icon"> Pertanyaan
                            </span>
                            <svg x-show="subject === 'Pertanyaan'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <button @click="subject = 'Saran & Masukan'"
                            :class="subject === 'Saran & Masukan' ? 'bg-yellow-400 text-emerald-900' :
                                'bg-emerald-800 text-emerald-100 hover:bg-emerald-700'"
                            class="w-full flex items-center justify-between p-5 rounded-2xl font-bold transition-all transform active:scale-95">
                            <span class="flex items-center gap-3">
                                <img src="{{ asset('img/beranda/pengaduan/saran.webp') }}" class="w-6 h-6"
                                    alt="icon"> Saran & Masukan
                            </span>
                            <svg x-show="subject === 'Saran & Masukan'" xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>

                        <button @click="subject = 'Hal Lainnya'"
                            :class="subject === 'Hal Lainnya' ? 'bg-yellow-400 text-emerald-900' :
                                'bg-emerald-800 text-emerald-100 hover:bg-emerald-700'"
                            class="w-full flex items-center justify-between p-5 rounded-2xl font-bold transition-all transform active:scale-95">
                            <span class="flex items-center gap-3">
                                <img src="{{ asset('img/beranda/pengaduan/lainnya.webp') }}" class="w-6 h-6"
                                    alt="icon"> Hal Lainnya
                            </span>
                            <svg x-show="subject === 'Hal Lainnya'" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                    clip-rule="evenodd" />
                            </svg>
                        </button>
                    </div>

                    <div class="mt-12 pt-8 border-t border-emerald-800">
                        <p class="text-emerald-300 text-sm font-medium mb-4 italic">
                            Perlu bantuan lebih lanjut? Kami siap dihubungi secara pribadi
                        </p>
                        <a href="https://wa.me/62895347139758?text=Hallo%20Kak%2C%20saya%20membutuhkan%20bantuan%20terkait%20layanan%20AgrOptimal%20mengenai%20(_isi%20sesuai%20kebutuhan%20Anda_).%20Mohon%20informasinya%20ya%2C%20terima%20kasih."
                            class="flex items-center gap-4 group">
                            <div class="relative">
                                <img src="{{ asset('img/beranda/pengaduan/user.webp') }}"
                                    class="w-12 h-12 rounded-full">
                                <span
                                    class="absolute bottom-0 right-0 w-3 h-3 bg-green-400 border-2 border-emerald-900 rounded-full"></span>
                            </div>
                            <div>
                                <p class="font-bold text-white group-hover:text-yellow-400 transition">Chat via WhatsApp
                                </p>
                                <p class="text-emerald-400 text-xs font-mono">Fast Respon Dalam Jam Kerja</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-8">
                <form action="{{ route('pengaduan.kirim') }}" method="POST" enctype="multipart/form-data"
                    @submit="isLoading = true"
                    class="bg-white rounded-[2.5rem] p-8 md:p-12 h-full flex flex-col justify-between ring-1 ring-black/5 shadow-[0_0_50px_rgba(0,0,0,0.15)] relative overflow-hidden">
                    @csrf
                    <div class="absolute top-10 right-10 w-32 h-32 rounded-full bg-emerald-400/5 pointer-events-none">
                    </div>

                    <input type="hidden" name="kategori" :value="subject">

                    <div class="relative z-10">
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div class="space-y-2">
                                <label class="font-bold text-emerald-900 ml-1">Nama Lengkap Bapak/Ibu</label>
                                <input type="text" name="nama" placeholder="Contoh: Pak Mulyono" required
                                    class="w-full p-4 bg-emerald-50/50 border-2 border-emerald-100 rounded-2xl focus:border-emerald-500 focus:bg-white outline-none transition-all text-lg">
                            </div>
                            <div class="space-y-2">
                                <label class="font-bold text-emerald-900 ml-1">Nomor WhatsApp Aktif</label>
                                <input type="number" name="no_whatsapp" placeholder="08123xxx" required
                                    class="w-full p-4 bg-emerald-50/50 border-2 border-emerald-100 rounded-2xl focus:border-emerald-500 focus:bg-white outline-none transition-all text-lg">
                            </div>
                        </div>

                        <div class="space-y-2 mb-6">
                            <label class="font-bold text-emerald-900 ml-1">Ceritakan Masalahnya</label>
                            <textarea name="pesan" rows="4" placeholder="Jelaskan kendala Anda agar tim kami bisa segera membantu..."
                                required
                                class="w-full p-4 bg-emerald-50/50 border-2 border-emerald-100 rounded-2xl focus:border-emerald-500 focus:bg-white outline-none transition-all text-lg"></textarea>
                        </div>

                        <div class="mb-8">
                            <label class="font-bold text-emerald-900 ml-1 mb-2 block">Lampiran Foto (Opsional)</label>
                            <div class="flex items-center justify-center w-full">
                                <label
                                    class="flex flex-col items-center justify-center w-full h-32 border-2 border-emerald-200 border-dashed rounded-2xl cursor-pointer bg-emerald-50/30 hover:bg-emerald-50 transition-all overflow-hidden relative">
                                    <input type="file" name="lampiran"
                                        class="absolute inset-0 opacity-0 cursor-pointer" @change="fileChosen" />

                                    <template x-if="!imagePreview">
                                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                            <svg class="w-8 h-8 mb-3 text-emerald-500" fill="none"
                                                stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                </path>
                                            </svg>
                                            <p class="text-sm text-emerald-600 font-medium italic">Klik untuk unggah
                                                foto pendukung</p>
                                        </div>
                                    </template>

                                    <template x-if="imagePreview">
                                        <div class="flex items-center gap-4">
                                            <img :src="imagePreview"
                                                class="h-24 w-24 object-cover rounded-xl border-2 border-white shadow-sm">
                                            <p class="text-emerald-900 font-bold text-sm">Foto terpilih!</p>
                                        </div>
                                    </template>
                                </label>
                            </div>
                        </div>
                    </div>

                    <button type="submit"
                        class="group w-full bg-emerald-600 hover:bg-emerald-700 text-white font-black text-1xl py-4 rounded-2xl transition-all flex items-center justify-center gap-4 transform active:scale-95 relative z-10">
                        KIRIM LAPORAN SEKARANG
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-8 w-8 text-yellow-400 group-hover:translate-x-2 transition-transform"
                            viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- LOADING POPUP --}}
    <div x-show="isLoading" style="display: none;"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity">
        <div class="bg-white rounded-3xl p-8 flex flex-col items-center shadow-2xl">
            <div class="w-16 h-16 border-4 border-emerald-200 border-t-emerald-600 rounded-full animate-spin mb-4">
            </div>
            <h3 class="text-xl font-bold text-emerald-800">Mengirim Laporan...</h3>
            <p class="text-emerald-600 text-sm">Mohon tunggu sebentar.</p>
        </div>
    </div>

    {{-- SUCCESS POPUP --}}
    <div x-show="successOpen" style="display: none;"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity">
        <div
            class="bg-white max-w-md w-full mx-4 rounded-3xl p-8 text-center shadow-2xl transform transition-all scale-100">
            <div class="flex justify-center mb-5">
                <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center animate-bounce">
                    <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-extrabold text-emerald-800 mb-2">Laporan Terkirim!</h3>
            <p class="text-gray-600 mb-8 leading-relaxed">
                Terima kasih telah menghubungi kami. Tim Agroptimal akan segera meninjau laporan Anda.
            </p>
            <button @click="successOpen = false"
                class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-bold py-4 rounded-2xl transition-all shadow-lg shadow-emerald-600/20">
                Tutup Notifikasi
            </button>
        </div>
    </div>

    {{-- ERROR POPUP --}}
    <div x-show="errorOpen" style="display: none;"
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity">
        <div
            class="bg-white max-w-md w-full mx-4 rounded-3xl p-8 text-center shadow-2xl transform transition-all scale-100">
            <div class="flex justify-center mb-5">
                <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center animate-bounce">
                    <svg class="w-10 h-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </div>
            </div>
            <h3 class="text-2xl font-extrabold text-red-800 mb-2">Gagal Mengirim!</h3>
            <p class="text-gray-600 mb-8 leading-relaxed">
                Maaf, terjadi kesalahan saat mengirim laporan. Silakan coba lagi atau hubungi kami via WhatsApp.
            </p>
            <button @click="errorOpen = false"
                class="w-full bg-red-600 hover:bg-red-700 text-white font-bold py-4 rounded-2xl transition-all shadow-lg shadow-red-600/20">
                Tutup
            </button>
        </div>
    </div>
</section>
