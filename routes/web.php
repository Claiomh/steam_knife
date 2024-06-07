<?php

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Public\PublicController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Public\ProductController as PublicProductController;
use App\Http\Controllers\Public\CartController;
use App\Http\Controllers\ApiController;





Route::get('/api-index', [ApiController::class, 'index']);




Route::get('/', [PublicController::class, 'index'])->name('home');
Route::get('shop/', [PublicController::class, 'shop'])->name('shop');
Route::get('shop/{category:slug}/{product:slug}', [PublicProductController::class, 'show'])->name('public.product.show');





Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'showCart'])->name('cart.show');
Route::post('/cart/remove', [CartController::class, 'removeFromCart'])->name('cart.remove');
//
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->middleware(['auth', 'verified'])->name('dashboard');


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

Route::get('/admin/products', [AdminProductController::class, 'index'])->middleware(['auth', 'admin'])->name('admin.product.index');
Route::get('/admin/products/create', [AdminProductController::class, 'create'])->middleware(['auth', 'admin'])->name('admin.product.create');
Route::post('/admin/products', [AdminProductController::class, 'store'])->middleware(['auth', 'admin'])->name('admin.product.store');
Route::get('/admin/products/{product}/edit', [AdminProductController::class, 'edit'])->middleware(['auth', 'admin'])->name('admin.product.edit');
Route::patch('/admin/products/{product}', [AdminProductController::class, 'update'])->middleware(['auth', 'admin'])->name('admin.product.update');
Route::delete('/admin/products/{product}', [AdminProductController::class, 'destroy'])->middleware(['auth', 'admin'])->name('admin.product.destroy');



