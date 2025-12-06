<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }} - Thriftsy</title>
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
        <div class="text-sm font-semibold">
            @guest
            <a href="{{ route('login') }}" class="mr-4 hover:underline">Login</a>
            <a href="{{ route('register') }}" class="hover:underline">Daftar</a>
            @endguest

            @auth
            <a href="/dashboard" class="hover:underline">{{ auth()->user()->name }}</a>
            @endauth
        </div>
    </nav>

    {{-- KATEGORI --}}
    <div class="px-10 py-3 text-sm text-gray-600 flex gap-6 font-medium">
        <a href="#" class="hover:text-black">Pria</a>
        <a href="#" class="hover:text-black">Wanita</a>
    </div>

    {{-- ================= PRODUCT DETAIL ================= --}}
    <div class="max-w-6xl mx-auto p-6 lg:flex lg:gap-12">

        {{-- LEFT : Product Image --}}
        <div class="lg:w-1/2">
            @php
            $thumbnail = $product->productImages->firstWhere('is_thumbnail', 1);
            @endphp

            @if($thumbnail)
            <img src="{{ asset('storage/products/' . $thumbnail->image) }}"
                class="rounded-lg w-full max-w-md object-cover" />
            @else
            <img src="https://via.placeholder.com/600"
                class="rounded-lg w-full max-w-md object-cover" />
            @endif
        </div>

        {{-- RIGHT : Product Info --}}
        <div class="lg:w-1/2 mt-8 lg:mt-0">
            <h1 class="text-3xl font-bold">{{ $product->name }}</h1>

            <p class="text-gray-600 mt-1 text-sm">
                {{ $product->productCategory->name }} · {{ $product->condition }}
            </p>

            <p class="mt-4 text-2xl font-semibold">
                Rp {{ number_format($product->price, 0, ',', '.') }}
            </p>

            <div class="flex gap-3 mt-6">
                <a href="{{ route('checkout.index', ['product' => $product->id]) }}"
                    class="w-full bg-black text-white py-3 rounded-md hover:bg-gray-800 text-center">
                    Beli Sekarang
                </a>

                <a href="https://wa.me/{{ $product->store->phone }}?text=Halo, saya tertarik dengan {{ $product->name }}"
                    class="w-full border py-3 rounded-md text-center">
                    Hubungi Penjual
                </a>
            </div>

            {{-- Detail Barang --}}
            <div class="mt-8">
                <h2 class="font-semibold text-lg">Detail Barang</h2>
                <p class="text-gray-700 mt-2 text-sm leading-relaxed">
                    {{ $product->description }}
                </p>
            </div>

            {{-- Store Info --}}
            <div class="mt-10 border-t pt-6 flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-600 text-2xl">
                    👤
                </div>
                <div>
                    <p class="font-medium">{{ $product->store->name }}</p>
                    <p class="text-gray-500 text-sm">{{ $product->store->city }}</p>
                </div>
            </div>

        </div>
    </div>


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