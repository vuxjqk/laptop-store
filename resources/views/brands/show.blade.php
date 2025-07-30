@extends('layouts.admin')

@section('title', $brand->name)

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
                <li class="text-gray-500">{{ $brand->name }}</li>
            </ol>
        </nav>

        <div class="bg-white rounded-xl shadow-lg p-6">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-4">
                    @if ($brand->logo)
                        <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}"
                            class="h-12 w-auto rounded">
                    @else
                        <span class="text-gray-400">Không có logo</span>
                    @endif
                    <div>
                        <h1 class="text-2xl font-bold text-gray-800">{{ $brand->name }}</h1>
                        <p class="text-gray-600">Slug: <span class="font-medium">{{ $brand->slug }}</span></p>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <span
                        class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-sm font-medium {{ $brand->is_active ? '' : 'bg-red-100 text-red-800' }}">
                        <i class="fas fa-check-circle mr-1"></i>{{ $brand->is_active ? 'Hoạt động' : 'Không hoạt động' }}
                    </span>
                    <a href="{{ route('brands.edit', $brand->id) }}"
                        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors">
                        <i class="fas fa-edit mr-2"></i>Chỉnh sửa
                    </a>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Description -->
                <div>
                    <h2 class="text-xl font-bold text-gray-800 mb-4"><i class="fas fa-info-circle text-blue-600 mr-2"></i>Mô
                        tả</h2>
                    <p class="text-gray-600">{{ $brand->description ?: 'Không có mô tả' }}</p>
                </div>

                <!-- Logo -->
                <div>
                    <h2 class="text-xl font-bold text-gray-800 mb-4"><i class="fas fa-image text-purple-600 mr-2"></i>Logo
                    </h2>
                    @if ($brand->logo)
                        <img src="{{ asset('storage/' . $brand->logo) }}" alt="{{ $brand->name }}"
                            class="h-24 w-auto rounded">
                    @else
                        <p class="text-gray-600">Không có logo</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
