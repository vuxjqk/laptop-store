export class AdminLayout {
    constructor() {
        this.isSidebarOpen = window.innerWidth >= 1024;
        this.init();
        this.showSessionMessages();
    }

    init() {
        this.setupEventListeners();
        this.updateLayout();
        this.setupResponsive();
    }

    setupEventListeners() {
        // Mobile menu toggle
        document.getElementById('mobileMenuBtn').addEventListener('click', () => {
            this.toggleSidebar();
        });

        // Overlay click
        document.getElementById('overlay').addEventListener('click', () => {
            this.closeSidebar();
        });

        // User dropdown
        document.getElementById('userMenuBtn').addEventListener('click', (e) => {
            e.stopPropagation();
            this.toggleDropdown('userDropdown', 'userChevron');
        });

        // Notification dropdown
        document.getElementById('notificationBtn').addEventListener('click', (e) => {
            e.stopPropagation();
            this.toggleDropdown('notificationDropdown');
        });

        // Search input focus
        const searchInput = document.getElementById('searchInput');
        if (searchInput) {
            searchInput.addEventListener('focus', () => {
                searchInput.classList.remove('search-collapsed');
                searchInput.classList.add('search-expanded');
            });

            searchInput.addEventListener('blur', () => {
                searchInput.classList.remove('search-expanded');
                searchInput.classList.add('search-collapsed');
            });
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', () => {
            this.closeAllDropdowns();
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.closeAllDropdowns();
                if (this.isSidebarOpen && window.innerWidth < 1024) {
                    this.closeSidebar();
                }
            }
        });
    }

    toggleSidebar() {
        this.isSidebarOpen = !this.isSidebarOpen;
        this.updateLayout();
    }

    closeSidebar() {
        if (window.innerWidth < 1024) {
            this.isSidebarOpen = false;
            this.updateLayout();
        }
    }

    updateLayout() {
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const overlay = document.getElementById('overlay');

        if (this.isSidebarOpen) {
            sidebar.classList.remove('sidebar-hidden');
            if (window.innerWidth < 1024) {
                overlay.classList.add('show');
            } else {
                mainContent.classList.remove('content-expanded');
                mainContent.classList.add('content-normal');
            }
        } else {
            sidebar.classList.add('sidebar-hidden');
            overlay.classList.remove('show');
            if (window.innerWidth >= 1024) {
                mainContent.classList.remove('content-normal');
                mainContent.classList.add('content-expanded');
            }
        }
    }

    toggleDropdown(dropdownId, chevronId = null) {
        const dropdown = document.getElementById(dropdownId);
        const isVisible = dropdown.classList.contains('show');

        this.closeAllDropdowns();

        if (!isVisible) {
            dropdown.classList.add('show');
            if (chevronId) {
                document.getElementById(chevronId).style.transform = 'rotate(180deg)';
            }
        }
    }

    closeAllDropdowns() {
        const dropdowns = document.querySelectorAll('.dropdown');
        dropdowns.forEach(dropdown => {
            dropdown.classList.remove('show');
        });

        const chevron = document.getElementById('userChevron');
        if (chevron) {
            chevron.style.transform = 'rotate(0deg)';
        }
    }

    setupResponsive() {
        let resizeTimer;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimer);
            resizeTimer = setTimeout(() => {
                if (window.innerWidth >= 1024) {
                    this.isSidebarOpen = true;
                } else {
                    this.isSidebarOpen = false;
                }
                this.updateLayout();
            }, 250);
        });
    }

    // Toast notification system
    showToast(message, type = 'info', duration = 5000) {
        const toastContainer = document.getElementById('toastContainer');
        const toastId = 'toast_' + Date.now();

        const icons = {
            success: 'fas fa-check-circle text-emerald-500',
            error: 'fas fa-exclamation-circle text-red-500',
            warning: 'fas fa-exclamation-triangle text-yellow-500',
            info: 'fas fa-info-circle text-sky-500'
        };

        const bgColors = {
            success: 'bg-emerald-50 border-emerald-200',
            error: 'bg-red-50 border-red-200',
            warning: 'bg-yellow-50 border-yellow-200',
            info: 'bg-sky-50 border-sky-200'
        };

        const toast = document.createElement('div');
        toast.id = toastId;
        toast.className = `toast ${bgColors[type]} border rounded-xl p-4 shadow-lg max-w-sm`;

        toast.innerHTML = `
            <div class="flex items-start space-x-3">
                <i class="${icons[type]}"></i>
                <div class="flex-1">
                    <p class="text-sm font-medium text-slate-800">${message}</p>
                </div>
                <button onclick="adminLayout.closeToast('${toastId}')" class="text-slate-400 hover:text-slate-600">
                    <i class="fas fa-times text-sm"></i>
                </button>
            </div>
            <div class="mt-3 h-1 bg-slate-200 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-sky-500 to-blue-500 rounded-full animate-toast-progress"></div>
            </div>
        `;

        toastContainer.appendChild(toast);

        // Show toast
        setTimeout(() => {
            toast.classList.add('show');
        }, 100);

        // Auto remove
        setTimeout(() => {
            this.closeToast(toastId);
        }, duration);
    }

    closeToast(toastId) {
        const toast = document.getElementById(toastId);
        if (toast) {
            toast.classList.remove('show');
            setTimeout(() => {
                toast.remove();
            }, 300);
        }
    }

    showSessionMessages() {
        // Check for Laravel session messages
        if (window.sessionMessages.success) {
            this.showToast(window.sessionMessages.success, 'success');
        }

        if (window.sessionMessages.error) {
            this.showToast(window.sessionMessages.error, 'error');
        }

        if (window.sessionMessages.warning) {
            this.showToast(window.sessionMessages.warning, 'warning');
        }

        if (window.sessionMessages.info) {
            this.showToast(window.sessionMessages.info, 'info');
        }
    }

    // API method for external use
    notify(message, type = 'info', duration = 5000) {
        this.showToast(message, type, duration);
    }
}