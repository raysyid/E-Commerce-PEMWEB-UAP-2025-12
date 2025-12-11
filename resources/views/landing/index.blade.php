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
  <nav class="w-full flex items-center justify-between px-12 py-4 border-b bg-white shadow-sm relative">

    <a href="/" class="relative flex items-center">
        <div class="h-10 flex items-center"> 
            <img src="{{ asset('assets/logo/thriftsy.png') }}" 
                 class="h-20 w-auto object-contain -ml-2">
        </div>
    </a>



    {{-- Search --}}
    <div class="hidden md:flex w-1/3">
      <input type="text" placeholder="Cari pakaian vintage..."
        class="w-full border rounded-xl px-4 py-2 outline-none shadow-sm text-sm focus:ring-2 focus:ring-gray-300 transition">
    </div>

    {{-- Auth --}}
    <div class="flex items-center gap-6 text-sm font-semibold">

      @guest
      <a href="{{ route('login') }}" class="hover:text-black transition">Login</a>
      <a href="{{ route('register') }}"
        class="px-4 py-2 bg-black text-white rounded-xl hover:bg-gray-800 transition">
        Daftar
      </a>
      @else

      {{-- MEMBER ONLY WALLET --}}
      @if(auth()->user()->role === 'member')
      <a href="{{ route('wallet.index') }}"
        class="p-2 rounded-xl bg-blue-500 text-white hover:bg-blue-600 transition flex items-center shadow-sm">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
          <path d="M20 7h-2V5a1 1 0 0 0-1-1H5a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h14a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1zm-4-2v2H5a1 1 0 0 1 0-2h11zm3 14H5a1 1 0 0 1-1-1V8h15v11z" />
          <circle cx="15" cy="13" r="2" />
        </svg>
      </a>
      @endif

      {{-- SELLER ONLY --}}
      @if(auth()->user()->role === 'seller' && auth()->user()->store)
      <a href="{{ route('seller.dashboard') }}"
        class="px-4 py-2 bg-black text-white rounded-xl hover:bg-gray-800 transition shadow-sm">
        🏪 Toko Saya
      </a>
      @endif

      {{-- ADMIN --}}
      @if(auth()->user()->role === 'admin')
      <a href="{{ route('admin.dashboard') }}"
        class="px-4 py-2 bg-purple-600 text-white rounded-xl hover:bg-purple-700 transition shadow-sm">
        🛠 Admin Panel
      </a>
      @endif

      {{-- DROPDOWN --}}
      <div class="group inline-block relative">
        <button class="flex items-center gap-1 text-gray-800 hover:text-black transition">
          {{ auth()->user()->name }}
          <span class="text-xs">▼</span>
        </button>

        <div
          class="absolute right-0 mt-2 w-36 bg-white border rounded-xl shadow-md opacity-0 invisible
                      group-hover:opacity-100 group-hover:visible transition-all duration-150 z-50">
          <a href="{{ route('profile.edit') }}"
            class="block px-4 py-2 hover:bg-gray-100 text-gray-700 transition">Profil</a>

          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit"
              class="w-full text-left px-4 py-2 text-red-500 hover:bg-gray-100 transition">
              Logout
            </button>
          </form>
        </div>
      </div>

      @endguest
    </div>
  </nav>

  {{-- KATEGORI --}}
  <div class="px-7 py-4">
  <div class="flex gap-4">

    <a href="#"
      class="flex items-center gap-2 px-5 py-1 bg-gray-100 rounded-2xl shadow-sm hover:bg-gray-200 hover:shadow-md transition">
      <span class="font-semibold">Pria</span>
    </a>

    <a href="#"
      class="flex items-center gap-2 px-5 py-1 bg-gray-100 rounded-2xl shadow-sm hover:bg-gray-200 hover:shadow-md transition">
      <span class="font-semibold">Wanita</span>
    </a>
  </div>
