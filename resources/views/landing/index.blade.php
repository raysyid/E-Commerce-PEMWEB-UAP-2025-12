<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Thriftsy</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite('resources/css/app.css')
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
    }
   
    /* Hero overlay gradient */
    .hero-gradient {
      background: linear-gradient(to right, rgba(0,0,0,0.7) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.2) 100%);
    }
   
    /* Product card hover */
    .product-card {
      transition: all 0.3s ease;
    }
   
    .product-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.1);
    }
   
    /* Store card accent */
    .store-card {
      position: relative;
      transition: all 0.3s ease;
    }
   
    .store-card::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      right: 0;
      height: 4px;
      background: linear-gradient(90deg, #000 0%, #3b82f6 100%);
      opacity: 0;
      transition: opacity 0.3s ease;
    }
   
    .store-card:hover::before {
      opacity: 1;
    }
   
    .store-card:hover {
      transform: translateY(-4px);
      box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }
  </style>
</head>

<body class="bg-gray-50 text-gray-900">

  {{-- NAVBAR GLOBAL --}}
  @include('layouts.navigation')

  {{-- HERO --}}
  <section class="relative h-[500px] overflow-hidden">
    <img src="{{ asset('assets/foto/fotoLanding.jpeg') }}"
         class="absolute inset-0 w-full h-full object-cover"
         alt="Vintage Fashion">
   
    <!-- Gradient Overlay -->
    <div class="absolute inset-0 hero-gradient"></div>
   
    <!-- Content -->
    <div class="relative h-full flex items-center px-10 md:px-20">
      <div class="max-w-2xl text-white">
        <h1 class="text-5xl md:text-6xl font-bold leading-tight mb-6">
          Jual-Beli<br>
          baju preloved<br>
          dan thrift
        </h1>
       
        <div class="flex gap-4 mt-8">
          @guest
          <a href="{{ route('login') }}"
            class="px-8 py-3 bg-white text-black font-semibold rounded-lg hover:bg-gray-100 transition">
            Mulai berjualan
          </a>
          @else
            @if(auth()->user()->role === 'member')
            <a href="/store/register"
              class="px-8 py-3 bg-white text-black font-semibold rounded-lg hover:bg-gray-100 transition">
              Mulai berjualan
            </a>
            @endif
          @endguest
        </div>
      </div>
    </div>
  </section>

  {{-- NEW ITEMS --}}
  <section class="px-10 py-16 bg-white">
    <div class="flex items-center justify-between mb-8">
      <h3 class="text-3xl font-bold">Hot Items</h3>
      <a href="#" class="text-sm font-semibold hover:underline flex items-center gap-1">
        Lihat semua
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
      </a>
    </div>

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
          <img src="{{ $image ? asset('storage/products/' . $image->image) : 'https://via.placeholder.com/300' }}"
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
  </section>

  {{-- REKOMENDASI TOKO --}}
  <section class="px-10 py-16 bg-gray-50">
    <div class="flex items-center justify-between mb-8">
      <h3 class="text-3xl font-bold">Rekomendasi Toko</h3>
      <a href="#" class="text-sm font-semibold hover:underline flex items-center gap-1">
        Lihat semua
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
      </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
      @foreach ($stores as $store)
      <div class="store-card bg-white rounded-xl p-6 text-center">
        <div class="flex justify-center mb-4">
          <img src="{{ asset('storage/store/' . $store->logo) }}"
            onerror="this.src='https://api.dicebear.com/7.x/initials/svg?seed={{ $store->name }}';"
            class="w-20 h-20 rounded-full object-cover border-2 border-gray-100">
        </div>

        <h4 class="font-bold text-lg capitalize mb-2">{{ $store->name }}</h4>
        
        <p class="text-sm text-gray-600 line-clamp-3 leading-relaxed mb-3">
          {{ $store->about }}
        </p>

        <div class="inline-flex items-center gap-1 text-xs text-gray-500 bg-gray-50 px-3 py-1.5 rounded-full">
          <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
          </svg>
          <span>{{ $store->city }}</span>
        </div>
      </div>
      @endforeach
    </div>
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

    <div class="flex items-center gap-4 mt-14 mb-6">
      <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 hover:bg-black hover:text-white transition">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
          <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
        </svg>
      </a>
      <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 hover:bg-black hover:text-white transition">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
          <path d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-5.2 1.74 2.89 2.89 0 012.31-4.64 2.93 2.93 0 01.88.13V9.4a6.84 6.84 0 00-1-.05A6.33 6.33 0 005 20.1a6.34 6.34 0 0010.86-4.43v-7a8.16 8.16 0 004.77 1.52v-3.4a4.85 4.85 0 01-1-.1z"/>
        </svg>
      </a>
      <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 hover:bg-black hover:text-white transition">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
          <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
        </svg>
      </a>
      <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 hover:bg-black hover:text-white transition">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
          <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
        </svg>
      </a>
      <a href="#" class="w-10 h-10 flex items-center justify-center rounded-full bg-gray-200 hover:bg-black hover:text-white transition">
        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
          <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
        </svg>
      </a>
    </div>

    <div class="flex gap-10 text-sm text-gray-700">
      <a href="#" class="hover:text-black transition">Privacy Policy</a>
      <a href="#" class="hover:text-black transition">Terms & Conditions</a>
    </div>
  </footer>

</body>
</html>
