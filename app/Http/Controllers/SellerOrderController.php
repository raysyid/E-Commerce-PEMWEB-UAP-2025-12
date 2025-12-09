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

        $newStatus = request('payment_status');

        /**
         * Seller hanya boleh update secara berurutan:
         * paid → processing → shipped → completed
         */
        $allowedFlow = [
            'paid'       => 'processing',
            'processing' => 'shipped',
            'shipped'    => 'completed',
        ];

        // Jika status tidak urut → tolak update
        if (!isset($allowedFlow[$transaction->payment_status]) ||
            $allowedFlow[$transaction->payment_status] !== $newStatus) {
            return back()->with('error', 'Status tidak valid untuk diperbarui.');
        }

        /**
         * 🚚 Jika status berubah menjadi "shipped"
         * generate nomor resi sekali saja
         */
        if ($newStatus === 'shipped') {

            $prefix = match ($transaction->shipping_type) {
                'express' => 'SC',
                'jne'     => 'JNE',
                default   => 'JNT',
            };

            if (!$transaction->tracking_number) {
                $transaction->tracking_number = $prefix . rand(100000, 999999);
            }
        }

        /**
         * Jika status bukan shipped → tracking_number kembali null
         */
        if ($newStatus !== 'shipped') {
            $transaction->tracking_number = null;
        }

        $transaction->payment_status = $newStatus;
        $transaction->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui');
    }
}