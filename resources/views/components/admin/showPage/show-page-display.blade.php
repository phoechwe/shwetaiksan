<div>

<div class="bg-white shadow-md rounded-lg p-6 dark:bg-gray-700 dark:text-white">
    <div class="flex justify-center">
        <div class="w-full space-y-6">
            <div class="grid lg:grid-cols-2 md:grid-cols-1 gap-6">
                {{ $slot}}
            </div>
        </div>
    </div>

</div>

<div class="mt-6">
    {{ $button }}
</div>

</div>
