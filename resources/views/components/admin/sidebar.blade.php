<aside x-data="{ sidebarOpen: true, currentUrl: '{{ url()->current() }}' }" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'"
    class="fixed z-40 w-72 bg-white border-r border-green-50/50 h-screen flex flex-col shadow-[4px_0_30px_rgba(0,0,0,0.03)] transition-transform duration-300 ease-in-out font-sans pb-6 overflow-hidden left-0 top-0">
    <!-- Header Logo -->
    <div class="px-8 py-8 flex items-center gap-3 bg-white/50 backdrop-blur-sm">
        <img src="{{ asset('img/core/logogo.webp') }}" alt="Logo Agroptimal"
            class="w-10 h-10 object-contain drop-shadow-sm">

        <div>
            <h2 class="text-xl font-bold text-green-600 tracking-tight leading-none">
                Agr<span class="text-yellow-600">Optimal</span>
            </h2>
            <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest mt-1">
                panel data agroptimal
            </p>
        </div>
    </div>

    <nav class="flex-1 px-4 space-y-3 mt-4 overflow-y-auto custom-scrollbar py-2">

        <div class="px-4 text-[11px] font-extrabold text-gray-400/80 uppercase tracking-widest mb-2">
            Menu Utama
        </div>

        <!-- Menu Dashboard -->
        <a href="{{ url('/dashboard') }}"
            :class="currentUrl === '{{ url('/dashboard') }}' ?
                'bg-gradient-to-r from-green-50 to-white text-green-800 shadow-sm border-green-100' :
                'text-gray-600 hover:bg-gradient-to-r hover:from-green-50 hover:to-white hover:text-green-800 hover:translate-x-1 hover:shadow-md hover:shadow-green-100/50 border-transparent'"
            class="group relative flex items-center gap-3.5 px-4 py-3.5 rounded-2xl border transition-all duration-300 ease-out overflow-hidden">

            <div :class="currentUrl === '{{ url('/dashboard') }}' ? 'w-1.5 bg-yellow-500' : 'w-0 bg-yellow-400 group-hover:w-1.5'"
                class="absolute left-0 top-1/2 -translate-y-1/2 h-3/5 rounded-r-full transition-all duration-300 ease-out">
            </div>

            <svg :class="currentUrl === '{{ url('/dashboard') }}' ? 'text-green-600 scale-110' :
                'text-gray-400 group-hover:text-yellow-600 group-hover:scale-110 group-hover:rotate-[6deg]'"
                class="w-6 h-6 transition-all duration-300 ease-out" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z">
                </path>
            </svg>
            <span class="font-semibold tracking-tight relative z-10">Dashboard</span>
            <div x-show="currentUrl === '{{ url('/dashboard') }}'"
                class="absolute right-4 w-2 h-2 bg-green-500 rounded-full"></div>
        </a>

        <!-- Menu Pengaduan -->
        <a href="{{ url('/dashboard/pengaduan') }}"
            :class="currentUrl === '{{ url('/dashboard/pengaduan') }}' ?
                'bg-gradient-to-r from-green-50 to-white text-green-800 shadow-sm border-green-100' :
                'text-gray-600 hover:bg-gradient-to-r hover:from-green-50 hover:to-white hover:text-green-800 hover:translate-x-1 hover:shadow-md hover:shadow-green-100/50 border-transparent'"
            class="group relative flex items-center gap-3.5 px-4 py-3.5 rounded-2xl border transition-all duration-300 ease-out overflow-hidden">

            <div :class="currentUrl === '{{ url('/dashboard/pengaduan') }}' ? 'w-1.5 bg-yellow-500' :
                'w-0 bg-yellow-400 group-hover:w-1.5'"
                class="absolute left-0 top-1/2 -translate-y-1/2 h-3/5 rounded-r-full transition-all duration-300 ease-out">
            </div>

            <svg :class="currentUrl === '{{ url('/dashboard/pengaduan') }}' ? 'text-green-600 scale-110' :
                'text-gray-400 group-hover:text-yellow-600 group-hover:scale-110 group-hover:rotate-[6deg]'"
                class="w-6 h-6 transition-all duration-300 ease-out" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z">
                </path>
            </svg>
            <span class="font-semibold tracking-tight relative z-10">Pengaduan</span>
            <div x-show="currentUrl === '{{ url('/dashboard/pengaduan') }}'"
                class="absolute right-4 w-2 h-2 bg-green-500 rounded-full"></div>
        </a>

        <!-- Dropdown Beranda -->
        <div class="relative space-y-1" x-data="{ open: {{ request()->is('dashboard/home-statistik*', 'dashboard/home-faq*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                :class="open ? 'bg-gray-50 text-green-800 shadow-inner-sm' :
                    'text-gray-600 hover:bg-gray-50 hover:text-green-800 hover:translate-x-1'"
                class="group w-full flex items-center justify-between px-4 py-3.5 rounded-2xl transition-all duration-300 ease-out">

                <div class="flex items-center gap-3.5 relative z-10">
                    <svg :class="open ? 'text-green-600' : 'text-gray-400 group-hover:text-yellow-600'"
                        class="w-6 h-6 transition-colors duration-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                        </path>
                    </svg>
                    <span class="font-semibold tracking-tight">Beranda</span>
                </div>
                <svg :class="open ? 'rotate-180 text-green-600' :
                    'text-gray-400 group-hover:text-gray-600 group-hover:translate-y-0.5'"
                    class="w-5 h-5 transition-all duration-300" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="open" x-collapse x-cloak class="relative pl-12 pr-2 space-y-1">

                <div class="absolute left-7 top-0 bottom-2 w-px bg-green-200/50"></div>

                <a href="{{ url('/dashboard/home-statistik') }}"
                    :class="currentUrl === '{{ url('/dashboard/home-statistik') }}' ?
                        'text-green-700 bg-green-50/50 border-l-yellow-500 font-medium pl-5' :
                        'text-gray-500 hover:text-green-700 hover:bg-green-50/30 hover:border-l-yellow-400 hover:pl-5'"
                    class="relative block py-2.5 rounded-r-xl transition-all duration-200 text-[15px] border-l-[3px] border-transparent pl-4">
                    <span class="relative z-10">Statistik Agro</span>
                </a>
                <a href="{{ url('/dashboard/home-faq') }}"
                    :class="currentUrl === '{{ url('/dashboard/home-faq') }}' ?
                        'text-green-700 bg-green-50/50 border-l-yellow-500 font-medium pl-5' :
                        'text-gray-500 hover:text-green-700 hover:bg-green-50/30 hover:border-l-yellow-400 hover:pl-5'"
                    class="relative block py-2.5 rounded-r-xl transition-all duration-200 text-[15px] border-l-[3px] border-transparent pl-4">
                    <span class="relative z-10">FAQ</span>
                </a>
            </div>
        </div>

        <!-- Dropdown Data Master Pupuk -->
        <div class="relative space-y-1" x-data="{ open: {{ request()->routeIs('admin.publikasi.*', 'admin.pupuk.*', 'admin.wilayah.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                :class="open ? 'bg-gray-50 text-green-800 shadow-inner-sm' :
                    'text-gray-600 hover:bg-gray-50 hover:text-green-800 hover:translate-x-1'"
                class="group w-full flex items-center justify-between px-4 py-3.5 rounded-2xl transition-all duration-300 ease-out">

                <div class="flex items-center gap-3.5 relative z-10">
                    <svg :class="open ? 'text-green-600' : 'text-gray-400 group-hover:text-yellow-600'"
                        class="w-6 h-6 transition-colors duration-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4">
                        </path>
                    </svg>
                    <span class="font-semibold tracking-tight">Data Master Pupuk</span>
                </div>
                <svg :class="open ? 'rotate-180 text-green-600' :
                    'text-gray-400 group-hover:text-gray-600 group-hover:translate-y-0.5'"
                    class="w-5 h-5 transition-all duration-300" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="open" x-collapse x-cloak class="relative pl-12 pr-2 space-y-1">

                <div class="absolute left-7 top-0 bottom-2 w-px bg-green-200/50"></div>

                <a href="{{ route('admin.publikasi.index') }}"
                    :class="currentUrl === '{{ route('admin.publikasi.index') }}' ?
                        'text-green-700 bg-green-50/50 border-l-yellow-500 font-medium pl-5' :
                        'text-gray-500 hover:text-green-700 hover:bg-green-50/30 hover:border-l-yellow-400 hover:pl-5'"
                    class="relative block py-2.5 rounded-r-xl transition-all duration-200 text-[15px] border-l-[3px] border-transparent pl-4">
                    <span class="relative z-10">Data Pupuk</span>
                </a>
                <a href="{{ route('admin.pupuk.index') }}"
                    :class="currentUrl === '{{ route('admin.pupuk.index') }}' ?
                        'text-green-700 bg-green-50/50 border-l-yellow-500 font-medium pl-5' :
                        'text-gray-500 hover:text-green-700 hover:bg-green-50/30 hover:border-l-yellow-400 hover:pl-5'"
                    class="relative block py-2.5 rounded-r-xl transition-all duration-200 text-[15px] border-l-[3px] border-transparent pl-4">
                    <span class="relative z-10">+ Pupuk</span>
                </a>
                <a href="{{ route('admin.wilayah.index') }}"
                    :class="currentUrl === '{{ route('admin.wilayah.index') }}' ?
                        'text-green-700 bg-green-50/50 border-l-yellow-500 font-medium pl-5' :
                        'text-gray-500 hover:text-green-700 hover:bg-green-50/30 hover:border-l-yellow-400 hover:pl-5'"
                    class="relative block py-2.5 rounded-r-xl transition-all duration-200 text-[15px] border-l-[3px] border-transparent pl-4">
                    <span class="relative z-10">+ Kecamatan & Desa</span>
                </a>
            </div>
        </div>

        <!-- Dropdown Data Edukasi Budidaya -->
        <div class="relative space-y-1" x-data="{ open: {{ request()->routeIs('admin.edukasi.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                :class="open ? 'bg-gray-50 text-green-800 shadow-inner-sm' :
                    'text-gray-600 hover:bg-gray-50 hover:text-green-800 hover:translate-x-1'"
                class="group w-full flex items-center justify-between px-4 py-3.5 rounded-2xl transition-all duration-300 ease-out">

                <div class="flex items-center gap-3.5 relative z-10">
                    <svg :class="open ? 'text-green-600' : 'text-gray-400 group-hover:text-yellow-600'"
                        class="w-6 h-6 transition-colors duration-300" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                        </path>
                    </svg>
                    <span class="font-semibold tracking-tight">Edukasi Budidaya</span>
                </div>
                <svg :class="open ? 'rotate-180 text-green-600' :
                    'text-gray-400 group-hover:text-gray-600 group-hover:translate-y-0.5'"
                    class="w-5 h-5 transition-all duration-300" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </button>

            <div x-show="open" x-collapse x-cloak class="relative pl-12 pr-2 space-y-1">

                <div class="absolute left-7 top-0 bottom-2 w-px bg-green-200/50"></div>

                <a href="{{ route('admin.edukasi.tips_bibit.index') }}"
                    :class="currentUrl === '{{ route('admin.edukasi.tips_bibit.index') }}' ?
                        'text-green-700 bg-green-50/50 border-l-yellow-500 font-medium pl-5' :
                        'text-gray-500 hover:text-green-700 hover:bg-green-50/30 hover:border-l-yellow-400 hover:pl-5'"
                    class="relative block py-2.5 rounded-r-xl transition-all duration-200 text-[15px] border-l-[3px] border-transparent pl-4">
                    <span class="relative z-10">~ Tips Bibit</span>
                </a>
                <a href="{{ route('admin.edukasi.tips_lahan.index') }}"
                    :class="currentUrl === '{{ route('admin.edukasi.tips_lahan.index') }}' ?
                        'text-green-700 bg-green-50/50 border-l-yellow-500 font-medium pl-5' :
                        'text-gray-500 hover:text-green-700 hover:bg-green-50/30 hover:border-l-yellow-400 hover:pl-5'"
                    class="relative block py-2.5 rounded-r-xl transition-all duration-200 text-[15px] border-l-[3px] border-transparent pl-4">
                    <span class="relative z-10">~ Tips Lahan</span>
                </a>
                <a href="{{ route('admin.edukasi.tips_pemupukan.index') }}"
                    :class="currentUrl === '{{ route('admin.edukasi.tips_pemupukan.index') }}' ?
                        'text-green-700 bg-green-50/50 border-l-yellow-500 font-medium pl-5' :
                        'text-gray-500 hover:text-green-700 hover:bg-green-50/30 hover:border-l-yellow-400 hover:pl-5'"
                    class="relative block py-2.5 rounded-r-xl transition-all duration-200 text-[15px] border-l-[3px] border-transparent pl-4">
                    <span class="relative z-10">~ Tips Pemupukan</span>
                </a>
                <a href="{{ route('admin.edukasi.cek_tanah.index') }}"
                    :class="currentUrl === '{{ route('admin.edukasi.cek_tanah.index') }}' ?
                        'text-green-700 bg-green-50/50 border-l-yellow-500 font-medium pl-5' :
                        'text-gray-500 hover:text-green-700 hover:bg-green-50/30 hover:border-l-yellow-400 hover:pl-5'"
                    class="relative block py-2.5 rounded-r-xl transition-all duration-200 text-[15px] border-l-[3px] border-transparent pl-4">
                    <span class="relative z-10">~ Pengecekan Tanah</span>
                </a>
                <a href="{{ route('admin.edukasi.irigasi.index') }}"
                    :class="currentUrl === '{{ route('admin.edukasi.irigasi.index') }}' ?
                        'text-green-700 bg-green-50/50 border-l-yellow-500 font-medium pl-5' :
                        'text-gray-500 hover:text-green-700 hover:bg-green-50/30 hover:border-l-yellow-400 hover:pl-5'"
                    class="relative block py-2.5 rounded-r-xl transition-all duration-200 text-[15px] border-l-[3px] border-transparent pl-4">
                    <span class="relative z-10">~ Irigasi</span>
                </a>
            </div>
        </div>



        <!-- Menu Simulasi -->
        <a href="{{ route('admin.komoditas.index') }}"
            :class="currentUrl === '{{ route('admin.komoditas.index') }}' ?
                'bg-gradient-to-r from-green-50 to-white text-green-800 shadow-sm border-green-100' :
                'text-gray-600 hover:bg-gradient-to-r hover:from-green-50 hover:to-white hover:text-green-800 hover:translate-x-1 hover:shadow-md hover:shadow-green-100/50 border-transparent'"
            class="group relative flex items-center gap-3.5 px-4 py-3.5 rounded-2xl border transition-all duration-300 ease-out overflow-hidden">
            <div :class="currentUrl === '{{ route('admin.komoditas.index') }}' ? 'w-1.5 bg-yellow-500' :
                'w-0 bg-yellow-400 group-hover:w-1.5'"
                class="absolute left-0 top-1/2 -translate-y-1/2 h-3/5 rounded-r-full transition-all duration-300 ease-out">
            </div>
            <svg :class="currentUrl === '{{ route('admin.komoditas.index') }}' ? 'text-green-600 scale-110' :
                'text-gray-400 group-hover:text-yellow-600 group-hover:scale-110 group-hover:rotate-[6deg]'"
                class="w-6 h-6 transition-colors duration-300" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                </path>
            </svg>
            <span class="font-semibold tracking-tight relative z-10">Simulasi</span>
        </a>


        <!-- Menu Berita -->
        <a href="{{ route('admin.berita.index') }}"
            :class="currentUrl === '{{ route('admin.berita.index') }}' ?
                'bg-gradient-to-r from-green-50 to-white text-green-800 shadow-sm border-green-100' :
                'text-gray-600 hover:bg-gradient-to-r hover:from-green-50 hover:to-white hover:text-green-800 hover:translate-x-1 hover:shadow-md hover:shadow-green-100/50 border-transparent'"
            class="group relative flex items-center gap-3.5 px-4 py-3.5 rounded-2xl border transition-all duration-300 ease-out overflow-hidden">
            <div :class="currentUrl === '{{ route('admin.berita.index') }}' ? 'w-1.5 bg-yellow-500' :
                'w-0 bg-yellow-400 group-hover:w-1.5'"
                class="absolute left-0 top-1/2 -translate-y-1/2 h-3/5 rounded-r-full transition-all duration-300 ease-out">
            </div>
            <svg :class="currentUrl === '{{ route('admin.berita.index') }}' ? 'text-green-600 scale-110' :
                'text-gray-400 group-hover:text-yellow-600 group-hover:scale-110 group-hover:rotate-[6deg]'"
                class="w-6 h-6 transition-all duration-300 ease-out" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                </path>
            </svg>
            <span class="font-semibold tracking-tight relative z-10">Berita</span>
        </a>

    </nav>

    <!-- Footer Logout -->
    <div
        class="p-5 mx-3 mt-auto rounded-3xl bg-gradient-to-b from-green-50/10 to-green-50/80 border border-green-100/50 shadow-inner-sm">

        <form method="POST" action="{{ route('admin.logout') }}">
            @csrf
            <button
                class="group relative w-full flex items-center justify-center gap-2 bg-white border-2 border-red-100 text-red-500 py-3 rounded-2xl text-sm font-bold transition-all duration-300 overflow-hidden hover:border-red-500 hover:text-white hover:shadow-lg hover:shadow-red-500/30 active:scale-95">
                <div
                    class="absolute inset-0 bg-gradient-to-r from-red-500 to-red-600 translate-y-full transition-transform duration-300 ease-out group-hover:translate-y-0">
                </div>

                <svg class="w-5 h-5 relative z-10 transition-transform group-hover:-translate-x-1" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                    </path>
                </svg>
                <span class="relative z-10">Log Out</span>
            </button>
        </form>
    </div>
</aside>
