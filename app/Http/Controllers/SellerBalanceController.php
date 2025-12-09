<?php

namespace App\Http\Controllers;

use App\Models\StoreBalance;
use App\Models\StoreBalanceHistory;
use Illuminate\Support\Facades\Auth;

class SellerBalanceController extends Controller
{
    public function index()
    {
        $store = Auth::user()->store;

        // Ambil saldo toko
        $balance = StoreBalance::where('store_id', $store->id)->first();

        // Ambil riwayat saldo
        $histories = StoreBalanceHistory::where('store_balance_id', $balance->id)
            ->latest()
            ->get();

        return view('seller.balance', compact('balance', 'histories'));
    }
}
