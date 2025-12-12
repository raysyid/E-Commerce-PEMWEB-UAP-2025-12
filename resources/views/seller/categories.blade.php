<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-6">

        {{-- HEADER --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Kategori Produk 📂</h1>
            <p class="text-gray-600 mt-2">Daftar kategori yang tersedia untuk produk Anda</p>
        </div>

        @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700 rounded">
            {{ session('success') }}
        </div>
        @endif

        {{-- INFO BOX --}}
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 mb-8 rounded">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">
                        <strong>Info:</strong> Kategori ini disediakan oleh sistem dan dibagikan untuk semua toko. 
                        Pilih kategori yang sesuai saat menambahkan produk di <a href="{{ route('seller.products.index') }}" class="underline font-semibold">Manajemen Produk</a>.
                    </p>
                </div>
            </div>
        </div>

        {{-- CATEGORIES GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($categories as $category)
            <div class="bg-white border-2 border-gray-100 rounded-xl p-6 hover:shadow-lg hover:border-gray-200 transition">
                <div class="flex items-start justify-between mb-3">
                    <h3 class="text-lg font-bold text-gray-900">{{ $category->name }}</h3>
                    <span class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-semibold rounded-full">
                        {{ $category->products_count ?? 0 }} produk
                    </span>
                </div>
                <p class="text-sm text-gray-600 leading-relaxed">
                    {{ $category->description ?? 'Tidak ada deskripsi' }}
                </p>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <div class="text-6xl mb-4">📦</div>
                <p class="text-gray-500 text-lg">Belum ada kategori tersedia</p>
            </div>
            @endforelse
        </div>

    </div>
</x-app-layout>