@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white shadow p-6 rounded-xl">
    <h2 class="text-2xl font-bold mb-4">Konfirmasi Pembayaran</h2>

    <div class="p-4 bg-gray-100 rounded mb-4">
        <p class="mb-1"><strong>Kode VA:</strong> {{ $transaction->code }}</p>
        <p class="mb-1"><strong>Total Dibayar:</strong> Rp {{ number_format($transaction->grand_total) }}</p>

        @if($transaction->shipping_type === "TOPUP")
            <p class="text-blue-600 font-semibold">Jenis: Topup Saldo</p>
        @else
            <p class="text-green-600 font-semibold">Jenis: Pembelian Produk</p>
        @endif
    </div>

    <form method="POST" action="{{ route('payment.confirm') }}">
        @csrf

        <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">

        <label class="font-semibold">Nominal Transfer:</label>
        <input type="number" name="amount" class="w-full border p-2 rounded mt-2" placeholder="Masukkan jumlah transfer">

        <button class="mt-4 w-full bg-green-600 text-white py-2 rounded">
            Konfirmasi Pembayaran
        </button>
    </form>
</div>
@endsection
