<section
    class="relative overflow-hidden py-16 lg:py-15 bg-[#d8ffe5] font-sans"
    x-data="{ show: false }"
    x-init="setTimeout(() => show = true, 300)"
>
    <div class="absolute top-0 right-0 -mr-20 -mt-20 hidden lg:block z-0 pointer-events-none opacity-50">
        <svg width="404" height="404" fill="none" viewBox="0 0 404 404" aria-hidden="true">
            <defs>
                <pattern id="de316486-4a29-4312-bdfc-fbce2132a2c1" x="0" y="0" width="20" height="20" patternUnits="userSpaceOnUse">
                    <rect x="0" y="0" width="4" height="4" class="text-gray-200" fill="currentColor" />
                </pattern>
            </defs>
            <rect width="404" height="404" fill="url(#de316486-4a29-4312-bdfc-fbce2132a2c1)" />
        </svg>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-8 items-center">

            <div
                class="relative"
                :class="show ? 'opacity-100 translate-x-0' : 'opacity-0 -translate-x-10'"
                class="transition-all duration-1000 ease-out"
            >
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white">
                    <img
                        src="{{ asset('img/profile/hero_desk/lokasi.webp') }}"
                        alt="AgrOptimal Smart Farming Sidoarjo"
                        class="w-full h-auto object-contain transform hover:scale-105 transition duration-700 ease-in-out"
                    >

                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                </div>
                <div class="absolute -top-6 -right-4 lg:right-8 bg-white/90 backdrop-blur-sm p-3 rounded-xl shadow-lg border border-gray-100 flex flex-col items-center justify-center gap-2 animate-bounce-slow min-w-[120px]">
                    <img src="{{ asset('img/core/logo.webp') }}" alt="Logo" class="w-24 h-auto object-contain">
                    <div class="text-center">
                        <p class="text-xs font-semibold text-gray-500">Agriculture</p>
                    </div>
                </div>

                <div class="absolute -bottom-8 -right-2 lg:-right-6 w-32 h-24 bg-white p-1 rounded-lg shadow-xl rotate-3 hover:rotate-0 transition-transform duration-300">
                    <img
                        src="{{ asset('img/core/logogo.webp') }}"
                        alt="Sensor Monitoring"
                        class="w-full h-full object-contain rounded-md"
                    >
                </div>

                <div class="absolute -z-10 top-10 -left-4 w-full h-full border-l-8 border-green-500 rounded-l-3xl opacity-60"></div>
            </div>

            <div
                class="lg:pl-10"
                :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-10'"
                class="transition-all duration-1000 delay-300 ease-out"
            >
                <div class="inline-flex items-center px-3 py-1 rounded-full bg-[#2e7d32]/10 text-[#2e7d32] text-sm font-semibold mb-4">
                    <span class="mr-2">🌱</span> Profil Startup
                </div>

                <h1 class="text-4xl lg:text-5xl font-extrabold text-[#2e7d32] leading-tight mb-4">
                    AgrOptimal <br>
                    <span class="text-[#f4b400]">Sidoarjo</span>
                </h1>

                <p class="text-center text-lg text-[#d8ffe5]/80 mb-8 leading-relaxed">
                    |
                </p>

                <div class="grid grid-cols-2 gap-4 mb-8">
                    <div class="border-l-4 border-[#2e7d32] pl-4">
                        <span class="block text-2xl font-bold text-[#2e7d32]">98%</span>
                        <span class="text-sm text-[#2e7d32]/60">Akurasi Data</span>
                    </div>
                    <div class="border-l-4 border-[#f4b400] pl-4">
                        <span class="block text-2xl font-bold text-[#2e7d32]">24/7</span>
                        <span class="text-sm text-[#2e7d32]/60">Real-time Monitoring</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    @keyframes bounce-slow {
        0%, 100% { transform: translateY(-3%); }
        50% { transform: translateY(3%); }
    }
    .animate-bounce-slow {
        animation: bounce-slow 3s infinite ease-in-out;
    }
</style>
