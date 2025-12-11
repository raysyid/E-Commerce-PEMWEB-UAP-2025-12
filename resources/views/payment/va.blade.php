<x-app-layout>
    <div class="max-w-3xl mx-auto py-10 px-6">
        
        <h1 class="text-2xl font-bold mb-6">Pembayaran Virtual Account</h1>

        <div class="bg-gray-100 p-4 rounded mb-4">
            <p class="text-gray-600 text-sm">Kode Transaksi</p>
            <p class="text-xl font-bold">{{ $transaction->code }}</p>
        </div>

        <div class="bg-gray-900 text-white text-center p-6 text-2xl rounded mb-8">
            VA-TRX-{{ $transaction->id }}
        </div>

        <h2 class="text-lg font-semibold">Detail Pembayaran</h2>
        <p class="text-gray-600 mb-4">Silahkan transfer sesuai nominal berikut:</p>

        <div class="bg-white border p-4 rounded mb-6">
            <p class="flex justify-between">
                <span>Total Pembayaran</span>
                <span class="font-bold">Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</span>
            </p>
        </div>

        <p class="text-gray-500 text-sm mb-8">
            Setelah melakukan transfer, pembayaran akan divalidasi otomatis dalam 1–2 menit.
        </p>

        <a href="{{ route('home') }}"
           class="block w-full text-center bg-black text-white py-3 rounded hover:bg-gray-800">
           Kembali ke Beranda
        </a>

    </div>
</x-app-layout>