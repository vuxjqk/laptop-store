<?php

use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductApplicationController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductFeatureController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'show'])->name('home.show');

Route::get('/auth/{provider}', [SocialiteController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback']);

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:admin')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::resource('brands', BrandController::class);
        Route::resource('products', ProductController::class);

        Route::get('/products/{product}/images', [ProductImageController::class, 'index'])->name('product-images.index');
        Route::post('/product-images', [ProductImageController::class, 'store'])->name('product-images.store');
        Route::delete('/product-images', [ProductImageController::class, 'destroy'])->name('product-images.destroy');

        Route::get('/products/{product}/features', [ProductFeatureController::class, 'index'])->name('product-features.index');
        Route::post('/product-features', [ProductFeatureController::class, 'store'])->name('product-features.store');
        Route::delete('/product-features', [ProductFeatureController::class, 'destroy'])->name('product-features.destroy');

        Route::post('/applications', [ApplicationController::class, 'store'])->name('applications.store');
        Route::put('/applications/{application}', [ApplicationController::class, 'update'])->name('applications.update');
        Route::delete('/applications/{application}', [ApplicationController::class, 'destroy'])->name('applications.destroy');

        Route::get('/products/{product}/applications', [ProductApplicationController::class, 'index'])->name('product-applications.index');
        Route::post('/product-applications', [ProductApplicationController::class, 'update'])->name('product-applications.update');

        Route::get('/products/{product}/variants', [ProductVariantController::class, 'index'])->name('product-variants.index');
        Route::post('/product-variants', [ProductVariantController::class, 'store'])->name('product-variants.store');
        Route::patch('/product-variants/{productVariant}', [ProductVariantController::class, 'update'])->name('product-variants.update');
        Route::delete('/product-variants', [ProductVariantController::class, 'destroy'])->name('product-variants.destroy');
    });

    Route::middleware('role:customer')->group(function () {
        //
    });
});

require __DIR__ . '/auth.php';
