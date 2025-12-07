<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;
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
| HOME / LANDING
|--------------------------------------------------------------------------
*/
Route::get('/', [LandingController::class, 'index'])->name('home');

/*
|--------------------------------------------------------------------------
| AUTO REDIRECT SETELAH LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {

    if (!Auth::check()) {
        return redirect()->route('login');
    }

    if (Auth::user()->role === 'seller') {
        return redirect()->route('seller.dashboard');
    }

    if (Auth::user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('home'); // member balik ke home
})->name('dashboard');


/*
|--------------------------------------------------------------------------
| PRODUK & CHECKOUT
|--------------------------------------------------------------------------
*/
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('product.detail');

Route::middleware('auth')->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
});


/*
|--------------------------------------------------------------------------
| REGISTRASI TOKO (MEMBER SAJA)
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
Route::middleware(['auth', 'isSeller'])->prefix('seller')->name('seller.')->group(function () {

    Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [SellerProfileController::class, 'index'])->name('profile');
    Route::post('/profile', [SellerProfileController::class, 'update'])->name('profile.update');

    Route::resource('/categories', SellerCategoryController::class)->except(['show']);
    Route::resource('/products', SellerProductController::class);

    Route::get('/orders', [SellerOrderController::class, 'index'])->name('orders');
    Route::patch('/orders/{id}', [SellerOrderController::class, 'update'])->name('orders.update');

    Route::get('/balance', [SellerBalanceController::class, 'index'])->name('balance');

    Route::resource('/withdrawals', SellerWithdrawalController::class)->only(['index', 'store']);
});


/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});


/*
|--------------------------------------------------------------------------
| PROFILE USER
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';
