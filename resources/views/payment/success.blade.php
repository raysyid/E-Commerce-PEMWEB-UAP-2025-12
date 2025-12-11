@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10">

    <div class="bg-white p-8 rounded-2xl shadow-lg text-center">
        
        <!-- Success Icon -->
        <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <h2 class="text-3xl font-bold text-gray-800 mb-3">Pembayaran Berhasil! 🎉</h2>
        <p class="text-gray-600 mb-6">Transaksi kamu telah berhasil diproses</p>

        <!-- Detail Transaksi -->
        <div class="bg-gray-50 rounded-xl p-5 mb-6 text-left">
            <div class="flex justify-between mb-3">
                <span class="text-gray-600">Kode Transaksi:</span>
                <span class="font-semibold text-gray-800">{{ $transaction->code }}</span>
            </div>
            <div class="flex justify-between mb-3">
                <span class="text-gray-600">Total Pembayaran:</span>
                <span class="font-bold text-green-600 text-xl">Rp {{ number_format($amount, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between">
                <span class="text-gray-600">Status:</span>
                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                    Lunas
                </span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="space-y-3">
            <a href="{{ route('home') }}" 
               class="block w-full text-center bg-gradient-to-r from-blue-600 to-blue-800 text-white font-bold py-3 rounded-xl hover:from-blue-700 hover:to-blue-900 transition shadow-lg">
                🏠 Kembali ke Beranda
            </a>
            
            <a href="{{ url('/history') }}" 
               class="block w-full text-center bg-gray-100 text-gray-700 font-semibold py-3 rounded-xl hover:bg-gray-200 transition">
                📜 Lihat Riwayat Pembelian
            </a>
        </div>

    </div>

</div>
@endsection
