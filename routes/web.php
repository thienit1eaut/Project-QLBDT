<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

// DEFAULT DASHBOARD & PROFILE
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::controller(ProductCategoryController::class)->group(function() {
        Route::get('product-category/view', 'view')->name('product_category_view');
    });

    Route::prefix('/product-category')->group(function () {
        Route::get('/view', [ProductCategoryController::class, 'view'])->name('category.view');
        Route::get('/create', [ProductCategoryController::class, 'create'])->name('category.create');
        Route::post('/insert', [ProductCategoryController::class, 'store'])->name('category.store');
        Route::get('/{id}/edit', [ProductCategoryController::class, 'edit'])->name('category.edit');
        Route::put('/update/{id}', [ProductCategoryController::class, 'update'])->name('category.update');
        Route::delete('delete/{id}', [ProductCategoryController::class, 'destroy'])->name('category.destroy');
        Route::get('/{id}', [ProductCategoryController::class, 'show'])->name('category.show');
    });

    Route::prefix('/supplier')->group(function () {
        Route::get('/view', [SupplierController::class, 'view'])->name('supplier.view');
        Route::get('/create', [SupplierController::class, 'create'])->name('supplier.create');
        Route::post('/insert', [SupplierController::class, 'store'])->name('supplier.store');
        Route::get('/{id}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
        Route::put('/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
        Route::delete('delete/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
        Route::get('/{id}', [SupplierController::class, 'show'])->name('supplier.show');
    });

    Route::prefix('/product')->group(function () {
        Route::get('/view', [ProductController::class, 'view'])->name('product.view');
        Route::get('/create', [ProductController::class, 'create'])->name('product.create');
        Route::post('/insert', [ProductController::class, 'store'])->name('product.store');
        Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('product.edit');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('product.update');
        Route::delete('delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
        Route::get('/{id}', [ProductController::class, 'show'])->name('product.show');
    });

});
