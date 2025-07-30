@php
    // Dữ liệu mẫu cho sản phẩm
    $product = [
        'id' => 1,
        'name' => 'MacBook Pro 14" M3 Max',
        'brand' => 'Apple',
        'price' => 52990000,
        'original_price' => 59990000,
        'discount' => 12,
        'rating' => 4.8,
        'review_count' => 1247,
        'stock' => 15,
        'description' =>
            'MacBook Pro 14 inch với chip M3 Max mang đến hiệu suất vượt trội cho các tác vụ chuyên nghiệp. Màn hình Liquid Retina XDR 14.2 inch với độ sáng 1000 nits, hỗ trợ ProMotion và Wide color (P3).',
        'specifications' => [
            'Processor' => 'Apple M3 Max 12-core CPU',
            'Memory' => '18GB Unified Memory',
            'Storage' => '512GB SSD Storage',
            'Display' => '14.2-inch Liquid Retina XDR',
            'Graphics' => '30-core GPU',
            'Battery' => 'Up to 18 hours',
            'Weight' => '1.61 kg',
            'Ports' => '3x Thunderbolt 4, HDMI, SDXC, MagSafe 3',
        ],
        'images' => [
            'https://images.unsplash.com/photo-1517336714731-489689fd1ca8?w=800',
            'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=800',
            'https://images.unsplash.com/photo-1605236453806-6ff36851218e?w=800',
            'https://images.unsplash.com/photo-1541807084-5c52b6b3adef?w=800',
        ],
        'memory_options' => [
            ['value' => '18GB', 'price' => 0, 'label' => '18GB Unified Memory'],
            ['value' => '36GB', 'price' => 5000000, 'label' => '36GB Unified Memory (+5.000.000đ)'],
            ['value' => '64GB', 'price' => 12000000, 'label' => '64GB Unified Memory (+12.000.000đ)'],
        ],
        'storage_options' => [
            ['value' => '512GB', 'price' => 0, 'label' => '512GB SSD'],
            ['value' => '1TB', 'price' => 6000000, 'label' => '1TB SSD (+6.000.000đ)'],
            ['value' => '2TB', 'price' => 15000000, 'label' => '2TB SSD (+15.000.000đ)'],
        ],
        'colors' => [
            ['value' => 'space-gray', 'name' => 'Space Gray', 'hex' => '#4A4A4A'],
            ['value' => 'silver', 'name' => 'Silver', 'hex' => '#E5E5E5'],
            ['value' => 'space-black', 'name' => 'Space Black', 'hex' => '#1D1D1F'],
        ],
    ];

    // Sản phẩm liên quan
    $relatedProducts = [
        [
            'id' => 2,
            'name' => 'MacBook Air 15" M3',
            'price' => 32990000,
            'original_price' => 34990000,
            'image' => 'https://images.unsplash.com/photo-1611186871348-b1ce696e52c9?w=400',
            'rating' => 4.7,
        ],
        [
            'id' => 3,
            'name' => 'Dell XPS 13 Plus',
            'price' => 28990000,
            'original_price' => 31990000,
            'image' => 'https://images.unsplash.com/photo-1593640408182-31c70c8268f5?w=400',
            'rating' => 4.5,
        ],
        [
            'id' => 4,
            'name' => 'HP Spectre x360',
            'price' => 26990000,
            'original_price' => 29990000,
            'image' => 'https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?w=400',
            'rating' => 4.6,
        ],
        [
            'id' => 5,
            'name' => 'Lenovo ThinkPad X1',
            'price' => 35990000,
            'original_price' => 38990000,
            'image' => 'https://images.unsplash.com/photo-1541807084-5c52b6b3adef?w=400',
            'rating' => 4.4,
        ],
    ];

    // Reviews mẫu
    $reviews = [
        [
            'id' => 1,
            'user' => 'Nguyễn Văn A',
            'rating' => 5,
            'date' => '2024-03-15',
            'comment' => 'Sản phẩm tuyệt vời! Hiệu suất mạnh mẽ, thiết kế đẹp. Rất hài lòng với chất lượng.',
        ],
        [
            'id' => 2,
            'user' => 'Trần Thị B',
            'rating' => 4,
            'date' => '2024-03-10',
            'comment' => 'Laptop chạy rất nhanh, màn hình đẹp. Giá hơi cao nhưng xứng đáng với chất lượng.',
        ],
        [
            'id' => 3,
            'user' => 'Lê Minh C',
            'rating' => 5,
            'date' => '2024-03-08',
            'comment' => 'Tuyệt vời cho công việc thiết kế. Pin trâu, hiệu suất ổn định.',
        ],
    ];
