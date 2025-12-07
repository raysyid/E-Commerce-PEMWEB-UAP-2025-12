<x-app-layout>
    <div class="max-w-7xl mx-auto py-8 px-6">

        <h1 class="text-3xl font-bold mb-6">Dashboard Penjual</h1>

        {{-- Statistik Utama --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="p-5 border rounded-lg shadow-sm bg-white">
                <p class="text-gray-600">Total Produk</p>
                <h2 class="font-bold text-2xl">{{ $products }}</h2>
            </div>

            <div class="p-5 border rounded-lg shadow-sm bg-white">
                <p class="text-gray-600">Total Pesanan</p>
                <h2 class="font-bold text-2xl">{{ $orders }}</h2>
            </div>

            <div class="p-5 border rounded-lg shadow-sm bg-white">
                <p class="text-gray-600">Status Toko</p>
                <h2 class="font-bold text-2xl {{ $store->is_verified ? 'text-green-600' : 'text-yellow-600' }}">
                    {{ $store->is_verified ? 'Terverifikasi' : 'Menunggu Verifikasi' }}
                </h2>
            </div>
        </div>

        {{-- Menu Aksi Seller --}}
        <h2 class="text-xl font-semibold mb-4">Kelola Toko</h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-5">

            <a href="{{ route('seller.profile') }}"
               class="p-4 border rounded-lg shadow-sm text-center bg-gray-50 hover:bg-gray-100">
                🏪 <br> <span class="font-medium">Profil Toko</span>
            </a>

            <a href="{{ route('seller.categories.index') }}"
               class="p-4 border rounded-lg shadow-sm text-center bg-gray-50 hover:bg-gray-100">
                🏷️ <br> <span class="font-medium">Kategori Produk</span>
            </a>

            <a href="{{ route('seller.products.index') }}"
               class="p-4 border rounded-lg shadow-sm text-center bg-gray-50 hover:bg-gray-100">
                📦 <br> <span class="font-medium">Produk</span>
            </a>

            <a href="{{ route('seller.orders') }}"
               class="p-4 border rounded-lg shadow-sm text-center bg-gray-50 hover:bg-gray-100">
                🧾 <br> <span class="font-medium">Pesanan Masuk</span>
            </a>

            <a href="{{ route('seller.balance') }}"
               class="p-4 border rounded-lg shadow-sm text-center bg-gray-50 hover:bg-gray-100">
                💰 <br> <span class="font-medium">Saldo Toko</span>
            </a>

            <a href="{{ route('seller.withdrawals.index') }}"
               class="p-4 border rounded-lg shadow-sm text-center bg-gray-50 hover:bg-gray-100">
                💸 <br> <span class="font-medium">Penarikan Dana</span>
            </a>

        </div>

    </div>
</x-app-layout>
