@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10">

    <div class="bg-white p-8 rounded-2xl shadow-lg text-center">
        
        <!-- Success Icon -->
        <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
        </div>

        <h2 class="text-3xl font-bold text-gray-800 mb-3">Kode VA Berhasil Dibuat! ✅</h2>
        <p class="text-gray-600 mb-6">Simpan kode VA di bawah ini untuk melakukan pembayaran</p>

        <!-- VA Code Card -->
        <div class="bg-gradient-to-r from-blue-600 to-blue-800 text-white p-6 rounded-xl mb-6">
            <p class="text-sm opacity-80 mb-2">Kode Virtual Account</p>
            <div class="bg-white bg-opacity-20 rounded-lg p-4 mb-3">
                <p class="text-3xl font-bold tracking-wider mb-3">{{ $va_code }}</p>
                <div class="flex justify-center">
                    <button id="copyBtn" onclick="copyVACode()" 
                            class="px-6 py-2 bg-white bg-opacity-20 hover:bg-opacity-30 text-white font-semibold rounded-lg transition">
                        📋 Salin Kode
                    </button>
                </div>
            </div>
        </div>

        <!-- Info Box -->
        <div class="bg-blue-50 border-l-4 border-blue-600 rounded-lg p-4 mb-6 text-left">
            <p class="text-sm text-blue-800">
                <strong>💡 Info:</strong> Kode VA ini dapat digunakan untuk membayar top-up saldo kamu. 
                Kamu bisa bayar sekarang atau nanti.
            </p>
        </div>

        <!-- Action Buttons -->
        <div class="space-y-3">
            <a href="{{ route('wallet.pay') }}" 
               class="block w-full text-center bg-gradient-to-r from-green-600 to-green-700 text-white font-bold py-4 rounded-xl hover:from-green-700 hover:to-green-800 transition shadow-lg">
                💳 Bayar Sekarang
            </a>
            
            <a href="{{ route('wallet.index') }}" 
               class="block w-full text-center bg-gray-100 text-gray-700 font-semibold py-4 rounded-xl hover:bg-gray-200 transition">
                🏠 Kembali ke Dompet
            </a>
        </div>

</div>

<script>
function copyVACode() {
    const vaCode = "{{ $va_code }}";
    const btn = document.getElementById('copyBtn');
    
    navigator.clipboard.writeText(vaCode).then(() => {
        // Change button text to success message (permanent)
        btn.innerHTML = '✅ Berhasil Disalin!';
        btn.classList.add('bg-green-500', 'bg-opacity-100');
    }).catch(err => {
        console.error('Failed to copy: ', err);
        btn.innerHTML = '❌ Gagal Menyalin';
    });
}
</script>
@endsection
