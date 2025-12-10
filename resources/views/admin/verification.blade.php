<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-6">
        <h1 class="text-3xl font-bold mb-6">Verifikasi Toko</h1>

        @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white p-6 border rounded-lg shadow-sm">
            <table class="w-full border-collapse text-center">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="p-3">Nama Toko</th>
                        <th class="p-3">Pemilik</th>
                        <th class="p-3">Kota</th>
                        <th class="p-3">Phone</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($stores as $store)
                    <tr class="border-t">
                        <td class="p-3 font-semibold">{{ $store->name }}</td>
                        <td class="p-3">{{ $store->user->name }}</td>
                        <td class="p-3">{{ $store->city }}</td>
                        <td class="p-3">{{ $store->phone }}</td>
                        <td class="p-3 flex justify-center gap-3">
                            <form action="{{ route('admin.verification.approve', $store->id) }}" method="POST">
                                @csrf
                                <button class="px-3 py-1 bg-green-600 text-white rounded hover:bg-green-700">
                                    Verifikasi
                                </button>
                            </form>

                            <form action="{{ route('admin.verification.reject', $store->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700">
                                    Tolak
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-4 text-gray-500">Tidak ada toko menunggu verifikasi</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>