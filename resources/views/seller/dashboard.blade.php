<x-app-layout>
    <h1 class="text-2xl font-bold">Dashboard Penjual</h1>

    <div class="mt-6 grid grid-cols-3 gap-6">
        <div class="p-4 border rounded-lg">
            <p>Total Produk</p>
            <h2 class="font-bold text-xl">{{ $products }}</h2>
        </div>

        <div class="p-4 border rounded-lg">
            <p>Total Pesanan</p>
            <h2 class="font-bold text-xl">{{ $orders }}</h2>
        </div>

        <div class="p-4 border rounded-lg">
            <p>Status Toko</p>
            <h2 class="font-bold text-xl">
                {{ $store->is_verified ? 'Terverifikasi' : 'Menunggu Verifikasi' }}
            </h2>
        </div>
    </div>
</x-app-layout>