@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto mt-10">

    <div class="bg-white p-6 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-2">Top Up Saldo</h2>
        <p class="text-sm text-gray-500 mb-6">Pilih nominal atau masukkan jumlah custom</p>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('wallet.topup.submit') }}" method="POST" id="topupForm">
            @csrf

            <!-- Pilihan Nominal Cepat -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-3">Pilih Nominal</label>
                <div class="grid grid-cols-2 gap-3">
                    <button type="button" onclick="selectAmount(50000)" 
                            class="amount-btn p-4 border-2 border-gray-300 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition text-center">
                        <div class="text-lg font-bold text-gray-800">Rp 50.000</div>
                    </button>
                    <button type="button" onclick="selectAmount(100000)" 
                            class="amount-btn p-4 border-2 border-gray-300 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition text-center">
                        <div class="text-lg font-bold text-gray-800">Rp 100.000</div>
                    </button>
                    <button type="button" onclick="selectAmount(200000)" 
                            class="amount-btn p-4 border-2 border-gray-300 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition text-center">
                        <div class="text-lg font-bold text-gray-800">Rp 200.000</div>
                    </button>
                    <button type="button" onclick="selectAmount(500000)" 
                            class="amount-btn p-4 border-2 border-gray-300 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition text-center">
                        <div class="text-lg font-bold text-gray-800">Rp 500.000</div>
                    </button>
                    <button type="button" onclick="selectAmount(1000000)" 
                            class="amount-btn p-4 border-2 border-gray-300 rounded-xl hover:border-blue-500 hover:bg-blue-50 transition text-center col-span-2">
                        <div class="text-lg font-bold text-gray-800">Rp 1.000.000</div>
                    </button>
                </div>
            </div>

            <!-- Input Manual -->
            <div class="mb-6">
                <label for="amount" class="block text-sm font-semibold text-gray-700 mb-2">Atau Masukkan Nominal Custom</label>
                <div class="relative">
                    <span class="absolute left-4 top-3 text-gray-500 font-semibold">Rp</span>
                    <input type="number" 
                           id="amount" 
                           name="amount" 
                           min="10000" 
                           step="1000"
                           class="w-full pl-12 pr-4 py-3 border-2 border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition"
                           placeholder="0"
                           required
                           oninput="updateAmountButtons()">
                </div>
                <p class="text-xs text-gray-500 mt-2">Minimal top up Rp 10.000</p>
            </div>

            <!-- Tombol Submit -->
            <button type="submit" 
                    class="w-full bg-gradient-to-r from-blue-600 to-blue-800 text-white font-bold py-3 rounded-xl hover:from-blue-700 hover:to-blue-900 transition shadow-lg">
                Lanjut Isi Saldo
            </button>

            <a href="{{ route('wallet.index') }}" 
               class="block text-center mt-4 text-gray-600 hover:text-gray-800 transition">
                Kembali ke Wallet
            </a>
        </form>
    </div>

</div>

<script>
    function selectAmount(amount) {
        // Set nilai input
        document.getElementById('amount').value = amount;
        
        // Update visual tombol
        updateAmountButtons();
    }

    function updateAmountButtons() {
        const currentAmount = parseInt(document.getElementById('amount').value) || 0;
        const buttons = document.querySelectorAll('.amount-btn');
        
        buttons.forEach(btn => {
            btn.classList.remove('border-blue-500', 'bg-blue-50');
            btn.classList.add('border-gray-300');
        });

        // Highlight tombol yang dipilih
        const amounts = [50000, 100000, 200000, 500000, 1000000];
        const index = amounts.indexOf(currentAmount);
        
        if (index !== -1) {
            buttons[index].classList.remove('border-gray-300');
            buttons[index].classList.add('border-blue-500', 'bg-blue-50');
        }
    }

    // Format ribuan saat input
    document.getElementById('amount').addEventListener('blur', function() {
        if (this.value) {
            const value = parseInt(this.value);
            // Pastikan minimal 10000
            if (value < 10000) {
                this.value = 10000;
            }
        }
    });
</script>
@endsection
