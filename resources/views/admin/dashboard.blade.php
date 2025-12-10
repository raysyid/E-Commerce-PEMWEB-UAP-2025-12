<x-app-layout>
    <div class="max-w-6xl mx-auto py-10 px-6">

        {{-- HEADER --}}
        <div class="mb-10">
            <h1 class="text-3xl font-bold">Dashboard Admin</h1>
            <p class="text-gray-600 mt-1">Halo, {{ auth()->user()->name }} 👋</p>
        </div>

        {{-- CARD MENU --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

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

        </div>

        

    </div>
</x-app-layout>