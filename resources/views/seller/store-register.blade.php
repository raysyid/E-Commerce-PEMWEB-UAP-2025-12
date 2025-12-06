<x-app-layout>

    {{-- WAJIB: agar CSRF tidak mismatch --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <div class="max-w-xl mx-auto py-10">

        <h1 class="text-2xl font-bold mb-6">Daftar Toko</h1>

        {{-- Jika user sudah punya toko, jangan bisa daftar --}}
        @if(auth()->user()->role === 'seller')
            <div class="p-4 bg-yellow-200 text-yellow-800 rounded mb-4">
                Kamu sudah memiliki toko.
                <a href="{{ route('seller.dashboard') }}" class="underline font-semibold">Masuk Dashboard</a>
            </div>
        @endif

        <form action="{{ route('store.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Nama Toko --}}
            <label class="block font-semibold mb-1">Nama Toko</label>
            <input type="text" name="name" required
                class="border w-full p-2 rounded mb-4"
                placeholder="contoh: thriftarchive">

            {{-- Tentang Toko --}}
            <label class="block font-semibold mb-1">Tentang Toko</label>
            <textarea name="about" required
                class="border w-full p-2 rounded mb-4"
                placeholder="Deskripsi singkat toko"></textarea>

            {{-- Nomor Telepon --}}
            <label class="block font-semibold mb-1">Nomor Telepon</label>
            <input type="text" name="phone" required
                class="border w-full p-2 rounded mb-4"
                placeholder="contoh: 081234567890">

            {{-- Kota --}}
            <label class="block font-semibold mb-1">Kota</label>
            <input type="text" name="city" required
                class="border w-full p-2 rounded mb-4"
                placeholder="contoh: Malang">

            {{-- Alamat Lengkap --}}
            <label class="block font-semibold mb-1">Alamat Lengkap</label>
            <textarea name="address" required
                class="border w-full p-2 rounded mb-4"
                placeholder="contoh: Perumahan Griya Permata Hijau, Blok A12"></textarea>

            {{-- Kode Pos --}}
            <label class="block font-semibold mb-1">Kode Pos</label>
            <input type="text" name="postal_code"
                class="border w-full p-2 rounded mb-6"
                placeholder="65432 (opsional)">

            <button type="submit"
                class="bg-black text-white px-5 py-2 rounded w-full hover:bg-gray-800">
                Daftarkan Toko
            </button>
        </form>
    </div>
</x-app-layout>
