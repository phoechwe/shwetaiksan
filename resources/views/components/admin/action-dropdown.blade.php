<div x-data="{ open: false }" class="relative">
    <!-- Dropdown Toggle -->
    <button @click="open = !open"
        class="inline-flex items-center px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
        <i class="fa-solid fa-ellipsis-vertical"></i>
    </button>

    <!-- Dropdown Menu -->
    <div x-show="open" @click.away="open = false"
        x-transition:enter="transition transform duration-300 ease-out"
        x-transition:enter-start="opacity-0 translate-y-2"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition transform duration-300 ease-in"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-2"
        class="absolute z-10 bg-white overflow-hidden divide-y ml-5 divide-gray-100 rounded-lg shadow dark:bg-gray-700">
        <ul class="text-sm text-gray-700 dark:text-gray-200">
            {{ $slot }}
        </ul>
    </div>
</div>
