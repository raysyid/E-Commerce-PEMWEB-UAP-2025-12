@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-50 py-12">
    <div class="max-w-6xl mx-auto px-6">
        
        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-4xl font-bold text-gray-900">Checkout</h1>
            <p class="text-gray-600 mt-2">Lengkapi informasi pengiriman Anda</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- ================= LEFT : FORM ================= --}}
            <div class="lg:col-span-2">
                <form id="checkoutForm" action="{{ route('checkout.process') }}" method="POST" class="space-y-6">
                    @csrf

                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    {{-- Alamat Card --}}
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg">Alamat Pengiriman</h3>
                                <p class="text-sm text-gray-500">Masukkan alamat lengkap Anda</p>
                            </div>
                        </div>
                        <textarea name="address"
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-black transition resize-none"
                            rows="4"
                            placeholder="Jl. Contoh No. 123, Kecamatan, Kota, Provinsi, Kode Pos"
                            required></textarea>
                    </div>

                    {{-- Pengiriman Card --}}
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16V6a1 1 0 00-1-1H4a1 1 0 00-1 1v10a1 1 0 001 1h1m8-1a1 1 0 01-1 1H9m4-1V8a1 1 0 011-1h2.586a1 1 0 01.707.293l3.414 3.414a1 1 0 01.293.707V16a1 1 0 01-1 1h-1m-6-1a1 1 0 001 1h1M5 17a2 2 0 104 0m-4 0a2 2 0 114 0m6 0a2 2 0 104 0m-4 0a2 2 0 114 0"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg">Metode Pengiriman</h3>
                                <p class="text-sm text-gray-500">Pilih kurir pengiriman</p>
                            </div>
                        </div>
                        <select name="shipping_type"
                            id="shippingSelect"
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-black transition appearance-none bg-white cursor-pointer"
                            required>
                            <option value="">Pilih Metode Pengiriman</option>
                            <option value="standard">🚚 JNT — Rp 17.000 (3-4 hari)</option>
                            <option value="express">⚡ SiCepat — Rp 20.000 (2-3 hari)</option>
                            <option value="jne">📦 JNE — Rp 22.000 (1-2 hari)</option>
                        </select>
                    </div>

                    {{-- Pembayaran Card --}}
                    <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition">
                        <div class="flex items-center gap-3 mb-4">
                            <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg">Metode Pembayaran</h3>
                                <p class="text-sm text-gray-500">Pilih cara pembayaran</p>
                            </div>
                        </div>
                        <select name="payment_method"
                            class="w-full border-2 border-gray-200 rounded-xl px-4 py-3 focus:outline-none focus:border-black transition appearance-none bg-white cursor-pointer"
                            required>
                            <option value="">Pilih Metode Pembayaran</option>
                            <option value="wallet">💳 Saldo Wallet</option>
                            <option value="va">🏦 Virtual Account</option>
                        </select>
                    </div>

                </form>
            </div>

            {{-- ================= RIGHT: ORDER SUMMARY ================= --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl p-6 shadow-lg border border-gray-100 sticky top-6">
                    <div id="orderSummary" data-price="{{ $product->price }}">
                        
                        <h3 class="text-xl font-bold mb-6 pb-4 border-b">Ringkasan Pesanan</h3>

                        {{-- Product Info --}}
                        <div class="flex items-start gap-4 mb-6 pb-6 border-b">
                            @php
                                $thumbnail = $product->productImages->firstWhere('is_thumbnail', 1);
                            @endphp
                            
                            <div class="w-20 h-20 rounded-xl overflow-hidden bg-gray-100 flex-shrink-0 border border-gray-200">
                                <img src="{{ $thumbnail 
                                        ? asset('storage/products/' . $thumbnail->image)
                                        : 'https://via.placeholder.com/80'
                                    }}"
                                    class="w-full h-full object-cover object-center">
                            </div>

                            <div class="flex-1">
                                <p class="font-bold text-gray-900 line-clamp-2">{{ $product->name }}</p>
                                <p class="text-sm text-gray-500 mt-1">{{ $product->productCategory->name }}</p>
                                <p class="text-base font-semibold text-gray-900 mt-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            </div>
                        </div>

                        {{-- Price Breakdown --}}
                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Subtotal</span>
                                <span class="font-medium">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>

                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Biaya Pengiriman</span>
                                <span id="ship" class="font-medium text-gray-400">Pilih kurir</span>
                            </div>
                        </div>

                        {{-- Total --}}
                        <div class="pt-4 border-t-2 border-gray-900 mb-6">
                            <div class="flex justify-between items-center">
                                <span class="text-lg font-bold">Total</span>
                                <span id="total" class="text-2xl font-bold">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        {{-- BUTTON BAYAR --}}
                        <button form="checkoutForm"
                            class="w-full bg-black text-white py-4 rounded-xl font-bold text-lg hover:bg-gray-800 transition transform hover:scale-[1.02] active:scale-[0.98] shadow-lg">
                            Bayar Sekarang
                        </button>

                        <p class="text-xs text-gray-500 text-center mt-4">
                            🔒 Pembayaran aman dan terenkripsi
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- ================= JS ONGKIR ================= --}}
<script>
    const orderBox = document.getElementById('orderSummary');
    const productPrice = Number(orderBox.dataset.price || 0);

    const shipText = document.getElementById('ship');
    const totalText = document.getElementById('total');
    const select = document.getElementById('shippingSelect');

    const rates = {
        standard: 17000,
        express: 20000,
        jne: 22000
    };

    select.addEventListener('change', function () {
        const ship = rates[this.value] ?? 0;

        if (ship > 0) {
            shipText.textContent = "Rp " + ship.toLocaleString("id-ID");
            shipText.classList.remove('text-gray-400');
            shipText.classList.add('font-semibold');
        } else {
            shipText.textContent = "Pilih kurir";
            shipText.classList.add('text-gray-400');
            shipText.classList.remove('font-semibold');
        }
        
        totalText.textContent = "Rp " + (productPrice + ship).toLocaleString("id-ID");
    });
</script>

@endsection