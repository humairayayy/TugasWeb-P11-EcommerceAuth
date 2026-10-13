<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('welcome'));

Route::get('/dashboard', fn () => view('dashboard'))
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Semua user yang login boleh melihat daftar produk
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
});

// Khusus admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', fn () => view('admin.dashboard'))->name('dashboard');
});

// Admin + Editor boleh kelola produk (detail otorisasi lewat PostPolicy)
Route::middleware(['auth', 'role:admin,editor'])->group(function () {
    Route::resource('products', ProductController::class)->except(['index', 'show']);
});

require __DIR__ . '/auth.php';