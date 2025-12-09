<?php

namespace App\Http\Controllers;

use App\Models\Transaction;

class PaymentController extends Controller
{
    public function showVA($id)
    {
        $transaction = Transaction::with('store')->findOrFail($id);

        return view('payment.va', compact('transaction'));
    }

    public function showWallet($id)
    {
        $transaction = Transaction::with('store')->findOrFail($id);

        return view('payment.wallet', compact('transaction'));
    }
}
