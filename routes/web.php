<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;

// Homepage tampil produk
Route::get('/', [ProductController::class, 'index'])->name('home');

// Dashboard setelah login
Route::get('/dashboard', function () {
    return view('dashboard');
})
->middleware(['auth', 'verified'])
->name('dashboard');

// Register Store untuk member (belum punya toko)
Route::middleware(['auth', 'isMember'])->group(function () {

    Route::get('/store/register', [StoreController::class, 'create'])
        ->name('store.register');

    Route::post('/store/register', [StoreController::class, 'store'])
        ->name('store.store');
});

// Seller route (sudah punya toko)
Route::middleware(['auth', 'isSeller'])->group(function () {

    Route::get('/seller/dashboard', function () {
        return 'Halo Seller, ini dashboard kamu.';
    })->name('seller.dashboard');
});

// Admin Only
Route::middleware(['auth', 'isAdmin'])->group(function () {

    Route::get('/admin/dashboard', function () {
        return 'Halo Admin, ini dashboard admin.';
    })->name('admin.dashboard');
});

// Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

// Detail produk
Route::get('/product/{slug}', [ProductController::class, 'show'])
    ->name('product.detail');

require __DIR__ . '/auth.php';