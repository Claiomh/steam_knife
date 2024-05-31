<?php

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as ProductCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PublicController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';




Route::get('/admin/dashboard', [BaseController::class, 'index'])->middleware(['auth', 'admin']);

Route::get('/admin/categories', [AdminCategoryController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.category.index');
Route::get('/admin/categories/create', [AdminCategoryController::class, 'create'])->middleware(['auth', 'admin'])->name('admin.category.create');
Route::post('/admin/categories', [AdminCategoryController::class, 'store'])->middleware(['auth', 'admin'])->name('admin.category.store');
Route::get('/admin/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->middleware(['auth', 'admin'])->name('admin.category.edit');
Route::patch('/admin/categories/{category}', [AdminCategoryController::class, 'update'])->middleware(['auth', 'admin'])->name('admin.category.update');
Route::delete('/admin/categories/{category}', [AdminCategoryController::class, 'destroy'])->middleware(['auth', 'admin'])->name('admin.category.destroy');

Route::get('/admin/products', [ProductCategoryController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.product.index');
Route::get('/admin/products/create', [ProductCategoryController::class, 'create'])->middleware(['auth', 'admin'])->name('admin.product.create');
Route::post('/admin/products', [ProductCategoryController::class, 'store'])->middleware(['auth', 'admin'])->name('admin.product.store');
Route::get('/admin/products/{product}/edit', [ProductCategoryController::class, 'edit'])->middleware(['auth', 'admin'])->name('admin.product.edit');
Route::patch('/admin/products/{product}', [ProductCategoryController::class, 'update'])->middleware(['auth', 'admin'])->name('admin.product.update');
Route::delete('/admin/products/{product}', [ProductCategoryController::class, 'destroy'])->middleware(['auth', 'admin'])->name('admin.product.destroy');


