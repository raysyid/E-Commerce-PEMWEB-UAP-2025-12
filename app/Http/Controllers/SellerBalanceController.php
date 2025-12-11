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

        // Ambil saldo toko (atau buat baru jika belum ada)
        $balance = StoreBalance::firstOrCreate(
            ['store_id' => $store->id],
            ['balance' => 0]
        );

        // Ambil riwayat saldo
        $histories = StoreBalanceHistory::where('store_balance_id', $balance->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('seller.balance', compact('balance', 'histories'));
    }
}
