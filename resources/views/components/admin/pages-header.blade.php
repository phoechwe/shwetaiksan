@props([
    'title' => 'Page Title', // Default title if not provided
    'breadcrumbs' => [], // Array of breadcrumbs
    'permission' => false, // Control button visibility
    'route' => '#',
])

<!-- Breadcrumb -->
<div class="flex items-center gap-4">
    <ol class="flex flex-wrap items-center gap-1 text-gray-600 dark:text-gray-300">
        <li class="flex items-center gap-1">
            <a href="{{ route('admin.dashboard') }}" wire:navigate
                class="hover:text-gray-900 dark:hover:text-white">Dashboard</a>
            @if (count($breadcrumbs) > 0)
                <svg xmlns="http://www.w3.org/2000/svg" class="size-4 dark:text-white" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                </svg>
            @endif
        </li>

        @foreach ($breadcrumbs as $breadcrumb)
            <li class="flex items-center gap-1">
                @if (isset($breadcrumb['url']))
                    <a href="{{ $breadcrumb['url'] }}" wire:navigate
                        class="hover:text-gray-900 dark:hover:text-white">{{ $breadcrumb['label'] }}</a>
                @else
                    <span class="text-gray-900 dark:text-white">{{ $breadcrumb['label'] }}</span>
                @endif
                @if (!$loop->last)
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4 dark:text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
                    </svg>
                @endif
            </li>
        @endforeach
    </ol>
</div>

<!-- Page Title & Create Button -->
<div class="pb-6 flex flex-wrap items-center justify-between">
    <h2 class="text-xl font-semibold text-gray-800 dark:text-white">{{ $title }}</h2>

    {{-- @can($permission) --}}
    @if ($permission)
        <x-admin.inputs.button-primary type="button" href="{{ $route }}" wire:navigate>
            <i class="fa-solid fa-user-plus mr-2"></i>{{ __('Create') }}
        </x-admin.inputs.button-primary>
    @endif
    {{-- @endcan --}}
</div>
