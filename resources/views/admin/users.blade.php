<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-6">

        <h1 class="text-2xl font-bold mb-8 text-center">Manajemen User & Store</h1>

        @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded text-center border border-green-300">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white border rounded-lg shadow-sm overflow-hidden">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-center font-semibold border-b">
                        <th class="p-3">Nama</th>
                        <th class="p-3">Email</th>
                        <th class="p-3">Role</th>
                        <th class="p-3">Store</th>
                        <th class="p-3">Status Store</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($users as $user)
                    <tr class="text-center border-b hover:bg-gray-50 transition">
                        <td class="p-3">{{ $user->name }}</td>
                        <td class="p-3 text-sm text-gray-700">{{ $user->email }}</td>
                        <td class="p-3 text-sm capitalize">{{ $user->role }}</td>

                        {{-- STORE NAME --}}
                        <td class="p-3">
                            @if($user->store)
                                {{ $user->store->name }}
                            @else
                                <span class="text-gray-400 text-sm">-</span>
                            @endif
                        </td>

                        {{-- STORE STATUS --}}
                        <td class="p-3">
                            @if(!$user->store)
                                <span class="text-gray-400 text-sm">-</span>
                            @else
                                @if($user->store->is_verified)
                                    <span class="text-green-600 font-semibold">Verified</span>
                                @else
                                    <span class="text-yellow-600 font-semibold">Pending</span>
                                @endif
                            @endif
                        </td>

                        {{-- ACTION --}}
                        <td class="p-3">
                            @if($user->store)
                            <form method="POST" action="{{ route('admin.store.delete', $user->store->id) }}">
                                @csrf @method('DELETE')
                                <button class="px-3 py-1 bg-red-600 text-white rounded hover:bg-red-700 text-xs">
                                    Hapus Store
                                </button>
                            </form>
                            @else
                                <span class="text-gray-300 text-sm">-</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-gray-500 text-sm py-6 text-center">
                            Tidak ada data user.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>

    </div>
</x-app-layout>
