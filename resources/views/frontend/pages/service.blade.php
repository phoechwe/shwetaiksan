    <!-- Services Page Content -->
    <main class="container mx-auto px-4 py-12">
        <div class="text-center">
            <h1 class="text-6xl font-bold mb-8 animate-fade-in-down">Our Services</h1>
            <p class="text-xl mb-12 max-w-2xl mx-auto animate-fade-in-up">
                At OneForAll, we offer a wide range of software solutions tailored to meet your business needs. From custom software development to cloud solutions, we've got you covered.
            </p>
        </div>

        <!-- Services Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service 1: Custom Software Development -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:scale-105 transition-transform animate-fade-in-left">
                <div class="text-center">
                    <i class="fas fa-code text-4xl text-blue-500 mb-4"></i>
                    <h3 class="text-2xl font-bold mb-4">Custom Software Development</h3>
                    <p class="text-gray-300">
                        We build tailor-made software solutions designed to address your unique business challenges and streamline your operations.
                    </p>
                </div>
            </div>

            <!-- Service 2: Web Development -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:scale-105 transition-transform animate-fade-in-up">
                <div class="text-center">
                    <i class="fas fa-globe text-4xl text-blue-500 mb-4"></i>
                    <h3 class="text-2xl font-bold mb-4">Web Development</h3>
                    <p class="text-gray-300">
                        From responsive websites to complex web applications, we create digital experiences that engage and convert.
                    </p>
                </div>
            </div>

            <!-- Service 3: Mobile App Development -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:scale-105 transition-transform animate-fade-in-right">
                <div class="text-center">
                    <i class="fas fa-mobile-alt text-4xl text-blue-500 mb-4"></i>
                    <h3 class="text-2xl font-bold mb-4">Mobile App Development</h3>
                    <p class="text-gray-300">
                        We develop high-performance mobile apps for iOS and Android that deliver seamless user experiences.
                    </p>
                </div>
            </div>

            <!-- Service 4: Cloud Solutions -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:scale-105 transition-transform animate-fade-in-left">
                <div class="text-center">
                    <i class="fas fa-cloud text-4xl text-blue-500 mb-4"></i>
                    <h3 class="text-2xl font-bold mb-4">Cloud Solutions</h3>
                    <p class="text-gray-300">
                        Harness the power of the cloud with our scalable and secure cloud infrastructure solutions.
                    </p>
                </div>
            </div>

            <!-- Service 5: UI/UX Design -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:scale-105 transition-transform animate-fade-in-up">
                <div class="text-center">
                    <i class="fas fa-palette text-4xl text-blue-500 mb-4"></i>
                    <h3 class="text-2xl font-bold mb-4">UI/UX Design</h3>
                    <p class="text-gray-300">
                        We design intuitive and visually appealing interfaces that enhance user engagement and satisfaction.
                    </p>
                </div>
            </div>

            <!-- Service 6: IT Consulting -->
            <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:scale-105 transition-transform animate-fade-in-right">
                <div class="text-center">
                    <i class="fas fa-chart-line text-4xl text-blue-500 mb-4"></i>
                    <h3 class="text-2xl font-bold mb-4">IT Consulting</h3>
                    <p class="text-gray-300">
                        Our experts provide strategic IT consulting to help you align technology with your business goals.
                    </p>
                </div>
            </div>
        </div>

        <!-- Call to Action -->
        <div class="mt-20 text-center">
            <h2 class="text-4xl font-bold mb-8 animate-fade-in-down">Ready to Transform Your Business?</h2>
            <p class="text-xl mb-8 max-w-2xl mx-auto animate-fade-in-up">
                Let's work together to create innovative solutions that drive your business forward. Contact us today to get started!
            </p>
            <a href="#" class="bg-blue-600 px-8 py-3 rounded-lg text-white hover:bg-blue-700 transition duration-300 animate-fade-in-up">
                Get in Touch
            </a>
        </div>
    </main>
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('animations', () => ({
                init() {
                    this.animateElements();
                },
                animateElements() {
                    const elements = document.querySelectorAll('[class*="animate-"]');
                    elements.forEach((el, index) => {
                        setTimeout(() => {
                            el.classList.remove('opacity-0');
                        }, index * 200);
                    });
                }
            }));
        });
    </script>