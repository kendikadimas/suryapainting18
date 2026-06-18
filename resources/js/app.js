import Alpine from 'alpinejs';
import { createIcons, icons } from 'lucide';

// Expose Lucide on window so inline <script> blocks in Blade can call
// `window.lucide.createIcons()` without rewriting every view.
window.lucide = { createIcons: () => createIcons({ icons }) };

// Render any icons already present once the DOM is ready.
document.addEventListener('DOMContentLoaded', () => window.lucide.createIcons());

// Re-render icons after Alpine swaps DOM (e.g. x-show templates, x-for nodes).
document.addEventListener('alpine:initialized', () => window.lucide.createIcons());

window.Alpine = Alpine;
Alpine.start();
