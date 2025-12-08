<?php

namespace App\Http\Controllers;

use App\Models\Store; // ✔️ model Store
use Illuminate\Support\Facades\Auth;

class SellerDashboardController extends Controller
{
    public function index()
{
    $store = auth()->user()->store;

    if (!$store) {
        return redirect()->route('store.register')
            ->with('error', 'Kamu belum memiliki toko.');
    }

    return view('seller.dashboard', [
        'store'    => $store,
        'products' => $store->products()->count(),
        'orders'   => $store->transactions()->where('payment_status', 'unpaid')->count(),
    ]);
}

}