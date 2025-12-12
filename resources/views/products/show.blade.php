<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $product->name }} - Thriftsy</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-white text-gray-800">

    {{-- NAVBAR GLOBAL --}}
    @include('layouts.navigation')

    {{-- PRODUCT DETAIL --}}
    <div class="max-w-6xl mx-auto p-6 lg:flex lg:gap-12">

        {{-- LEFT IMAGE --}}
        <div class="lg:w-1/2">
            @php
                $thumbnail = $product->productImages->firstWhere('is_thumbnail', 1);
            @endphp

            <div class="aspect-square w-full max-w-md mx-auto overflow-hidden rounded-lg bg-gray-100">
                <img src="{{ $thumbnail 
                        ? asset('storage/products/' . $thumbnail->image)
                        : 'https://via.placeholder.com/600'
                    }}"
                    class="w-full h-full object-cover object-center">
            </div>
        </div>

        {{-- RIGHT INFO --}}
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

            <div class="mt-8">
                <h2 class="font-semibold text-lg">Detail Barang</h2>
                <p class="text-gray-700 mt-2 text-sm leading-relaxed">
                    {{ $product->description }}
                </p>
            </div>

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

    {{-- FOOTER GLOBAL --}}
    @include('layouts.footer')

</body>
</html>
