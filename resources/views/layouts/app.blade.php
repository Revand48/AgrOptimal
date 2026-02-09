<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ dark: localStorage.getItem('dark') === 'true' }" x-init="$watch('dark', val => localStorage.setItem('dark', val))"
    :class="{ 'dark': dark }" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? config('app.name') }}</title>
    <link rel="icon" href="{{ asset('img/core/logogo.webp') }}">
    @vite('resources/css/app.css')

    <!-- Tailwind CSS 4 (CDN) -->
    <script src="https://cdn.tailwindcss.com/4"></script>

    <!-- Alpine.js 3 -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Konfigurasi tambahan Tailwind (opsional) -->
    <script>
        tailwind.config = {
            darkMode: 'class', // kita pakai class strategy
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Inter', 'system-ui', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-[#d8ffe5] dark:bg-gray-900 text-gray-900 dark:text-gray-100">
    <!-- NAVBAR -->
    @include('components.header')

    <!-- KONTEN UTAMA -->
    <main class="min-h-[60vh]">
        @yield('content')
    </main>

    <!-- FOOTER -->
    <div class="relative z-130">
        @include('components.footer')
    </div>
</body>

</html>
