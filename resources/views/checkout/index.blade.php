@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-8 py-10 grid grid-cols-1 md:grid-cols-2 gap-16">

    {{-- ================= LEFT : FORM ================= --}}
    <div>
        <h2 class="text-3xl font-bold mb-8">Checkout</h2>

        <form id="checkoutForm" action="{{ route('checkout.process') }}" method="POST" class="space-y-6">
            @csrf

            <input type="hidden" name="product_id" value="{{ $product->id }}">

            {{-- Alamat --}}
            <div>
                <label class="block text-sm font-medium mb-1">Alamat Lengkap</label>
                <textarea name="address"
                    class="w-full border rounded-lg px-4 py-2 h-28 focus:ring focus:ring-black/20"
                    placeholder="Masukkan alamat lengkap..."
                    required></textarea>
            </div>

            {{-- Pengiriman --}}
            <div>
                <label class="block text-sm font-medium mb-1">Metode Pengiriman</label>
                <select name="shipping_type"
                    id="shippingSelect"
                    class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-black/20"
                    required>
                    <option value="">Pilih Metode Pengiriman</option>
                    <option value="standard">JNT — Rp 17.000</option>
                    <option value="express">SiCepat — Rp 20.000</option>
                    <option value="jne">JNE — Rp 22.000</option>
                </select>
            </div>

            {{-- Pembayaran --}}
            <div>
                <label class="block text-sm font-medium mb-1">Metode Pembayaran</label>
                <select name="payment_method"
                    class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-black/20"
                    required>
                    <option value="">Pilih Metode Pembayaran</option>
                    <option value="wallet">Saldo Wallet</option>
                    <option value="va">Virtual Account</option>
                </select>
            </div>

        </form>
    </div>

    {{-- ================= RIGHT: ORDER ================= --}}
    <div id="orderSummary"
         class="border rounded-xl p-6 shadow-sm"
         data-price="{{ $product->price }}">

        <div class="flex justify-between items-start mb-6">
            <h3 class="text-lg font-bold">Ringkasan Pesanan</h3>
        </div>

        <div class="flex items-center gap-4 mb-4">
            <img src="https://via.placeholder.com/80"
                class="w-16 h-16 object-cover rounded-lg">

            <div>
                <p class="font-semibold">{{ $product->name }}</p>
                <p class="text-sm text-gray-600">Rp {{ number_format($product->price) }}</p>
            </div>
        </div>

        <div class="text-sm space-y-2 border-t pt-4">
            <div class="flex justify-between">
                <span>Subtotal</span>
                <span>Rp {{ number_format($product->price) }}</span>
            </div>

            <div class="flex justify-between">
                <span>Pengiriman</span>
                <span id="ship">-</span>
            </div>

            <div class="flex justify-between font-bold text-lg border-t pt-2">
                <span>Total</span>
                <span id="total">Rp {{ number_format($product->price) }}</span>
            </div>
        </div>

        {{-- BUTTON BAYAR --}}
        <button form="checkoutForm"
            class="w-full mt-6 bg-black text-white py-3 rounded-lg font-semibold hover:bg-gray-800">
            Bayar Sekarang
        </button>

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

        shipText.textContent = "Rp " + ship.toLocaleString("id-ID");
        totalText.textContent = "Rp " + (productPrice + ship).toLocaleString("id-ID");
    });
</script>

@endsection