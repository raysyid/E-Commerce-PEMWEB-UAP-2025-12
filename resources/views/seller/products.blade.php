<x-app-layout title="Manajemen Produk - Thriftsy">
    <div class="max-w-6xl mx-auto py-10 px-6">

        {{-- HEADER --}}
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Manajemen Produk</h1>
                <p class="text-gray-600 mt-2">Kelola semua produk yang Anda jual</p>
            </div>
            <a href="{{ route('seller.products.create') }}"
                class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-gray-900 text-white rounded-xl font-semibold hover:bg-gray-800 transition shadow-lg hover:shadow-xl">
                <span class="text-xl">+</span> Tambah Produk
            </a>
        </div>

        {{-- SUCCESS ALERT --}}
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-700 border border-green-300 rounded-xl shadow-sm">
            {{ session('success') }}
        </div>
        @endif

        {{-- PRODUCTS GRID --}}
        <div class="grid gap-4">
            @forelse($products as $product)
            @php
            $thumb = $product->productImages->where('is_thumbnail', 1)->first();
            $thumbPath = $thumb 
                ? (str_starts_with($thumb->image, 'seed-')
                    ? asset('assets/products-seed/' . str_replace('seed-', '', $thumb->image))
                    : asset('storage/products/' . $thumb->image))
                : 'https://via.placeholder.com/80';
            @endphp

            <div class="bg-white rounded-xl shadow-sm border-2 border-gray-100 p-4 hover:shadow-md transition">
                <div class="flex items-center gap-4">
                    {{-- Thumbnail --}}
                    <img src="{{ $thumbPath }}" class="w-20 h-20 object-cover rounded-lg border-2 border-gray-200 flex-shrink-0">
                    
                    {{-- Product Info --}}
                    <div class="flex-1 min-w-0">
                        <h3 class="font-semibold text-gray-900 truncate">{{ $product->name }}</h3>
                        <p class="text-xs text-gray-500 mt-1">ID: #{{ $product->id }}</p>
                        <div class="flex items-center gap-2 mt-2">
                            <span class="px-2 py-1 bg-gray-100 text-gray-700 rounded text-xs font-medium">
                                {{ $product->category->name }}
                            </span>
                            <span class="px-2 py-1 rounded text-xs font-semibold {{ $product->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ $product->stock }} unit
                            </span>
                        </div>
                    </div>

                    {{-- Price --}}
                    <div class="text-right flex-shrink-0">
                        <p class="font-bold text-gray-900">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>

                    {{-- Actions --}}
                    <div class="flex gap-2 flex-shrink-0">
                        <a href="{{ route('seller.products.edit', $product->id) }}"
                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition text-sm font-semibold">
                            ✏️ Edit
                        </a>
                        <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition text-sm font-semibold">
                                🗑️ Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            @empty
            <div class="bg-white rounded-xl shadow-sm border-2 border-gray-100 p-16 text-center">
                <div class="text-6xl mb-4">📦</div>
                <p class="text-gray-500 text-lg font-medium">Belum ada produk</p>
                <p class="text-gray-400 text-sm mt-2">Mulai tambahkan produk pertama Anda!</p>
            </div>
            @endforelse
        </div>

    </div>
</x-app-layout>