@extends('layouts.admin')

@section('title', 'Danh sách thương hiệu')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Breadcrumb -->
        <nav class="flex items-center mb-6" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="{{ route('dashboard') }}" class="text-blue-600 hover:text-blue-800"><i
                            class="fas fa-home"></i></a></li>
                <li><i class="fas fa-chevron-right text-gray-400"></i></li>
                <li class="text-gray-500">Thương hiệu</li>
            </ol>
        </nav>

        <!-- Header and Search -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <div class="flex items-center justify-between mb-4">
                <h1 class="text-2xl font-bold text-gray-800">Quản lý thương hiệu</h1>
                <a href="{{ route('brands.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                    <i class="fas fa-plus mr-2"></i>Thêm thương hiệu
                </a>
            </div>

            <!-- Search Form -->
            <form method="GET" action="{{ route('brands.index') }}" class="mb-4">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Tìm kiếm theo tên hoặc slug..."
                        class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                </div>
            </form>

            <!-- Brands Table -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white rounded-lg">
                    <thead>
                        <tr class="border-b">
                            <th class="py-3 px-4 text-left text-gray-600 font-medium">Logo</th>
                            <th class="py-3 px-4 text-left text-gray-600 font-medium">Tên</th>
                            <th class="py-3 px-4 text-left text-gray-600 font-medium">Slug</th>
                            <th class="py-3 px-4 text-left text-gray-600 font-medium">Trạng thái</th>
                            <th class="py-3 px-4 text-left text-gray-600 font-medium">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($brands as $brand)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-3 px-4">
                                    @if ($brand->logo)
                                        <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}"
                                            class="h-10 w-auto rounded">
                                    @else
                                        <span class="text-gray-400">Không có logo</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4">{{ $brand->name }}</td>
                                <td class="py-3 px-4">{{ $brand->slug }}</td>
                                <td class="py-3 px-4">
                                    <span
                                        class="px-2 py-1 rounded-full text-sm font-medium {{ $brand->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $brand->is_active ? 'Hoạt động' : 'Không hoạt động' }}
                                    </span>
                                </td>
                                <td class="py-3 px-4 flex space-x-2">
                                    <a href="{{ route('brands.show', $brand->id) }}"
                                        class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('brands.edit', $brand->id) }}"
                                        class="text-yellow-600 hover:text-yellow-800">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button onclick="openDeleteModal({{ $brand->id }})"
                                        class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-3 px-4 text-center text-gray-500">Không tìm thấy thương hiệu
                                    nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $brands->links('pagination::tailwind') }}
            </div>
        </div>

        <!-- Delete Confirmation Modal -->
        <div id="deleteModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-6 w-full max-w-md">
                <h2 class="text-xl font-bold text-gray-800 mb-4">Xác nhận xoá</h2>
                <p class="text-gray-600 mb-6">Bạn có chắc chắn muốn xoá thương hiệu này? Hành động này không thể hoàn tác.
                </p>
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
            let deleteBrandId = null;

            function openDeleteModal(id) {
                deleteBrandId = id;
                document.getElementById('deleteModal').classList.remove('hidden');
            }

            function closeDeleteModal() {
                document.getElementById('deleteModal').classList.add('hidden');
                deleteBrandId = null;
            }

            document.getElementById('confirmDelete').addEventListener('click', function() {
                if (deleteBrandId) {
                    const baseUrl = "{{ url('/') }}";
                    fetch(baseUrl + '/brands/' + deleteBrandId, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json',
                            },
                        })
                        .then(response => response.json())
                        .then(data => {
                            window.location.reload();
                        })
                    closeDeleteModal();
                }
            });
        </script>
    @endpush
@endsection
