<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Toko Rekomendasi - Thriftsy</title>
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
      <h1 class="text-4xl font-bold text-gray-900">Toko Rekomendasi</h1>
      <p class="text-gray-600 mt-2">16 toko terbaik dengan produk terbanyak</p>
    </div>

    {{-- STORES GRID --}}
    @if($stores->count() > 0)
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
      @foreach ($stores as $store)
      <a href="{{ route('store.show', $store->id) }}" class="store-card bg-white rounded-xl p-6 text-center block hover:shadow-xl transition">
        <div class="flex justify-center mb-4">
          @php
            $logoPath = str_starts_with($store->logo, 'seed-')
              ? asset('assets/store/' . str_replace('seed-', '', $store->logo))
              : asset('storage/store/' . $store->logo);
          @endphp
          <img src="{{ $logoPath }}"
            onerror="this.src='https://api.dicebear.com/7.x/initials/svg?seed={{ $store->name }}';"
            class="w-20 h-20 rounded-full object-cover border-2 border-gray-100">
        </div>

        <h4 class="font-bold text-lg capitalize mb-2">{{ $store->name }}</h4>
        
        <p class="text-sm text-gray-600 line-clamp-3 leading-relaxed mb-3">
          {{ $store->about }}
        </p>

        <div class="flex items-center justify-center gap-2 text-sm text-gray-500">
          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
          </svg>
          <span class="font-semibold">{{ $store->products_count }} Produk</span>
        </div>
      </a>
      @endforeach
    </div>
    @else
    <div class="text-center py-16">
      <div class="text-6xl mb-4">🏪</div>
      <p class="text-xl text-gray-500">Belum ada toko</p>
    </div>
    @endif

  </section>

  {{-- FOOTER --}}
  @include('layouts.footer')

</body>
</html>
