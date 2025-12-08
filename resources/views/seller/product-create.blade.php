<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 px-6">

        <h1 class="text-3xl font-bold mb-6">Tambah Produk</h1>

        <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <label class="font-medium">Nama Produk</label>
                <input type="text" name="name" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="font-medium">Kategori</label>
                <select name="product_category_id" class="w-full border p-2 rounded" required>
                    <option value="">-- pilih kategori --</option>
                    @foreach($categories as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="font-medium">Harga</label>
                <input type="number" name="price" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="font-medium">Stok</label>
                <input type="number" name="stock" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="font-medium">Kondisi Produk</label>
                <select name="condition" class="w-full border p-2 rounded" required>
                    <option value="new">Baru</option>
                    <option value="second">Bekas</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="font-medium">Berat Produk (gram)</label>
                <input type="number" name="weight" class="w-full border p-2 rounded" required>
            </div>

            <div class="mb-4">
                <label class="font-medium">Deskripsi</label>
                <textarea name="description" class="w-full border p-2 rounded" rows="4" required></textarea>
            </div>

            <div class="mb-4">
                <label class="font-medium">Foto Produk (bisa lebih dari 1)</label>
                <input type="file" name="images[]" multiple class="border w-full p-2 rounded cursor-pointer">
            </div>

            <button class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">
                Simpan Produk
            </button>
        </form>
    </div>
</x-app-layout>