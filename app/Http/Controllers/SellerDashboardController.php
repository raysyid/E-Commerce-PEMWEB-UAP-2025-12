<?php

namespace App\Http\Controllers;

use App\Models\Store; // ✔️ model Store
use Illuminate\Support\Facades\Auth;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $store = Store::where('user_id', $userId)->first();

        if (!$store) {
            return redirect()->route('store.register')
                ->with('error', 'Kamu belum memiliki toko.');
        }

        $products = $store->products()->count() ?? 0;
        $orders   = $store->transactions()->count() ?? 0;

        return view('seller.dashboard', compact('store', 'products', 'orders'));
    }
}