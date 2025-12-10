@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">

    <!-- Card Saldo -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6 rounded-2xl shadow-lg">
        <p class="text-sm opacity-80">Saldo dompet kamu</p>
        <h1 class="text-4xl font-bold mt-1">Rp {{ number_format($balance,0,',','.') }}</h1>

        <div class="mt-6 grid grid-cols-3 gap-3 text-center">
            <a href="{{ route('wallet.topup') }}" class="flex flex-col items-center">
                <div class="w-12 h-12 flex items-center justify-center bg-white bg-opacity-20 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <span class="text-sm mt-1">Top Up</span>
            </a>

            <a href="{{ route('wallet.pay') }}" class="flex flex-col items-center">
                <div class="w-12 h-12 flex items-center justify-center bg-white bg-opacity-20 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17 9V7a5 5 0 00-10 0v2M5 9h14l-1 11H6L5 9z" />
                    </svg>
                </div>
                <span class="text-sm mt-1">Bayar</span>
            </a>

            <a href="{{ route('wallet.history') }}" class="flex flex-col items-center">
                <div class="w-12 h-12 flex items-center justify-center bg-white bg-opacity-20 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 8v4l3 2m6-2a9 9 0 11-6-8.48" />
                    </svg>
                </div>
                <span class="text-sm mt-1">Riwayat</span>
            </a>
        </div>
    </div>

    <!-- Menu Tambahan -->
    <div class="mt-8 space-y-3">

        <a href="{{ route('wallet.topup') }}"
           class="flex items-center p-4 bg-white shadow rounded-xl hover:bg-gray-50 transition">
            <div class="w-10 h-10 flex items-center justify-center bg-blue-100 text-blue-600 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 4v16m8-8H4" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="font-semibold text-gray-700">Top Up Saldo</h3>
                <p class="text-sm text-gray-500">Isi saldo dompetmu dengan aman</p>
            </div>
        </a>

        <a href="{{ route('wallet.pay') }}"
           class="flex items-center p-4 bg-white shadow rounded-xl hover:bg-gray-50 transition">
            <div class="w-10 h-10 flex items-center justify-center bg-green-100 text-green-600 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M17 9V7a5 5 0 00-10 0v2M5 9h14l-1 11H6L5 9z" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="font-semibold text-gray-700">Pembayaran</h3>
                <p class="text-sm text-gray-500">Bayar transaksi menggunakan dompet</p>
            </div>
        </a>

        <a href="{{ route('wallet.history') }}"
           class="flex items-center p-4 bg-white shadow rounded-xl hover:bg-gray-50 transition">
            <div class="w-10 h-10 flex items-center justify-center bg-gray-200 text-gray-800 rounded-xl">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 8v4l3 2m6-2a9 9 0 11-6-8.48" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="font-semibold text-gray-700">Riwayat Transaksi</h3>
                <p class="text-sm text-gray-500">Lihat semua aktivitas dompetmu</p>
            </div>
        </a>

    </div>

</div>
@endsection
