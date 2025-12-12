<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\UserBalance; // MODEL SALDO USER
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * HALAMAN INPUT KODE VA
     */
    public function index()
    {
        return view('payment.index');
    }

    /**
     * CEK KODE VA
     */
    public function check(Request $request)
    {
        $request->validate([
            'va_code' => 'required'
        ]);

        $code = $request->va_code;

        // ===== TOPUP =====
        if (str_starts_with($code, "VA-TOPUP-")) {
            $id = str_replace("VA-TOPUP-", "", $code);
            
            // Ambil data topup dari database
            $topup = \App\Models\TopupTransaction::find($id);
            
            if (!$topup) {
                return back()->with('error', "Kode VA topup tidak ditemukan");
            }

            return view('payment.confirm', [
                'status' => 'Topup Saldo',
                'message' => "Total harus dibayar: Rp " . number_format($topup->amount, 0, ',', '.'),
                'transaction' => null,
                'topup_id' => $id,
                'topup_amount' => $topup->amount
            ]);
        }

        // ===== TRANSAKSI =====
        if (str_starts_with($code, "VA-TRX-")) {

            $id = str_replace("VA-TRX-", "", $code);
            $transaction = Transaction::find($id);

            if (!$transaction) {
                return back()->with('error', "Transaksi tidak ditemukan");
            }

            return view('payment.confirm', [
                'status' => 'Pembelian Produk',
                'message' => "Total harus dibayar: Rp " . number_format($transaction->grand_total),
                'transaction' => $transaction,
                'topup_id' => null
            ]);
        }

        return back()->with('error', "Format VA tidak dikenal!");
    }

    /**
     * KONFIRMASI PEMBAYARAN
     */
    public function confirm(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        // ===== Jika transaksi =====
        if ($request->transaction_id) {

            // Load transaction dengan details dan products
            $transaction = Transaction::with('transactionDetails.product')->find($request->transaction_id);

            if (!$transaction) {
                return view('payment.confirm', [
                    'status' => 'Gagal',
                    'message' => 'Transaksi tidak ditemukan',
                    'transaction' => null,
                    'topup_id' => null
                ]);
            }

            // Nominal cocok → sukses
            if ($request->amount == $transaction->grand_total) {

                $transaction->payment_status = 'paid';
                $transaction->save();

                // ✅ KURANGI STOK PRODUK
                foreach ($transaction->transactionDetails as $detail) {
                    $product = $detail->product;
                    if ($product) {
                        $product->stock -= $detail->qty;
                        $product->save();
                    }
                }

                return view('payment.confirm', [
                    'status' => 'Berhasil',
                    'message' => 'Pembayaran berhasil! Seller akan segera memproses pesanan Anda.',
                    'transaction' => $transaction,
                    'topup_id' => null
                ]);
            }

            // Nominal salah
            return view('payment.confirm', [
                'status' => 'Gagal',
                'message' => 'Nominal pembayaran tidak sesuai',
                'transaction' => $transaction,
                'topup_id' => null
            ]);
        }

        // ===== Jika topup =====
        if ($request->topup_id) {
            
            $topup = \App\Models\TopupTransaction::find($request->topup_id);
            
            if (!$topup) {
                return view('payment.confirm', [
                    'status' => 'Gagal',
                    'message' => 'Transaksi topup tidak ditemukan',
                    'transaction' => null,
                    'topup_id' => null
                ]);
            }

            // Cek jika nominal sesuai
            if ($request->amount == $topup->amount) {
                
                // Tambahkan saldo user
                $balance = \App\Models\UserBalance::firstOrCreate(
                    ['user_id' => \Auth::id()],
                    ['balance' => 0]
                );
                
                $balance->balance += $topup->amount;
                $balance->save();

                // Update status topup
                $topup->status = 'success';
                $topup->save();

                return view('payment.confirm', [
                    'status' => 'Berhasil',
                    'message' => 'Saldo berhasil ditambahkan sebesar Rp ' . number_format($topup->amount, 0, ',', '.'),
                    'transaction' => null,
                    'topup_id' => null
                ]);
            }

            // Nominal salah
            return view('payment.confirm', [
                'status' => 'Gagal',
                'message' => 'Nominal pembayaran tidak sesuai. Harap transfer sebesar Rp ' . number_format($topup->amount, 0, ',', '.'),
                'transaction' => null,
                'topup_id' => $request->topup_id,
                'topup_amount' => $topup->amount
            ]);
        }
    }

    public function showVA($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('payment.va', compact('transaction'));
    }

    /**
     * Proses pembayaran dengan saldo wallet
     */
    public function processWallet($id)
    {
        // Load transaction dengan details dan products
        $transaction = Transaction::with('transactionDetails.product')->findOrFail($id);
        
        // Cek saldo user
        $balance = \App\Models\UserBalance::where('user_id', \Auth::id())->first();
        $userBalance = $balance ? $balance->balance : 0;
        
        // Validasi saldo cukup
        if ($userBalance < $transaction->grand_total) {
            return redirect()->route('payment.wallet', $id)
                ->with('error', 'Saldo tidak cukup! Silakan top up terlebih dahulu.');
        }
        
        // Kurangi saldo
        $balance->balance -= $transaction->grand_total;
        $balance->save();
        
        // Update status transaksi
        $transaction->payment_status = 'paid';
        $transaction->save();
        
        // ✅ KURANGI STOK PRODUK
        foreach ($transaction->transactionDetails as $detail) {
            $product = $detail->product;
            if ($product) {
                $product->stock -= $detail->qty;
                $product->save();
            }
        }
        
        // Redirect ke halaman sukses
        return view('payment.success', [
            'transaction' => $transaction,
            'amount' => $transaction->grand_total
        ]);
    }

    public function showWallet($id)
    {
        $transaction = Transaction::findOrFail($id);
        return view('payment.wallet', compact('transaction'));
    }
}
