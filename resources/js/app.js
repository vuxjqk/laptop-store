import './bootstrap';

import Alpine from 'alpinejs';

import { AdminLayoutExtended } from './AdminLayoutExtended.js';

document.addEventListener('DOMContentLoaded', () => {
    // Replace the basic AdminLayout with the extended version
    const adminLayoutExtended = new AdminLayoutExtended();
    adminLayoutExtended.initTheme();

    // Make it globally available
    window.adminLayout = adminLayoutExtended;
    window.adminLayoutExtended = adminLayoutExtended;
});

window.Alpine = Alpine;

Alpine.start();
