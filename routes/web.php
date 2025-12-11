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
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WalletController;


/*
|--------------------------------------------------------------------------
| HOME / LANDING
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => app(LandingController::class)->index())->name('home');


/*
|--------------------------------------------------------------------------
| AUTO REDIRECT SETELAH LOGIN
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {

    if (!Auth::check()) return redirect()->route('login');

    if (Auth::user()->role === 'admin') return redirect()->route('admin.dashboard');
    if (Auth::user()->role === 'seller') return redirect()->route('seller.dashboard');

    return redirect()->route('home');
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
    
    // Riwayat Pembelian Produk
    Route::get('/history', [CheckoutController::class, 'history'])->name('purchase.history');
});


/*
|--------------------------------------------------------------------------
| PAYMENT CENTRAL PAGE (WAJIB)
|--------------------------------------------------------------------------
| Dipakai:
| - Pembelian produk (VA-TRX-xxx)
| - Topup saldo (VA-TOPUP-xxx)
*/
Route::middleware('auth')
    ->prefix('payment')
    ->name('payment.')
    ->group(function () {

        Route::post('/check', [PaymentController::class, 'check'])->name('check');
        Route::post('/confirm', [PaymentController::class, 'confirm'])->name('confirm');

        Route::get('/va/{id}', [PaymentController::class, 'showVA'])->name('va');
        Route::get('/wallet/{id}', [PaymentController::class, 'showWallet'])->name('wallet');
        Route::post('/wallet/{id}', [PaymentController::class, 'processWallet'])->name('process.wallet');
    });


/*
|--------------------------------------------------------------------------
| REGISTER TOKO
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
Route::middleware(['auth', 'isSeller'])
    ->prefix('seller')
    ->name('seller.')
    ->group(function () {

        Route::get('/profile', [SellerProfileController::class, 'index'])->name('profile');
        Route::post('/profile', [SellerProfileController::class, 'update'])->name('profile.update');

        Route::get('/pending', fn() => view('seller.pending'))->name('pending');

        Route::middleware('storeVerified')->group(function () {

            Route::get('/dashboard', [SellerDashboardController::class, 'index'])->name('dashboard');
            Route::resource('categories', SellerCategoryController::class)->except(['show']);
            Route::resource('products', SellerProductController::class);
            Route::get('/orders', [SellerOrderController::class, 'index'])->name('orders');
            Route::patch('/orders/{id}', [SellerOrderController::class, 'update'])->name('orders.update');
            Route::get('/balance', [SellerBalanceController::class, 'index'])->name('balance');
            Route::resource('withdrawals', SellerWithdrawalController::class)->only(['index', 'store']);
        });
    });


/*
|--------------------------------------------------------------------------
| WALLET USER
|--------------------------------------------------------------------------
*/
Route::middleware('auth')
    ->prefix('wallet')
    ->name('wallet.')
    ->group(function () {

        Route::get('/', [WalletController::class, 'index'])->name('index');
        Route::get('/history', [WalletController::class, 'history'])->name('history');

        Route::get('/topup', [WalletController::class, 'topup'])->name('topup');
        Route::post('/topup', [WalletController::class, 'submitTopup'])->name('topup.submit');

        Route::get('/pay', [WalletController::class, 'pay'])->name('pay');
    });


/*
|--------------------------------------------------------------------------
| ADMIN AREA
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'isAdmin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', fn() => view('admin.dashboard'))->name('dashboard');

        Route::get('/verification', [\App\Http\Controllers\AdminVerificationController::class, 'index'])
            ->name('verification');

        Route::post('/verification/approve/{id}', [\App\Http\Controllers\AdminVerificationController::class, 'approve'])
            ->name('verification.approve');

        Route::delete('/verification/reject/{id}', [\App\Http\Controllers\AdminVerificationController::class, 'reject'])
            ->name('verification.reject');

        Route::get('/users', [\App\Http\Controllers\AdminUserController::class, 'index'])
            ->name('users');

        Route::delete('/users/store/{id}', [\App\Http\Controllers\AdminUserController::class, 'deleteStore'])
            ->name('store.delete');
    });


/*
|--------------------------------------------------------------------------
| USER PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';