@props(['id', 'icon', 'label' => 'Menu', 'active' => false])

<li>
    <div x-data="{ isExpanded: {{ $active ? 'true' : 'false' }} }" class="flex flex-col">
        <!-- Button to Toggle Collapse -->
        <button type="button" x-on:click="isExpanded = ! isExpanded" id="dropdown-{{ $id }}-btn"
                aria-controls="dropdown-{{ $id }}"
                x-bind:aria-expanded="isExpanded ? 'true' : 'false'"
                class="flex items-center rounded-md gap-2 hover:shadow-lg px-8 py-3 transition-transform transform hover:scale-105 duration-300 text-sm font-medium focus:outline-none focus-visible:underline
                {{ $active ? 'text-neutral-900 dark:text-white ' : 'text-neutral-600 hover:bg-black/5 hover:text-neutral-900 dark:text-neutral-300 dark:hover:text-white dark:hover:bg-white/5' }}
                 ">
            <!-- Icon -->
            <i class="{{ $icon }} text-gray-500 dark:text-gray-400"></i>

            <!-- Label -->
            <span class="mr-auto text-left">{{ __($label) }}</span>

            <!-- Arrow Icon -->
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5 transition-transform rotate-0 shrink-0"
                x-bind:class="isExpanded ? 'rotate-180' : 'rotate-0'" aria-hidden="true">
                <path fill-rule="evenodd"
                    d="M5.22 8.22a.75.75 0 0 1 1.06 0L10 11.94l3.72-3.72a.75.75 0 1 1 1.06 1.06l-4.25 4.25a.75.75 0 0 1-1.06 0L5.22 9.28a.75.75 0 0 1 0-1.06Z"
                    clip-rule="evenodd" />
            </svg>
        </button>

        <!-- Collapsible Menu Items -->
        <ul x-cloak x-collapse x-show="isExpanded" aria-labelledby="dropdown-{{ $id }}-btn" id="dropdown-{{ $id }}">
            {{ $slot }}
        </ul>
    </div>
</li>
