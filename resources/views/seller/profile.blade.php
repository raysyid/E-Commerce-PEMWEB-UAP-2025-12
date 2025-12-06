<x-app-layout>
    <h1 class="text-2xl font-bold">Profil Toko</h1>

    <form method="POST" enctype="multipart/form-data" action="{{ route('seller.profile.update') }}">
        @csrf

        <div class="mt-4">
            <label>Nama Toko</label>
            <input type="text" name="name" value="{{ $store->name }}" class="border p-2 w-full">
        </div>

        <div class="mt-4">
            <label>Deskripsi</label>
            <textarea name="about" class="border p-2 w-full">{{ $store->about }}</textarea>
        </div>

        <div class="mt-4">
            <label>No WhatsApp</label>
            <input type="text" name="phone" value="{{ $store->phone }}" class="border p-2 w-full">
        </div>

        <div class="mt-4">
            <label>Logo Toko</label>
            <input type="file" name="logo" class="border p-2 w-full">

            @if($store->logo)
                <img src="{{ asset('storage/store_logo/'.$store->logo) }}" class="w-24 mt-3 rounded">
            @endif
        </div>

        <button class="mt-6 bg-black text-white px-4 py-2 rounded">Simpan</button>
    </form>
</x-app-layout>