<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{
    dark: localStorage.getItem('dark') === 'true',
    sidebarOpen: false
}" x-init="$watch('dark', val => localStorage.setItem('dark', val))"
    :class="{ 'dark': dark }" class="scroll-smooth">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? 'Admin - ' . config('app.name') }}</title>

    @vite('resources/css/app.css')

    <script src="https://cdn.tailwindcss.com/4"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <script>
        tailwind.config = {
            darkMode: 'class',
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

<body class="bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100">

    <div class="flex min-h-screen">

        {{-- Sidebar --}}
        @include('components.admin.sidebar')

        {{-- Overlay Mobile --}}
        <div x-show="sidebarOpen" x-transition.opacity @click="sidebarOpen=false"
            class="fixed inset-0 bg-black/40 z-30 md:hidden">
        </div>

        {{-- Content Area --}}
        <div class="flex-1 flex flex-col min-h-screen md:ml-72 transition-all duration-300">

            {{-- Topbar --}}
            <div class="sticky top-0 z-30">
                @include('components.admin.topbar')
            </div>

            <main class="flex-1 p-6 bg-white dark:bg-gray-900">
                @yield('content')
            </main>

        </div>
    </div>

</body>

</html>
