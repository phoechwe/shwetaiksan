@if(session('message'))
    <div x-data="{ show: true }"
        x-show="show" 
        x-init="setTimeout(() => show = false, 3000)" 
        x-transition:enter="transition ease-out duration-300 transform"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300 transform"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-4"
        class="fixed top-4 right-4 p-2 rounded-2xl shadow-lg flex items-center space-x-2 z-50"
        :class="{
            'bg-green-600 text-white': '{{ session('type') }}' === 'success',
            'bg-orange-500 text-white': '{{ session('type') }}' === 'warning',
            'bg-red-500 text-white': '{{ session('type') }}' === 'error'
        }">
        
        <template x-if="'{{ session('type') }}' === 'success'">
            <i class="fa-solid fa-check-circle text-xl"></i>
        </template>
        <template x-if="'{{ session('type') }}' === 'warning'">
            <i class="fa-solid fa-exclamation-circle text-xl"></i>
        </template>
        <template x-if="'{{ session('type') }}' === 'error'">
            <i class="fa-solid fa-times-circle text-xl"></i>
        </template>
        
        <span>{{ session('message') }}</span>
        
        <button type="button" 
            class="ml-auto p-2 rounded-full text-white transition duration-300 ease-in-out 
                hover:bg-white/20 focus:outline-none focus:ring-2 focus:ring-white focus:ring-opacity-50"
            x-on:click="show = false">
            <i class="fa-solid fa-times"></i>
        </button>
    </div>
@endif
