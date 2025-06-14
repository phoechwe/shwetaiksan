import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import persist from '@alpinejs/persist';
import 'flowbite';
import '@fortawesome/fontawesome-free/js/all.js';

if (!window.Alpine) {
    Alpine.plugin(focus);
    Alpine.plugin(persist);
    window.Alpine = Alpine;
    Alpine.start();
}


function initializeFlowbite() {
    initFlowbite();
}

document.addEventListener("livewire:navigating", () => {
    initializeFlowbite();
});

document.addEventListener("livewire:navigated", () => {
    initializeFlowbite();
});
document.addEventListener("livewire:load", () => {
    initializeFlowbite();
});

// Initialize on page load
initializeFlowbite();


