<x-app-layout title="Edit Produk - Thriftsy">
<div class="max-w-4xl mx-auto py-10 px-6">
    
    {{-- HEADER --}}
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Edit Produk</h1>
        <p class="text-gray-600 mt-2">Perbarui informasi produk Anda</p>
    </div>

    {{-- SUCCESS ALERT --}}
    @if(session('success'))
    <div class="mb-6 p-4 bg-green-100 text-green-700 border border-green-300 rounded-xl shadow-sm">
        {{ session('success') }}
    </div>
    @endif

    {{-- FORM --}}
    <form action="{{ route('seller.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf @method('PUT')

        <div class="bg-white rounded-xl shadow-sm border-2 border-gray-100 p-8 space-y-6">
            
            {{-- BASIC INFO SECTION --}}
            <div>
                <h2 class="text-xl font-bold text-gray-900 mb-4 pb-2 border-b">📝 Informasi Dasar</h2>
                
                <div class="space-y-4">
                    {{-- Product Name --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Produk</label>
                        <input type="text" name="name" value="{{ $product->name }}" required
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-gray-900 focus:border-transparent transition">
                    </div>

                    {{-- Category --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
                        <select name="category_id" required
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-gray-900 focus:border-transparent transition">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ $product->product_category_id == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Price & Stock --}}
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Harga (Rp)</label>
                            <input type="number" name="price" value="{{ $product->price }}" required min="0"
                                class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-gray-900 focus:border-transparent transition">
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Stok</label>
                            <input type="number" name="stock" value="{{ $product->stock }}" required min="0"
                                class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-gray-900 focus:border-transparent transition">
                        </div>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi</label>
                        <textarea name="description" rows="4" required
                            class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-gray-900 focus:border-transparent transition">{{ $product->description }}</textarea>
                    </div>
                </div>
            </div>

            {{-- IMAGES SECTION --}}
            <div>
                <h2 class="text-xl font-bold text-gray-900 mb-4 pb-2 border-b">📸 Gambar Produk</h2>
                
                {{-- Current Thumbnail --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Thumbnail Saat Ini</label>
                    @php 
                        $thumb = $product->productImages->where('is_thumbnail', 1)->first();
                        $thumbPath = $thumb
                            ? (str_starts_with($thumb->image, 'seed-')
                                ? asset('assets/products-seed/' . str_replace('seed-', '', $thumb->image))
                                : asset('storage/products/' . $thumb->image))
                            : 'https://via.placeholder.com/150';
                    @endphp
                    <div class="inline-block p-2 bg-gray-50 rounded-lg border-2 border-gray-200">
                        <img src="{{ $thumbPath }}" class="w-32 h-32 object-cover rounded-lg">
                    </div>
                </div>

                {{-- Change Thumbnail --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Ganti Thumbnail (opsional)</label>
                    <input type="file" name="thumbnail" accept="image/*"
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-gray-900 focus:border-transparent transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-900 file:text-white hover:file:bg-gray-800">
                    <p class="text-xs text-gray-500 mt-2">Format: JPG, PNG, WEBP. Max: 2MB</p>
                </div>

                {{-- Gallery Images --}}
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-700 mb-3">Galeri Foto Lainnya</label>
                    @if($product->productImages->where('is_thumbnail', 0)->count() > 0)
                    <div class="flex flex-wrap gap-3 mb-4">
                        @foreach($product->productImages->where('is_thumbnail', 0) as $img)
                            <div class="relative group">
                                @php
                                    $imgPath = str_starts_with($img->image, 'seed-')
                                        ? asset('assets/products-seed/' . str_replace('seed-', '', $img->image))
                                        : asset('storage/products/' . $img->image);
                                @endphp
                                <div class="p-2 bg-gray-50 rounded-lg border-2 border-gray-200">
                                    <img src="{{ $imgPath }}" class="w-24 h-24 object-cover rounded-lg">
                                </div>
                                <form action="{{ route('seller.products.deleteImage', [$product->id, $img->id]) }}" method="POST" class="mt-2">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Hapus gambar ini?')"
                                        class="w-full h-10 px-3 bg-red-500 text-white text-xs font-semibold rounded-lg hover:bg-red-600 transition flex items-center justify-center whitespace-nowrap">
                                        🗑️ Hapus
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                    @else
                    <p class="text-sm text-gray-500 mb-4">Belum ada foto galeri</p>
                    @endif
                </div>

                {{-- Add New Images --}}
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Tambah Foto Baru (opsional)</label>
                    <input type="file" name="images[]" multiple accept="image/*"
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-gray-900 focus:border-transparent transition file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-gray-900 file:text-white hover:file:bg-gray-800">
                    <p class="text-xs text-gray-500 mt-2">Pilih beberapa gambar sekaligus untuk galeri</p>
                </div>
            </div>

            {{-- ACTION BUTTONS --}}
            <div class="flex gap-3 pt-4 border-t">
                <button type="submit"
                    class="flex-1 bg-gray-900 text-white py-3.5 rounded-xl font-bold hover:bg-gray-800 transition shadow-lg hover:shadow-xl">
                    💾 Simpan Perubahan
                </button>
                <a href="{{ route('seller.products.index') }}"
                    class="px-6 py-3.5 border-2 border-gray-300 text-gray-700 rounded-xl font-semibold hover:bg-gray-50 transition">
                    Batal
                </a>
            </div>
        </div>
    </form>

</div>
</x-app-layout>
