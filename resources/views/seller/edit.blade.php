<x-app-layout>
<div class="max-w-4xl mx-auto py-8 px-6">
    <h1 class="text-2xl font-bold mb-4">Edit Produk</h1>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('seller.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <label>Nama Produk</label>
        <input type="text" name="name" value="{{ $product->name }}" class="w-full border p-2 mb-4">

        <label>Kategori</label>
        <select name="category_id" class="w-full border p-2 mb-4">
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $product->product_category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <label>Harga</label>
        <input type="number" name="price" value="{{ $product->price }}" class="w-full border p-2 mb-4">

        <label>Stok</label>
        <input type="number" name="stock" value="{{ $product->stock }}" class="w-full border p-2 mb-4">

        <label>Deskripsi</label>
        <textarea name="description" class="w-full border p-2 mb-4">{{ $product->description }}</textarea>

        <hr class="my-4">

        <label>Thumbnail Saat Ini</label>
        @php $thumb = $product->productImages->where('is_thumbnail', 1)->first(); @endphp
        <div class="mb-4">
            <img src="{{ $thumb ? asset('storage/products/'.$thumb->image) : 'https://via.placeholder.com/100' }}"
                 class="w-24 h-24 object-cover rounded">
        </div>

        <label>Ganti Thumbnail (opsional)</label>
        <input type="file" name="thumbnail" class="w-full border p-2 mb-4">

        <label>Galeri (Foto Lain)</label>
        <div class="flex gap-2 mb-4">
            @foreach($product->productImages->where('is_thumbnail', 0) as $img)
                <div class="text-center">
                    <img src="{{ asset('storage/products/'.$img->image) }}"
                         class="w-20 h-20 object-cover rounded mb-1">
                    <form action="{{ route('seller.products.image.delete', $img->id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="text-red-600 text-sm">Hapus</button>
                    </form>
                </div>
            @endforeach
        </div>

        <label>Tambah Foto Baru (opsional)</label>
        <input type="file" name="images[]" multiple class="w-full border p-2 mb-4">

        <button class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">
            Simpan Perubahan
        </button>
    </form>
</div>
</x-app-layout>
