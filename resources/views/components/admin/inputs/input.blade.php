@props(['disabled' => false, 'error' => false])

{{-- A single input --}}

<input
    {{ $disabled ? 'disabled' : '' }}
    {!! $attributes->merge([
        'class' =>
            'bg-gray-50 border text-gray-900 sm:text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 ' .
            ($error ? 'border-red-500 focus:ring-red-500 dark:border-red-500 focus:border-red-500' : 'border-gray-300 focus:ring-primary-500 focus:border-primary-500') .
            ' dark:bg-gray-700 dark:border-gray-400 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500',
    ]) !!}
>
