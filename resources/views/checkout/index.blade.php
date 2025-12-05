<h2>Checkout</h2>

<p>Produk: {{ $product->name }}</p>
<p>Harga: Rp {{ number_format($product->price) }}</p>

<form method="POST" action="{{ route('checkout.process') }}">
    @csrf

    <input type="hidden" name="product_id" value="{{ $product->id }}">

    <label>Alamat:</label>
    <textarea name="address" required></textarea>

    <label>Pengiriman:</label>
    <select name="shipping_type" required>
        <option value="standard">Standard (Rp 15.000)</option>
        <option value="express">Express (Rp 25.000)</option>
    </select>

    <label>Pembayaran:</label>
    <select name="payment_method" required>
        <option value="wallet">Saldo Wallet</option>
        <option value="va">Virtual Account</option>
    </select>

    <button type="submit" class="btn btn-dark">Bayar Sekarang</button>
</form>