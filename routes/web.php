<?php

use App\Http\Controllers\Admin\BaseController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
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

Route::get('/admin/categories/edit/{{category}}', [AdminCategoryController::class, 'create'])->middleware(['auth', 'admin']);




