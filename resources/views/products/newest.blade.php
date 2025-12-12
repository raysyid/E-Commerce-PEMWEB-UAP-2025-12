<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Produk Terbaru - Thriftsy</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/logo/thriftsy.png') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite('resources/css/app.css')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    body { font-family: 'Inter', sans-serif; }
  </style>
</head>

<body class="bg-gray-50 text-gray-900">

  {{-- NAVBAR --}}
  @include('layouts.navigation')

  {{-- MAIN CONTENT --}}
  <section class="max-w-7xl mx-auto px-10 py-16">
    
    {{-- HEADER --}}
    <div class="mb-10">
      <h1 class="text-4xl font-bold text-gray-900">Produk Terbaru</h1>
      <p class="text-gray-600 mt-2">16 produk terbaru yang tersedia di Thriftsy</p>
    </div>

    {{-- PRODUCTS GRID --}}
    @if($products->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-4 gap-5">
      @foreach ($products as $product)
      @php
      $image = $product->productImages->where('is_thumbnail', 1)->first()
      ?? $product->productImages->first()
      ?? null;
      @endphp

      <a href="{{ route('product.detail', $product->slug) }}" class="product-card group bg-white border border-gray-200 rounded-lg overflow-hidden">
        {{-- Image --}}
        <div class="aspect-square w-full overflow-hidden bg-gray-100">
          @php
            $imagePath = $image 
              ? (str_starts_with($image->image, 'seed-') 
                  ? asset('assets/products-seed/' . str_replace('seed-', '', $image->image))
                  : asset('storage/products/' . $image->image))
              : 'https://via.placeholder.com/300';
          @endphp
          <img src="{{ $imagePath }}"
            class="w-full h-full object-cover transition duration-500 group-hover:scale-105">
        </div>

        {{-- Name + Price --}}
        <div class="p-3">
          <h4 class="font-medium text-sm line-clamp-2 text-gray-900 mb-1">
            {{ $product->name }}
          </h4>
          <p class="text-black font-bold text-base">
            Rp {{ number_format($product->price, 0, ',', '.') }}
          </p>
        </div>
      </a>
      @endforeach
    </div>
    @else
    <div class="text-center py-16">
      <div class="text-6xl mb-4">📦</div>
      <p class="text-xl text-gray-500">Belum ada produk</p>
    </div>
    @endif

  </section>

  {{-- FOOTER --}}
  @include('layouts.footer')

</body>
</html>
