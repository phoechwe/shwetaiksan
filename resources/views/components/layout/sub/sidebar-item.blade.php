@props(['label', 'icon', 'route', 'active' => false])

<li>
    <a href="{{ $route }}" wire:navigate
    class="flex items-center rounded-md gap-2 hover:shadow-lg px-8 py-3 transition-transform transform hover:scale-105 duration-300 text-sm font-medium focus:outline-none focus-visible:underline
    {{ $active ? 'bg-black/10 text-neutral-900 dark:bg-white/10 dark:text-white shadow-lg' : 'text-neutral-600 hover:bg-black/5 hover:text-neutral-900 dark:text-neutral-300 dark:hover:text-white dark:hover:bg-white/5 ' }}">
     <i class="{{ $icon }} text-gray-500 dark:text-gray-400"></i>
     <span>{{ $label }}</span>
 </a>
</li>
