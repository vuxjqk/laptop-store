<header class="glass-effect border-b border-slate-200/60 fixed top-0 left-0 right-0 z-30">
    <div class="flex items-center justify-between px-4 lg:px-8 py-4">
        <!-- Logo Section -->
        <div class="flex items-center space-x-4 ml-12 lg:ml-0">
            <div class="w-10 h-10 rounded-xl gradient-bg flex items-center justify-center shadow-lg">
                <i class="fas fa-laptop text-lg text-white"></i>
            </div>
            <div class="hidden sm:block">
                <h1 class="text-xl font-bold text-slate-100">LaptopStore</h1>
                <p class="text-xs text-slate-500 font-medium">Admin Dashboard</p>
            </div>
        </div>

        <!-- Search & User Section -->
        <div class="flex items-center space-x-3 lg:space-x-6">
            <!-- Search Bar -->
            <div class="relative hidden sm:block">
                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                    <i class="fas fa-search text-slate-400 text-sm"></i>
                </div>
                <input type="text" id="searchInput" placeholder="Tìm kiếm..."
                    class="search-collapsed pl-11 pr-4 py-2.5 border border-slate-200 rounded-xl focus:ring-2 focus:ring-sky-500 focus:border-sky-500 bg-white/70 text-sm font-medium placeholder-slate-400 transition-all duration-300">
            </div>

            <!-- Quick Actions -->
            <div class="hidden md:flex items-center space-x-2">
                <button
                    class="w-9 h-9 rounded-lg bg-white/70 hover:bg-white hover:shadow-md flex items-center justify-center transition-all duration-200">
                    <i class="fas fa-plus text-slate-600 text-sm"></i>
                </button>
                <button
                    class="w-9 h-9 rounded-lg bg-white/70 hover:bg-white hover:shadow-md flex items-center justify-center transition-all duration-200">
                    <i class="fas fa-moon text-slate-600 text-sm"></i>
                </button>
            </div>

            <!-- Notifications -->
            <div class="relative">
                <button id="notificationBtn"
                    class="w-10 h-10 rounded-xl bg-white/70 hover:bg-white hover:shadow-md flex items-center justify-center transition-all duration-200 relative">
                    <i class="fas fa-bell text-slate-600 text-sm notification-bell"></i>
                    <span
                        class="absolute -top-1 -right-1 w-5 h-5 bg-gradient-to-r from-red-500 to-pink-500 rounded-full text-xs text-white flex items-center justify-center font-bold shadow-lg">3</span>
                </button>

                <!-- Notification Dropdown -->
                <div id="notificationDropdown"
                    class="dropdown absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-xl border border-slate-200/60 overflow-hidden">
                    <div class="p-4 border-b border-slate-100">
                        <h3 class="font-semibold text-slate-800">Thông báo</h3>
                        <p class="text-sm text-slate-500">Bạn có 3 thông báo mới</p>
                    </div>
                    <div class="max-h-64 overflow-y-auto">
                        <div class="p-3 hover:bg-slate-50 border-b border-slate-50 cursor-pointer">
                            <div class="flex space-x-3">
                                <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-shopping-cart text-green-600 text-xs"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-slate-800">Đơn hàng mới #12345</p>
                                    <p class="text-xs text-slate-500">2 phút trước</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-3 hover:bg-slate-50 border-b border-slate-50 cursor-pointer">
                            <div class="flex space-x-3">
                                <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-blue-600 text-xs"></i>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-slate-800">Khách hàng mới đăng ký</p>
                                    <p class="text-xs text-slate-500">15 phút trước</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="p-3 border-t border-slate-100">
                        <button class="w-full text-center text-sm text-sky-600 hover:text-sky-700 font-medium">Xem
                            tất cả</button>
                    </div>
                </div>
            </div>

            <!-- User Profile -->
            <div class="relative">
                <button id="userMenuBtn"
                    class="flex items-center space-x-3 px-3 py-2 rounded-xl hover:bg-white/70 transition-all duration-200 cursor-pointer">
                    <div class="w-9 h-9 rounded-full gradient-bg flex items-center justify-center shadow-md">
                        <span class="text-white font-semibold text-sm">A</span>
                    </div>
                    <div class="hidden lg:block text-left">
                        <p class="text-sm font-semibold text-slate-500">Admin User</p>
                        <p class="text-xs text-slate-500">Super Admin</p>
                    </div>
                    <i class="fas fa-chevron-down text-slate-400 text-xs transition-transform duration-200"
                        id="userChevron"></i>
                </button>

                <!-- User Dropdown -->
                <div id="userDropdown"
                    class="dropdown absolute right-0 mt-2 w-64 bg-white rounded-xl shadow-xl border border-slate-200/60 overflow-hidden">
                    <div class="p-4 border-b border-slate-100">
                        <div class="flex items-center space-x-3">
                            <div class="w-12 h-12 rounded-full gradient-bg flex items-center justify-center shadow-md">
                                <span class="text-white font-semibold">A</span>
                            </div>
                            <div>
                                <p class="font-semibold text-slate-800">Admin User</p>
                                <p class="text-sm text-slate-500">admin@laptopstore.com</p>
                            </div>
                        </div>
                    </div>
                    <div class="py-2">
                        <a href="#"
                            class="flex items-center space-x-3 px-4 py-3 hover:bg-slate-50 transition-colors">
                            <i class="fas fa-user text-slate-400 w-4"></i>
                            <span class="text-sm text-slate-700">Hồ sơ cá nhân</span>
                        </a>
                        <a href="#"
                            class="flex items-center space-x-3 px-4 py-3 hover:bg-slate-50 transition-colors">
                            <i class="fas fa-cog text-slate-400 w-4"></i>
                            <span class="text-sm text-slate-700">Cài đặt</span>
                        </a>
                        <a href="#"
                            class="flex items-center space-x-3 px-4 py-3 hover:bg-slate-50 transition-colors">
                            <i class="fas fa-question-circle text-slate-400 w-4"></i>
                            <span class="text-sm text-slate-700">Trợ giúp</span>
                        </a>
                        <div class="border-t border-slate-100 mt-2 pt-2">
                            <a href="#"
                                class="flex items-center space-x-3 px-4 py-3 hover:bg-red-50 transition-colors text-red-600">
                                <i class="fas fa-sign-out-alt w-4"></i>
                                <span class="text-sm font-medium">Đăng xuất</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
