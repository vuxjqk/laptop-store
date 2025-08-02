<nav id="sidebar" class="sidebar fixed left-0 top-0 h-full bg-white shadow-2xl z-40">
    <!-- Logo Section -->
    <div class="glass-effect border-b border-slate-200/60">
        <div class="flex items-center justify-between px-4 lg:px-8 py-5">
            <div class="flex items-center space-x-4 ml-12 lg:ml-0">
                <div class="w-10 h-10 rounded-xl gradient-bg flex items-center justify-center shadow-lg">
                    <i class="fas fa-laptop text-lg text-white"></i>
                </div>
                <div class="hidden sm:block">
                    <h1 class="text-xl font-bold text-slate-800 dark:text-slate-200">LaptopStore</h1>
                    <p class="text-xs text-slate-500 font-medium">Admin Dashboard</p>
                </div>
            </div>
        </div>
    </div>

    <div class="px-6 pb-6 h-[calc(100vh-4rem)] overflow-y-auto scrollbar-hidden">
        <!-- Navigation Menu -->
        <div class="space-y-2 mt-6">
            <div class="mb-6">
                <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Tổng quan</h3>
                <ul class="space-y-1">
                    <li>
                        <a href="#" class="{{ request()->routeIs('dashboard') ? 'active' : 'inactive' }}">
                            <i class="fas fa-chart-pie nav-icon"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="{{ request()->routeIs('analytics.*') ? 'active' : 'inactive' }}">
                            <i class="fas fa-chart-line nav-icon"></i>
                            <span>Analytics</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="mb-6">
                <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Quản lý</h3>
                <ul class="space-y-1">
                    <li>
                        <a href="{{ route('products.index') }}"
                            class="{{ request()->routeIs('products.*', 'product-images.*', 'product-features.*', 'product-applications.*', 'product-variants.*') ? 'active' : 'inactive' }}">
                            <i class="fas fa-laptop nav-icon"></i>
                            <span>Sản phẩm</span>
                            <span
                                class="ml-auto bg-sky-100 text-sky-600 text-xs font-medium px-2 py-1 rounded-full">142</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('brands.index') }}"
                            class="{{ request()->routeIs('brands.*') ? 'active' : 'inactive' }}">
                            <i class="fas fa-tags nav-icon"></i>
                            <span>Thương hiệu</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="{{ request()->routeIs('categories.*') ? 'active' : 'inactive' }}">
                            <i class="fas fa-layer-group nav-icon"></i>
                            <span>Danh mục</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="mb-6">
                <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Bán hàng</h3>
                <ul class="space-y-1">
                    <li>
                        <a href="#" class="{{ request()->routeIs('orders.*') ? 'active' : 'inactive' }}">
                            <i class="fas fa-shopping-cart nav-icon"></i>
                            <span>Đơn hàng</span>
                            <span
                                class="ml-auto bg-emerald-100 text-emerald-600 text-xs font-medium px-2 py-1 rounded-full">8</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="{{ request()->routeIs('customers.*') ? 'active' : 'inactive' }}">
                            <i class="fas fa-users nav-icon"></i>
                            <span>Khách hàng</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="{{ request()->routeIs('invoices.*') ? 'active' : 'inactive' }}">
                            <i class="fas fa-file-invoice nav-icon"></i>
                            <span>Hóa đơn</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="mb-6">
                <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Báo cáo</h3>
                <ul class="space-y-1">
                    <li>
                        <a href="#" class="{{ request()->routeIs('reports.*') ? 'active' : 'inactive' }}">
                            <i class="fas fa-chart-bar nav-icon"></i>
                            <span>Báo cáo bán hàng</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="{{ request()->routeIs('inventory.*') ? 'active' : 'inactive' }}">
                            <i class="fas fa-boxes nav-icon"></i>
                            <span>Tồn kho</span>
                        </a>
                    </li>
                </ul>
            </div>

            <div>
                <h3 class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-3">Hệ thống</h3>
                <ul class="space-y-1">
                    <li>
                        <a href="#" class="{{ request()->routeIs('settings.*') ? 'active' : 'inactive' }}">
                            <i class="fas fa-cog nav-icon"></i>
                            <span>Cài đặt</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" class="{{ request()->routeIs('users.*') ? 'active' : 'inactive' }}">
                            <i class="fas fa-user-shield nav-icon"></i>
                            <span>Người dùng</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Quick Stats Card -->
        <div
            class="mt-8 mb-4 p-4 bg-gradient-to-br from-sky-50 via-blue-50 to-indigo-50 rounded-xl border border-sky-100">
            <div class="flex items-center space-x-3 mb-3">
                <div class="w-8 h-8 gradient-bg rounded-lg flex items-center justify-center shadow-md">
                    <i class="fas fa-chart-line text-white text-sm"></i>
                </div>
                <div>
                    <p class="text-sm font-semibold text-slate-800">Doanh thu hôm nay</p>
                    <p class="text-xs text-emerald-600 font-medium">+12% so với hôm qua</p>
                </div>
            </div>
            <p class="text-2xl font-bold bg-gradient-to-r from-sky-600 to-blue-600 bg-clip-text text-transparent">
                ₫24,500,000</p>
        </div>
    </div>
</nav>
