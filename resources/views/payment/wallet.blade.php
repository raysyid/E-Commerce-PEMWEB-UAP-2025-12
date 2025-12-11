@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10">

    <div class="bg-white p-6 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Bayar dengan Saldo</h2>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-4">
                <strong>Error!</strong> {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Detail Transaksi -->
        <div class="bg-gray-50 rounded-xl p-4 mb-6">
            <h3 class="font-semibold text-gray-700 mb-3">Detail Pembelian</h3>
            
            @foreach($transaction->transactionDetails as $detail)
                <div class="flex justify-between mb-2">
                    <span class="text-gray-600">{{ $detail->product->name ?? 'Produk' }}</span>
                    <span class="font-semibold">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</span>
                </div>
            @endforeach
            
            <div class="flex justify-between mb-2">
                <span class="text-gray-600">Ongkir ({{ $transaction->shipping }})</span>
                <span class="font-semibold">Rp {{ number_format($transaction->shipping_cost, 0, ',', '.') }}</span>
            </div>
            
            <div class="border-t border-gray-300 mt-3 pt-3 flex justify-between">
                <span class="font-bold text-gray-800">Total</span>
                <span class="font-bold text-blue-600 text-xl">Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</span>
            </div>
        </div>

        <!-- Saldo User -->
        @php
            $balance = \App\Models\UserBalance::where('user_id', Auth::id())->first();
            $userBalance = $balance ? $balance->balance : 0;
            $canPay = $userBalance >= $transaction->grand_total;
        @endphp

        <div class="bg-blue-50 border-l-4 border-blue-600 rounded-lg p-4 mb-6">
            <p class="text-sm text-blue-800">Saldo Kamu:</p>
            <p class="text-2xl font-bold text-blue-900">Rp {{ number_format($userBalance, 0, ',', '.') }}</p>
        </div>

        @if($canPay)
            <!-- Tombol Bayar -->
            <form action="{{ route('payment.process.wallet', $transaction->id) }}" method="POST">
                @csrf
                <button type="submit" 
                        class="w-full bg-gradient-to-r from-green-600 to-green-700 text-white font-bold py-3 rounded-xl hover:from-green-700 hover:to-green-800 transition shadow-lg">
                    💳 Bayar dengan Saldo
                </button>
            </form>
        @else
            <!-- Saldo Tidak Cukup -->
            <div class="bg-red-50 border border-red-300 rounded-xl p-4 mb-4">
                <p class="text-red-800 font-semibold mb-2">❌ Saldo Tidak Cukup!</p>
                <p class="text-sm text-red-700">Kamu butuh Rp {{ number_format($transaction->grand_total - $userBalance, 0, ',', '.') }} lagi.</p>
            </div>
            
            <a href="{{ route('wallet.topup') }}" 
               class="block w-full text-center bg-gradient-to-r from-blue-600 to-blue-800 text-white font-bold py-3 rounded-xl hover:from-blue-700 hover:to-blue-900 transition shadow-lg">
                💰 Top Up Saldo
            </a>
        @endif

        <a href="{{ route('home') }}" 
           class="block text-center mt-4 text-gray-600 hover:text-gray-800 font-semibold transition">
            ← Kembali ke Beranda
        </a>
    </div>

</div>
@endsection
