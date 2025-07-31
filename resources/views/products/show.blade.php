@php
    // Dữ liệu mẫu cho demo
    // $brand = (object) [
    //     'id' => 1,
    //     'name' => 'Dell',
    //     'slug' => 'dell',
    //     'description' => 'Thương hiệu máy tính hàng đầu thế giới',
    //     'logo' => 'https://via.placeholder.com/100x50/007DB8/FFFFFF?text=Dell',
    //     'is_active' => true,
    // ];

    // $product = (object) [
    //     'id' => 1,
    //     'name' => 'Dell XPS 13 Plus',
    //     'slug' => 'dell-xps-13-plus',
    //     'brand_id' => 1,
    //     'description' =>
    //         'Laptop cao cấp với thiết kế siêu mỏng, hiệu năng mạnh mẽ và màn hình InfinityEdge đẹp mắt. Phù hợp cho công việc chuyên nghiệp và sáng tạo.',
    //     'processor' => 'Intel Core i7-1260P (12 cores, 16 threads, up to 4.7GHz)',
    //     'display' => '13.4" OLED 3.5K (3456x2160) Touch Display, 400 nits',
    //     'graphics' => 'Intel Iris Xe Graphics',
    //     'battery' => '55Wh, up to 12 hours',
    //     'weight' => '1.26kg',
    //     'ports' => '2x Thunderbolt 4, 1x 3.5mm headphone jack',
    //     'is_active' => true,
    // ];

    // $product_images = [
    //     (object) [
    //         'id' => 1,
    //         'product_id' => 1,
    //         'path' => 'https://via.placeholder.com/800x600/F5F5F5/333333?text=Dell+XPS+13+Main',
    //     ],
    //     (object) [
    //         'id' => 2,
    //         'product_id' => 1,
    //         'path' => 'https://via.placeholder.com/800x600/F5F5F5/333333?text=Dell+XPS+13+Side',
    //     ],
    //     (object) [
    //         'id' => 3,
    //         'product_id' => 1,
    //         'path' => 'https://via.placeholder.com/800x600/F5F5F5/333333?text=Dell+XPS+13+Open',
    //     ],
    //     (object) [
    //         'id' => 4,
    //         'product_id' => 1,
    //         'path' => 'https://via.placeholder.com/800x600/F5F5F5/333333?text=Dell+XPS+13+Back',
    //     ],
    // ];

    // $product_features = [
    //     (object) ['id' => 1, 'product_id' => 1, 'feature' => 'Màn hình OLED 3.5K siêu nét'],
    //     (object) ['id' => 2, 'product_id' => 1, 'feature' => 'Bàn phím backlit LED'],
    //     (object) ['id' => 3, 'product_id' => 1, 'feature' => 'Webcam Full HD với Windows Hello'],
    //     (object) ['id' => 4, 'product_id' => 1, 'feature' => 'Audio Waves MaxxAudio Pro'],
    //     (object) ['id' => 5, 'product_id' => 1, 'feature' => 'Thiết kế carbon fiber cao cấp'],
    //     (object) ['id' => 6, 'product_id' => 1, 'feature' => 'Sạc nhanh ExpressCharge'],
    // ];

    // $applications = [
    //     (object) [
    //         'id' => 1,
    //         'name' => 'Lập trình phần mềm',
    //         'description' => 'Phù hợp cho các IDE và framework hiện đại',
    //     ],
    //     (object) [
    //         'id' => 2,
    //         'name' => 'Thiết kế đồ họa',
    //         'description' => 'Hỗ trợ Adobe Creative Suite và các phần mềm thiết kế',
    //     ],
    //     (object) [
    //         'id' => 3,
    //         'name' => 'Doanh nghiệp',
    //         'description' => 'Công việc văn phòng, thuyết trình chuyên nghiệp',
    //     ],
    //     (object) ['id' => 4, 'name' => 'Học tập', 'description' => 'Phù hợp cho sinh viên và nghiên cứu'],
    // ];

    $rams = [
        (object) ['id' => 1, 'size' => '8GB'],
        (object) ['id' => 2, 'size' => '16GB'],
        (object) ['id' => 3, 'size' => '32GB'],
    ];

    $storages = [
        (object) ['id' => 1, 'capacity' => '256GB SSD'],
        (object) ['id' => 2, 'capacity' => '512GB SSD'],
        (object) ['id' => 3, 'capacity' => '1TB SSD'],
    ];

    $colors = [
        (object) ['id' => 1, 'name' => 'Platinum Silver', 'hex_code' => '#E5E4E2'],
        (object) ['id' => 2, 'name' => 'Graphite', 'hex_code' => '#41424C'],
        (object) ['id' => 3, 'name' => 'Sky Blue', 'hex_code' => '#87CEEB'],
    ];

    $product_variants = [
        (object) [
            'id' => 1,
            'ram_id' => 1,
            'storage_id' => 1,
            'color_id' => 1,
            'price' => 25990000,
            'original_price' => 28990000,
            'stock_quantity' => 15,
        ],
        (object) [
            'id' => 2,
            'ram_id' => 1,
            'storage_id' => 1,
            'color_id' => 2,
            'price' => 25990000,
            'original_price' => 28990000,
            'stock_quantity' => 8,
        ],
        (object) [
            'id' => 3,
            'ram_id' => 2,
            'storage_id' => 2,
            'color_id' => 1,
            'price' => 32990000,
            'original_price' => 35990000,
            'stock_quantity' => 12,
        ],
        (object) [
            'id' => 4,
            'ram_id' => 2,
            'storage_id' => 2,
            'color_id' => 2,
            'price' => 32990000,
            'original_price' => 35990000,
            'stock_quantity' => 6,
        ],
        (object) [
            'id' => 5,
            'ram_id' => 3,
            'storage_id' => 3,
            'color_id' => 3,
            'price' => 45990000,
            'original_price' => 49990000,
            'stock_quantity' => 3,
        ],
    ];
