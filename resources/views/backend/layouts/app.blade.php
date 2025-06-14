<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{
    isSidebarOpen: window.innerWidth > 900,
    darkMode: localStorage.getItem('darkMode') || 'system',
    updateSidebarState() {
        this.isSidebarOpen = window.innerWidth > 900;
    }
}" x-init="window.addEventListener('resize', updateSidebarState);
$watch('darkMode', value => localStorage.setItem('darkMode', value));"
    :class="{
        'dark': darkMode === 'dark' || (darkMode === 'system' && window.matchMedia('(prefers-color-scheme: dark)')
            .matches)
    }">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Styles -->
    @livewireStyles

</head>

<body class="font-sans bg-gray-50 dark:bg-gray-900 antialiased">
    <div>
        <x-layout.navbar />
        <x-layout.sidebar />
        <x-admin.noti-message />

        <div x-data>
            <main
                :class="{ 'ml-0': !$store.sidebar.isSidebarOpen, 'lg:ml-64 md:ml-0 sm:ml-0': $store.sidebar.isSidebarOpen }"
                class="p-4 h-auto pt-20 transition-all duration-700 ease-in-out ">
                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('modals')
    @livewireScripts
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.store('sidebar', {
                isSidebarOpen: JSON.parse(localStorage.getItem('isSidebarOpen')) ?? (window.innerWidth >
                    900),
                toggle() {
                    this.isSidebarOpen = !this.isSidebarOpen;
                    localStorage.setItem('isSidebarOpen', this.isSidebarOpen);
                },
                close() {
                    this.isSidebarOpen = false;
                    localStorage.setItem('isSidebarOpen', false);
                },
                open() {
                    this.isSidebarOpen = true;
                    localStorage.setItem('isSidebarOpen', true);
                },
                init() {
                    window.addEventListener('resize', () => {
                        if (window.innerWidth > 900) {
                            this.isSidebarOpen = true;
                            localStorage.setItem('isSidebarOpen', true);
                        }
                    });
                }
            });

            document.addEventListener('livewire:navigated', () => {
                Alpine.store('sidebar').isSidebarOpen = JSON.parse(localStorage.getItem('isSidebarOpen')) ??
                    (window.innerWidth > 900);

                document.documentElement.classList.toggle('dark', localStorage.getItem('darkMode') ===
                    'dark' ||
                    (localStorage.getItem('darkMode') === 'system' && window.matchMedia(
                        '(prefers-color-scheme: dark)').matches));
            });
        });
    </script>
    <script>
        Livewire.on('navigate', (url) => {
            window.Livewire.navigate(url);
        });
    </script>

    {{-- <script>
        document.addEventListener('livewire:navigate', event => {
            window.history.pushState({}, '', event.detail.url);
            window.dispatchEvent(new PopStateEvent('popstate'));
        });
    </script> --}}


</body>

</html>
