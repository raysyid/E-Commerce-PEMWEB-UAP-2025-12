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
                    <tr class="bg-gray-200 text-center font-semibold">
                        <th class="p-3">Thumbnail</th>
                        <th class="p-3">Nama</th>
                        <th class="p-3">Kategori</th>
                        <th class="p-3">Harga</th>
                        <th class="p-3">Stok</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($products as $product)
                    @php
                    $thumb = $product->productImages->where('is_thumbnail', 1)->first();
                    @endphp

                    <tr class="border-t hover:bg-gray-50">
                        <td class="p-3 text-center">
                            <img src="{{ $thumb ? asset('storage/products/'.$thumb->image) : 'https://via.placeholder.com/60' }}"
                                class="w-16 h-16 object-cover rounded mx-auto">
                        </td>

                        <td class="p-3">{{ $product->name }}</td>
                        <td class="p-3">{{ $product->category->name }}</td>
                        <td class="p-3">Rp {{ number_format($product->price,0, ',', '.') }}</td>
                        <td class="p-3 text-center">{{ $product->stock }}</td>

                        <td class="p-3">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('seller.products.edit', $product->id) }}"
                                    class="px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">
                                    Edit
                                </a>

                                <form action="{{ route('seller.products.destroy', $product->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Hapus produk?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="px-4 py-2 text-sm bg-red-600 text-white rounded hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>
                            </div>
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