<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-6">

        <h1 class="text-3xl font-bold mb-6">Manajemen Kategori Produk</h1>

        @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 border border-green-300 rounded">
            {{ session('success') }}
        </div>
        @endif

        {{-- FORM TAMBAH KATEGORI --}}
        <div class="bg-white border rounded-lg shadow-sm p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Tambah Kategori</h2>

            <form action="{{ route('seller.categories.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="font-medium">Nama Kategori</label>
                    <input type="text" name="name" class="w-full border p-2 rounded" required>
                </div>

                <div class="mb-4">
                    <label class="font-medium">Deskripsi (opsional)</label>
                    <textarea name="description" class="w-full border p-2 rounded"></textarea>
                </div>

                <button class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800">
                    Simpan
                </button>
            </form>
        </div>

        {{-- DAFTAR KATEGORI --}}
        <div class="bg-white border rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-semibold mb-4">Daftar Kategori</h2>

            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-200 text-left">
                        <th class="p-3">Nama</th>
                        <th class="p-3">Deskripsi</th>
                        <th class="p-3 text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($categories as $category)
                    <tr class="border-t">
                        <td class="p-3">{{ $category->name }}</td>
                        <td class="p-3">{{ $category->description ?? '-' }}</td>

                        <td class="p-3">
                            <div class="inline-flex gap-2 justify-center items-center w-full">

                                {{-- EDIT --}}
                                <a href="{{ route('seller.categories.edit', $category->id) }}"
                                    class="px-3 py-1 bg-emerald-600 text-white rounded hover:bg-emerald-700">
                                    Edit
                                </a>

                                {{-- DELETE --}}
                                <form action="{{ route('seller.categories.destroy', $category->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Hapus kategori?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                        Hapus
                                    </button>
                                </form>

                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-center p-4 text-gray-500">Belum ada kategori</td>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</x-app-layout>