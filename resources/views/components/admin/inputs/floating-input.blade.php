@props([
    'disabled' => false,
    'id' => 'floating_outlined',
    'label' => 'Floating Label',
    'error' => false, // Set true to indicate an error
    'errorMessage' => null, // Error message text
])

<div class="py-3">
    <div class="relative">
        <input 
            {{ $disabled ? 'disabled' : '' }}
            {!! $attributes->merge([
                'id' => $id,
                'class' =>
                    'block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-900 bg-transparent rounded-lg border-1 appearance-none dark:text-white ' .
                    ($error
                        ? 'border-red-600 dark:border-red-500 focus:border-red-600 dark:focus:border-red-500'
                        : 'border-gray-300 dark:border-gray-600 focus:border-blue-600 dark:focus:border-blue-500') .
                    ' focus:outline-none focus:ring-0 peer',
            ]) !!}
            placeholder=" "
        />
        <label 
            for="{{ $id }}" 
            class="absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-4 scale-75 top-2 z-10 origin-[0] bg-white dark:bg-gray-800 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-1/2 peer-focus:top-2 peer-focus:scale-75 peer-focus:-translate-y-4 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto start-1 ' .
            ($error ? 'text-red-600 dark:text-red-500' : 'text-gray-500 dark:text-gray-400 peer-focus:text-blue-600 dark:peer-focus:text-blue-500')"
        >
            {{ $label }}
        </label>
    </div>
    @if ($error && $errorMessage)
        <p class="mt-2 text-xs text-red-600 dark:text-red-400">{{ $errorMessage }}</p>
    @endif
</div>
