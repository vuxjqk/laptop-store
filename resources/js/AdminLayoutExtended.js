import { AdminLayout } from './AdminLayout.js';

export class AdminLayoutExtended extends AdminLayout {
    constructor() {
        super();
        this.setupAdvancedFeatures();
    }

    setupAdvancedFeatures() {
        this.setupSearch();
        this.setupKeyboardShortcuts();
        this.setupPerformanceOptimizations();
        this.setupAccessibility();
        this.setupThemeToggle();
    }

    setupSearch() {
        const searchInput = document.getElementById('searchInput');
        if (!searchInput) return;

        let searchTimeout;

        searchInput.addEventListener('input', (e) => {
            clearTimeout(searchTimeout);
            const query = e.target.value.trim();

            if (query.length > 0) {
                searchTimeout = setTimeout(() => {
                    this.performSearch(query);
                }, 300);
            }
        });

        // Search suggestions
        searchInput.addEventListener('focus', () => {
            this.showSearchSuggestions();
        });
    }

    performSearch(query) {
        // Add loading state
        const searchInput = document.getElementById('searchInput');
        searchInput.classList.add('loading');

        // Simulate API call
        setTimeout(() => {
            searchInput.classList.remove('loading');
            console.log('Searching for:', query);
            // Here you would make an actual API call
        }, 500);
    }

    showSearchSuggestions() {
        // Create search suggestions dropdown
        const suggestions = [{
            icon: 'fas fa-laptop',
            text: 'MacBook Pro M3',
            type: 'Sản phẩm'
        },
        {
            icon: 'fas fa-shopping-cart',
            text: 'Đơn hàng #12345',
            type: 'Đơn hàng'
        },
        {
            icon: 'fas fa-user',
            text: 'Nguyễn Văn A',
            type: 'Khách hàng'
        }
        ];

        // Implementation would create and show suggestions dropdown
        console.log('Showing search suggestions:', suggestions);
    }

