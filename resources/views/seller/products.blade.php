<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-6">

        <h1 class="text-3xl font-bold mb-6">Manajemen Produk</h1>

        @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
        @endif

        <a href="{{ route('seller.products.create') }}"
            class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800 mb-6 inline-block">
            + Tambah Produk
        </a>

        <div class="bg-white border rounded-lg p-6">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="p-3">Thumbnail</th>
                        <th class="p-3">Nama</th>
                        <th class="p-3">Kategori</th>
                        <th class="p-3">Harga</th>
                        <th class="p-3">Stok</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    @php
                    $thumb = $product->productImages->where('is_thumbnail', 1)->first();
                    @endphp
                    <tr class="border-t">
                        <td class="p-3">
                            <img src="{{ $thumb ? asset('storage/products/'.$thumb->image) : 'https://via.placeholder.com/60' }}"
                                class="w-16 h-16 object-cover rounded">
                        </td>
                        <td class="p-3">{{ $product->name }}</td>
                        <td class="p-3">{{ $product->category->name }}</td>
                        <td class="p-3">Rp {{ number_format($product->price,0, ',', '.') }}</td>
                        <td class="p-3">{{ $product->stock }}</td>
                        <td class="p-3 text-center">
                            <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST"
                                onsubmit="return confirm('Hapus produk?')">
                                @csrf @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-gray-500 p-4">Belum ada produk</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>