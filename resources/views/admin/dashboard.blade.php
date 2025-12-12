<x-app-layout title="Admin Dashboard - Thriftsy">
    <div class="max-w-6xl mx-auto py-10 px-6 pb-20">

        {{-- HEADER --}}
        <div class="mb-10">
            <h1 class="text-3xl font-bold">Dashboard Admin</h1>
            <p class="text-gray-600 mt-1">Halo, {{ auth()->user()->name }} 👋</p>
        </div>

        {{-- STATISTICS SECTION --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800">📊 Statistik</h2>
            <p class="text-sm text-gray-500 mt-1">Ringkasan data platform</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            
            {{-- Total Users --}}
            <div class="p-6 bg-white rounded-2xl border shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Total User</p>
                        <h3 class="text-3xl font-bold mt-1">{{ $stats['total_users'] }}</h3>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-xl">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Pending Store Verifications --}}
            <div class="p-6 bg-white rounded-2xl border shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Pending Verifikasi</p>
                        <h3 class="text-3xl font-bold mt-1">{{ $stats['pending_stores'] }}</h3>
                    </div>
                    <div class="p-3 bg-yellow-100 rounded-xl">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            {{-- Pending Withdrawals --}}
            <div class="p-6 bg-white rounded-2xl border shadow-sm">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Pending Withdrawal</p>
                        <h3 class="text-3xl font-bold mt-1">{{ $stats['pending_withdrawals'] }}</h3>
                    </div>
                    <div class="p-3 bg-green-100 rounded-xl">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

        </div>

        {{-- ACTION MENU SECTION --}}
        <div class="mb-6">
            <h2 class="text-xl font-semibold text-gray-800">⚡ Menu Aksi</h2>
            <p class="text-sm text-gray-500 mt-1">Kelola platform Thriftsy</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            <a href="{{ route('admin.verification') }}"
               class="group p-7 bg-white border rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 hover:-translate-y-1">
                <h2 class="text-xl font-semibold mb-2 group-hover:text-black">
                    🔍 Verifikasi Toko
                </h2>
                <p class="text-gray-600 text-sm">
                    Lihat & verifikasi toko yang menunggu persetujuan
                </p>
            </a>

            <a href="{{ route('admin.users') }}"
               class="group p-7 bg-white border rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 hover:-translate-y-1">
                <h2 class="text-xl font-semibold mb-2 group-hover:text-black">
                    🗂 Manajemen User & Store
                </h2>
                <p class="text-gray-600 text-sm">
                    Kelola seluruh akun user & toko
                </p>
            </a>

            <a href="{{ route('admin.withdrawals.index') }}"
               class="group p-7 bg-white border rounded-2xl shadow-sm hover:shadow-md transition-all duration-200 hover:-translate-y-1">
                <h2 class="text-xl font-semibold mb-2 group-hover:text-black">
                    💸 Kelola Penarikan Dana
                </h2>
                <p class="text-gray-600 text-sm">
                    Review & approve/reject withdrawal request dari seller
                </p>
            </a>

        </div>

        

    </div>
</x-app-layout>