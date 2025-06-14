   <!-- About Page Content -->
   <main class="container mx-auto px-4 py-12">
       <div class="text-center">
           <h1 class="text-6xl font-bold mb-8 animate-fade-in-down">About OneForAll</h1>
           <p class="text-xl mb-12 max-w-2xl mx-auto animate-fade-in-up">
               At OneForAll, we believe in creating unified software solutions that empower businesses and individuals to achieve their goals. Our mission is to deliver innovative, scalable, and user-friendly software that transforms the way you work.
           </p>
       </div>

       <!-- Team Section -->
       <div class="mt-16">
           <h2 class="text-4xl font-bold text-center mb-12 animate-fade-in-down">Meet Our Team</h2>
           <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
               <!-- Team Member 1 -->
               <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:scale-105 transition-transform animate-fade-in-left">
                   <img src="https://placehold.co/200x200" alt="Team Member" class="w-32 h-32 rounded-full mx-auto mb-4">
                   <h3 class="text-2xl font-bold text-center">John Doe</h3>
                   <p class="text-gray-400 text-center">CEO & Founder</p>
                   <p class="text-gray-300 mt-4">John is a visionary leader with over 15 years of experience in software development and business strategy.</p>
               </div>

               <!-- Team Member 2 -->
               <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:scale-105 transition-transform animate-fade-in-up">
                   <img src="https://placehold.co/200x200" alt="Team Member" class="w-32 h-32 rounded-full mx-auto mb-4">
                   <h3 class="text-2xl font-bold text-center">Jane Smith</h3>
                   <p class="text-gray-400 text-center">CTO</p>
                   <p class="text-gray-300 mt-4">Jane is a tech enthusiast with a passion for building scalable and secure systems.</p>
               </div>

               <!-- Team Member 3 -->
               <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:scale-105 transition-transform animate-fade-in-right">
                   <img src="https://placehold.co/200x200" alt="Team Member" class="w-32 h-32 rounded-full mx-auto mb-4">
                   <h3 class="text-2xl font-bold text-center">Mike Johnson</h3>
                   <p class="text-gray-400 text-center">Lead Developer</p>
                   <p class="text-gray-300 mt-4">Mike is a coding wizard who loves solving complex problems with elegant solutions.</p>
               </div>
           </div>
       </div>

       <!-- Mission Section -->
       <div class="mt-20 text-center">
           <h2 class="text-4xl font-bold mb-8 animate-fade-in-down">Our Mission</h2>
           <p class="text-xl max-w-2xl mx-auto animate-fade-in-up">
               Our mission is to provide cutting-edge software solutions that simplify processes, enhance productivity, and drive innovation. We are committed to delivering excellence in every product we create.
           </p>
       </div>

       <!-- Values Section -->
       <div class="mt-20">
           <h2 class="text-4xl font-bold text-center mb-12 animate-fade-in-down">Our Core Values</h2>
           <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
               <!-- Value 1 -->
               <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:scale-105 transition-transform animate-fade-in-left">
                   <h3 class="text-2xl font-bold text-center">Innovation</h3>
                   <p class="text-gray-300 mt-4">We constantly push the boundaries of technology to create innovative solutions.</p>
               </div>

               <!-- Value 2 -->
               <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:scale-105 transition-transform animate-fade-in-up">
                   <h3 class="text-2xl font-bold text-center">Integrity</h3>
                   <p class="text-gray-300 mt-4">We believe in transparency, honesty, and ethical practices in everything we do.</p>
               </div>

               <!-- Value 3 -->
               <div class="bg-gray-800 p-6 rounded-lg shadow-lg hover:scale-105 transition-transform animate-fade-in-right">
                   <h3 class="text-2xl font-bold text-center">Customer Focus</h3>
                   <p class="text-gray-300 mt-4">Our customers are at the heart of everything we do. We strive to exceed their expectations.</p>
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