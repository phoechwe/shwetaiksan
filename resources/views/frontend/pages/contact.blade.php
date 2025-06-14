    <!-- Contact Page Content -->
    <main class="container mx-auto px-4 py-12">
        <!-- Hero Section -->
        <div class="text-center">
            <h1 class="text-6xl font-bold mb-8 animate-fade-in-down">Contact Us</h1>
            <p class="text-xl mb-12 max-w-2xl mx-auto animate-fade-in-up">
                Have a question or want to work with us? We'd love to hear from you! Reach out to us using the form below or through our contact information.
            </p>
        </div>

        <!-- Contact Form and Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Contact Form -->
            <div class="bg-gray-800 p-8 rounded-lg shadow-lg animate-fade-in-left">
                <h2 class="text-3xl font-bold mb-6">Send Us a Message</h2>
                <form>
                    <div class="mb-6">
                        <label for="name" class="block text-sm font-medium mb-2">Your Name</label>
                        <input type="text" id="name" name="name"
                            class="w-full p-3 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="John Doe" required>
                    </div>
                    <div class="mb-6">
                        <label for="email" class="block text-sm font-medium mb-2">Your Email</label>
                        <input type="email" id="email" name="email"
                            class="w-full p-3 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="johndoe@example.com" required>
                    </div>
                    <div class="mb-6">
                        <label for="message" class="block text-sm font-medium mb-2">Your Message</label>
                        <textarea id="message" name="message" rows="5"
                            class="w-full p-3 rounded-lg bg-gray-700 text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            placeholder="How can we help you?" required></textarea>
                    </div>
                    <button type="submit"
                        class="bg-blue-600 px-6 py-3 rounded-lg text-white hover:bg-blue-700 transition duration-300">
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Contact Information -->
            <div class="bg-gray-800 p-8 rounded-lg shadow-lg animate-fade-in-right">
                <h2 class="text-3xl font-bold mb-6">Contact Information</h2>
                <div class="space-y-6">
                    <!-- Address -->
                    <div>
                        <h3 class="text-xl font-semibold mb-2">Address</h3>
                        <p class="text-gray-300">123 Tech Street, Suite 456</p>
                        <p class="text-gray-300">Innovation City, IC 78901</p>
                    </div>

                    <!-- Phone -->
                    <div>
                        <h3 class="text-xl font-semibold mb-2">Phone</h3>
                        <p class="text-gray-300">+1 (123) 456-7890</p>
                    </div>

                    <!-- Email -->
                    <div>
                        <h3 class="text-xl font-semibold mb-2">Email</h3>
                        <p class="text-gray-300">info@oneforall.com</p>
                    </div>

                    <!-- Social Media -->
                    <div>
                        <h3 class="text-xl font-semibold mb-2">Follow Us</h3>
                        <div class="flex space-x-4">
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
                </div>
            </div>
        </div>
    </main>

    <!-- Alpine.js for Animations -->
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