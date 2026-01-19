<header
    class="bg-white dark:bg-gray-900 border-b border-gray-100 dark:border-gray-800 px-8 py-5 flex justify-between items-center transition-colors duration-300">

    <div class="flex items-center gap-3">
        <div class="flex flex-col">
            <h1 class="text-xl font-bold text-gray-800 dark:text-white tracking-tight leading-none">
                {{ $header ?? 'Dashboard' }}
            </h1>
            <span class="text-xs text-emerald-600 dark:text-emerald-400 font-medium mt-1">
                Admin Panel
            </span>
        </div>
    </div>

    <div class="flex items-center gap-4">

        <div class="hidden md:block text-right">
            <p class="text-sm font-semibold text-gray-700 dark:text-gray-200">
                {{ auth()->user()->name ?? 'Admin' }}
            </p>
            <p class="text-[10px] uppercase tracking-wider text-gray-400 font-medium">
                Administrator
            </p>
        </div>

        <div
            class="h-10 w-10 rounded-full bg-gray-50 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 flex items-center justify-center text-gray-500 hover:text-emerald-600 dark:text-gray-400 dark:hover:text-emerald-400 transition-colors duration-200 cursor-pointer">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
        </div>

    </div>
</header>
