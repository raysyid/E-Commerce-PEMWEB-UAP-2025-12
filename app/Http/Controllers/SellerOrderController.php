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
            ->orderBy('created_at', 'desc')
            ->get();

        return view('seller.orders.index', compact('orders'));
    }

    public function update($id)
    {
        $transaction = Transaction::findOrFail($id);

        request()->validate([
            'status' => 'required',
            'tracking_number' => 'nullable|string'
        ]);

        $transaction->update([
            'status' => request('status'),
            'tracking_number' => request('tracking_number')
        ]);

        return back()->with('success', 'Status pesanan berhasil diperbarui');
    }
}