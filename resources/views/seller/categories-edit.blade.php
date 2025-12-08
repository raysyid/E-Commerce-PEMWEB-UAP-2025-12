<x-app-layout>
    <div class="max-w-4xl mx-auto py-8 px-6">

        <h1 class="text-2xl font-bold mb-6">Edit Kategori</h1>

        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 text-green-700 border border-green-300 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white border rounded-lg shadow-sm p-6">
            <form action="{{ route('seller.categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="font-medium">Nama Kategori</label>
                    <input type="text" name="name"
                           class="w-full border p-2 rounded"
                           value="{{ $category->name }}" required>
                </div>

                <div class="mb-4">
                    <label class="font-medium">Deskripsi</label>
                    <textarea name="description"
                              class="w-full border p-2 rounded"
                              rows="3">{{ $category->description }}</textarea>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('seller.categories.index') }}"
                       class="px-4 py-2 bg-gray-300 rounded">
                        Batal
                    </a>

                    <button type="submit"
                       class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Update
                    </button>
                </div>
            </form>
        </div>

    </div>
</x-app-layout>
