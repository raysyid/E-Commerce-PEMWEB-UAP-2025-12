@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white shadow-lg p-6 rounded-xl">

    {{-- JIKA SUDAH BERHASIL (status = 'Berhasil' atau 'success') --}}
    @if($status === 'Berhasil' || $status === 'success')
        
        {{-- Success Card dengan Icon --}}
        <div class="text-center mb-6">
            <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Pembayaran Berhasil! 🎉</h2>
            <p class="text-gray-600">{{ $message }}</p>
        </div>

        {{-- Action Buttons --}}
        <div class="space-y-3">
            <a href="{{ route('home') }}" 
               class="block w-full text-center bg-gradient-to-r from-blue-600 to-blue-800 text-white font-bold py-3 rounded-xl hover:from-blue-700 hover:to-blue-900 transition shadow-lg">
                Kembali ke Beranda
            </a>
            
            {{-- Link riwayat berbeda tergantung jenis transaksi --}}
            @if(!empty($transaction))
                {{-- Jika pembelian produk, ke /history --}}
                <a href="{{ url('/history') }}" 
                   class="block w-full text-center bg-gray-100 text-gray-700 font-semibold py-3 rounded-xl hover:bg-gray-200 transition">
                    Lihat Riwayat Pembelian
                </a>
            @else
                {{-- Jika topup, ke /wallet/history --}}
                <a href="{{ route('wallet.history') }}" 
                   class="block w-full text-center bg-gray-100 text-gray-700 font-semibold py-3 rounded-xl hover:bg-gray-200 transition">
                    Lihat Riwayat Top Up
                </a>
            @endif
        </div>

    {{-- JIKA GAGAL --}}
    @elseif($status === 'Gagal')
        
        <div class="text-center mb-6">
            <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-800 mb-2">Pembayaran Gagal</h2>
            <p class="text-red-600">{{ $message }}</p>
        </div>

        <div class="space-y-3">
            <a href="{{ route('wallet.pay') }}" 
               class="block w-full text-center bg-blue-600 text-white font-bold py-3 rounded-xl hover:bg-blue-700 transition">
                Coba Lagi
            </a>
            
            <a href="{{ route('wallet.index') }}" 
               class="block w-full text-center bg-gray-100 text-gray-700 font-semibold py-3 rounded-xl hover:bg-gray-200 transition">
                Kembali ke Dompet
            </a>
        </div>

    {{-- FORM KONFIRMASI (Sebelum Submit) --}}
    @else
        
        <h2 class="text-2xl font-bold mb-4">Konfirmasi Pembayaran</h2>

        <div class="p-4 bg-blue-50 border-l-4 border-blue-600 rounded mb-4">
            <p class="font-semibold text-blue-900">{{ $status }}</p>
            <p class="text-blue-800 mt-1">{{ $message }}</p>
        </div>

        <form action="{{ route('payment.confirm') }}" method="POST">
            @csrf

            {{-- Jika transaksi --}}
            @if(!empty($transaction))
                <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
            @endif

            {{-- Jika topup --}}
            @if(!empty($topup_id))
                <input type="hidden" name="topup_id" value="{{ $topup_id }}">
                @if(!empty($topup_amount))
                    <input type="hidden" name="topup_amount" value="{{ $topup_amount }}">
                @endif
            @endif

            <label class="font-semibold text-gray-700">Nominal Transfer:</label>
            <input type="number" name="amount"
                   class="w-full border-2 border-gray-300 p-3 rounded-xl mt-2 focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                   placeholder="Masukkan jumlah transfer"
                   required>

            <button class="mt-4 w-full bg-gradient-to-r from-green-600 to-green-700 text-white font-bold py-3 rounded-xl hover:from-green-700 hover:to-green-800 transition shadow-lg">
                💳 Konfirmasi Pembayaran
            </button>
        </form>

        <a href="{{ route('wallet.index') }}"
           class="block mt-4 w-full text-center bg-gray-100 text-gray-700 font-semibold py-3 rounded-xl hover:bg-gray-200 transition">
           Kembali ke Dompet
        </a>

    @endif

</div>
@endsection