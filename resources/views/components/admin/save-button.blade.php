@props(['function' , 'text' => 'Save'])
<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'px-5 py-2 text-base font-medium text-center text-white bg-primary-700 rounded-lg relative focus:ring-4 focus:ring-primary-300 sm:w-auto dark:bg-primary-600 dark:focus:ring-primary-800 disabled:bg-primary-300 disabled:text-white  dark:disabled:bg-primary-400 disabled:cursor-progress']) }}
    wire:loading.attr="disabled">
    <!-- Loading Spinner -->
        <i class="fa-solid fa-arrows-rotate animate-spin" wire:loading wire:target="{{ $function }}"></i>

    <!-- Default Icon -->
    <i class="fa-solid fa-paper-plane" wire:loading.remove></i>

    {{$text}}
</button>
