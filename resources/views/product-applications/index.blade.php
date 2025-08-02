@extends('layouts.admin')

@section('title', 'Quản lý ứng dụng sản phẩm')

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
                <li class="text-gray-500">Ứng dụng</li>
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

            <!-- Add Application Button and Search -->
            <div class="flex items-center justify-between mb-4">
                <div class="relative w-full max-w-md">
                    <input type="text" id="search" placeholder="Tìm kiếm ứng dụng..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
                <button id="addApplicationBtn"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <i class="fas fa-plus mr-2"></i>Thêm ứng dụng
                </button>
            </div>

            <!-- Applications List -->
            <div class="mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-800"><i class="fas fa-rocket text-red-500 mr-2"></i>Danh sách ứng
                        dụng</h2>
                    <div class="flex items-center space-x-2">
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" id="selectAll" class="form-checkbox h-5 w-5 text-blue-600">
                            <span class="text-gray-700">Chọn tất cả</span>
                        </label>
                        <button id="confirmSelected"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                            <i class="fas fa-check mr-2"></i>Xác nhận
                        </button>
                    </div>
                </div>
                <div id="applicationsList" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach ($applications as $application)
                        <div class="application-item border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow"
                            data-name="{{ strtolower($application->name) }}">
                            <div class="flex items-center justify-between mb-2">
                                <div class="flex items-center space-x-3">
                                    <input type="checkbox" name="application_ids[]" value="{{ $application->id }}"
                                        class="application-checkbox form-checkbox h-5 w-5 text-blue-600"
                                        {{ $product->applications->contains($application->id) ? 'checked' : '' }}>
                                    <h3 class="font-medium text-gray-800">{{ $application->name }}</h3>
                                </div>
                                <div class="flex space-x-2">
                                    <button
                                        onclick="openEditModal({{ $application->id }}, '{{ $application->name }}', '{{ $application->description }}')"
                                        class="text-yellow-600 hover:text-yellow-800">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button onclick="openDeleteModal({{ $application->id }})"
                                        class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            <p class="text-sm text-gray-600">{{ $application->description ?: 'Không có mô tả' }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Add Application Modal -->
        <div id="addModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Thêm ứng dụng mới</h2>
                <form id="addApplicationForm" method="POST" action="{{ route('applications.store') }}">
                    @csrf
                    <div class="mb-4">
                        <label for="add_name" class="block text-sm font-medium text-gray-700">Tên ứng dụng</label>
                        <input type="text" name="name" id="add_name" value="{{ old('name') }}"
                            class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        <div id="add_name_error" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>
                    <div class="mb-4">
                        <label for="add_description" class="block text-sm font-medium text-gray-700">Mô tả</label>
                        <textarea name="description" id="add_description" rows="4"
                            class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                        <div id="add_description_error" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeAddModal()"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">Hủy</button>
                        <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Thêm</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Application Modal -->
        <div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Chỉnh sửa ứng dụng</h2>
                <form id="editApplicationForm" method="POST" action="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="application_id" id="edit_application_id">
                    <div class="mb-4">
                        <label for="edit_name" class="block text-sm font-medium text-gray-700">Tên ứng dụng</label>
                        <input type="text" name="name" id="edit_name"
                            class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        <div id="edit_name_error" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>
                    <div class="mb-4">
                        <label for="edit_description" class="block text-sm font-medium text-gray-700">Mô tả</label>
                        <textarea name="description" id="edit_description" rows="4"
                            class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"></textarea>
                        <div id="edit_description_error" class="text-red-500 text-sm mt-1 hidden"></div>
                    </div>
                    <div class="flex justify-end space-x-2">
                        <button type="button" onclick="closeEditModal()"
                            class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">Hủy</button>
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Cập
                            nhật</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal"
            class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Xác nhận xoá</h2>
                <p class="text-gray-600 mb-6">Bạn có chắc chắn muốn xoá ứng dụng này? Hành động này không thể hoàn tác.</p>
                <div class="flex justify-end space-x-2">
                    <button onclick="closeDeleteModal()"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">Hủy</button>
                    <button id="confirmDelete"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">Xoá</button>
                </div>
            </div>
        </div>

        <!-- Confirm Selected Modal -->
        <div id="confirmModal"
            class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Xác nhận cập nhật</h2>
                <p class="text-gray-600 mb-6">Bạn có chắc chắn muốn cập nhật danh sách ứng dụng cho sản phẩm này?</p>
                <div class="flex justify-end space-x-2">
                    <button onclick="closeConfirmModal()"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">Hủy</button>
                    <button id="confirmUpdate" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Xác
                        nhận</button>
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
                document.querySelectorAll('.application-item').forEach(item => {
                    const name = item.dataset.name;
                    item.style.display = name.includes(searchTerm) ? '' : 'none';
                });
            });

            // Add application modal
            function openAddModal() {
                document.getElementById('addModal').classList.remove('hidden');
                document.getElementById('add_name').value = '';
                document.getElementById('add_description').value = '';
                document.getElementById('add_name_error').classList.add('hidden');
                document.getElementById('add_description_error').classList.add('hidden');
            }

            function closeAddModal() {
                document.getElementById('addModal').classList.add('hidden');
            }

            document.getElementById('addApplicationBtn').addEventListener('click', openAddModal);

            document.getElementById('addApplicationForm').addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                const nameError = document.getElementById('add_name_error');
                const descError = document.getElementById('add_description_error');
                nameError.classList.add('hidden');
                descError.classList.add('hidden');

                fetch('{{ route('applications.store') }}', {
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
                            window.location.reload();
                        } else {
                            if (data.errors.name) nameError.textContent = data.errors.name[0];
                            if (data.errors.description) descError.textContent = data.errors.description[0];
                            nameError.classList.remove('hidden');
                            descError.classList.remove('hidden');
                        }
                    })
                    .catch(error => {
                        showToast('Đã xảy ra lỗi: ' + error.message, 'error');
                    });
            });

            // Edit application modal
            function openEditModal(id, name, description) {
                const form = document.getElementById('editApplicationForm');
                const baseUrl = "{{ url('/') }}";
                form.action = `${baseUrl}/applications/${id}`;
                document.getElementById('edit_application_id').value = id;
                document.getElementById('edit_name').value = name;
                document.getElementById('edit_description').value = description || '';
                document.getElementById('edit_name_error').classList.add('hidden');
                document.getElementById('edit_description_error').classList.add('hidden');
                document.getElementById('editModal').classList.remove('hidden');
            }

            function closeEditModal() {
                document.getElementById('editModal').classList.add('hidden');
            }

            document.getElementById('editApplicationForm').addEventListener('submit', function(event) {
                event.preventDefault();
                const formData = new FormData(this);
                const nameError = document.getElementById('edit_name_error');
                const descError = document.getElementById('edit_description_error');
                nameError.classList.add('hidden');
                descError.classList.add('hidden');

                fetch(this.action, {
                        method: 'POST', // Laravel uses POST with _method=PUT
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status) {
                            window.location.reload();
                        } else {
                            if (data.errors.name) nameError.textContent = data.errors.name[0];
                            if (data.errors.description) descError.textContent = data.errors.description[0];
                            nameError.classList.remove('hidden');
                            descError.classList.remove('hidden');
                        }
                    })
                    .catch(error => {
                        showToast('Đã xảy ra lỗi: ' + error.message, 'error');
                    });
            });

            // Delete single application
            let deleteApplicationId = null;

            function openDeleteModal(id) {
                deleteApplicationId = id;
                document.getElementById('deleteModal').classList.remove('hidden');
            }

            function closeDeleteModal() {
                document.getElementById('deleteModal').classList.add('hidden');
                deleteApplicationId = null;
            }

            document.getElementById('confirmDelete').addEventListener('click', function() {
                if (deleteApplicationId) {
                    const baseUrl = "{{ url('/') }}";
                    fetch(`${baseUrl}/applications/${deleteApplicationId}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status) {
                                window.location.reload();
                            } else {
                                showToast('Đã xảy ra lỗi khi xoá ứng dụng.', 'error');
                            }
                        })
                        .catch(error => {
                            showToast('Đã xảy ra lỗi: ' + error.message, 'error');
                        });
                    closeDeleteModal();
                }
            });

            // Confirm selected applications
            const selectAllCheckbox = document.getElementById('selectAll');
            const applicationCheckboxes = document.querySelectorAll('.application-checkbox');
            const confirmButton = document.getElementById('confirmSelected');

            // Check initial state of checkboxes on page load
            function updateSelectAllCheckbox() {
                const total = applicationCheckboxes.length;
                const checked = Array.from(applicationCheckboxes).filter(cb => cb.checked).length;

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
            }

            // Run on page load
            updateSelectAllCheckbox();

            selectAllCheckbox.addEventListener('change', function() {
                applicationCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
            });

            applicationCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', function() {
                    updateSelectAllCheckbox();
                });
            });

            function openConfirmModal() {
                document.getElementById('confirmModal').classList.remove('hidden');
            }

            function closeConfirmModal() {
                document.getElementById('confirmModal').classList.add('hidden');
            }

            document.getElementById('confirmSelected').addEventListener('click', function() {
                openConfirmModal();
            });

            document.getElementById('confirmUpdate').addEventListener('click', function() {
                const selectedApplications = Array.from(document.querySelectorAll('.application-checkbox:checked')).map(
                    checkbox => checkbox.value);
                fetch('{{ route('product-applications.update') }}', {
                        method: 'POST', // Laravel uses POST with _method=PUT
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                        },
                        body: JSON.stringify({
                            product_id: {{ $product->id }},
                            application_ids: selectedApplications,
                        }),
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status) {
                            window.location.reload();
                        } else {
                            let errorMessage = 'Đã xảy ra lỗi khi cập nhật danh sách ứng dụng.';
                            if (data.errors) {
                                if (data.errors.product_id) errorMessage = data.errors.product_id[0];
                                else if (data.errors.application_ids) errorMessage = data.errors.application_ids[0];
                            }
                            showToast(errorMessage, 'error');
                        }
                    })
                    .catch(error => {
                        showToast('Đã xảy ra lỗi: ' + error.message, 'error');
                    });
                closeConfirmModal();
            });
        </script>
    @endpush
@endsection
