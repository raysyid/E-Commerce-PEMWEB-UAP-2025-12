<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use App\Models\StoreBalance;
use App\Models\StoreBalanceHistory;
use Illuminate\Http\Request;

class AdminWithdrawalController extends Controller
{
    public function index()
    {
        $withdrawals = Withdrawal::with('store')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.withdrawals', compact('withdrawals'));
    }

    public function approve($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'Withdrawal sudah diproses sebelumnya.');
        }

        // Update status jadi approved
        $withdrawal->status = 'approved';
        $withdrawal->save();

        return back()->with('success', 'Withdrawal berhasil diapprove! Silakan transfer ke rekening seller.');
    }

    public function reject($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'Withdrawal sudah diproses sebelumnya.');
        }

        // Kembalikan saldo ke seller
        $balance = StoreBalance::where('store_id', $withdrawal->store_id)->first();
        $balance->balance += $withdrawal->amount;
        $balance->save();

        // Catat history pengembalian
        StoreBalanceHistory::create([
            'store_id' => $withdrawal->store_id,
            'type' => 'income',
            'amount' => $withdrawal->amount,
            'description' => 'Pengembalian withdrawal yang ditolak',
        ]);

        // Update status jadi rejected
        $withdrawal->status = 'rejected';
        $withdrawal->save();

        return back()->with('success', 'Withdrawal ditolak dan saldo dikembalikan ke seller.');
    }
}
