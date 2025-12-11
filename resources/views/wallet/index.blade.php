@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10 px-4">

    <!-- Card Saldo -->
    <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6 rounded-2xl shadow-lg">
        <p class="text-sm opacity-80">Saldo dompet kamu</p>
        <h1 class="text-4xl font-bold mt-1">Rp {{ number_format($balance,0,',','.') }}</h1>

        <!-- Quick Actions - Cuma Top Up & Bayar -->
        <div class="mt-6 grid grid-cols-2 gap-4">
            <a href="{{ route('wallet.topup') }}" class="flex items-center justify-center gap-3 bg-white bg-opacity-20 hover:bg-opacity-30 transition p-4 rounded-xl">
                <div class="w-10 h-10 flex items-center justify-center bg-white bg-opacity-30 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 4v16m8-8H4" />
                    </svg>
                </div>
                <span class="font-semibold">Top Up Saldo</span>
            </a>

            <a href="{{ route('wallet.pay') }}" class="flex items-center justify-center gap-3 bg-white bg-opacity-20 hover:bg-opacity-30 transition p-4 rounded-xl">
                <div class="w-10 h-10 flex items-center justify-center bg-white bg-opacity-30 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M17 9V7a5 5 0 00-10 0v2M5 9h14l-1 11H6L5 9z" />
                    </svg>
                </div>
                <span class="font-semibold">Bayar</span>
            </a>
        </div>
    </div>

    <!-- Menu Riwayat - Desktop Grid 2x2, Mobile Stack -->
    <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">

        <!-- Riwayat Top Up -->
        <a href="{{ route('wallet.history') }}"
           class="flex items-center p-5 bg-white shadow-lg rounded-2xl hover:shadow-xl hover:scale-[1.02] transition-all">
            <div class="w-14 h-14 flex items-center justify-center bg-gradient-to-br from-purple-400 to-purple-600 text-white rounded-2xl shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 8v4l3 2m6-2a9 9 0 11-6-8.48" />
                </svg>
            </div>
            <div class="ml-4 flex-1">
                <h3 class="font-bold text-lg text-gray-800">Riwayat Top Up</h3>
                <p class="text-sm text-gray-500">Lihat riwayat isi saldo dompet</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>

        <!-- Riwayat Pembelian -->
        <a href="{{ url('/history') }}"
           class="flex items-center p-5 bg-white shadow-lg rounded-2xl hover:shadow-xl hover:scale-[1.02] transition-all">
            <div class="w-14 h-14 flex items-center justify-center bg-gradient-to-br from-orange-400 to-orange-600 text-white rounded-2xl shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                </svg>
            </div>
            <div class="ml-4 flex-1">
                <h3 class="font-bold text-lg text-gray-800">Riwayat Pembelian</h3>
                <p class="text-sm text-gray-500">Lihat riwayat belanja produk</p>
            </div>
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
            </svg>
        </a>

    </div>

</div>
@endsection

