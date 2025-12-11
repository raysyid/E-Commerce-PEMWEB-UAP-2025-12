<?php

namespace App\Http\Controllers;

use App\Models\UserBalance;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    /**
     * Halaman saldo user
     */
    public function index()
    {
        $balance = UserBalance::firstOrCreate(
            ['user_id' => Auth::id()],
            ['balance' => 0]
        );

        return view('wallet.index', [
            'balance' => $balance->balance
        ]);
    }

    /**
     * Riwayat Topup / Pembayaran
     */
    public function history()
    {
        // Ambil riwayat topup dari database
        $topups = \App\Models\TopupTransaction::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('wallet.history', compact('topups'));
    }

    /**
     * Form Top Up saldo
     */
    public function topup()
    {
        return view('wallet.topup');
    }

    /**
     * Submit Top Up dan generate VA code
     */
    public function submitTopup(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000'
        ]);

        $amount = $request->amount;

        // Buat transaksi topup di tabel topup_transactions
        $topup = \App\Models\TopupTransaction::create([
            'user_id' => Auth::id(),
            'amount' => $amount,
            'va_code' => 'TEMP', // temporary, akan diganti setelah dapat ID
            'status' => 'pending',
        ]);

        // Update VA code dengan ID yang sudah didapat
        $vaCode = 'VA-TOPUP-' . $topup->id;
        $topup->va_code = $vaCode;
        $topup->save();

        // Tampilkan halaman konfirmasi dengan VA code
        return view('wallet.topup-success', [
            'va_code' => $vaCode,
            'amount' => $amount
        ]);
    }

    /**
     * Input kode VA
     */
    public function pay()
    {
        return view('wallet.pay');
    }

    /**
     * Memproses VA:
     * - VA-TOPUP-{id} → topup saldo
     * - VA-TRX-{id} → bayar transaksi pembelian
     */
    public function payment($va)
    {
        /**
         * Format VA:
         * VA-TOPUP-15
         * VA-TRX-22
         */

        if (!str_starts_with($va, "VA-")) {
            return back()->with('error', 'Kode VA tidak valid');
        }

        $parts = explode("-", $va); // ["VA", "TOPUP", "15"]

        if (count($parts) < 3) {
            return back()->with('error', 'Format VA salah');
        }

        $type = $parts[1];
        $id   = $parts[2];

        if ($type === "TOPUP") {
            return $this->processTopup($id);
        }

        if ($type === "TRX") {
            return $this->processPurchase($id);
        }

        return back()->with('error', 'Jenis VA tidak dikenali');
    }

    /**
     * Proses TOP UP saldo berdasarkan VA
     */
    private function processTopup($id)
    {
        // Ambil transaksi topup dari tabel topup_transactions
        $topup = \App\Models\TopupTransaction::find($id);
        if (!$topup) return back()->with('error', 'Transaksi topup tidak ditemukan');

        // Cek jika sudah diproses
        if ($topup->status === 'success') {
            return back()->with('error', 'Topup ini sudah diproses sebelumnya');
        }

        $amount = $topup->amount;

        // tambahkan saldo user
        $balance = UserBalance::firstOrCreate(
            ['user_id' => Auth::id()],
            ['balance' => 0]
        );

        $balance->balance += $amount;
        $balance->save();

        // Update status topup menjadi success
        $topup->status = 'success';
        $topup->save();

        return view('payment.confirm', [
            'status' => 'success',
            'message' => "Topup berhasil. Saldo bertambah Rp " . number_format($amount, 0, ',', '.')
        ]);
    }

    /**
     * Proses pembayaran transaksi pembelian
     */
    private function processPurchase($id)
    {
        $trx = Transaction::find($id);
        if (!$trx) return back()->with('error', 'Transaksi tidak ditemukan');

        // ubah status pembayaran menjadi paid
        $trx->payment_status = 'paid';
        $trx->save();

        return view('payment.confirm', [
            'status' => 'success',
            'message' => 'Pembayaran berhasil, terima kasih!'
        ]);
    }
}