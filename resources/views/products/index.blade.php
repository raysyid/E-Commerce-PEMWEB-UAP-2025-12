<h1>Daftar Produk</h1>

@foreach($products as $p)
    <a href="{{ route('product.detail', $p->slug) }}">
        <p>{{ $p->name }} - Rp {{ number_format($p->price) }}</p>
    </a>
@endforeach