</div>


  {{-- HERO --}}
  <section class="px-10 mt-8">
  <div
    class="w-full rounded-3xl p-12 text-white shadow-lg relative overflow-hidden bg-center bg-cover"
    style="background-image: url('/images/hero-vintage.jpg');">

    <!-- overlay gelap untuk memperjelas teks -->
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>

    <!-- content -->
    <div class="relative z-10">
      <h2 class="text-4xl md:text-4xl font-bold leading-tight tracking-tight">
        Pieces Vintage Pilihan <br />
        yang Bikin Gayamu Makin Standout
      </h2>

      @guest
      <a href="{{ route('login') }}"
        class="mt-8 inline-block bg-white text-black px-8 py-3 rounded-xl font-semibold shadow-md hover:shadow-lg transition">
        Mulai Berjualan
      </a>
      @else
      <a href="/store/register"
        class="mt-8 inline-block bg-white text-black px-8 py-3 rounded-xl font-semibold shadow-md hover:shadow-lg transition">
        Mulai Berjualan
      </a>
      @endguest
    </div>
  </div>
</section>


  {{-- NEW ITEMS --}}
  <section class="px-10 my-12">
    <h3 class="text-2xl font-bold mb-6">New Items</h3>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-8">
      @foreach ($products as $product)
      @php
      $image = $product->productImages->where('is_thumbnail', 1)->first()
      ?? $product->productImages->first()
      ?? null;
      @endphp

      <a href="{{ route('product.detail', $product->slug) }}" class="group">

        {{-- Image --}}
        <div class="aspect-square w-full overflow-hidden rounded-2xl bg-gray-100 shadow-sm">
          <img src="{{ $image ? asset('storage/products/' . $image->image) : 'https://via.placeholder.com/300' }}"
            class="w-full h-full object-cover transition duration-300 group-hover:scale-110">
        </div>

        {{-- Name + Price --}}
        <div class="mt-3">
          <h4 class="font-semibold text-base line-clamp-1 group-hover:text-black transition">
            {{ $product->name }}
          </h4>
          <p class="text-gray-700 text-sm mt-1">
            Rp {{ number_format($product->price, 0, ',', '.') }}
          </p>
        </div>

      </a>
      @endforeach
    </div>
  </section>

  {{-- REKOMENDASI TOKO --}}
  <section class="px-10 my-14">
    <h3 class="text-2xl font-bold mb-6">Rekomendasi Toko</h3>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">

      @foreach ($stores as $store)
      <div
        class="border rounded-2xl p-6 text-center shadow-sm hover:shadow-lg transition bg-white">

        <div class="flex justify-center mb-4">
          <img src="{{ asset('storage/store/' . $store->logo) }}"
            onerror="this.src='https://api.dicebear.com/7.x/initials/svg?seed={{ $store->name }}';"
            class="w-16 h-16 rounded-full object-cover shadow-sm">
        </div>

        <h4 class="font-semibold text-lg capitalize">{{ $store->name }}</h4>

        <p class="text-sm text-gray-600 mt-3 line-clamp-3 leading-relaxed">
          {{ $store->about }}
        </p>

        <p class="text-xs text-gray-500 mt-2">
          📍 {{ $store->city }}
        </p>

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
      <a href="#"><img src="icons/ig.svg" class="w-6 opacity-80 hover:opacity-100 transition"></a>
      <a href="#"><img src="icons/tiktok.svg" class="w-6 opacity-80 hover:opacity-100 transition"></a>
      <a href="#"><img src="icons/x.svg" class="w-6 opacity-80 hover:opacity-100 transition"></a>
      <a href="#"><img src="icons/fb.svg" class="w-6 opacity-80 hover:opacity-100 transition"></a>
      <a href="#"><img src="icons/linkedin.svg" class="w-6 opacity-80 hover:opacity-100 transition"></a>
    </div>

    <div class="flex gap-10 text-sm text-gray-700">
      <a href="#" class="hover:text-black transition">Privacy Policy</a>
      <a href="#" class="hover:text-black transition">Terms & Conditions</a>
    </div>
  </footer>

</body>

</html>
