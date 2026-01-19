@extends('layouts.app')

@section('content')
<div class="min-h-screen from-green-50 to-lime-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-4xl mx-auto bg-white rounded-xl shadow-lg overflow-hidden transition-all duration-500 transform hover:scale-[1.001]">
        <!-- Header Gambar -->
        <div class="relative h-64 md:h-80 overflow-hidden">
            <img
                src="{{ asset('storage/news_images/padi_hijau.jpg') }}"
                alt="Ladang Padi Hijau"
                class="w-full h-full object-cover transition-opacity duration-500 hover:opacity-90"
            >
            <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent"></div>
            <div class="absolute bottom-0 left-0 p-6 text-left">
                <span class="bg-yellow-500 text-green-900 text-sm font-bold px-3 py-1 rounded-full">Pertanian</span>
                <h1 class="text-2xl md:text-4xl font-extrabold text-white mt-2">Inovasi Baru dalam Teknologi Pertanian Berkelanjutan</h1>
            </div>
        </div>

        <!-- Konten Berita -->
        <div class="p-6 md:p-8">
            <div class="flex items-center text-gray-500 text-sm mb-4 border-b pb-4">
                <span>Dipublikasikan oleh Admin</span>
                <span class="mx-2"> | </span>
                <span>14 Januari 2026</span>
            </div>

            <article class="prose prose-green max-w-none">
                <p class="lead text-lg text-gray-700 font-medium">
                    Teknologi pertanian modern semakin berkembang pesat, membantu petani meningkatkan hasil panen secara berkelanjutan tanpa merusak lingkungan.
                </p>

                <p>
                    Dalam beberapa tahun terakhir, adopsi teknologi seperti sensor tanah, drone pertanian, dan sistem irigasi pintar telah membuktikan efisiensinya dalam meningkatkan produktivitas lahan. Para petani tidak hanya menghemat air dan pupuk, tetapi juga memperoleh data akurat untuk pengambilan keputusan yang lebih baik.
                </p>

                <h2 class="text-xl font-bold text-green-800 mt-6">Dampak Positif Terhadap Lingkungan</h2>
                <p>
                    Pendekatan pertanian berkelanjutan ini juga turut menjaga ekosistem lokal. Penggunaan pestisida kimia yang berlebihan dapat diminimalisir, sehingga populasi serangga penyerbuk seperti lebah tetap lestari.
                </p>

                <blockquote class="border-l-4 border-yellow-500 pl-4 italic text-gray-700 my-6">
                    "Pertanian bukan hanya soal menanam dan memanen, tapi bagaimana kita menjaga bumi ini untuk generasi mendatang."
                </blockquote>

                <h2 class="text-xl font-bold text-green-800 mt-6">Tantangan dan Harapan Masa Depan</h2>
                <p>
                    Meski banyak manfaatnya, tantangan seperti biaya awal yang tinggi dan rendahnya literasi digital di kalangan petani masih menjadi kendala. Namun, pemerintah dan organisasi non-pemerintah terus memberikan pelatihan dan bantuan untuk mengatasi masalah tersebut.
                </p>
            </article>
            <!-- Tombol Kembali -->
            <div class="mt-10">
                <a href="{{ url()->previous() ?: route('home') }}"
                   class="inline-flex items-center justify-center bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-opacity-50">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
