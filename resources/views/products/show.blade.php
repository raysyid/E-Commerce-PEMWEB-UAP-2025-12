<h2>{{ $product->name }}</h2>

<p>Kategori: {{ $product->productCategory->name }}</p>

<p>Harga: Rp {{ number_format($product->price) }}</p>

<p>Penjual: {{ $product->store->name }}</p>

<a href="/checkout?product={{ $product->id }}">Beli Sekarang</a>