@endphp

@extends('layouts.admin')

@section('title', $product->name)

@section('content')
    <!-- Breadcrumb -->
    <div class="mb-6">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800"><i
                            class="fas fa-home"></i></a></li>
                <li><i class="fas fa-chevron-right text-gray-400"></i></li>
                <li><a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800">Sản phẩm</a></li>
                <li><i class="fas fa-chevron-right text-gray-400"></i></li>
                <li class="text-gray-500">{{ $product->name }}</li>
            </ol>
        </nav>
    </div>

    <!-- Product Header -->
    <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center space-x-4">
                <img src="{{ asset('storage/' . $product->brand->logo) }}" alt="{{ $product->brand->name }}" class="h-12">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h1>
                    <p class="text-gray-600">Thương hiệu: <span
                            class="font-medium text-blue-600">{{ $product->brand->name }}</span>
                    </p>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium">
                    <i class="fas fa-check-circle mr-1"></i>Đang hoạt động
                </span>
                <a href="{{ route('products.edit', $product->id) }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <i class="fas fa-edit mr-2"></i>Chỉnh sửa
                </a>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Product Images Section -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-800">
                        <i class="fas fa-images text-purple-600 mr-2"></i>Hình ảnh sản phẩm
                    </h2>
                    <a href="{{ route('product-images.index', $product) }}"
                        class="text-blue-600 hover:text-blue-800 font-medium">
                        <i class="fas fa-edit mr-1"></i>Chỉnh sửa
                    </a>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    @foreach ($product->images as $image)
                        <div class="aspect-video bg-gray-100 rounded-lg overflow-hidden">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="Product Image"
                                class="w-full h-full object-cover hover:scale-105 transition-transform cursor-pointer">
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Product Specifications -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">
                    <i class="fas fa-cogs text-green-600 mr-2"></i>Thông số kỹ thuật
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-microchip text-blue-500 mt-1"></i>
                            <div>
                                <span class="font-medium text-gray-700">Bộ xử lý:</span>
                                <p class="text-gray-600">{{ $product->processor }}</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-desktop text-purple-500 mt-1"></i>
                            <div>
                                <span class="font-medium text-gray-700">Màn hình:</span>
                                <p class="text-gray-600">{{ $product->display }}</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-paint-brush text-pink-500 mt-1"></i>
                            <div>
                                <span class="font-medium text-gray-700">Đồ họa:</span>
                                <p class="text-gray-600">{{ $product->graphics }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-battery-half text-green-500 mt-1"></i>
                            <div>
                                <span class="font-medium text-gray-700">Pin:</span>
                                <p class="text-gray-600">{{ $product->battery }}</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-weight text-orange-500 mt-1"></i>
                            <div>
                                <span class="font-medium text-gray-700">Trọng lượng:</span>
                                <p class="text-gray-600">{{ $product->weight }}</p>
                            </div>
                        </div>
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-plug text-indigo-500 mt-1"></i>
                            <div>
                                <span class="font-medium text-gray-700">Cổng kết nối:</span>
                                <p class="text-gray-600">{{ $product->ports }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Features -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-800">
                        <i class="fas fa-star text-yellow-500 mr-2"></i>Tính năng nổi bật
                    </h2>
                    <a href="{{ route('product-features.index', $product) }}"
                        class="text-blue-600 hover:text-blue-800 font-medium">
                        <i class="fas fa-edit mr-1"></i>Chỉnh sửa
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                    @foreach ($product->features as $feature)
                        <div class="flex items-center space-x-3 p-3 bg-blue-50 rounded-lg">
                            <i class="fas fa-check-circle text-blue-600"></i>
                            <span class="text-gray-700">{{ $feature->feature }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Applications -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-800">
                        <i class="fas fa-rocket text-red-500 mr-2"></i>Ứng dụng phù hợp
                    </h2>
                    <a href="{{ route('product-applications.index', $product) }}"
                        class="text-blue-600 hover:text-blue-800 font-medium">
                        <i class="fas fa-edit mr-1"></i>Chỉnh sửa
                    </a>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($product->applications as $app)
                        <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                            <h3 class="font-medium text-gray-800 mb-2">{{ $app->name }}</h3>
                            <p class="text-sm text-gray-600">{{ $app->description }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Sidebar with Variants -->
        <div class="lg:col-span-1">
            <!-- Product Description -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4">
                    <i class="fas fa-info-circle text-blue-600 mr-2"></i>Mô tả sản phẩm
                </h2>
                <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
            </div>

            <!-- Product Variants -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-800">
                        <i class="fas fa-palette text-purple-600 mr-2"></i>Phiên bản sản phẩm
                    </h2>
                    <a href="#" class="text-blue-600 hover:text-blue-800 font-medium">
                        <i class="fas fa-edit mr-1"></i>Chỉnh sửa
                    </a>
                </div>
                <div class="space-y-4">
                    @foreach ($product_variants as $variant)
                        @php
                            $ram = collect($rams)->firstWhere('id', $variant->ram_id);
                            $storage = collect($storages)->firstWhere('id', $variant->storage_id);
                            $color = collect($colors)->firstWhere('id', $variant->color_id);
                        @endphp
                        <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-300 transition-colors">
                            <div class="flex items-center justify-between mb-3">
                                <div class="flex items-center space-x-2">
                                    <div class="w-4 h-4 rounded-full border-2 border-gray-300"
                                        style="background-color: {{ $color->hex_code }}"></div>
                                    <span class="font-medium text-gray-800">{{ $color->name }}</span>
                                </div>
                                <span
                                    class="px-2 py-1 text-xs rounded-full 
                                    {{ $variant->stock_quantity > 10
                                        ? 'bg-green-100 text-green-800'
                                        : ($variant->stock_quantity > 0
                                            ? 'bg-yellow-100 text-yellow-800'
                                            : 'bg-red-100 text-red-800') }}">
                                    {{ $variant->stock_quantity }} có sẵn
                                </span>
                            </div>
                            <div class="text-sm text-gray-600 mb-2">
                                <span class="font-medium">RAM:</span> {{ $ram->size }} |
                                <span class="font-medium">Ổ cứng:</span> {{ $storage->capacity }}
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span
                                        class="text-lg font-bold text-blue-600">{{ number_format($variant->price, 0, ',', '.') }}₫</span>
                                    @if ($variant->original_price > $variant->price)
                                        <span
                                            class="text-sm text-gray-500 line-through ml-2">{{ number_format($variant->original_price, 0, ',', '.') }}₫</span>
                                    @endif
                                </div>
                                @if ($variant->original_price > $variant->price)
                                    <span class="bg-red-100 text-red-800 text-xs px-2 py-1 rounded-full">
                                        -{{ round((($variant->original_price - $variant->price) / $variant->original_price) * 100) }}%
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Image click to enlarge functionality
            document.querySelectorAll('img[alt="Product Image"]').forEach(img => {
                img.addEventListener('click', function() {
                    // Simple modal implementation would go here
                    console.log('Image clicked:', this.src);
                });
            });
        </script>
    @endpush
@endsection
