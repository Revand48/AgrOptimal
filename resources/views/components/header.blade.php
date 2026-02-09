<div class="flex justify-center p-4 sticky top-0 z-50 bg-transparent">
    <nav x-data="{ mobileMenuOpen: false }"
        class="bg-emerald-600/90 backdrop-blur-md border border-emerald-500/30 rounded-2xl w-full max-w-6xl shadow-2xl shadow-emerald-900/20 transition-all duration-300">
        <div class="flex flex-wrap items-center justify-between mx-4 p-4">

            <!-- Logo & Brand -->
            <a href="{{ url('/') }}" class="flex items-center space-x-3 rtl:space-x-reverse group">
                <img src="{{ asset('img/core/logogo.webp') }}"
                    class="h-10 transition-transform duration-300 group-hover:scale-105" alt="Logo Pertani" />
                <span class="self-center text-2xl font-bold whitespace-nowrap text-white drop-shadow-sm">Agr<span
                        class="text-amber-200">Optimal</span></span>
            </a>

            <!-- Tombol Mobile Menu -->
            <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                class="inline-flex items-center p-2 w-10 h-10 justify-center text-white rounded-lg md:hidden hover:bg-emerald-500 focus:outline-none focus:ring-2 focus:ring-amber-300 transition-all duration-200 ease-in-out">
                <span class="sr-only">Buka menu</span>
                <svg class="w-6 h-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>

            <!-- Menu Utama -->
            <div :class="{ 'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }"
                class="hidden w-full md:block md:w-auto mt-4 md:mt-0" id="navbar-menu">
                <ul
                    class="font-medium flex flex-col md:flex-row md:space-x-6 md:items-center md:space-y-0 space-y-2 p-3 md:p-0 bg-emerald-700/50 md:bg-transparent rounded-xl md:rounded-none">

                    <li>
                        <a href="{{ url('/') }}"
                            class="relative group py-2 text-white font-bold transition-colors duration-300 hover:text-amber-300 {{ request()->is('/') ? 'text-amber-300' : '' }}">
                            Beranda
                            <span
                                class="absolute left-0 bottom-0 w-0 h-0.5 bg-amber-300 transition-all duration-300 group-hover:w-full {{ request()->is('/') ? 'w-full' : '' }}"></span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('profile') }}"
                            class="relative group py-2 text-white font-bold transition-colors duration-300 hover:text-amber-300 {{ request()->is('profil') ? 'text-amber-300' : '' }}">
                            Profil Kami
                            <span
                                class="absolute left-0 bottom-0 w-0 h-0.5 bg-amber-300 transition-all duration-300 group-hover:w-full {{ request()->is('profil') ? 'w-full' : '' }}"></span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('datapupuk') }}"
                            class="relative group py-2 text-white font-bold transition-colors duration-300 hover:text-amber-300 {{ request()->is('data-pupuk') ? 'text-amber-300' : '' }}">
                            Data Pupuk
                            <span
                                class="absolute left-0 bottom-0 w-0 h-0.5 bg-amber-300 transition-all duration-300 group-hover:w-full {{ request()->is('data-pupuk') ? 'w-full' : '' }}"></span>
                        </a>
                    </li>

                    <!-- Dropdown: Panduan Budidaya -->
                    <li class="relative" x-data="{ open: false }">
                        <button @click="open = !open" @click.outside="open = false"
                            class="flex items-center justify-between w-full py-2 text-white font-bold transition-colors duration-300 hover:text-amber-300 md:w-auto group">
                            Panduan Budidaya
                            <span
                                class="absolute left-0 bottom-0 w-0 h-0.5 bg-amber-300 transition-all duration-300 group-hover:w-full"
                                :class="open ? 'w-full' : ''"></span>
                            <svg :class="{ 'rotate-180': open }" class="w-4 h-4 ms-1.5 transition-transform duration-300"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m19 9-7 7-7-7" />
                            </svg>
                        </button>

                        <div x-show="open" x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 -translate-y-2"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 -translate-y-2"
                            class="relative md:absolute left-0 md:left-1/2 md:-translate-x-1/2 mt-4 w-full md:w-64 bg-emerald-600/95 backdrop-blur-xl border border-emerald-500/30 rounded-2xl shadow-2xl shadow-emerald-900/20 z-20 overflow-hidden">
                            <ul class="p-2 text-sm font-medium text-white">
                                <li><a href="{{ route('edukasi.bibit') }}"
                                        class="block p-3 rounded-xl hover:bg-emerald-500/50 hover:text-amber-300 transition-all duration-300">Tips
                                        Pemilihan Bibit</a></li>
                                <li><a href="{{ route('edukasi.lahan') }}"
                                        class="block p-3 rounded-xl hover:bg-emerald-500/50 hover:text-amber-300 transition-all duration-300">Tips
                                        Pengolahan Lahan</a></li>
                                <li><a href="{{ route('edukasi.pemupukan') }}"
                                        class="block p-3 rounded-xl hover:bg-emerald-500/50 hover:text-amber-300 transition-all duration-300">Tips
                                        Pemupukan</a></li>
                                <li><a href="{{ route('edukasi.cek_tanah') }}"
                                        class="block p-3 rounded-xl hover:bg-emerald-500/50 hover:text-amber-300 transition-all duration-300">Cek
                                        Tanah Tanpa Alat</a></li>
                                <li><a href="{{ route('edukasi.irigasi') }}"
                                        class="block p-3 rounded-xl hover:bg-emerald-500/50 hover:text-amber-300 transition-all duration-300">Irigasi
                                        Efisien</a></li>
                            </ul>
                        </div>
                    </li>

                    <li>
                        <a href="{{ url('/simulasi') }}"
                            class="relative group py-2 text-white font-bold transition-colors duration-300 hover:text-amber-300 {{ request()->is('simulasi') ? 'text-amber-300' : '' }}">
                            Simulasi Panen
                            <span
                                class="absolute left-0 bottom-0 w-0 h-0.5 bg-amber-300 transition-all duration-300 group-hover:w-full {{ request()->is('simulasi') ? 'w-full' : '' }}"></span>
                        </a>
                    </li>

                    <li>
                        <a href="{{ url('/berita') }}"
                            class="relative group py-2 text-white font-bold transition-colors duration-300 hover:text-amber-300 {{ request()->is('berita') ? 'text-amber-300' : '' }}">
                            Berita
                            <span
                                class="absolute left-0 bottom-0 w-0 h-0.5 bg-amber-300 transition-all duration-300 group-hover:w-full {{ request()->is('berita') ? 'w-full' : '' }}"></span>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</div>
