import { AdminLayoutExtended } from './AdminLayoutExtended.js';

document.addEventListener('DOMContentLoaded', () => {
    // Replace the basic AdminLayout with the extended version
    const adminLayoutExtended = new AdminLayoutExtended();
    adminLayoutExtended.initTheme();
});