@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-10">

    <div class="bg-white p-6 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Riwayat Pembelian</h2>

        @if($transactions->count() > 0)
            <div class="space-y-4">
                @foreach($transactions as $transaction)
                    <div class="border-2 border-gray-200 rounded-xl p-5 hover:border-blue-300 transition">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="font-bold text-gray-800">Transaksi #{{ $transaction->code }}</h3>
                                <p class="text-sm text-gray-500">{{ $transaction->created_at->format('d M Y, H:i') }}</p>
                            </div>
                            <div class="text-right">
                                <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full
                                    {{ $transaction->payment_status === 'paid' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $transaction->payment_status === 'paid' ? 'Lunas' : 'Belum Lunas' }}
                                </span>
                            </div>
                        </div>

                        {{-- Detail Produk --}}
                        <div class="bg-gray-50 rounded-lg p-4 mb-3">
                            @foreach($transaction->transactionDetails as $detail)
                                <div class="flex items-center justify-between mb-3 last:mb-0">
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-800">{{ $detail->product->name ?? 'Produk Tidak Ditemukan' }}</h4>
                                        <p class="text-sm text-gray-600">Qty: {{ $detail->qty }}</p>
                                        <p class="text-sm font-semibold text-gray-700">Rp {{ number_format($detail->subtotal, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        {{-- VA Code untuk yang belum lunas --}}
                        @if($transaction->payment_status !== 'paid')
                            <div class="bg-yellow-50 border-l-4 border-yellow-500 rounded-lg p-4 mb-3">
                                <p class="text-xs text-yellow-800 font-semibold mb-2">⚠️ Belum Lunas - Kode VA:</p>
                                <div class="flex items-center gap-2 mb-2">
                                    <p class="font-mono text-lg font-bold text-yellow-900">VA-TRX-{{ $transaction->id }}</p>
                                    <button onclick="copyVACode('VA-TRX-{{ $transaction->id }}')" 
                                            class="px-3 py-1 bg-yellow-600 hover:bg-yellow-700 text-white text-xs font-semibold rounded-lg transition whitespace-nowrap">
                                        📋 Salin
                                    </button>
                                </div>
                                <p class="text-xs text-yellow-700 mb-3">Gunakan kode ini untuk pembayaran</p>
                                <div class="flex justify-end">
                                    <a href="{{ route('wallet.pay') }}" 
                                       class="inline-block px-6 py-2 bg-yellow-600 hover:bg-yellow-700 text-white font-semibold text-sm rounded-lg transition">
                                        💳 Bayar Sekarang
                                    </a>
                                </div>
                            </div>
                        @endif

                        {{-- Info Pengiriman & Total --}}
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <p class="text-gray-500">Alamat:</p>
                                <p class="font-semibold text-gray-800">{{ $transaction->address }}</p>
                            </div>
                            <div>
                                <p class="text-gray-500">Pengiriman:</p>
                                <p class="font-semibold text-gray-800">{{ $transaction->shipping }} (Rp {{ number_format($transaction->shipping_cost, 0, ',', '.') }})</p>
                            </div>
                        </div>

                        <div class="mt-4 pt-4 border-t border-gray-200 flex justify-between items-center">
                            <span class="text-gray-600">Total Pembayaran:</span>
                            <span class="text-2xl font-bold text-blue-600">Rp {{ number_format($transaction->grand_total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Pembelian</h3>
                <p class="text-gray-500 mb-6">Kamu belum pernah membeli produk apapun</p>
                
                <a href="{{ route('home') }}" 
                   class="inline-block bg-gradient-to-r from-blue-600 to-blue-800 text-white font-bold px-6 py-3 rounded-xl hover:from-blue-700 hover:to-blue-900 transition shadow-lg">
                    Belanja Sekarang
                </a>
            </div>
        @endif

        <a href="{{ route('wallet.index') }}" 
           class="block text-center mt-6 text-gray-600 hover:text-gray-800 font-semibold transition">
            ← Kembali ke Dompet
        </a>
    </div>

</div>

<script>
function copyVACode(vaCode) {
    navigator.clipboard.writeText(vaCode).then(() => {
        alert('✅ Kode VA berhasil disalin: ' + vaCode);
    }).catch(err => {
        console.error('Failed to copy: ', err);
        alert('❌ Gagal menyalin kode VA');
    });
}
</script>
@endsection
