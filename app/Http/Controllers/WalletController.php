<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WalletController extends Controller
{
    public function index()
    {
        // contoh balance dummy
        $balance = 125000;

        return view('wallet.index', compact('balance'));
    }

    public function history()
    {
        $transactions = [
            ['type' => 'Top Up', 'amount' => 50000, 'status' => 'success'],
            ['type' => 'Bayar', 'amount' => -20000, 'status' => 'success'],
            ['type' => 'Top Up', 'amount' => 100000, 'status' => 'success'],
        ];

        return view('wallet.history', compact('transactions'));
    }
}