@endphp

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product['name'] }} - Laptop Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#3B82F6',
                        secondary: '#1E40AF',
                        accent: '#F59E0B'
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-white shadow-lg sticky top-0 z-50">
        <div class="container mx-auto px-4">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <div class="flex items-center space-x-4">
                    <div class="text-2xl font-bold text-primary">
                        <i class="fas fa-laptop mr-2"></i>LaptopStore
                    </div>
                </div>

                <!-- Navigation -->
                <nav class="hidden md:flex space-x-8">
                    <a href="#" class="text-gray-700 hover:text-primary transition">Trang chủ</a>
                    <a href="#" class="text-gray-700 hover:text-primary transition">Sản phẩm</a>
                    <a href="#" class="text-gray-700 hover:text-primary transition">Thương hiệu</a>
                    <a href="#" class="text-gray-700 hover:text-primary transition">Tin tức</a>
                    <a href="#" class="text-gray-700 hover:text-primary transition">Liên hệ</a>
                </nav>

                <!-- User Actions -->
                <div class="flex items-center space-x-4">
                    <button class="text-gray-700 hover:text-primary transition">
                        <i class="fas fa-search text-lg"></i>
                    </button>
                    <button class="text-gray-700 hover:text-primary transition relative">
                        <i class="fas fa-heart text-lg"></i>
                        <span
                            class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
                    </button>
                    <button class="text-gray-700 hover:text-primary transition relative">
                        <i class="fas fa-shopping-cart text-lg"></i>
                        <span
                            class="absolute -top-2 -right-2 bg-primary text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">2</span>
                    </button>
                    <button class="text-gray-700 hover:text-primary transition">
                        <i class="fas fa-user text-lg"></i>
                    </button>
                </div>
            </div>
        </div>
    </header>

    <!-- Breadcrumb -->
    <div class="bg-gray-100 py-4">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 text-sm">
                <a href="#" class="text-gray-600 hover:text-primary">Trang chủ</a>
                <i class="fas fa-chevron-right text-gray-400"></i>
                <a href="#" class="text-gray-600 hover:text-primary">Laptop</a>
                <i class="fas fa-chevron-right text-gray-400"></i>
                <a href="#" class="text-gray-600 hover:text-primary">{{ $product['brand'] }}</a>
                <i class="fas fa-chevron-right text-gray-400"></i>
                <span class="text-gray-800">{{ $product['name'] }}</span>
            </nav>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Product Images -->
            <div class="space-y-4">
                <!-- Main Image -->
                <div class="aspect-square bg-white rounded-lg shadow-md overflow-hidden">
                    <img id="mainImage" src="{{ $product['images'][0] }}" alt="{{ $product['name'] }}"
                        class="w-full h-full object-cover">
                </div>

                <!-- Thumbnail Images -->
                <div class="grid grid-cols-4 gap-2">
                    @foreach ($product['images'] as $index => $image)
                        <div class="aspect-square bg-white rounded-lg shadow-sm overflow-hidden cursor-pointer hover:ring-2 hover:ring-primary transition thumbnail {{ $index === 0 ? 'ring-2 ring-primary' : '' }}"
                            onclick="changeMainImage('{{ $image }}', this)">
                            <img src="{{ $image }}" alt="Thumbnail {{ $index + 1 }}"
                                class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Product Info -->
            <div class="space-y-6">
                <!-- Basic Info -->
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $product['name'] }}</h1>
                    <div class="flex items-center space-x-4 mb-4">
                        <div class="flex items-center">
                            @for ($i = 1; $i <= 5; $i++)
                                <i
                                    class="fas fa-star {{ $i <= floor($product['rating']) ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                            @endfor
                            <span class="ml-2 text-sm text-gray-600">({{ $product['review_count'] }} đánh giá)</span>
                        </div>
                        <span class="text-sm text-green-600 font-medium">
                            <i class="fas fa-check-circle mr-1"></i>Còn {{ $product['stock'] }} sản phẩm
                        </span>
                    </div>

                    <!-- Price -->
                    <div class="flex items-center space-x-4 mb-6">
                        <span class="text-3xl font-bold text-red-500"
                            id="currentPrice">{{ number_format($product['price']) }}đ</span>
                        <span
                            class="text-xl text-gray-500 line-through">{{ number_format($product['original_price']) }}đ</span>
                        <span class="bg-red-100 text-red-600 px-2 py-1 rounded-full text-sm font-medium">
                            -{{ $product['discount'] }}%
                        </span>
                    </div>
                </div>

                <!-- Options -->
                <div class="space-y-4">
                    <!-- Memory Options -->
                    <div>
                        <h3 class="text-lg font-semibold mb-3">Bộ nhớ:</h3>
                        <div class="grid grid-cols-1 gap-2">
                            @foreach ($product['memory_options'] as $index => $option)
                                <label
                                    class="flex items-center justify-between p-3 border-2 rounded-lg cursor-pointer hover:border-primary transition memory-option {{ $index === 0 ? 'border-primary bg-blue-50' : 'border-gray-200' }}">
                                    <input type="radio" name="memory" value="{{ $option['value'] }}" class="hidden"
                                        {{ $index === 0 ? 'checked' : '' }} data-price="{{ $option['price'] }}">
                                    <span class="font-medium">{{ $option['label'] }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Storage Options -->
                    <div>
                        <h3 class="text-lg font-semibold mb-3">Dung lượng lưu trữ:</h3>
                        <div class="grid grid-cols-1 gap-2">
                            @foreach ($product['storage_options'] as $index => $option)
                                <label
                                    class="flex items-center justify-between p-3 border-2 rounded-lg cursor-pointer hover:border-primary transition storage-option {{ $index === 0 ? 'border-primary bg-blue-50' : 'border-gray-200' }}">
                                    <input type="radio" name="storage" value="{{ $option['value'] }}" class="hidden"
                                        {{ $index === 0 ? 'checked' : '' }} data-price="{{ $option['price'] }}">
                                    <span class="font-medium">{{ $option['label'] }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Color Options -->
                    <div>
                        <h3 class="text-lg font-semibold mb-3">Màu sắc:</h3>
                        <div class="flex space-x-3">
                            @foreach ($product['colors'] as $index => $color)
                                <label
                                    class="cursor-pointer color-option {{ $index === 0 ? 'ring-2 ring-primary' : '' }}">
                                    <input type="radio" name="color" value="{{ $color['value'] }}" class="hidden"
                                        {{ $index === 0 ? 'checked' : '' }}>
                                    <div class="w-10 h-10 rounded-full border-2 border-gray-300"
                                        style="background-color: {{ $color['hex'] }}" title="{{ $color['name'] }}">
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Quantity -->
                <div>
                    <h3 class="text-lg font-semibold mb-3">Số lượng:</h3>
                    <div class="flex items-center space-x-3">
                        <button onclick="changeQuantity(-1)"
                            class="w-10 h-10 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                            <i class="fas fa-minus"></i>
                        </button>
                        <input type="number" id="quantity" value="1" min="1"
                            max="{{ $product['stock'] }}"
                            class="w-20 h-10 text-center border border-gray-300 rounded-lg">
                        <button onclick="changeQuantity(1)"
                            class="w-10 h-10 bg-gray-200 rounded-lg hover:bg-gray-300 transition">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="space-y-3">
                    <button onclick="addToCart()"
                        class="w-full bg-primary text-white py-3 rounded-lg font-semibold hover:bg-secondary transition">
                        <i class="fas fa-shopping-cart mr-2"></i>Thêm vào giỏ hàng
                    </button>
                    <div class="grid grid-cols-2 gap-3">
                        <button onclick="buyNow()"
                            class="bg-red-500 text-white py-3 rounded-lg font-semibold hover:bg-red-600 transition">
                            <i class="fas fa-bolt mr-2"></i>Mua ngay
                        </button>
                        <button onclick="toggleWishlist()"
                            class="border-2 border-gray-300 text-gray-700 py-3 rounded-lg font-semibold hover:border-red-500 hover:text-red-500 transition">
                            <i class="far fa-heart mr-2" id="wishlistIcon"></i>Yêu thích
                        </button>
                    </div>
                </div>

                <!-- Quick Info -->
                <div class="bg-blue-50 p-4 rounded-lg">
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        <div class="flex items-center">
                            <i class="fas fa-shipping-fast text-blue-500 mr-2"></i>
                            <span>Giao hàng miễn phí</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-shield-alt text-blue-500 mr-2"></i>
                            <span>Bảo hành 12 tháng</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-undo text-blue-500 mr-2"></i>
                            <span>Đổi trả 7 ngày</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-headset text-blue-500 mr-2"></i>
                            <span>Hỗ trợ 24/7</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Details Tabs -->
        <div class="mt-12">
            <div class="border-b border-gray-200">
                <nav class="flex space-x-8">
                    <button onclick="showTab('description')"
                        class="tab-button py-4 px-1 border-b-2 border-primary text-primary font-medium">
                        Mô tả sản phẩm
                    </button>
                    <button onclick="showTab('specifications')"
                        class="tab-button py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700">
                        Thông số kỹ thuật
                    </button>
                    <button onclick="showTab('reviews')"
                        class="tab-button py-4 px-1 border-b-2 border-transparent text-gray-500 hover:text-gray-700">
                        Đánh giá ({{ $product['review_count'] }})
                    </button>
                </nav>
            </div>

            <div class="py-6">
                <!-- Description Tab -->
                <div id="description" class="tab-content">
                    <div class="prose max-w-none">
                        <p class="text-gray-700 leading-relaxed">{{ $product['description'] }}</p>
                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-bold text-lg mb-3">Tính năng nổi bật:</h4>
                                <ul class="space-y-2">
                                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Chip
                                        M3 Max hiệu suất cao</li>
                                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Màn
                                        hình Liquid Retina XDR</li>
                                    <li class="flex items-center"><i class="fas fa-check text-green-500 mr-2"></i>Pin
                                        sử dụng lên đến 18 giờ</li>
                                    <li class="flex items-center"><i
                                            class="fas fa-check text-green-500 mr-2"></i>Thiết kế mỏng nhẹ</li>
                                </ul>
                            </div>
                            <div>
                                <h4 class="font-bold text-lg mb-3">Phù hợp cho:</h4>
                                <ul class="space-y-2">
                                    <li class="flex items-center"><i
                                            class="fas fa-paint-brush text-blue-500 mr-2"></i>Thiết kế đồ họa</li>
                                    <li class="flex items-center"><i class="fas fa-video text-blue-500 mr-2"></i>Chỉnh
                                        sửa video</li>
                                    <li class="flex items-center"><i class="fas fa-code text-blue-500 mr-2"></i>Lập
                                        trình</li>
                                    <li class="flex items-center"><i
                                            class="fas fa-briefcase text-blue-500 mr-2"></i>Công việc văn phòng</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Specifications Tab -->
                <div id="specifications" class="tab-content hidden">
                    <div class="bg-white rounded-lg shadow-sm">
                        <table class="w-full">
                            @foreach ($product['specifications'] as $key => $value)
                                <tr class="border-b border-gray-100">
                                    <td class="py-4 px-6 bg-gray-50 font-medium text-gray-700 w-1/3">
                                        {{ $key }}</td>
                                    <td class="py-4 px-6 text-gray-900">{{ $value }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <!-- Reviews Tab -->
                <div id="reviews" class="tab-content hidden">
                    <div class="space-y-6">
                        <!-- Review Summary -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="text-center">
                                    <div class="text-4xl font-bold text-gray-900 mb-2">{{ $product['rating'] }}</div>
                                    <div class="flex justify-center mb-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <i
                                                class="fas fa-star {{ $i <= floor($product['rating']) ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                        @endfor
                                    </div>
                                    <p class="text-gray-600">{{ $product['review_count'] }} đánh giá</p>
                                </div>
                                <div class="space-y-2">
                                    @for ($i = 5; $i >= 1; $i--)
                                        <div class="flex items-center">
                                            <span class="text-sm w-2">{{ $i }}</span>
                                            <i class="fas fa-star text-yellow-400 mx-2"></i>
                                            <div class="flex-1 h-2 bg-gray-200 rounded">
                                                <div class="h-2 bg-yellow-400 rounded"
                                                    style="width: {{ $i == 5 ? '70%' : ($i == 4 ? '20%' : '5%') }}">
                                                </div>
                                            </div>
                                            <span
                                                class="text-sm ml-2 w-8">{{ $i == 5 ? '70%' : ($i == 4 ? '20%' : '5%') }}</span>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                        </div>

                        <!-- Write Review -->
                        <div class="bg-white rounded-lg shadow-sm p-6">
                            <h3 class="text-lg font-semibold mb-4">Viết đánh giá</h3>
                            <form onsubmit="submitReview(event)">
                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-sm font-medium mb-2">Đánh giá của bạn:</label>
                                        <div class="flex space-x-1">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <button type="button" onclick="setRating({{ $i }})"
                                                    class="rating-star text-2xl text-gray-300 hover:text-yellow-400 transition">
                                                    <i class="fas fa-star"></i>
                                                </button>
                                            @endfor
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium mb-2">Nhận xét:</label>
                                        <textarea class="w-full p-3 border border-gray-300 rounded-lg" rows="4"
                                            placeholder="Chia sẻ trải nghiệm của bạn về sản phẩm..."></textarea>
                                    </div>
                                    <button type="submit"
                                        class="bg-primary text-white px-6 py-2 rounded-lg hover:bg-secondary transition">
                                        Gửi đánh giá
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Reviews List -->
                        <div class="space-y-4">
                            @foreach ($reviews as $review)
                                <div class="bg-white rounded-lg shadow-sm p-6">
                                    <div class="flex items-start justify-between mb-3">
                                        <div>
                                            <h4 class="font-semibold">{{ $review['user'] }}</h4>
                                            <div class="flex items-center mt-1">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    <i
                                                        class="fas fa-star {{ $i <= $review['rating'] ? 'text-yellow-400' : 'text-gray-300' }} text-sm"></i>
                                                @endfor
                                                <span
                                                    class="text-sm text-gray-500 ml-2">{{ date('d/m/Y', strtotime($review['date'])) }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="text-gray-700">{{ $review['comment'] }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-6">Sản phẩm liên quan</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($relatedProducts as $relatedProduct)
                    <div class="bg-white rounded-lg shadow-sm hover:shadow-md transition group">
                        <div class="aspect-square overflow-hidden rounded-t-lg">
                            <img src="{{ $relatedProduct['image'] }}" alt="{{ $relatedProduct['name'] }}"
                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                        </div>
                        <div class="p-4">
                            <h3 class="font-semibold text-gray-900 mb-2 line-clamp-2">{{ $relatedProduct['name'] }}
                            </h3>
                            <div class="flex items-center mb-2">
                                @for ($i = 1; $i <= 5; $i++)
                                    <i
                                        class="fas fa-star {{ $i <= floor($relatedProduct['rating']) ? 'text-yellow-400' : 'text-gray-300' }} text-sm"></i>
                                @endfor
                                <span class="text-xs text-gray-500 ml-1">({{ $relatedProduct['rating'] }})</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <span
                                        class="text-lg font-bold text-red-500">{{ number_format($relatedProduct['price']) }}đ</span>
                                    <div class="text-sm text-gray-500 line-through">
                                        {{ number_format($relatedProduct['original_price']) }}đ</div>
                                </div>
                                <button class="bg-primary text-white p-2 rounded-lg hover:bg-secondary transition">
                                    <i class="fas fa-shopping-cart"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white mt-16">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <div class="text-2xl font-bold mb-4">
                        <i class="fas fa-laptop mr-2"></i>LaptopStore
                    </div>
                    <p class="text-gray-300 mb-4">Chuyên cung cấp laptop chính hãng với giá tốt nhất thị trường. Uy tín
                        - Chất lượng - Bảo hành tốt.</p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-300 hover:text-white transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="text-gray-300 hover:text-white transition">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Liên kết nhanh</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Trang chủ</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Sản phẩm</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Thương hiệu</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Tin tức</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Liên hệ</a></li>
                    </ul>
                </div>

                <!-- Customer Service -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Dịch vụ khách hàng</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Chính sách bảo
                                hành</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Chính sách đổi trả</a>
                        </li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Hướng dẫn mua hàng</a>
                        </li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Phương thức thanh
                                toán</a></li>
                        <li><a href="#" class="text-gray-300 hover:text-white transition">Vận chuyển</a></li>
                    </ul>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-semibold mb-4">Thông tin liên hệ</h3>
                    <div class="space-y-3">
                        <div class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-3"></i>
                            <span class="text-gray-300">123 Đường ABC, Quận 1, TP.HCM</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-phone mr-3"></i>
                            <span class="text-gray-300">0901 234 567</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-envelope mr-3"></i>
                            <span class="text-gray-300">info@laptopstore.com</span>
                        </div>
                        <div class="flex items-center">
                            <i class="fas fa-clock mr-3"></i>
                            <span class="text-gray-300">8:00 - 22:00 (Thứ 2 - CN)</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-t border-gray-700 mt-8 pt-8 text-center">
                <p class="text-gray-300">&copy; 2024 LaptopStore. Tất cả quyền được bảo lưu.</p>
            </div>
        </div>
    </footer>

    <!-- JavaScript -->
    <script>
        let basePrice = {{ $product['price'] }};
        let currentMemoryPrice = 0;
        let currentStoragePrice = 0;
        let currentRating = 0;

        // Change main image
        function changeMainImage(src, element) {
            document.getElementById('mainImage').src = src;

            // Update active thumbnail
            document.querySelectorAll('.thumbnail').forEach(thumb => {
                thumb.classList.remove('ring-2', 'ring-primary');
            });
            element.classList.add('ring-2', 'ring-primary');
        }

        // Handle option selections
        document.addEventListener('DOMContentLoaded', function() {
            // Memory options
            document.querySelectorAll('.memory-option').forEach(option => {
                option.addEventListener('click', function() {
                    document.querySelectorAll('.memory-option').forEach(opt => {
                        opt.classList.remove('border-primary', 'bg-blue-50');
                        opt.classList.add('border-gray-200');
                    });
                    this.classList.add('border-primary', 'bg-blue-50');
                    this.classList.remove('border-gray-200');

                    const input = this.querySelector('input');
                    input.checked = true;
                    currentMemoryPrice = parseInt(input.dataset.price);
                    updatePrice();
                });
            });

            // Storage options
            document.querySelectorAll('.storage-option').forEach(option => {
                option.addEventListener('click', function() {
                    document.querySelectorAll('.storage-option').forEach(opt => {
                        opt.classList.remove('border-primary', 'bg-blue-50');
                        opt.classList.add('border-gray-200');
                    });
                    this.classList.add('border-primary', 'bg-blue-50');
                    this.classList.remove('border-gray-200');

                    const input = this.querySelector('input');
                    input.checked = true;
                    currentStoragePrice = parseInt(input.dataset.price);
                    updatePrice();
                });
            });

            // Color options
            document.querySelectorAll('.color-option').forEach(option => {
                option.addEventListener('click', function() {
                    document.querySelectorAll('.color-option').forEach(opt => {
                        opt.classList.remove('ring-2', 'ring-primary');
                    });
                    this.classList.add('ring-2', 'ring-primary');

                    const input = this.querySelector('input');
                    input.checked = true;
                });
            });
        });

        // Update price based on selected options
        function updatePrice() {
            const totalPrice = basePrice + currentMemoryPrice + currentStoragePrice;
            document.getElementById('currentPrice').textContent = totalPrice.toLocaleString('vi-VN') + 'đ';
        }

        // Quantity controls
        function changeQuantity(delta) {
            const quantityInput = document.getElementById('quantity');
            let currentQuantity = parseInt(quantityInput.value);
            let newQuantity = currentQuantity + delta;

            if (newQuantity >= 1 && newQuantity <= {{ $product['stock'] }}) {
                quantityInput.value = newQuantity;
            }
        }

        // Tab functionality
        function showTab(tabName) {
            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(content => {
                content.classList.add('hidden');
            });

            // Remove active state from all tab buttons
            document.querySelectorAll('.tab-button').forEach(button => {
                button.classList.remove('border-primary', 'text-primary');
                button.classList.add('border-transparent', 'text-gray-500');
            });

            // Show selected tab content
            document.getElementById(tabName).classList.remove('hidden');

            // Add active state to clicked tab button
            event.target.classList.add('border-primary', 'text-primary');
            event.target.classList.remove('border-transparent', 'text-gray-500');
        }

        // Rating functionality
        function setRating(rating) {
            currentRating = rating;
            const stars = document.querySelectorAll('.rating-star');
            stars.forEach((star, index) => {
                const icon = star.querySelector('i');
                if (index < rating) {
                    icon.classList.remove('text-gray-300');
                    icon.classList.add('text-yellow-400');
                } else {
                    icon.classList.remove('text-yellow-400');
                    icon.classList.add('text-gray-300');
                }
            });
        }

        // Actions
        function addToCart() {
            const selectedMemory = document.querySelector('input[name="memory"]:checked').value;
            const selectedStorage = document.querySelector('input[name="storage"]:checked').value;
            const selectedColor = document.querySelector('input[name="color"]:checked').value;
            const quantity = document.getElementById('quantity').value;

            alert(
                `Đã thêm vào giỏ hàng:\n- Sản phẩm: {{ $product['name'] }}\n- Bộ nhớ: ${selectedMemory}\n- Lưu trữ: ${selectedStorage}\n- Màu sắc: ${selectedColor}\n- Số lượng: ${quantity}`);
        }

        function buyNow() {
            addToCart();
            alert('Chuyển đến trang thanh toán...');
        }

        function toggleWishlist() {
            const icon = document.getElementById('wishlistIcon');
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                alert('Đã thêm vào danh sách yêu thích!');
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                alert('Đã xóa khỏi danh sách yêu thích!');
            }
        }

        function submitReview(event) {
            event.preventDefault();
            const textarea = event.target.querySelector('textarea');
            const comment = textarea.value.trim();

            if (currentRating === 0) {
                alert('Vui lòng chọn số sao đánh giá!');
                return;
            }

            if (comment === '') {
                alert('Vui lòng nhập nhận xét!');
                return;
            }

            alert(`Cảm ơn bạn đã đánh giá!\nSố sao: ${currentRating}\nNhận xét: ${comment}`);

            // Reset form
            textarea.value = '';
            setRating(0);
            currentRating = 0;
        }

        // Smooth scroll for internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Back to top functionality
        window.addEventListener('scroll', function() {
            const backToTop = document.getElementById('backToTop');
            if (backToTop) {
                if (window.pageYOffset > 300) {
                    backToTop.style.display = 'flex';
                } else {
                    backToTop.style.display = 'none';
                }
            }
        });
    </script>

    <!-- Back to top button -->
    <button id="backToTop" onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
        class="fixed bottom-6 right-6 bg-primary text-white w-12 h-12 rounded-full shadow-lg hover:bg-secondary transition duration-300 items-center justify-center hidden z-50">
        <i class="fas fa-chevron-up"></i>
    </button>

    <!-- Loading overlay (optional) -->
    <div id="loadingOverlay"
        class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-lg p-6 flex items-center space-x-3">
            <div class="animate-spin rounded-full h-6 w-6 border-b-2 border-primary"></div>
            <span>Đang xử lý...</span>
        </div>
    </div>
</body>

</html>
