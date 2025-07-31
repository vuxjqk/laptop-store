@extends('layouts.admin')

@section('title', 'Quản lý hình ảnh sản phẩm')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Breadcrumb -->
        <nav class="flex items-center mb-6" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800"><i
                            class="fas fa-home"></i></a></li>
                <li><i class="fas fa-chevron-right text-gray-400"></i></li>
                <li><a href="{{ route('products.index') }}" class="text-blue-600 hover:text-blue-800">Sản phẩm</a></li>
                <li><i class="fas fa-chevron-right text-gray-400"></i></li>
                <li><a href="{{ route('products.show', $product) }}"
                        class="text-blue-600 hover:text-blue-800">{{ $product->name }}</a></li>
                <li><i class="fas fa-chevron-right text-gray-400"></i></li>
                <li class="text-gray-500">Hình ảnh</li>
            </ol>
        </nav>

        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <!-- Product Header -->
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-4">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">{{ $product->name }}</h1>
                        <p class="text-gray-600">Thương hiệu: <span
                                class="font-medium text-blue-600">{{ $product->brand ? $product->brand->name : 'Không có thương hiệu' }}</span>
                        </p>
                        <p class="text-gray-600">Slug: <span class="font-medium">{{ $product->slug }}</span></p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <span
                        class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium {{ $product->is_active ? '' : 'bg-red-100 text-red-800' }}">
                        <i class="fas fa-check-circle mr-1"></i>{{ $product->is_active ? 'Hoạt động' : 'Không hoạt động' }}
                    </span>
                    <a href="{{ route('products.show', $product) }}"
                        class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>Quay lại sản phẩm
                    </a>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4 rounded" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <!-- Image Upload Section -->
            <div class="mb-6">
                <h2 class="text-xl font-bold text-gray-800 mb-4"><i class="fas fa-upload text-blue-600 mr-2"></i>Thêm hình
                    ảnh mới</h2>
                <form id="uploadForm" method="POST" action="{{ route('product-images.store') }}"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="mb-4">
                        <label for="images" class="block text-sm font-medium text-gray-700">Chọn hình ảnh</label>
                        <input type="file" name="images[]" id="images" multiple accept="image/*"
                            class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">

                        <p id="error-images" class="text-red-500 text-sm mt-1"></p>
                        <p id="error-images-dot" class="text-red-500 text-sm mt-1"></p>
                    </div>
                    <div id="image-preview" class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-4"></div>
                    <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        <i class="fas fa-upload mr-2"></i>Tải lên
                    </button>
                </form>
            </div>

            <!-- Existing Images Section -->
            <div>
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-800"><i class="fas fa-images text-purple-600 mr-2"></i>Hình ảnh
                        hiện có</h2>
                    <div class="flex items-center space-x-2">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" id="selectAll" class="form-checkbox h-5 w-5 text-blue-600">
                            <span class="text-gray-700">Chọn tất cả</span>
                        </label>
                        <button id="deleteSelected"
                            class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors disabled:opacity-50"
                            disabled>
                            <i class="fas fa-trash mr-2"></i>Xoá đã chọn
                        </button>
                    </div>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    @forelse ($images as $image)
                        <div class="relative bg-gray-100 rounded-lg overflow-hidden">
                            <input type="checkbox" name="image_ids[]" value="{{ $image->id }}"
                                class="image-checkbox absolute top-2 left-2 form-checkbox h-5 w-5 text-blue-600 z-20">
                            <img src="{{ asset('storage/' . $image->path) }}" alt="Product Image"
                                class="w-full h-48 object-cover hover:scale-105 transition-transform cursor-pointer z-10">
                        </div>
                    @empty
                        <p class="text-gray-600 col-span-full">Chưa có hình ảnh nào cho sản phẩm này.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Xác nhận xoá</h2>
                <p class="text-gray-600 mb-6">Bạn có chắc chắn muốn xoá các hình ảnh đã chọn? Hành động này không thể hoàn
                    tác.</p>
                <div class="flex justify-end space-x-2">
                    <button onclick="closeDeleteModal()"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">Hủy</button>
                    <button id="confirmDelete"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">Xoá</button>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Image preview
            document.getElementById('images').addEventListener('change', function(event) {
                const previewContainer = document.getElementById('image-preview');
                previewContainer.innerHTML = '';
                const files = event.target.files;
                for (const file of files) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.className = 'h-48 w-full object-cover rounded-lg';
                        previewContainer.appendChild(img);
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Upload images via AJAX
            document.getElementById('uploadForm').addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                fetch('{{ route('product-images.store') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                    })
                    .then(response => {
                        if (!response.ok) {
                            return response.json().then(data => {
                                document.getElementById('error-images').innerText = '';
                                document.getElementById('error-images-dot').innerText = '';

                                if (data.errors) {
                                    if (data.errors.images) {
                                        document.getElementById('error-images').innerText = data.errors
                                            .images[0];
                                    }

                                    if (data.errors['images.*']) {
                                        document.getElementById('error-images-dot').innerText = data.errors[
                                            'images.*'][0];
                                    }
                                }
                            })
                        } else {
                            return response.json().then(
                                data => {
                                    window.location.reload();
                                }
                            )
                        }
                    })
            });

            // Select all checkbox functionality
            const selectAllCheckbox = document.getElementById('selectAll');
            const imageCheckboxes = document.querySelectorAll('.image-checkbox');
            const deleteButton = document.getElementById('deleteSelected');

            selectAllCheckbox.addEventListener('change', function() {
                imageCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                updateDeleteButtonState();
            });

            imageCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateDeleteButtonState();
                    if (!this.checked) {
                        selectAllCheckbox.checked = false;
                    } else if (document.querySelectorAll('.image-checkbox:checked').length === imageCheckboxes
                        .length) {
                        selectAllCheckbox.checked = true;
                    }
                });
            });

            function updateDeleteButtonState() {
                deleteButton.disabled = !document.querySelector('.image-checkbox:checked');
            }

            // Delete selected images
            function openDeleteModal() {
                document.getElementById('deleteModal').classList.remove('hidden');
            }

            function closeDeleteModal() {
                document.getElementById('deleteModal').classList.add('hidden');
            }

            document.getElementById('deleteSelected').addEventListener('click', function() {
                const selectedImages = Array.from(document.querySelectorAll('.image-checkbox:checked')).map(checkbox =>
                    checkbox.value);
                if (selectedImages.length > 0) {
                    openDeleteModal();
                }
            });

            document.getElementById('confirmDelete').addEventListener('click', function() {
                const selectedImages = Array.from(document.querySelectorAll('.image-checkbox:checked')).map(checkbox =>
                    checkbox.value);
                if (selectedImages.length > 0) {
                    fetch('{{ route('product-images.destroy') }}', {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                image_ids: selectedImages
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status) {
                                window.location.reload();
                            } else {
                                alert('Đã xảy ra lỗi khi xoá hình ảnh.');
                            }
                        })
                        .catch(error => {
                            alert('Đã xảy ra lỗi: ' + error.message);
                        });
                    closeDeleteModal();
                }
            });
        </script>
    @endpush
@endsection
