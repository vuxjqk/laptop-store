@extends('layouts.admin')

@section('title', 'Quản lý biến thể sản phẩm')

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
                <li class="text-gray-500">Biến thể</li>
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

            <!-- Search and Add Variant -->
            <div class="flex items-center justify-between mb-4">
                <div class="relative w-full max-w-md">
                    <input type="text" id="search" placeholder="Tìm kiếm biến thể (RAM, bộ nhớ, màu sắc)..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <button id="addVariantBtn"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <i class="fas fa-plus mr-2"></i>Thêm biến thể
                </button>
            </div>

            <!-- Variants Table -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-800"><i class="fas fa-cubes text-blue-600 mr-2"></i>Danh sách
                        biến thể</h2>
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
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200">
                        <thead>
                            <tr class="bg-gray-100">
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700"></th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">RAM</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Bộ nhớ</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Màu sắc</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Giá</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Giá gốc</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Tồn kho</th>
                                <th class="px-4 py-2 text-left text-sm font-medium text-gray-700">Hành động</th>
                            </tr>
                        </thead>
                        <tbody id="variantsTable">
                            @foreach ($product->variants as $variant)
                                <tr class="variant-row border-t" data-ram="{{ strtolower($variant->ram->size) }}"
                                    data-storage="{{ strtolower($variant->storage->capacity) }}"
                                    data-color="{{ strtolower($variant->color->name) }}">
                                    <td class="px-4 py-2">
                                        <input type="checkbox" name="variant_ids[]" value="{{ $variant->id }}"
                                            class="variant-checkbox form-checkbox h-5 w-5 text-blue-600">
                                    </td>
                                    <td class="px-4 py-2 text-gray-600">{{ $variant->ram->size }}</td>
                                    <td class="px-4 py-2 text-gray-600">{{ $variant->storage->capacity }}</td>
                                    <td class="px-4 py-2 text-gray-600">
                                        <span class="inline-block w-4 h-4 rounded-full mr-2"
                                            style="background-color: {{ $variant->color->hex_code }}"></span>
                                        {{ $variant->color->name }}
                                    </td>
                                    <td class="px-4 py-2">
                                        <input type="number" data-id="{{ $variant->id }}" data-field="price"
                                            value="{{ $variant->price }}"
                                            class="w-full border border-gray-300 rounded-lg p-1 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            step="0.01" min="0">
                                    </td>
                                    <td class="px-4 py-2">
                                        <input type="number" data-id="{{ $variant->id }}" data-field="original_price"
                                            value="{{ $variant->original_price }}"
                                            class="w-full border border-gray-300 rounded-lg p-1 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            step="0.01" min="0">
                                    </td>
                                    <td class="px-4 py-2">
                                        <input type="number" data-id="{{ $variant->id }}" data-field="stock_quantity"
                                            value="{{ $variant->stock_quantity }}"
                                            class="w-full border border-gray-300 rounded-lg p-1 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                            min="0">
                                    </td>
                                    <td class="px-4 py-2">
                                        <button onclick="deleteVariant({{ $variant->id }})"
                                            class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Add Variant Modal -->
        <div id="addVariantModal"
            class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-lg max-h-full overflow-y-auto">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Thêm biến thể mới</h2>
                <form id="addVariantForm" method="POST" action="{{ route('product-variants.store') }}">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="mb-4">
                        <label for="ram_id" class="block text-sm font-medium text-gray-700">RAM</label>
                        <select name="ram_id" id="ram_id"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Chọn RAM</option>
                            @foreach ($rams as $ram)
                                <option value="{{ $ram->id }}">{{ $ram->size }}</option>
                            @endforeach
                            <option value="new">Thêm RAM mới...</option>
                        </select>
                        <input type="text" name="new_ram" id="new_ram"
                            placeholder="Nhập kích thước RAM mới (e.g., 8GB)"
                            class="mt-2 w-full border border-gray-300 rounded-lg p-2 hidden">
                        <div id="ram_error" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>
                    <div class="mb-4">
                        <label for="storage_id" class="block text-sm font-medium text-gray-700">Bộ nhớ</label>
                        <select name="storage_id" id="storage_id"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Chọn bộ nhớ</option>
                            @foreach ($storages as $storage)
                                <option value="{{ $storage->id }}">{{ $storage->capacity }}</option>
                            @endforeach
                            <option value="new">Thêm bộ nhớ mới...</option>
                        </select>
                        <input type="text" name="new_storage" id="new_storage"
                            placeholder="Nhập dung lượng bộ nhớ mới (e.g., 256GB)"
                            class="mt-2 w-full border border-gray-300 rounded-lg p-2 hidden">
                        <div id="storage_error" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>
                    <div class="mb-4">
                        <label for="color_id" class="block text-sm font-medium text-gray-700">Màu sắc</label>
                        <select name="color_id" id="color_id"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Chọn màu sắc</option>
                            @foreach ($colors as $color)
                                <option value="{{ $color->id }}" data-hex="{{ $color->hex_code }}">
                                    {{ $color->name }}</option>
                            @endforeach
                            <option value="new">Thêm màu sắc mới...</option>
                        </select>
                        <div class="mt-2 hidden" id="new_color_inputs">
                            <input type="text" name="new_color_name" id="new_color_name"
                                placeholder="Nhập tên màu sắc (e.g., Đen)"
                                class="w-full border border-gray-300 rounded-lg p-2 mb-2">
                            <input type="color" name="new_color_hex" id="new_color_hex" value="#000000"
                                class="w-full h-12 border-2 border-gray-300 rounded-lg p-2 cursor-pointer focus:outline-none hover:ring-2 hover:ring-blue-400">
                        </div>
                        <div id="color_error" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>
                    <div class="mb-4">
                        <label for="price" class="block text-sm font-medium text-gray-700">Giá</label>
                        <input type="number" name="price" id="price" step="0.01" min="0"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        <div id="price_error" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>
                    <div class="mb-4">
                        <label for="original_price" class="block text-sm font-medium text-gray-700">Giá gốc</label>
                        <input type="number" name="original_price" id="original_price" step="0.01" min="0"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        <div id="original_price_error" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>
                    <div class="mb-4">
                        <label for="stock_quantity" class="block text-sm font-medium text-gray-700">Tồn kho</label>
                        <input type="number" name="stock_quantity" id="stock_quantity" min="0"
                            class="w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        <div id="stock_quantity_error" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>
                    <div class="mb-4">
                        <div id="general_error" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeAddVariantModal()"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">Hủy</button>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Thêm</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal"
            class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Xác nhận xoá</h2>
                <p class="text-gray-600 mb-6">Bạn có chắc chắn muốn xoá biến thể này? Hành động này không thể hoàn tác.</p>
                <div class="flex justify-end space-x-2">
                    <button onclick="closeDeleteModal()"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">Hủy</button>
                    <button id="confirmDelete"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">Xoá</button>
                </div>
            </div>
        </div>

        <!-- Delete Selected Confirmation Modal -->
        <div id="deleteSelectedModal"
            class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Xác nhận xoá</h2>
                <p class="text-gray-600 mb-6">Bạn có chắc chắn muốn xoá các biến thể đã chọn? Hành động này không thể hoàn
                    tác.</p>
                <div class="flex justify-end space-x-2">
                    <button onclick="closeDeleteSelectedModal()"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">Hủy</button>
                    <button id="confirmDeleteSelected"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">Xoá</button>
                </div>
            </div>
        </div>

        <!-- Toast Notification -->
        <div id="toast" class="fixed bottom-4 right-4 hidden p-4 rounded-lg shadow-lg">
            <p id="toast-message" class="text-white"></p>
        </div>
    </div>

    @push('scripts')
        <script>
            // Toast notification function
            function showToast(message, type = 'success') {
                const toast = document.getElementById('toast');
                const toastMessage = document.getElementById('toast-message');
                toastMessage.textContent = message;
                toast.className =
                    `fixed bottom-4 right-4 p-4 rounded-lg shadow-lg ${type === 'success' ? 'bg-green-600' : 'bg-red-600'}`;
                toast.classList.remove('hidden');
                setTimeout(() => toast.classList.add('hidden'), 3000);
            }

            // Search filter
            document.getElementById('search').addEventListener('input', function() {
                const searchTerm = this.value.toLowerCase();
                document.querySelectorAll('.variant-row').forEach(row => {
                    const ram = row.dataset.ram;
                    const storage = row.dataset.storage;
                    const color = row.dataset.color;
                    row.style.display = ram.includes(searchTerm) || storage.includes(searchTerm) || color
                        .includes(searchTerm) ? '' : 'none';
                });
            });

            // Add variant modal
            function openAddVariantModal() {
                document.getElementById('addVariantModal').classList.remove('hidden');
                document.getElementById('ram_id').value = '';
                document.getElementById('storage_id').value = '';
                document.getElementById('color_id').value = '';
                document.getElementById('new_ram').classList.add('hidden');
                document.getElementById('new_storage').classList.add('hidden');
                document.getElementById('new_color_inputs').classList.add('hidden');
                document.getElementById('price').value = '';
                document.getElementById('original_price').value = '';
                document.getElementById('stock_quantity').value = '';
                document.querySelectorAll('#addVariantModal .text-red-500').forEach(el => el.classList.add('hidden'));
            }

            function closeAddVariantModal() {
                document.getElementById('addVariantModal').classList.add('hidden');
            }

            document.getElementById('addVariantBtn').addEventListener('click', openAddVariantModal);

            // Toggle new RAM/storage/color inputs
            document.getElementById('ram_id').addEventListener('change', function() {
                document.getElementById('new_ram').classList.toggle('hidden', this.value !== 'new');
            });

            document.getElementById('storage_id').addEventListener('change', function() {
                document.getElementById('new_storage').classList.toggle('hidden', this.value !== 'new');
            });

            document.getElementById('color_id').addEventListener('change', function() {
                document.getElementById('new_color_inputs').classList.toggle('hidden', this.value !== 'new');
            });

            // Add variant form submission
            document.getElementById('addVariantForm').addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                document.querySelectorAll('#addVariantModal .text-red-500').forEach(el => el.classList.add('hidden'));

                fetch('{{ route('product-variants.store') }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status) {
                            showToast('Biến thể đã được thêm thành công.', 'success');
                            window.location.reload();
                        } else {
                            if (data.errors) {
                                if (data.errors.ram_id) document.getElementById('ram_error').textContent = data
                                    .errors.ram_id[0];
                                if (data.errors.new_ram) document.getElementById('ram_error').textContent = data
                                    .errors.new_ram[0];
                                if (data.errors.storage_id) document.getElementById('storage_error').textContent =
                                    data.errors.storage_id[0];
                                if (data.errors.new_storage) document.getElementById('storage_error').textContent =
                                    data.errors.new_storage[0];
                                if (data.errors.color_id) document.getElementById('color_error').textContent = data
                                    .errors.color_id[0];
                                if (data.errors.new_color_name) document.getElementById('color_error').textContent =
                                    data.errors.new_color_name[0];
                                if (data.errors.new_color_hex) document.getElementById('color_error').textContent =
                                    data.errors.new_color_hex[0];
                                if (data.errors.price) document.getElementById('price_error').textContent = data
                                    .errors.price[0];
                                if (data.errors.original_price) document.getElementById('original_price_error')
                                    .textContent = data.errors.original_price[0];
                                if (data.errors.stock_quantity) document.getElementById('stock_quantity_error')
                                    .textContent = data.errors.stock_quantity[0];
                                if (data.errors.general) document.getElementById('general_error')
                                    .textContent = data.errors.general;
                                document.querySelectorAll('#addVariantModal .text-red-500').forEach(el => {
                                    if (el.textContent) el.classList.remove('hidden');
                                });
                            } else {
                                showToast('Đã xảy ra lỗi khi thêm biến thể.', 'error');
                            }
                        }
                    })
                    .catch(error => {
                        showToast('Đã xảy ra lỗi: ' + error.message, 'error');
                    });
            });

            // Update variant fields
            document.querySelectorAll('#variantsTable input').forEach(input => {
                input.addEventListener('change', function() {
                    if (this.type === 'checkbox') {
                        return; // Nếu là checkbox, không thực hiện AJAX
                    }

                    const id = this.dataset.id;
                    const field = this.dataset.field;
                    const value = this.value;
                    const baseUrl = "{{ url('/') }}";

                    fetch(`${baseUrl}/product-variants/${id}`, {
                            method: 'PATCH',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                [field]: value
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status) {
                                showToast('Cập nhật biến thể thành công.', 'success');
                            } else {
                                showToast('Đã xảy ra lỗi khi cập nhật biến thể.', 'error');
                                this.value = this.defaultValue; // Revert on error
                            }
                        })
                        .catch(error => {
                            showToast('Đã xảy ra lỗi: ' + error.message, 'error');
                            this.value = this.defaultValue; // Revert on error
                        });
                });
            });

            // Select all checkbox
            const selectAllCheckbox = document.getElementById('selectAll');
            const variantCheckboxes = document.querySelectorAll('.variant-checkbox');
            const deleteButton = document.getElementById('deleteSelected');

            function updateSelectAllCheckbox() {
                const total = variantCheckboxes.length;
                const checked = Array.from(variantCheckboxes).filter(cb => cb.checked).length;

                if (checked === 0) {
                    selectAllCheckbox.checked = false;
                    selectAllCheckbox.indeterminate = false;
                } else if (checked === total) {
                    selectAllCheckbox.checked = true;
                    selectAllCheckbox.indeterminate = false;
                } else {
                    selectAllCheckbox.checked = false;
                    selectAllCheckbox.indeterminate = true;
                }
                deleteButton.disabled = !document.querySelector('.variant-checkbox:checked');
            }

            updateSelectAllCheckbox();

            selectAllCheckbox.addEventListener('change', function() {
                variantCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                deleteButton.disabled = !this.checked;
            });

            variantCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateSelectAllCheckbox();
                });
            });

            // Delete single variant
            let deleteVariantId = null;

            function deleteVariant(id) {
                deleteVariantId = id;
                document.getElementById('deleteModal').classList.remove('hidden');
            }

            function closeDeleteModal() {
                document.getElementById('deleteModal').classList.add('hidden');
                deleteVariantId = null;
            }

            document.getElementById('confirmDelete').addEventListener('click', function() {
                if (deleteVariantId) {
                    fetch(`{{ route('product-variants.destroy') }}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                variant_ids: [deleteVariantId]
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status) {
                                showToast('Biến thể đã được xoá thành công.', 'success');
                                window.location.reload();
                            } else {
                                showToast('Đã xảy ra lỗi khi xoá biến thể.', 'error');
                            }
                        })
                        .catch(error => {
                            showToast('Đã xảy ra lỗi: ' + error.message, 'error');
                        });
                    closeDeleteModal();
                }
            });

            // Delete selected variants
            function openDeleteSelectedModal() {
                document.getElementById('deleteSelectedModal').classList.remove('hidden');
            }

            function closeDeleteSelectedModal() {
                document.getElementById('deleteSelectedModal').classList.add('hidden');
            }

            document.getElementById('deleteSelected').addEventListener('click', function() {
                const selectedVariants = Array.from(document.querySelectorAll('.variant-checkbox:checked')).map(
                    checkbox => checkbox.value);
                if (selectedVariants.length > 0) {
                    openDeleteSelectedModal();
                }
            });

            document.getElementById('confirmDeleteSelected').addEventListener('click', function() {
                const selectedVariants = Array.from(document.querySelectorAll('.variant-checkbox:checked')).map(
                    checkbox => checkbox.value);
                if (selectedVariants.length > 0) {
                    fetch('{{ route('product-variants.destroy') }}', {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                            },
                            body: JSON.stringify({
                                variant_ids: selectedVariants
                            }),
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status) {
                                showToast('Các biến thể đã được xoá thành công.', 'success');
                                window.location.reload();
                            } else {
                                showToast('Đã xảy ra lỗi khi xoá các biến thể.', 'error');
                            }
                        })
                        .catch(error => {
                            showToast('Đã xảy ra lỗi: ' + error.message, 'error');
                        });
                    closeDeleteSelectedModal();
                }
            });
        </script>
    @endpush
@endsection
