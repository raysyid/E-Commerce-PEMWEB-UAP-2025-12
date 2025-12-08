@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto px-8 py-10 grid grid-cols-1 md:grid-cols-2 gap-16">



    {{-- ================= LEFT : FORM ================= --}}
    <div>
        <h2 class="text-3xl font-bold mb-8">Isi Data Penerima</h2>

        <form id="checkoutForm" action="{{ route('checkout.process') }}" method="POST" class="space-y-6">
            @csrf

            <input type="hidden" name="product_id" value="{{ $product->id }}">

            {{-- Nama --}}
            <div>
                <label class="block text-sm font-medium mb-1">Nama Penerima</label>
                <input type="text" name="receiver_name" value="{{ auth()->user()->name }}"
                    class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-black/20" required>
            </div>

            {{-- Alamat --}}
            <div>
                <label class="block text-sm font-medium mb-1">Alamat Lengkap</label>
                <textarea name="address"
                    class="w-full border rounded-lg px-4 py-2 h-28 focus:ring focus:ring-black/20" required></textarea>
            </div>

            {{-- Telp --}}
            <div>
                <label class="block text-sm font-medium mb-1">No Telp</label>
                <input type="text" name="phone"
                    class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-black/20" required>
            </div>

            {{-- Pengiriman --}}
            <div>
                <label class="block text-sm font-medium mb-1">Metode Pengiriman</label>
                <select name="shipping_type"
                    class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-black/20" required>
                    <option value="">Pilih Metode Pengiriman</option>
                    <option value="standard">JNT Rp 17.000</option>
                    <option value="express">SiCepat Rp 20.000</option>
                </select>
            </div>

            {{-- Pembayaran --}}
            <div>
                <label class="block text-sm font-medium mb-1">Metode Pembayaran</label>
                <select name="payment_method"
                    class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-black/20" required>
                    <option value="">Pilih Metode Pembayaran</option>
                    <option value="wallet">Saldo Wallet</option>
                    <option value="va">Virtual Account</option>
                </select>
            </div>
        </form>
    </div>

    {{-- ================= RIGHT : SELLER + ORDER ================= --}}
    <div class="border rounded-xl p-6 shadow-sm">

        {{-- Header --}}
        <div class="flex justify-between items-start mb-6">
            <h3 class="text-lg font-bold">Seller</h3>

            <div class="text-right text-xs text-gray-500">
                <p class="font-semibold">Garansi Pembeli</p>
                <p>Pembelianmu Terlindungi</p>
            </div>
        </div>

        {{-- Seller --}}
        <div class="flex items-center gap-4 mb-6">
            <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center font-bold">
                {{ strtoupper(substr($product->store->name,0,1)) }}
            </div>

            <div>
                <p class="font-semibold">{{ $product->store->name }}</p>
                <p class="text-xs text-gray-500">{{ $product->store->city }}</p>
            </div>
        </div>

        {{-- Order --}}
        <h3 class="font-bold mb-4">Order</h3>

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
                <span>1 Item</span>
                <span>Rp {{ number_format($product->price) }}</span>
            </div>

            <div class="flex justify-between">
                <span>Pengiriman</span>
                <span>Rp 17.000</span>
            </div>

            <div class="flex justify-between font-bold text-lg border-t pt-2">
                <span>Total</span>
                <span>Rp {{ number_format($product->price + 17000) }}</span>
            </div>
        </div>

        {{-- BUTTON BAYAR (KANAN BAWAH) --}}
        <button form="checkoutForm"
            class="w-full mt-6 bg-black text-white py-3 rounded-lg font-semibold hover:bg-gray-800">
            Bayar Sekarang
        </button>

    </div>

</div>

@endsection
