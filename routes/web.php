<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\SellerDashboardController;
use App\Http\Controllers\SellerProfileController;
use App\Http\Controllers\SellerProductController;
use App\Http\Controllers\SellerOrderController;
use App\Http\Controllers\SellerBalanceController;
use App\Http\Controllers\SellerWithdrawalController;
use App\Http\Controllers\SellerCategoryController;

/*
|--------------------------------------------------------------------------
| LANDING PAGE (lebih simpel)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    // Kalau seller → langsung ke dashboard seller
    if (Auth::check() && Auth::user()->role === 'seller') {
        return redirect()->route('seller.dashboard');
    }

    // Kalau admin → ke dashboard admin
    if (Auth::check() && Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    // Selain itu (guest / member) → lihat landing biasa
    return app(LandingController::class)->index();
})->name('home');

/*
|--------------------------------------------------------------------------
| DETAIL PRODUK PUBLIC
|--------------------------------------------------------------------------
*/
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.detail');

/*
|--------------------------------------------------------------------------
| CHECKOUT (harus login)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
});

/*
|--------------------------------------------------------------------------
| DASHBOARD DEFAULT (setelah login)
| Biar login nggak ke halaman laravel default, kita arahkan ke home saja.
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return redirect()->route('home');
})->middleware(['auth'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| MEMBER BELUM PUNYA TOKO
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isMember'])->group(function () {
    Route::get('/store/register', [StoreController::class, 'create'])->name('store.register');
    Route::post('/store/register', [StoreController::class, 'store'])->name('store.store');
});

/*
|--------------------------------------------------------------------------
| SELLER AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isSeller'])->prefix('seller')->group(function () {

    Route::get('/dashboard', [SellerDashboardController::class, 'index'])
        ->name('seller.dashboard');

    Route::get('/profile', [SellerProfileController::class, 'index'])
        ->name('seller.profile');
    Route::post('/profile', [SellerProfileController::class, 'update'])
        ->name('seller.profile.update');

    Route::resource('/categories', SellerCategoryController::class, ['as' => 'seller'])
        ->except(['show']);

    Route::resource('/products', SellerProductController::class, ['as' => 'seller']);

    Route::get('/orders', [SellerOrderController::class, 'index'])
        ->name('seller.orders');
    Route::patch('/orders/{id}', [SellerOrderController::class, 'update'])
        ->name('seller.orders.update');

    Route::get('/balance', [SellerBalanceController::class, 'index'])
        ->name('seller.balance');

    Route::resource('/withdrawals', SellerWithdrawalController::class, ['as' => 'seller'])
        ->only(['index', 'store']);
});

/*
|--------------------------------------------------------------------------
| ADMIN ONLY
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
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

require __DIR__ . '/auth.php';