<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user || !$user->store) {
            return redirect()->route('store.register')
                ->with('error', 'Kamu belum memiliki toko.');
        }

        $store = $user->store;

        return view('seller.dashboard', [
            'store'    => $store,
            'products' => $store->products()->count(),
            'orders'   => $store->transactions()
                                 ->where('payment_status', 'unpaid')
                                 ->count(),
        ]);
    }
}