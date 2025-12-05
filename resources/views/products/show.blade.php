<h2>{{ $product->name }}</h2>
<p>Kategori: {{ $product->productCategory->name }}</p>
<p>Harga: Rp {{ number_format($product->price) }}</p>
<p>Penjual: {{ $product->store->name }}</p>

<a href="{{ route('checkout.index', ['product' => $product->id]) }}" class="btn btn-dark">
    Beli Sekarang
</a>

<a href="https://wa.me/{{ $product->store->phone }}?text=Halo, saya tertarik dengan {{ $product->name }} masih tersedia?"
   class="btn btn-outline-dark">
    Hubungi Penjual
</a>