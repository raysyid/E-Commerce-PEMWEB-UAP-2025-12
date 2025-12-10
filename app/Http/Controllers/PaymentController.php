<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Wallet;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * METODE PEMBAYARAN VIA VIRTUAL ACCOUNT
     */
    public function showVA($id)
    {
        $transaction = Transaction::with('store')->findOrFail($id);

        return view('payment.va', compact('transaction'));
    }


    /**
     * METODE PEMBAYARAN VIA WALLET
     */
    public function showWallet($id)
    {
        $transaction = Transaction::with('store')->findOrFail($id);

        // Ambil saldo user
        $wallet = Wallet::firstOrCreate(
            ['user_id' => Auth::id()],
            ['balance' => 0]
        );

        return view('payment.wallet', compact('transaction', 'wallet'));
    }


    /**
     * PROSES PEMBAYARAN WALLET (TIDAK MENGUBAH STRUKTUR BACKEND)
     */
    public function payWallet($id)
    {
        $transaction = Transaction::findOrFail($id);

        $wallet = Wallet::firstOrCreate(
            ['user_id' => Auth::id()],
            ['balance' => 0]
        );

        // cek cukup atau tidak
        if ($wallet->balance < $transaction->total_amount) {
            return back()->with('error', 'Saldo wallet tidak cukup!');
        }

        // pengurangan saldo
        $wallet->balance -= $transaction->total_amount;
        $wallet->save();

        // update status transaksi
        $transaction->payment_method = 'wallet';
        $transaction->payment_status = 'paid';
        $transaction->save();

        return redirect()
            ->route('wallet.index')
            ->with('success', 'Pembayaran berhasil menggunakan Wallet!');
    }
}
