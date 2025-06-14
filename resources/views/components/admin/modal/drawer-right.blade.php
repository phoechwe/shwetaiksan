<!-- drawer component -->
@props(['submit'])

<div id="drawer-right"
    class="fixed top-14 right-0 z-40 h-screen p-4 overflow-y-auto transition-transform duration-500 translate-x-full bg-white w-80 dark:bg-gray-800"
    tabindex="-1" aria-labelledby="drawer-right-label">
    <h5 id="drawer-right-label" class="inline-flex items-center mb-4 text-base font-semibold text-gray-500 dark:text-gray-400">
        <i class="fa-solid fa-circle-info"></i>
        <div class="text-lg font-medium ">
            {{ $title }}
        </div>
    </h5>
    
    <button type="button" data-drawer-hide="drawer-right" aria-controls="drawer-right"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white">
        <i class="fa-solid fa-xmark"></i>
        <span class="sr-only">Close menu</span>
    </button>


    <div class="">
        <form wire:submit.prevent="{{ $submit }}">
            <div class="">
                {{ $form }}
            </div>

            @if (isset($actions))
                <div class="">
                    {{ $actions }}
                </div>
            @endif
        </form>
    </div>
   
</div>
