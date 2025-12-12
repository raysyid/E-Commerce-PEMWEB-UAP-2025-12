<x-app-layout title="Verifikasi Toko - Thriftsy">
    <div class="max-w-6xl mx-auto py-10 px-6 pb-20">

        {{-- HEADER --}}
        <div class="mb-10">
            <h1 class="text-3xl font-bold text-gray-900">🔍 Verifikasi Toko</h1>
            <p class="text-gray-600 mt-2">Kelola permohonan verifikasi toko dari seller</p>
        </div>

        {{-- SUCCESS ALERT --}}
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-700 border border-green-300 rounded-xl shadow-sm">
            {{ session('success') }}
        </div>
        @endif

        {{-- STORES TABLE --}}
        <div class="bg-white rounded-xl shadow-sm border-2 border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b-2 border-gray-200">
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Toko</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Pemilik</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Lokasi</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Kontak</th>
                            <th class="px-6 py-4 text-center text-sm font-bold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($stores as $store)
                        <tr class="hover:bg-gray-50 transition">
                            {{-- Store Info --}}
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    @php
                                        $logoPath = str_starts_with($store->logo, 'seed-')
                                            ? asset('assets/store/' . str_replace('seed-', '', $store->logo))
                                            : asset('storage/store/' . $store->logo);
                                    @endphp
                                    <img src="{{ $logoPath }}"
                                        onerror="this.src='https://api.dicebear.com/7.x/initials/svg?seed={{ $store->name }}';"
                                        class="w-12 h-12 rounded-full object-cover border-2 border-gray-200">
                                    <div>
                                        <p class="font-semibold text-gray-900 capitalize">{{ $store->name }}</p>
                                        <p class="text-xs text-gray-500 mt-1">ID: #{{ $store->id }}</p>
                                    </div>
                                </div>
                            </td>

                            {{-- Owner --}}
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-900">{{ $store->user->name }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $store->user->email }}</p>
                            </td>

                            {{-- Location --}}
                            <td class="px-6 py-4">
                                <p class="text-gray-900">{{ $store->city }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $store->address }}</p>
                            </td>

                            {{-- Contact --}}
                            <td class="px-6 py-4">
                                <p class="text-gray-900">{{ $store->phone }}</p>
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4">
                                <div class="flex justify-center gap-2">
                                    <form action="{{ route('admin.verification.approve', $store->id) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition text-sm font-semibold">
                                            ✓ Verifikasi
                                        </button>
                                    </form>

                                    <form action="{{ route('admin.verification.reject', $store->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            onclick="return confirm('Tolak verifikasi toko ini?')"
                                            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition text-sm font-semibold">
                                            ✕ Tolak
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center">
                                <div class="text-6xl mb-4">🔍</div>
                                <p class="text-gray-500 text-lg font-medium">Tidak ada toko menunggu verifikasi</p>
                                <p class="text-gray-400 text-sm mt-2">Semua toko sudah diverifikasi</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>