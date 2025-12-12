@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-8 px-6">
    
    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">{{ $category->name }}</h1>
        <p class="text-gray-600 mt-2">{{ $category->description }}</p>
        <p class="text-sm text-gray-500 mt-1">{{ $products->total() }} produk tersedia</p>
    </div>

    {{-- PRODUCTS GRID --}}
    @if($products->count() > 0)
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
            @foreach($products as $product)
            <a href="{{ route('product.detail', $product->slug) }}" 
               class="bg-white border-2 border-gray-100 rounded-xl overflow-hidden hover:shadow-lg hover:border-gray-200 transition group">
                
                {{-- Product Image --}}
                <div class="aspect-square bg-gray-100 overflow-hidden">
                    @php
                        $thumbnail = $product->productImages->where('is_thumbnail', 1)->first() 
                                  ?? $product->productImages->first();
                    @endphp
                    @if($thumbnail)
                        <img src="{{ asset('storage/products/' . $thumbnail->image) }}" 
                             alt="{{ $product->name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            No Image
                        </div>
                    @endif
                </div>

                {{-- Product Info --}}
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 line-clamp-2 mb-2 group-hover:text-black">
                        {{ $product->name }}
                    </h3>
                    <p class="text-lg font-bold text-gray-900 mb-1">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ $product->store->name ?? 'Unknown Store' }}
                    </p>
                </div>
            </a>
            @endforeach
        </div>

        {{-- PAGINATION --}}
        <div class="mt-8">
            {{ $products->links() }}
        </div>
    @else
        <div class="text-center py-16">
            <div class="text-6xl mb-4">📦</div>
            <p class="text-xl text-gray-500">Belum ada produk di kategori ini</p>
        </div>
    @endif

</div>
@endsection
