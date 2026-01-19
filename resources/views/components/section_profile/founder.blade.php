@props(['founders' => null])

@php
    $data = $founders ?? [
        [
            'name' => 'Sack Sick Sock S.Pki',
            'role' => 'Chief Executive Officer (CEO)',
            'image' => 'pp1.webp',
            'bio' => 'Menentukan arah visi dan strategi AgrOptimal agar tetap relevan dengan kebutuhan petani.'
        ],
        [
            'name' => 'MasBro Demi U.Keh U.Ker ',
            'role' => 'Chief Technology Officer (CTO)',
            'image' => 'pp2.webp',
            'bio' => 'Mengembangkan sistem, fitur, dan teknologi AgrOptimal agar mudah digunakan dan stabil.'
        ],
        [
            'name' => 'Drtn. Ekokokokpetok S.Ppg.',
            'role' => 'Chief Product & Education Officer (CPO)',
            'image' => 'pp3.webp',
            'bio' => 'Menyusun konten edukasi, panduan tanam, dan materi pembelajaran yang mudah dipahami.'
        ]
    ];
@endphp

<section class="relative py-20 bg-[#d8ffe5] font-sans overflow-hidden">

    <div class="absolute inset-0 pointer-events-none">
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-[#2e7d32]/10 rounded-full blur-[80px] mix-blend-multiply"></div>
        <div class="absolute top-1/2 right-0 w-64 h-64 bg-[#f4b400]/10 rounded-full blur-[60px] mix-blend-multiply"></div>
    </div>

    <div class="relative z-10 max-w-6xl mx-auto px-4 sm:px-6">

        <!-- Heading -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-extrabold text-[#2e7d32]">
                Tiga Manusia<span class="text-[#f4b400]">,</span> Satu Visi untuk <span class="text-[#f4b400]">Pertanian</span> Indonesia
            </h2>
            <p class="mt-3 max-w-2xl mx-auto text-[#2e7d32]/80">
                Kita berbeda namun saling melengkapi, untuk menghadirkan solusi pertanian cerdas.
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($data as $index => $founder)
                <div
                    x-data="{ open: false }"
                    class="group relative w-full h-[380px] rounded-3xl overflow-hidden shadow-sm hover:shadow-xl hover:shadow-[#2e7d32]/10 transition-all duration-500 bg-white"
                >
                    <img
                        src="{{ asset('img/profile/founders/' . $founder['image']) }}"
                        onerror="this.src='https://images.unsplash.com/photo-{{ $index == 0 ? '1595955627932-ff45e05031b2' : ($index == 1 ? '1580894732444-8ecded7900cd' : '1552642986-53a630dc89df') }}?auto=format&fit=crop&w=600&q=80'"
                        alt="{{ $founder['name'] }}"
                        class="absolute inset-0 w-full h-full object-cover transition-transform duration-700 ease-out group-hover:scale-110"
                    >

                    <div class="absolute inset-0 bg-gradient-to-t from-[#2e7d32]/90 via-[#2e7d32]/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-500"></div>

                    <div
                        class="absolute bottom-0 left-0 w-full p-5 flex flex-col justify-end transition-all duration-500 ease-out"
                        :class="open ? 'translate-y-0' : 'translate-y-2'"
                    >

                        <div class="relative z-10">
                            <span class="inline-block px-2 py-0.5 mb-2 text-[10px] font-bold tracking-widest text-[#d8ffe5] uppercase bg-white/10 backdrop-blur-md rounded border border-white/20">
                                {{ $founder['role'] }}
                            </span>
                            <h3 class="text-xl font-serif font-bold text-white mb-1">
                                {{ $founder['name'] }}
                            </h3>
                        </div>

                        <div
                            x-show="open"
                            x-collapse.duration.500ms
                            class="text-sm text-[#d8ffe5]/90 leading-relaxed font-light mt-2 overflow-hidden"
                            style="display: none;"
                        >
                            <div class="pt-2 border-t border-white/10">
                                {{ $founder['bio'] }}
                            </div>
                        </div>

                        <button
                            @click="open = !open"
                            class="mt-3 flex items-center gap-2 text-xs font-semibold text-white/80 hover:text-white transition-colors group/btn focus:outline-none w-max"
                        >
                            <span x-text="open ? 'Tutup' : 'Lihat Profil'"></span>

                            <div
                                class="w-6 h-6 rounded-full bg-white/20 flex items-center justify-center transition-all duration-500 ease-out"
                                :class="open ? 'rotate-180 bg-[#2e7d32]/80' : 'rotate-0 group-hover/btn:rotate-90'"
                            >
                                <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                                </svg>
                            </div>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
