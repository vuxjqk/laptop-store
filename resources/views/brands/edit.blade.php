@extends('layouts.admin')

@section('title', 'Chỉnh sửa thương hiệu')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Breadcrumb -->
        <nav class="flex items-center mb-6" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800"><i
                            class="fas fa-home"></i></a></li>
                <li><i class="fas fa-chevron-right text-gray-400"></i></li>
                <li><a href="{{ route('brands.index') }}" class="text-blue-600 hover:text-blue-800">Thương hiệu</a></li>
                <li><i class="fas fa-chevron-right text-gray-400"></i></li>
                <li class="text-gray-500">Chỉnh sửa</li>
            </ol>
        </nav>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6"><i class="fas fa-edit text-blue-600 mr-2"></i>Chỉnh sửa thương
                hiệu</h1>

            <form method="POST" action="{{ route('brands.update', $brand->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">Tên thương hiệu</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $brand->name) }}"
                            class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div>
                        <label for="slug" class="block text-sm font-medium text-gray-700">Slug</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug', $brand->slug) }}"
                            class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                            required>
                        @error('slug')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Description -->
                    <div class="md:col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Mô tả</label>
                        <textarea name="description" id="description" rows="4"
                            class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description', $brand->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div>
                        <label for="image" class="block text-sm font-medium text-gray-700">Logo</label>
                        <input type="file" name="image" id="image" accept="image/*"
                            class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <div id="image-preview" class="{{ $brand->logo ? '' : 'hidden' }} mt-2 relative">
                            <img id="preview-img" src="{{ $brand->logo ? asset('storage/' . $brand->logo) : '#' }}"
                                alt="Image Preview" class="h-24 w-auto rounded">
                            @if ($brand->logo)
                                <button type="button" onclick="removeImage()"
                                    class="absolute top-0 right-0 bg-red-600 text-white p-1 rounded-full">
                                    <i class="fas fa-trash"></i>
                                </button>
                                <input type="hidden" name="remove_image" id="remove_image" value="0">
                            @endif
                        </div>
                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label for="is_active" class="block text-sm font-medium text-gray-700">Trạng thái</label>
                        <select name="is_active" id="is_active"
                            class="mt-1 w-full border border-gray-300 rounded-lg p-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="1" {{ old('is_active', $brand->is_active) ? 'selected' : '' }}>Hoạt động
                            </option>
                            <option value="0" {{ old('is_active', $brand->is_active) ? '' : 'selected' }}>Không hoạt
                                động</option>
                        </select>
                    </div>
                </div>

                <div class="mt-6 flex justify-end space-x-2">
                    <a href="{{ route('brands.index') }}"
                        class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg">Hủy</a>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                        <i class="fas fa-save mr-2"></i>Cập nhật
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script>
            // Auto-generate slug from name
            document.getElementById('name').addEventListener('input', function() {
                const name = this.value;
                const slug = name.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/(^-|-$)/g, '');
                document.getElementById('slug').value = slug;
            });

            // Image preview
            document.getElementById('image').addEventListener('change', function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const preview = document.getElementById('image-preview');
                        const img = document.getElementById('preview-img');
                        img.src = e.target.result;
                        preview.classList.remove('hidden');
                        document.getElementById('remove_image').value = '0';
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Remove image
            function removeImage() {
                const preview = document.getElementById('image-preview');
                const img = document.getElementById('preview-img');
                img.src = '#';
                preview.classList.add('hidden');
                document.getElementById('remove_image').value = '1';
                document.getElementById('image').value = '';
            }
        </script>
    @endpush
@endsection
