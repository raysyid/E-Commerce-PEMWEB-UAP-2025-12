<x-app-layout>
    <div class="max-w-5xl mx-auto py-10 px-6">

        <h1 class="text-3xl font-bold mb-6 text-center">Profil Toko</h1>

        {{-- Card Container --}}
        <div class="bg-white border rounded-lg shadow-sm p-8 max-w-2xl mx-auto">

            <form method="POST" enctype="multipart/form-data" action="{{ route('seller.profile.update') }}">
                @csrf

                {{-- Nama Toko --}}
                <div class="mb-5">
                    <label class="block font-semibold text-gray-700 mb-1">Nama Toko</label>
                    <input type="text" name="name"
                        value="{{ $store->name }}"
                        class="w-full border px-3 py-2 rounded focus:ring focus:ring-gray-200">
                </div>

                {{-- Tentang Toko --}}
                <div class="mb-5">
                    <label class="block font-semibold text-gray-700 mb-1">Tentang Toko</label>
                    <textarea name="about"
                        class="w-full border px-3 py-2 rounded focus:ring focus:ring-gray-200"
                        rows="4">{{ $store->about }}</textarea>
                </div>

                {{-- Nomor WhatsApp --}}
                <div class="mb-5">
                    <label class="block font-semibold text-gray-700 mb-1">Nomor WhatsApp</label>
                    <input type="text" name="phone"
                        value="{{ $store->phone }}"
                        class="w-full border px-3 py-2 rounded focus:ring focus:ring-gray-200">
                </div>

                {{-- Kota --}}
                <div class="mb-5">
                    <label class="block font-semibold text-gray-700 mb-1">Kota</label>
                    <input type="text" name="city"
                        value="{{ $store->city }}"
                        class="w-full border px-3 py-2 rounded focus:ring focus:ring-gray-200">
                </div>

                {{-- Alamat --}}
                <div class="mb-5">
                    <label class="block font-semibold text-gray-700 mb-1">Alamat Lengkap</label>
                    <textarea name="address"
                        class="w-full border px-3 py-2 rounded focus:ring focus:ring-gray-200"
                        rows="2">{{ $store->address }}</textarea>
                </div>

                {{-- Logo Toko --}}
                <div class="mb-5">
                    <label class="block font-semibold text-gray-700 mb-1">Logo Toko</label>
                    <input type="file" name="logo"
                        accept="image/png, image/jpeg, image/jpg, image/webp"
                        class="border w-full px-3 py-2 rounded cursor-pointer">
                    <p class="text-xs text-gray-500 mb-3">Format: JPG, PNG, WEBP — Max 2MB</p>
                    @if($store->logo)
                    <img src="{{ asset('storage/store/'.$store->logo) }}"
                        class="w-20 h-20 object-cover mt-3 rounded-full border">
                    @endif
                </div>

                {{-- Tombol --}}
                <div class="mt-6">
                    <button type="submit"
                        class="bg-black text-white px-6 py-2 rounded hover:bg-gray-800 transition">
                        Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>