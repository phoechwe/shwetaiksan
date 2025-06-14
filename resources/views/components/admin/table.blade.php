<!-- Table Component -->
<div class="shadow-md bg-white dark:bg-gray-800 overflow-visible relative">
    <div class="lg:overflow-visible md:overflow-visible sm:overflow-x-auto">
        <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">

            <!-- Header Slot (thead) -->
            <thead class="bg-gray-100 dark:bg-gray-900 text-gray-700 dark:text-gray-300 uppercase">
                {{ $header }}
            </thead>

            <!-- Body Slot (tbody) -->
            <tbody class="divide-y divide-gray-200 dark:divide-gray-700 bg-white dark:bg-gray-800">
                {{ $body }}
            </tbody>
        </table>
    </div>

    <!-- Loading Overlay -->
    <div wire:loading wire:target="search, gotoPage, previousPage, nextPage ,filterDate"
        class="absolute inset-0 dark:bg-gray-900 bg-gray-200 transition bg-opacity-50 dark:bg-opacity-50 flex justify-center items-center">
        <div class="flex flex-col items-center h-screen">
            <div class="flex space-x-2 mt-40">
                <div class="w-2 h-2 bg-primary-700 rounded-full animate-bounce"></div>
                <div class="w-2 h-2 bg-primary-700 rounded-full animate-bounce [animation-delay:-0.2s]"></div>
                <div class="w-2 h-2 bg-primary-700 rounded-full animate-bounce [animation-delay:-0.4s]"></div>
            </div>

            <!-- Loading Text -->
            <span class="text-black text-lg font-semibold mt-4">Loading...</span>
        </div>
    </div>

</div>
