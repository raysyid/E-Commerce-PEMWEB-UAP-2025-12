<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LandingController;

/*
|--------------------------------------------------------------------------
| GUEST (bisa akses tanpa login)
|--------------------------------------------------------------------------
*/

// Homepage menampilkan produk
Route::get('/', [LandingController::class, 'index'])->name('home');

// Detail produk
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.detail');

// Checkout harus login
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
});


/*
|--------------------------------------------------------------------------
| DASHBOARD (Hanya user login)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return view('dashboard');
})
->middleware(['auth', 'verified'])
->name('dashboard');


/*
|--------------------------------------------------------------------------
| MEMBER YANG BELUM PUNYA TOKO
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isMember'])->group(function () {

    Route::get('/store/register', [StoreController::class, 'create'])
        ->name('store.register');

    Route::post('/store/register', [StoreController::class, 'store'])
        ->name('store.store');
});


/*
|--------------------------------------------------------------------------
| SELLER (sudah punya toko)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isSeller'])->group(function () {
    Route::get('/seller/dashboard', function () {
        return view('seller.dashboard'); // nanti dibuat
    })->name('seller.dashboard');
});


/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); // nanti dibuat
    })->name('admin.dashboard');
});


/*
|--------------------------------------------------------------------------
| PROFILE SETTINGS
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';