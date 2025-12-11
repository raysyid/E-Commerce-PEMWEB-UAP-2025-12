@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 px-4">

    <div class="bg-white p-8 rounded-2xl shadow-lg">
        
        <!-- Header dengan Icon -->
        <div class="text-center mb-6">
            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center mx-auto mb-4 shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800">Bayar dengan VA</h2>
            <p class="text-gray-500 text-sm mt-1">Masukkan kode Virtual Account untuk melanjutkan</p>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 mb-6">
                <div class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="ml-3 text-green-800 text-sm">{{ session('success') }}</p>
                </div>
            </div>
        @endif

        <!-- Error Message -->
        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 mb-6">
                <div class="flex items-start">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <p class="ml-3 text-red-800 text-sm">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <!-- Form Input VA -->
        <form action="{{ route('payment.check') }}" method="POST">
            @csrf

            <div class="mb-6">
                <label for="va_code" class="block text-sm font-semibold text-gray-700 mb-2">
                    Kode Virtual Account
                </label>
                <div class="relative">
                    <input type="text" 
                           id="va_code"
                           name="va_code"
                           class="w-full px-4 py-4 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition font-mono text-lg"
                           placeholder="VA-TRX-12 atau VA-TOPUP-5"
                           value="{{ session('va_code') ?? old('va_code') }}"
                           required>
                    <div class="absolute right-4 top-4 text-gray-400">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z" />
                        </svg>
                    </div>
                </div>
                <p class="text-xs text-gray-500 mt-2">💡 Format: VA-TOPUP-xxx untuk top-up atau VA-TRX-xxx untuk pembelian</p>
            </div>

            <!-- Submit Button -->
            <button type="submit" 
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-800 text-white font-bold py-4 rounded-xl hover:from-blue-700 hover:to-blue-900 transition shadow-lg hover:shadow-xl transform hover:scale-[1.02]">
                🔍 Cek Kode VA
            </button>
        </form>

        <!-- Divider -->
        <div class="flex items-center my-6">
            <div class="flex-1 border-t border-gray-300"></div>
            <span class="px-4 text-sm text-gray-500">atau</span>
            <div class="flex-1 border-t border-gray-300"></div>
        </div>

        <!-- Quick Actions -->
        <div class="grid grid-cols-2 gap-3">
            <a href="{{ route('wallet.topup') }}" 
               class="flex flex-col items-center p-4 bg-gradient-to-br from-green-50 to-green-100 border border-green-200 rounded-xl hover:shadow-md transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                </svg>
                <span class="text-sm font-semibold text-green-700">Top Up</span>
            </a>

            <a href="{{ route('wallet.index') }}" 
               class="flex flex-col items-center p-4 bg-gradient-to-br from-gray-50 to-gray-100 border border-gray-200 rounded-xl hover:shadow-md transition">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 mb-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-sm font-semibold text-gray-700">Dompet</span>
            </a>
        </div>

    </div>

</div>
@endsection