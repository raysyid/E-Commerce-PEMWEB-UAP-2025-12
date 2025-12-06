<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Thriftsy</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-white text-gray-800">

    {{-- Navbar --}}
    <nav class="flex justify-between items-center px-10 py-6">
        <h1 class="text-2xl font-bold tracking-wide">Thriftsy</h1>

        {{-- Search --}}
        <div class="w-1/3">
            <input type="text" placeholder="Cari pakaian vintage..."
                class="w-full border rounded-full px-4 py-2 outline-none shadow-sm">
        </div>

        {{-- Auth --}}
        <div>
            @guest
                <a href="{{ route('login') }}" class="mr-4 font-semibold">Login</a>
                <a href="{{ route('register') }}" class="bg-black text-white px-4 py-2 rounded-lg">
                    Daftar
                </a>
            @endguest

            @auth
                <a href="/dashboard" class="font-semibold">{{ auth()->user()->name }}</a>
            @endauth
        </div>
    </nav>

    {{-- Gender Filter --}}
    <div class="flex gap-6 px-10 text-lg font-medium">
        <a href="#" class="hover:text-black text-gray-600">Pria</a>
        <a href="#" class="hover:text-black text-gray-600">Wanita</a>
    </div>

    {{-- Hero Banner --}}
    <section class="px-10 my-10">
        <div class="bg-gray-800 text-white rounded-xl p-10">
            <h2 class="text-4xl font-extrabold leading-snug w-2/3">
                THRIFT JUAL-BELI BAJU VINTAGE DENGAN BAHAN BERKUALITAS
            </h2>

            @guest
                <a href="{{ route('login') }}" class="mt-6 inline-block bg-white text-black px-5 py-2 rounded-lg">
                    Berjualan Sekarang
                </a>
            @else
                <a href="/store/register" class="mt-6 inline-block bg-white text-black px-5 py-2 rounded-lg">
                    Berjualan Sekarang
                </a>
            @endguest
        </div>
    </section>

    {{-- Trending Items --}}
    <section class="px-10 my-8">
        <h3 class="text-xl font-bold mb-4">Trending Item</h3>

        <div class="grid grid-cols-3 gap-6">
            @foreach($products as $product)
                <a href="{{ route('product.detail', $product->slug) }}" class="border rounded-xl overflow-hidden shadow-sm">
                    <img src="{{ $product->productImages->first()->image ?? 'https://via.placeholder.com/300' }}"
                         class="w-full h-72 object-cover">
                    <div class="p-3">
                        <h4 class="font-semibold">{{ $product->name }}</h4>
                        <p class="text-gray-600">Rp {{ number_format($product->price) }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </section>

</body>
</html>