    setupKeyboardShortcuts() {
        document.addEventListener('keydown', (e) => {
            // Ctrl/Cmd + K for search
            if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
                e.preventDefault();
                document.getElementById('searchInput')?.focus();
            }

            // Ctrl/Cmd + B for sidebar toggle
            if ((e.ctrlKey || e.metaKey) && e.key === 'b') {
                e.preventDefault();
                this.toggleSidebar();
            }

            // Ctrl/Cmd + N for new item
            if ((e.ctrlKey || e.metaKey) && e.key === 'n') {
                e.preventDefault();
                this.showQuickAdd();
            }
        });
    }

    showQuickAdd() {
        this.notify('Nhấn Ctrl+N để thêm mới nhanh', 'info');
        // Implementation for quick add modal
    }

    setupPerformanceOptimizations() {
        // Lazy load sidebar content
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('loaded');
                }
            });
        });

        document.querySelectorAll('.nav-item').forEach(item => {
            observer.observe(item);
        });

        // Debounce resize events
        let resizeTimeout;
        window.addEventListener('resize', () => {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                this.handleResize();
            }, 150);
        });
    }

    handleResize() {
        const width = window.innerWidth;

        if (width < 768) {
            // Mobile optimizations
            document.body.classList.add('mobile-mode');
        } else {
            document.body.classList.remove('mobile-mode');
        }
    }

    setupAccessibility() {
        // Add focus indicators
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Tab') {
                document.body.classList.add('using-keyboard');
            }
        });

        document.addEventListener('mousedown', () => {
            document.body.classList.remove('using-keyboard');
        });

        // ARIA labels and roles
        this.enhanceAccessibility();
    }

    enhanceAccessibility() {
        const sidebar = document.getElementById('sidebar');
        sidebar.setAttribute('role', 'navigation');
        sidebar.setAttribute('aria-label', 'Main navigation');

        const dropdowns = document.querySelectorAll('.dropdown');
        dropdowns.forEach((dropdown, index) => {
            dropdown.setAttribute('role', 'menu');
            dropdown.setAttribute('aria-hidden', 'true');
        });
    }

    setupThemeToggle() {
        const themeBtn = document.querySelector('.fas.fa-moon').parentElement;
        if (!themeBtn) return;

        themeBtn.addEventListener('click', () => {
            this.toggleTheme();
        });
    }

    toggleTheme() {
        const isDark = document.body.classList.toggle('dark');

        if (isDark) {
            const icon = document.querySelector('.fas.fa-moon');
            icon.className = 'fas fa-sun text-slate-600 text-sm';
            localStorage.setItem('theme', 'dark');
        } else {
            const icon = document.querySelector('.fas.fa-sun');
            icon.className = 'fas fa-moon text-slate-600 text-sm';
            localStorage.setItem('theme', 'light');
        }
    }

    // Enhanced notification system
    showAdvancedToast(options = {}) {
        const {
            message,
            type = 'info',
            duration = 5000,
            actions = [],
            persistent = false,
            position = 'top-right'
        } = options;

        const toastContainer = document.getElementById('toastContainer');
        const toastId = 'toast_' + Date.now();

        const toast = document.createElement('div');
        toast.id = toastId;
        toast.className =
            `toast bg-white border border-slate-200 rounded-xl p-4 shadow-xl max-w-sm backdrop-blur-sm`;

        let actionsHtml = '';
        if (actions.length > 0) {
            actionsHtml = `
                <div class="mt-3 flex space-x-2">
                    ${actions.map(action => `
                        <button onclick="${action.onClick}" class="px-3 py-1 text-xs font-medium rounded-lg ${action.class || 'bg-slate-100 hover:bg-slate-200 text-slate-700'}">
                            ${action.label}
                        </button>
                    `).join('')}
                </div>
            `;
        }

        toast.innerHTML = `
            <div class="flex items-start space-x-3">
                <div class="w-8 h-8 rounded-full bg-gradient-to-r from-sky-500 to-blue-500 flex items-center justify-center">
                    <i class="fas fa-info text-white text-sm"></i>
                </div>
                <div class="flex-1">
                    <p class="text-sm font-medium text-slate-800">${message}</p>
                    ${actionsHtml}
                </div>
                ${!persistent ? `
                    <button onclick="adminLayoutExtended.closeToast('${toastId}')" class="text-slate-400 hover:text-slate-600">
                        <i class="fas fa-times text-sm"></i>
                    </button>
                ` : ''}
            </div>
            ${!persistent ? `
                <div class="mt-3 h-1 bg-slate-200 rounded-full overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-sky-500 to-blue-500 rounded-full animate-toast-progress"></div>
                </div>
            ` : ''}
        `;

        toastContainer.appendChild(toast);

        setTimeout(() => {
            toast.classList.add('show');
        }, 100);

        if (!persistent) {
            setTimeout(() => {
                this.closeToast(toastId);
            }, duration);
        }
    }

    // API methods for external use
    showConfirmation(message, onConfirm, onCancel) {
        this.showAdvancedToast({
            message: message,
            type: 'warning',
            persistent: true,
            actions: [{
                label: 'Xác nhận',
                onClick: `${onConfirm}; adminLayoutExtended.closeToast('${toastId}')`,
                class: 'bg-red-500 hover:bg-red-600 text-white'
            },
            {
                label: 'Hủy',
                onClick: `${onCancel || ''}; adminLayoutExtended.closeToast('${toastId}')`
            }
            ]
        });
    }

    // Initialize theme from localStorage
    initTheme() {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark' || (!savedTheme && window.matchMedia('(prefers-color-scheme: dark)')
            .matches)) {
            document.body.classList.add('dark');
            const icon = document.querySelector('.fas.fa-moon');
            if (icon) {
                icon.className = 'fas fa-sun text-slate-600 text-sm';
            }
        }
    }
}