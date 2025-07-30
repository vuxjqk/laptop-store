<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin Layout - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
        integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <style>
        .sidebar-shadow {
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-lg border-b border-gray-200 fixed top-0 left-0 right-0 z-30">
        <div class="flex items-center justify-between px-6 py-4">
            <div class="flex items-center space-x-4">
                <i class="fas fa-laptop text-2xl text-blue-600"></i>
                <h1 class="text-xl font-bold text-gray-800">LaptopStore Admin</h1>
            </div>
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                    <input type="text" placeholder="Tìm kiếm sản phẩm..."
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex items-center space-x-2">
                    <img src="https://via.placeholder.com/32x32/4F46E5/FFFFFF?text=A" alt="Avatar"
                        class="w-8 h-8 rounded-full">
                    <span class="text-sm text-gray-700">Admin</span>
                    <i class="fas fa-chevron-down text-gray-400"></i>
                </div>
            </div>
        </div>
    </header>

    <!-- Sidebar Navigation -->
    <nav class="fixed left-0 top-0 h-full w-64 bg-white sidebar-shadow z-20 pt-20">
        <div class="p-4">
            <ul class="space-y-2">
                <li>
                    <a href="#" class="{{ request()->routeIs('dashboard') ? 'active' : 'inactive' }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('products.index') }}"
                        class="{{ request()->routeIs('products.*') ? 'active' : 'inactive' }}">
                        <i class="fas fa-laptop"></i>
                        <span>Sản phẩm</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('brands.index') }}"
                        class="{{ request()->routeIs('brands.*') ? 'active' : 'inactive' }}">
                        <i class="fas fa-tags"></i>
                        <span>Thương hiệu</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="{{ request()->routeIs('orders.*') ? 'active' : 'inactive' }}">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Đơn hàng</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="{{ request()->routeIs('customers.*') ? 'active' : 'inactive' }}">
                        <i class="fas fa-users"></i>
                        <span>Khách hàng</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="{{ request()->routeIs('reports.*') ? 'active' : 'inactive' }}">
                        <i class="fas fa-chart-bar"></i>
                        <span>Báo cáo</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="ml-64 pt-20 p-6">
        @yield('content')
    </main>

    <!-- Scripts -->
    @stack('scripts')
</body>

</html>
