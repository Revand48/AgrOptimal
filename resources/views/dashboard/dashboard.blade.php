@extends('layouts.hal_admin')

@section('content')
    <div class="space-y-8" x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)">
        <!-- Header Section with Gradient & Pattern -->
        <div class="relative overflow-hidden bg-gradient-to-br from-[#2e7d32] to-emerald-600 rounded-[2rem] p-8 shadow-lg shadow-emerald-900/20 text-white transition-all duration-700 transform"
            :class="show ? 'translate-y-0 opacity-100' : '-translate-y-4 opacity-0'">

            <!-- Decorative Background Elements -->
            <div class="absolute top-0 right-0 -mt-10 -mr-10 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -mb-10 -ml-10 w-40 h-40 bg-yellow-400/20 rounded-full blur-2xl"></div>

            <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="text-3xl font-black tracking-tight">Dashboard Admin</h2>
                    <p class="text-emerald-100 mt-2 text-lg font-medium">
                        Selamat Datang, <span class="text-[#f4b400] font-bold">{{ Auth::user()->name ?? 'Admin' }}</span>!
                    </p>
                    <p class="text-sm text-emerald-200/80 mt-1">
                        Pantau perkembangan pertanian dan data terkini dalam satu tampilan.
                    </p>
                </div>
                <div class="text-right bg-white/10 backdrop-blur-sm px-6 py-3 rounded-2xl border border-white/20">
                    <p class="text-xl font-bold text-white" id="real-time-clock">
                        {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y | H:i:s') }}
                    </p>
                    <div class="flex items-center justify-end gap-2 mt-1 text-emerald-100 text-xs">
                        <div class="w-2 h-2 bg-[#f4b400] rounded-full animate-pulse"></div>
                        Update: {{ $lastUpdateString ?? 'Baru saja' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Pengaduan -->
            <div class="bg-white p-6 rounded-[2rem] border border-emerald-50 shadow-sm hover:shadow-xl hover:shadow-emerald-100/50 transition-all duration-300 group hover:-translate-y-1"
                :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'" style="transition-delay: 100ms;">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="p-3 bg-orange-50 rounded-2xl text-orange-500 group-hover:bg-orange-500 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <span
                        class="text-xs font-bold uppercase tracking-wider text-gray-400 bg-gray-50 px-2 py-1 rounded-lg">Laporan</span>
                </div>
                <div>
                    <p class="text-3xl font-black text-gray-800 group-hover:text-orange-500 transition-colors">
                        {{ number_format($countPengaduan) }}</p>
                    <p class="text-sm font-medium text-gray-500 mt-1">Total Pengaduan Masuk</p>
                </div>
            </div>

            <!-- Komoditas -->
            <div class="bg-white p-6 rounded-[2rem] border border-emerald-50 shadow-sm hover:shadow-xl hover:shadow-emerald-100/50 transition-all duration-300 group hover:-translate-y-1"
                :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'" style="transition-delay: 200ms;">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="p-3 bg-emerald-50 rounded-2xl text-emerald-600 group-hover:bg-emerald-600 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3">
                            </path>
                        </svg>
                    </div>
                    <span
                        class="text-xs font-bold uppercase tracking-wider text-gray-400 bg-gray-50 px-2 py-1 rounded-lg">Data</span>
                </div>
                <div>
                    <p class="text-3xl font-black text-gray-800 group-hover:text-emerald-600 transition-colors">
                        {{ number_format($countKomoditas) }}</p>
                    <p class="text-sm font-medium text-gray-500 mt-1">Komoditas Aktif</p>
                </div>
            </div>

            <!-- Pupuk -->
            <div class="bg-white p-6 rounded-[2rem] border border-emerald-50 shadow-sm hover:shadow-xl hover:shadow-emerald-100/50 transition-all duration-300 group hover:-translate-y-1"
                :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'" style="transition-delay: 300ms;">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="p-3 bg-blue-50 rounded-2xl text-blue-500 group-hover:bg-blue-500 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19.428 15.428a2 2 0 00-1.022-.547l-2.384-.477a6 6 0 00-3.86.517l-.318.158a6 6 0 01-3.86.517L6.05 15.21a2 2 0 00-1.806.547M8 4h8l-1 1v5.172a2 2 0 00.586 1.414l5 5c1.26 1.26.367 3.414-1.415 3.414H4.828c-1.782 0-2.674-2.154-1.414-3.414l5-5A2 2 0 009 10.172V5L8 4z">
                            </path>
                        </svg>
                    </div>
                    <span
                        class="text-xs font-bold uppercase tracking-wider text-gray-400 bg-gray-50 px-2 py-1 rounded-lg">Stok</span>
                </div>
                <div>
                    <p class="text-3xl font-black text-gray-800 group-hover:text-blue-500 transition-colors">
                        {{ number_format($countPupuk) }}</p>
                    <p class="text-sm font-medium text-gray-500 mt-1">Jenis Pupuk Terdaftar</p>
                </div>
            </div>

            <!-- Simulasi -->
            <div class="bg-white p-6 rounded-[2rem] border border-emerald-50 shadow-sm hover:shadow-xl hover:shadow-emerald-100/50 transition-all duration-300 group hover:-translate-y-1"
                :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'" style="transition-delay: 400ms;">
                <div class="flex items-center justify-between mb-4">
                    <div
                        class="p-3 bg-purple-50 rounded-2xl text-purple-500 group-hover:bg-purple-500 group-hover:text-white transition-colors duration-300">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z">
                            </path>
                        </svg>
                    </div>
                    <span
                        class="text-xs font-bold uppercase tracking-wider text-gray-400 bg-gray-50 px-2 py-1 rounded-lg">Aktivitas</span>
                </div>
                <div>
                    <p class="text-3xl font-black text-gray-800 group-hover:text-purple-500 transition-colors">
                        {{ number_format($countSimulasi) }}</p>
                    <p class="text-sm font-medium text-gray-500 mt-1">Total Simulasi User</p>
                </div>
            </div>
        </div>

        <!-- Charts Area -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8"
            :class="show ? 'opacity-100 translate-y-0' : 'opacity-0 translate-y-4'" style="transition-delay: 500ms;">

            <!-- Komoditas Price Chart -->
            <div
                class="bg-white p-8 rounded-[2.5rem] shadow-lg shadow-slate-200/50 border border-slate-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-full -mr-8 -mt-8 opacity-50"></div>
                <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-2 h-8 bg-emerald-500 rounded-full"></span>
                    Harga Pasaran Komoditas
                    <span
                        class="text-xs font-normal text-slate-400 ml-auto bg-slate-50 px-3 py-1 rounded-full border border-slate-100">Per
                        Kg</span>
                </h3>
                <div id="chartKomoditasPrices" class="w-full"></div>
            </div>

            <!-- Pupuk Stock Chart -->
            <div
                class="bg-white p-8 rounded-[2.5rem] shadow-lg shadow-slate-200/50 border border-slate-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -mr-8 -mt-8 opacity-50"></div>
                <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-2 h-8 bg-blue-500 rounded-full"></span>
                    Estimasi Stok Pupuk
                    <span
                        class="text-xs font-normal text-slate-400 ml-auto bg-slate-50 px-3 py-1 rounded-full border border-slate-100">Total
                        Kg</span>
                </h3>
                <div id="chartPupukStock" class="w-full"></div>
            </div>

            <!-- Pengaduan Status Chart -->
            <div
                class="bg-white p-8 rounded-[2.5rem] shadow-lg shadow-slate-200/50 border border-slate-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-orange-50 rounded-bl-full -mr-8 -mt-8 opacity-50"></div>
                <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-2 h-8 bg-orange-500 rounded-full"></span>
                    Status Pengaduan
                </h3>
                <div id="chartPengaduanStatus" class="w-full"></div>
            </div>

            <!-- Pengaduan Kategori Chart -->
            <div
                class="bg-white p-8 rounded-[2.5rem] shadow-lg shadow-slate-200/50 border border-slate-100 relative overflow-hidden">
                <div class="absolute top-0 right-0 w-32 h-32 bg-purple-50 rounded-bl-full -mr-8 -mt-8 opacity-50"></div>
                <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-2 h-8 bg-purple-500 rounded-full"></span>
                    Kategori Pengaduan
                </h3>
                <div id="chartPengaduanKategori" class="w-full"></div>
            </div>
        </div>
    </div>

    <!-- ApexCharts -->
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Live Clock Function
            function updateClock() {
                const now = new Date();
                const options = {
                    weekday: 'long',
                    day: '2-digit',
                    month: 'long',
                    year: 'numeric',
                    hour: '2-digit',
                    minute: '2-digit',
                    second: '2-digit',
                    hour12: false
                };

                // Format with ID locale for Indonesian names
                const formatted = new Intl.DateTimeFormat('id-ID', options).format(now);
                document.getElementById('real-time-clock').textContent = formatted.replace(/\./g, ':');
            }
            setInterval(updateClock, 1000);
            updateClock();

            // 1. Komoditas Prices Bar Chart
            var komoditasData = @json($komoditasPrices);
            var optionsKomoditas = {
                series: [{
                    name: 'Harga (Rp)',
                    data: komoditasData.map(item => parseInt(item.price_per_kg))
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        horizontal: true,
                    }
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: komoditasData.map(item => item.nama),
                },
                colors: ['#10B981'], // Emerald-500
            };
            var chartKomoditas = new ApexCharts(document.querySelector("#chartKomoditasPrices"), optionsKomoditas);
            chartKomoditas.render();

            // 2. Pupuk Stock Pie Chart
            var pupukData = @json($pupukStocks);
            var optionsPupuk = {
                series: pupukData.map(item => item.total_kg),
                chart: {
                    type: 'pie',
                    height: 350
                },
                labels: pupukData.map(item => item.nama),
                colors: ['#3B82F6', '#10B981', '#F59E0B', '#EF4444', '#8B5CF6'], // Tailwind colors
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            };
            var chartPupuk = new ApexCharts(document.querySelector("#chartPupukStock"), optionsPupuk);
            chartPupuk.render();

            // 3. Pengaduan Status Donut Chart
            var pengaduanStatusData = @json($pengaduanStatus);
            var optionsPengaduanStatus = {
                series: pengaduanStatusData.map(item => item.total),
                chart: {
                    type: 'donut',
                    height: 350
                },
                labels: pengaduanStatusData.map(item => item.status.charAt(0).toUpperCase() + item.status.slice(
                    1)),
                colors: ['#F59E0B', '#10B981', '#3B82F6'], // Adjust based on statuses
                plotOptions: {
                    pie: {
                        donut: {
                            labels: {
                                show: true,
                                total: {
                                    show: true,
                                    label: 'Total',
                                    formatter: function(w) {
                                        return w.globals.seriesTotals.reduce((a, b) => a + b, 0)
                                    }
                                }
                            }
                        }
                    }
                }
            };
            var chartPengaduanStatus = new ApexCharts(document.querySelector("#chartPengaduanStatus"),
                optionsPengaduanStatus);
            chartPengaduanStatus.render();

            // 4. Pengaduan Kategori Bar Chart (Vertical)
            var pengaduanKategoriData = @json($pengaduanKategori);
            var optionsPengaduanKategori = {
                series: [{
                    name: 'Jumlah',
                    data: pengaduanKategoriData.map(item => item.total)
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: {
                        show: false
                    }
                },
                plotOptions: {
                    bar: {
                        borderRadius: 4,
                        columnWidth: '50%',
                    }
                },
                dataLabels: {
                    enabled: false
                },
                xaxis: {
                    categories: pengaduanKategoriData.map(item => item.kategori),
                    labels: {
                        style: {
                            fontSize: '12px'
                        }
                    }
                },
                colors: ['#F97316'], // Orange-500
            };
            var chartPengaduanKategori = new ApexCharts(document.querySelector("#chartPengaduanKategori"),
                optionsPengaduanKategori);
            chartPengaduanKategori.render();

        });
    </script>
@endsection
