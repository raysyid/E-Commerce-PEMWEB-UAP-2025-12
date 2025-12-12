<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>{{ ucfirst($store->name) }} - Thriftsy</title>
  <link rel="icon" type="image/png" href="{{ asset('assets/logo/thriftsy.png') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite('resources/css/app.css')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
   
    .product-card {
      transition: all 0.3s ease;
    }
   
    .product-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
  </style>
</head>

<body class="bg-gray-50 text-gray-900">

  {{-- NAVBAR GLOBAL --}}
  @include('layouts.navigation')

  {{-- STORE HEADER --}}
  <section class="bg-white border-b">
    <div class="max-w-7xl mx-auto px-10 py-12">
      <div class="flex items-start gap-8">
        {{-- Logo --}}
        <div class="flex-shrink-0">
          @php
            $logoPath = str_starts_with($store->logo, 'seed-')
              ? asset('assets/store/' . str_replace('seed-', '', $store->logo))
              : asset('storage/store/' . $store->logo);
          @endphp
          <img src="{{ $logoPath }}"
            onerror="this.src='https://api.dicebear.com/7.x/initials/svg?seed={{ $store->name }}';"
            class="w-32 h-32 rounded-full object-cover border-4 border-gray-100 shadow-lg">
        </div>

        {{-- Store Info --}}
        <div class="flex-1">
          <h1 class="text-4xl font-bold capitalize mb-3">{{ $store->name }}</h1>
          
          <div class="flex items-center gap-2 text-gray-600 mb-4">
            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
              <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
            </svg>
            <span class="font-medium">{{ $store->city }}</span>
          </div>

          <p class="text-gray-700 leading-relaxed max-w-3xl">
            {{ $store->about }}
          </p>

          <div class="mt-6 flex items-center gap-4 text-sm text-gray-600">
            <div class="flex items-center gap-2">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
              </svg>
              <span class="font-semibold">{{ $products->total() }} Produk</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  {{-- PRODUCTS --}}
  <section class="px-10 py-16 bg-white">
    <h3 class="text-3xl font-bold mb-8">Produk dari {{ ucfirst($store->name) }}</h3>

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

    {{-- Pagination --}}
    <div class="mt-8">
      {{ $products->links() }}
    </div>
    @else
    <div class="text-center py-16">
      <svg class="w-24 h-24 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
      </svg>
      <p class="text-gray-500 text-lg">Toko ini belum memiliki produk</p>
    </div>
    @endif
  </section>

  {{-- FOOTER --}}
  <footer class="bg-[#f5f3ee] text-black py-12 px-6 md:px-20 mt-16 border-t">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
      <div>
        <h3 class="font-bold text-lg mb-4">Thriftsy</h3>
        <ul class="space-y-2 text-sm text-gray-700">
          <li><a href="#" class="hover:text-black transition">Tentang Kami</a></li>
        </ul>
      </div>

      <div>
        <h3 class="font-bold text-lg mb-4">Discover</h3>
        <ul class="space-y-2 text-sm text-gray-700">
          <li><a href="#" class="hover:text-black transition">Cara Kerjanya</a></li>
          <li><a href="#" class="hover:text-black transition">Mulai Jualan</a></li>
          <li><a href="#" class="hover:text-black transition">Belanja</a></li>
        </ul>
      </div>

      <div>
        <h3 class="font-bold text-lg mb-4">Help</h3>
        <ul class="space-y-2 text-sm text-gray-700">
          <li><a href="#" class="hover:text-black transition">Contact</a></li>
        </ul>
      </div>
    </div>

    <div class="flex gap-10 text-sm text-gray-700 mt-8">
      <a href="#" class="hover:text-black transition">Privacy Policy</a>
      <a href="#" class="hover:text-black transition">Terms & Conditions</a>
    </div>
  </footer>

</body>
</html>
