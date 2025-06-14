    <div class="font-sans antialiased bg-gray-900 text-white flex items-center justify-center h-screen">
        <!-- Page Content -->
        <main>
            <div class="text-center" x-data="{ countdown: { days: 0, hours: 0, minutes: 0, seconds: 0 } }" x-init="const targetDate = new Date('2023-12-31T23:59:59').getTime();
            setInterval(() => {
                const now = new Date().getTime();
                const distance = targetDate - now;
                countdown.days = Math.floor(distance / (1000 * 60 * 60 * 24));
                countdown.hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                countdown.minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                countdown.seconds = Math.floor((distance % (1000 * 60)) / 1000);
            }, 1000);">
                <!-- Company Logo -->
                <img src="https://placehold.co/150x150" alt="ImpactTech Logo"
                    class="mx-auto mb-6 rounded-full animate-pulse">

                <!-- Heading -->
                <h1 class="text-6xl font-bold mb-4 animate-bounce">ImpactTech</h1>
                <p class="text-xl mb-8">Empowering your world with unified solutions. Something incredible is on the way!
                </p>

                <!-- Countdown Timer -->
                <div class="flex justify-center space-x-4 mb-8">
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:scale-105 transition-transform">
                        <span class="text-4xl font-bold" x-text="countdown.days"></span>
                        <span class="text-sm">Days</span>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:scale-105 transition-transform">
                        <span class="text-4xl font-bold" x-text="countdown.hours"></span>
                        <span class="text-sm">Hours</span>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:scale-105 transition-transform">
                        <span class="text-4xl font-bold" x-text="countdown.minutes"></span>
                        <span class="text-sm">Minutes</span>
                    </div>
                    <div class="bg-gray-800 p-4 rounded-lg shadow-lg hover:scale-105 transition-transform">
                        <span class="text-4xl font-bold" x-text="countdown.seconds"></span>
                        <span class="text-sm">Seconds</span>
                    </div>
                </div>

                <!-- Subscribe Form -->
                <div class="max-w-md mx-auto">
                    <form class="flex items-center">
                        <input type="email"
                            class="flex-1 p-2 rounded-l-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="Enter your email">
                        <button type="submit"
                            class="bg-blue-600 p-2 rounded-r-lg hover:bg-blue-700 transition duration-300">Notify
                            Me</button>
                    </form>
                </div>

                <!-- Social Icons -->
                <div class="mt-8 flex justify-center space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <i class="fab fa-facebook fa-2x"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <i class="fab fa-twitter fa-2x"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <i class="fab fa-linkedin fa-2x"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                        <i class="fab fa-instagram fa-2x"></i>
                    </a>
                </div>
            </div>
        </main>
    </div>
