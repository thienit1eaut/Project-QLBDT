<?php

use Illuminate\Support\Facades\Route;

use App\Http\Middleware\CheckRole;

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\RoleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ImportProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/role/add', [RoleController::class, 'showFormCreate']);
Route::post('role/create', [RoleController::class, 'store'])->name('role.create');

// DEFAULT DASHBOARD & PROFILE
Route::middleware([CheckRole::class . ':admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route::controller(ProductCategoryController::class)->group(function() {
    //     Route::get('product-category/view', 'view')->name('product_category_view');
    // });

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

    Route::prefix('/employee')->group(function () {
        Route::get('/view', [EmployeeController::class, 'view'])->name('employee.view');
        Route::get('/create', [EmployeeController::class, 'create'])->name('employee.create');
        Route::post('/insert', [EmployeeController::class, 'store'])->name('employee.store');
        Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
        Route::put('/update/{id}', [EmployeeController::class, 'update'])->name('employee.update');
        Route::delete('delete/{id}', [EmployeeController::class, 'destroy'])->name('employee.destroy');
        Route::get('/{id}', [EmployeeController::class, 'show'])->name('employee.show');
    });

    Route::prefix('/imports')->group(function () {
        Route::get('/', [ImportProductController::class, 'index'])->name('imports.index');
        Route::get('/create', [ImportProductController::class, 'create'])->name('imports.create');
        Route::post('/insert', [ImportProductController::class, 'store'])->name('imports.store');
        Route::get('/{import}/print', [ImportProductController::class, 'print'])->name('imports.print');
    });

    Route::prefix('/orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/create', [OrderController::class, 'create'])->name('orders.create');
        Route::post('/insert', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/{order}/print', [OrderController::class, 'print'])->name('orders.print');
    });

    Route::prefix('/user')->group(function () {
        Route::get('/view', [UserController::class, 'view'])->name('user.view');
        Route::get('/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/insert', [UserController::class, 'store'])->name('user.store');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::put('/update/{id}', [UserController::class, 'update'])->name('user.update');
        Route::delete('delete/{id}', [UserController::class, 'destroy'])->name('user.destroy');
        Route::get('/{id}', [UserController::class, 'show'])->name('user.show');
    });

    Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search.index');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    Route::get('/reports/export/pdf', [ReportController::class, 'exportPdf'])->name('reports.export.pdf');
    
    Route::get('/reports/export/excel', [ReportController::class, 'exportExcel'])->name('reports.export.excel');


});

Route::middleware([CheckRole::class . ':admin,nhanvien'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('/orders')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('orders.index');
        Route::get('/create', [OrderController::class, 'create'])->name('orders.create');
        Route::post('/insert', [OrderController::class, 'store'])->name('orders.store');
        Route::get('/{order}/print', [OrderController::class, 'print'])->name('orders.print');
    });
});
