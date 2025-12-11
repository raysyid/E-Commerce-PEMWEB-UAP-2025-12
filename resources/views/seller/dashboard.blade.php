<x-app-layout>

    <div class="max-w-7xl mx-auto py-10 px-6">

        {{-- HEADER GREETING --}}
        <div class="mb-10">
            <h1 class="text-4xl font-extrabold mb-2 tracking-tight">
                Halo, <span class="capitalize">{{ $store->name }}</span> 👋
            </h1>
            <p class="text-gray-600 text-lg">
                Selamat datang kembali! Semoga harimu penuh orderan 💸
            </p>
        </div>

        {{-- ALERT SUKSES --}}
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-700 border border-green-300 rounded-xl shadow-sm">
            {{ session('success') }}
        </div>
        @endif


        {{-- STATISTIK UTAMA --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">

            <div class="p-6 bg-white rounded-2xl border shadow-sm hover:shadow-md transition">
                <p class="text-gray-500 text-sm">Total Produk</p>
                <h2 class="font-bold text-3xl mt-1">{{ $products }}</h2>
            </div>

            <div class="p-6 bg-white rounded-2xl border shadow-sm hover:shadow-md transition">
                <p class="text-gray-500 text-sm">Pesanan Baru</p>
                <h2 class="font-bold text-3xl mt-1">{{ $orders }}</h2>
                <p class="text-gray-500 text-xs mt-2">Menunggu tindakan</p>
            </div>

            <div class="p-6 bg-white rounded-2xl border shadow-sm hover:shadow-md transition">
                <p class="text-gray-500 text-sm">Status Toko</p>
                <h2 class="font-bold text-2xl mt-1 {{ $store->is_verified ? 'text-green-600' : 'text-yellow-600' }}">
                    {{ $store->is_verified ? 'Terverifikasi' : 'Menunggu Verifikasi' }}
                </h2>
            </div>

        </div>


        {{-- MENU AKSI SELLER --}}
        <h2 class="text-2xl font-bold mb-5 tracking-tight">Kelola Toko</h2>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-5">

            <a href="{{ route('seller.profile') }}"
                class="p-5 bg-white border rounded-2xl shadow-sm hover:shadow-lg hover:bg-gray-50 transition text-center flex flex-col items-center gap-2">
                <span class="text-3xl">🏪</span>
                <span class="font-medium text-gray-800">Profil Toko</span>
            </a>

            <a href="{{ route('seller.categories.index') }}"
                class="p-5 bg-white border rounded-2xl shadow-sm hover:shadow-lg hover:bg-gray-50 transition text-center flex flex-col items-center gap-2">
                <span class="text-3xl">🏷️</span>
                <span class="font-medium text-gray-800">Daftar Kategori</span>
            </a>

            <a href="{{ route('seller.products.index') }}"
                class="p-5 bg-white border rounded-2xl shadow-sm hover:shadow-lg hover:bg-gray-50 transition text-center flex flex-col items-center gap-2">
                <span class="text-3xl">📦</span>
                <span class="font-medium text-gray-800">Daftar Produk</span>
            </a>

            <a href="{{ route('seller.orders') }}"
                class="p-5 bg-white border rounded-2xl shadow-sm hover:shadow-lg hover:bg-gray-50 transition text-center flex flex-col items-center gap-2">
                <span class="text-3xl">🧾</span>
                <span class="font-medium text-gray-800">Daftar Pesanan</span>
            </a>

            <a href="{{ route('seller.balance') }}"
                class="p-5 bg-white border rounded-2xl shadow-sm hover:shadow-lg hover:bg-gray-50 transition text-center flex flex-col items-center gap-2">
                <span class="text-3xl">💰</span>
                <span class="font-medium text-gray-800">Saldo Toko</span>
            </a>

            <a href="{{ route('seller.withdrawals.index') }}"
                class="p-5 bg-white border rounded-2xl shadow-sm hover:shadow-lg hover:bg-gray-50 transition text-center flex flex-col items-center gap-2">
                <span class="text-3xl">💸</span>
                <span class="font-medium text-gray-800">Penarikan Dana</span>
            </a>

        </div>

    </div>

</x-app-layout>
