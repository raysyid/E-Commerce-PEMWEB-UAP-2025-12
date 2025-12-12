<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-8">
        <div class="max-w-lg mx-auto px-4">
            
            {{-- Header --}}
            <div class="text-center mb-6">
                <div class="w-16 h-16 bg-black rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h1 class="text-2xl font-bold text-gray-900 mb-1">Pembayaran Virtual Account</h1>
                <p class="text-sm text-gray-600">Selesaikan pembayaran dengan transfer ke nomor VA</p>
            </div>

            {{-- Transaction Code --}}
            <div class="bg-white rounded-xl p-4 shadow-sm border border-gray-200 mb-4">
                <p class="text-xs text-gray-500 mb-1">Kode Transaksi</p>
                <p class="text-lg font-bold text-gray-900">{{ $transaction->code }}</p>
            </div>

            {{-- VA Number Card --}}
            <div class="bg-gradient-to-br from-gray-900 to-gray-800 rounded-2xl p-5 shadow-lg mb-4">
                <p class="text-gray-300 text-xs mb-2 text-center">Nomor Virtual Account</p>
                <div class="bg-white/10 backdrop-blur rounded-xl p-3 mb-3">
                    <p class="text-2xl font-bold text-white text-center tracking-wider" id="vaNumber">
                        VA-TRX-{{ $transaction->id }}
                    </p>
                </div>
                <button onclick="copyVA()" class="w-full bg-white text-gray-900 py-2.5 rounded-xl font-semibold hover:bg-gray-100 transition flex items-center justify-center gap-2 text-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                    </svg>
                    <span id="copyText">Salin Nomor VA</span>
                </button>
            </div>

            {{-- Info Banner --}}
            <div class="bg-gray-100 border border-gray-200 rounded-lg p-3 mb-4">
                <div class="flex items-start gap-2">
                    <svg class="w-4 h-4 text-gray-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-xs text-gray-700">
                        Setelah transfer, pembayaran akan <strong>divalidasi otomatis dalam 1-2 menit</strong>.
                    </p>
                </div>
            </div>

            {{-- Wallet Actions --}}
            <div class="mb-4">
                <p class="text-center text-xs text-gray-500 mb-3">atau</p>
                <div class="grid grid-cols-2 gap-3">
                    <a href="{{ route('home') }}" class="flex items-center justify-center gap-2 bg-white hover:bg-gray-50 border-2 border-gray-300 rounded-xl py-3 px-3 transition">
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        <span class="font-semibold text-xs text-gray-700">Kembali ke Beranda</span>
                    </a>
                    
                    <a href="{{ route('wallet.pay') }}" class="flex items-center justify-center gap-2 bg-black hover:bg-gray-800 rounded-xl py-3 px-3 transition">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        <span class="font-semibold text-xs text-white">Bayar Sekarang</span>
                    </a>
                </div>
            </div>

        </div>
    </div>

    {{-- Copy VA Script --}}
    <script>
        function copyVA() {
            const vaNumber = document.getElementById('vaNumber').textContent.trim();
            const copyText = document.getElementById('copyText');
            
            navigator.clipboard.writeText(vaNumber).then(() => {
                copyText.textContent = '✓ Tersalin!';
                setTimeout(() => {
                    copyText.textContent = 'Salin Nomor VA';
                }, 2000);
            });
        }
    </script>
</x-app-layout>