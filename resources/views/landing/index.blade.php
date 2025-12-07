<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <title>Thriftsy</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  @vite('resources/css/app.css')
</head>

<body class="bg-white text-gray-800">

  {{-- NAVBAR --}}
  <nav class="w-full flex items-center justify-between px-10 py-6 border-b bg-white">
    <a href="/" class="text-2xl font-bold tracking-wide">Thriftsy</a>

    {{-- Search --}}
    <div class="hidden md:flex w-1/3">
      <input type="text" placeholder="Cari pakaian vintage..."
        class="w-full border rounded-lg px-4 py-2 outline-none shadow-sm text-sm">
    </div>

    {{-- Auth --}}
    <div class="relative text-sm font-semibold">
      @guest
      <a href="{{ route('login') }}" class="hover:underline">Login</a>
      <a href="{{ route('register') }}" class="hover:underline">Daftar</a>
      @else

      <div class="group inline-block relative">

        {{-- Trigger (nama user + ikon optional) --}}
        <button class="flex items-center gap-1 text-gray-800">
          {{ auth()->user()->name }}
          <span class="text-xs">▼</span>
        </button>

        {{-- Dropdown --}}
        <div
          class="absolute right-0 mt-2 w-36 bg-white border rounded-lg shadow-lg 
                opacity-0 invisible group-hover:opacity-100 group-hover:visible 
                transition-all duration-150 z-50">
          <a href="{{ route('profile.edit') }}"
            class="block px-4 py-2 hover:bg-gray-100 text-gray-700">
            Profil
          </a>

          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
              class="w-full text-left px-4 py-2 text-red-500 hover:bg-gray-100">
              Logout
            </button>
          </form>
        </div>
      </div>

      @endguest
    </div>
  </nav>

  {{-- KATEGORI --}}
  <div class="px-10 py-3 text-sm text-gray-600 flex gap-6 font-medium">
    <a href="#" class="hover:text-black">Pria</a>
    <a href="#" class="hover:text-black">Wanita</a>
  </div>

  {{-- HERO SECTION (FULL WIDTH FEEL) --}}
  <section class="px-10 mt-6">
    <div class="w-full bg-gray-800 rounded-2xl p-12 text-white relative overflow-hidden">

      <h2 class="text-3xl md:text-4xl font-bold leading-snug w-full md:w-2/3">
        THRIFT JUAL-BELI BAJU VINTAGE<br />
        DENGAN BAHAN BERKUALITAS
      </h2>

      @guest
      <a href="{{ route('login') }}"
        class="mt-6 inline-block bg-white text-black px-6 py-3 rounded-lg font-semibold">
        Berjualan Sekarang
      </a>
      @else
      <a href="/store/register"
        class="mt-6 inline-block bg-white text-black px-6 py-3 rounded-lg font-semibold">
        Berjualan Sekarang
      </a>
      @endguest

    </div>
  </section>

  {{-- TRENDING ITEM --}}
  <section class="px-10 my-10">
    <h3 class="text-xl font-bold mb-4">TRENDING ITEM</h3>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
      @foreach ($products as $product)

      @php
      $image = $product->productImages->where('is_thumbnail', 1)->first()
      ?? $product->productImages->first()
      ?? null;
      @endphp

      <a href="{{ route('product.detail', $product->slug) }}" class="group">

        {{-- Image --}}
        <div class="aspect-square w-full overflow-hidden rounded-xl bg-gray-100">
          <img src="{{ $image ? asset('storage/products/' . $image->image) : 'https://via.placeholder.com/300' }}"
            class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
        </div>

        {{-- Name + Price --}}
        <div class="mt-2">
          <h4 class="font-semibold text-sm line-clamp-1">{{ $product->name }}</h4>
          <p class="text-gray-700 text-sm">
            Rp {{ number_format($product->price, 0, ',', '.') }}
          </p>
        </div>

      </a>

      @endforeach
    </div>
  </section>

  {{-- REKOMENDASI TOKO --}}
  <section class="px-10 my-14">
    <h3 class="text-xl font-bold mb-6">Rekomendasi Toko</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">

      @foreach ($stores as $store)
      <div class="border rounded-xl p-6 text-center shadow-sm hover:shadow-md transition">

        {{-- Logo toko --}}
        <div class="flex justify-center mb-4">
          <img src="{{ asset('storage/store/' . $store->logo) }}"
            onerror="this.src='https://api.dicebear.com/7.x/initials/svg?seed={{ $store->name }}';"
            class="w-16 h-16 rounded-full object-cover">
        </div>

        {{-- Nama Toko --}}
        <h4 class="font-semibold text-lg capitalize">{{ $store->name }}</h4>

        {{-- Deskripsi --}}
        <p class="text-sm text-gray-600 mt-2 leading-relaxed line-clamp-3">
          {{ $store->about }}
        </p>

        {{-- Kota --}}
        <p class="text-xs text-gray-500 mt-2">
          📍 {{ $store->city }}
        </p>

      </div>
      @endforeach

    </div>
  </section>


  {{-- FOOTER --}}
  <footer class="bg-[#f7f4ed] text-black py-12 px-6 md:px-20">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-10">

      <!-- Column 1 -->
      <div>
        <h3 class="font-semibold text-lg mb-4">Thriftsy</h3>
        <ul class="space-y-2 text-sm text-gray-700">
          <li><a href="#" class="hover:text-black">Tentang Kami</a></li>
        </ul>
      </div>

      <!-- Column 2 -->
      <div>
        <h3 class="font-semibold text-lg mb-4">Discover</h3>
        <ul class="space-y-2 text-sm text-gray-700">
          <li><a href="#" class="hover:text-black">Cara Kerjanya</a></li>
          <li><a href="#" class="hover:text-black">Mulai Jualan</a></li>
          <li><a href="#" class="hover:text-black">Belanja</a></li>
        </ul>
      </div>

      <!-- Column 3 -->
      <div>
        <h3 class="font-semibold text-lg mb-4">Help</h3>
        <ul class="space-y-2 text-sm text-gray-700">
          <li><a href="#" class="hover:text-black">Contact</a></li>
        </ul>
      </div>

    </div>

    <!-- Social Icons -->
    <div class="flex items-center gap-4 mt-14 mb-6">
      <a href="#"><img src="icons/ig.svg" class="w-6"></a>
      <a href="#"><img src="icons/tiktok.svg" class="w-6"></a>
      <a href="#"><img src="icons/x.svg" class="w-6"></a>
      <a href="#"><img src="icons/fb.svg" class="w-6"></a>
      <a href="#"><img src="icons/linkedin.svg" class="w-6"></a>
    </div>

    <!-- Bottom Links -->
    <div class="flex gap-10 text-sm text-gray-700">
      <a href="#" class="hover:text-black">Privacy Policy</a>
      <a href="#" class="hover:text-black">Terms & Conditions</a>
    </div>
  </footer>

</body>

</html>