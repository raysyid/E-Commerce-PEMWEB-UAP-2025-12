<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;

class SellerOrderController extends Controller
{
    public function index()
    {
        $storeId = Auth::user()->store->id;

        $orders = Transaction::where('store_id', $storeId)
            ->with(['buyer', 'transactionDetails.product'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('seller.orders', compact('orders'));
    }

    public function update($id)
    {
        $transaction = Transaction::where('id', $id)
            ->where('store_id', Auth::user()->store->id)
            ->firstOrFail();

        // Hanya order yang paid bisa dikirim
        if ($transaction->payment_status !== 'paid') {
            return back()->with('error', 'Hanya pesanan yang sudah dibayar yang bisa dikirim.');
        }

        // Cek jika sudah punya tracking number (sudah dikirim)
        if ($transaction->tracking_number) {
            return back()->with('error', 'Pesanan ini sudah dikirim sebelumnya.');
        }

        /**
         * 🚚 Generate tracking number
         */
        $prefix = match ($transaction->shipping_type) {
            'express' => 'SC',
            'jne'     => 'JNE',
            default   => 'JNT',
        };
        $transaction->tracking_number = $prefix . rand(100000, 999999);
        $transaction->save();

        /**
         * 💰 Transfer uang ke seller saat kirim barang
         */
        $store = Auth::user()->store;
        
        $storeBalance = \App\Models\StoreBalance::firstOrCreate(
            ['store_id' => $store->id],
            ['balance' => 0]
        );
        
        $storeBalance->balance += $transaction->grand_total;
        $storeBalance->save();
        
        // Log history
        if (class_exists('\App\Models\StoreBalanceHistory')) {
            \App\Models\StoreBalanceHistory::create([
                'store_balance_id' => $storeBalance->id,
                'type' => 'income',
                'amount' => $transaction->grand_total,
                'remarks' => 'Pembayaran dari pesanan #' . $transaction->code,
                'reference_type' => 'transaction',
                'reference_id' => $transaction->id
            ]);
        }

        return back()->with('success', 'Pesanan berhasil dikirim! Nomor resi: ' . $transaction->tracking_number);
    }
}