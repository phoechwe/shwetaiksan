<header class="bg-gray-800 shadow-lg">
    <nav class="container mx-auto px-6 py-4 flex justify-between items-center">
        <!-- Logo -->
        <div>
            <a href="/" class="text-2xl font-bold text-white hover:text-blue-500 transition duration-300">
                ImpactTech
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="hidden md:flex space-x-8">
            <a href="/" wire:navigate class="text-gray-300 hover:text-white transition duration-300">Home</a>
            <a href="{{route('about')}}" wire:navigate class="text-gray-300 hover:text-white transition duration-300">About</a>
            <a href="{{ route('service')}}" wire:navigate class="text-gray-300 hover:text-white transition duration-300">Services</a>
            <a href="{{ route('contact')}}" wire:navigate class="text-gray-300 hover:text-white transition duration-300">Contact</a>
        </div>

        <!-- Dark Mode Toggle -->
        <div class="flex items-center">
            <button @click="darkMode = darkMode === 'dark' ? 'light' : 'dark'"
                class="text-gray-300 hover:text-white transition duration-300">
                <i x-bind:class="darkMode === 'dark' ? 'fas fa-sun' : 'fas fa-moon'" class="fas fa-moon"></i>
            </button>
        </div>
    </nav>
</header>