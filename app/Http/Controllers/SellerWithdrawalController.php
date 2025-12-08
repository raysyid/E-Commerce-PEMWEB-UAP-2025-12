<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Withdrawal;
use App\Models\StoreBalance;

class SellerWithdrawalController extends Controller
{
    public function index()
{
    $store = Auth::user()->store;

    // AMAN: Buat saldo otomatis kalau belum ada
    $balance = StoreBalance::firstOrCreate(
        ['store_id' => $store->id],
        ['balance' => 0]
    );

    $withdrawals = Withdrawal::where('store_balance_id', $balance->id)
        ->latest()
        ->get();

    return view('seller.withdraw', compact('balance', 'withdrawals'));
}



    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000',
            'bank' => 'required',
            'account_number' => 'required',
            'account_name' => 'required',
        ]);

        $store = Auth::user()->store;
        $balance = StoreBalance::where('store_id', $store->id)->first();

        // ❌ Cegah jika saldo tidak cukup
        if ($request->amount > $balance->balance) {
            return back()->with('error', 'Saldo tidak mencukupi!');
        }

        Withdrawal::create([
            'store_balance_id' => $balance->id,
            'amount' => $request->amount,
            'bank_account_name' => $request->account_name,
            'bank_account_number' => $request->account_number,
            'bank_name' => $request->bank,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Withdraw berhasil diajukan!');
    }
}
