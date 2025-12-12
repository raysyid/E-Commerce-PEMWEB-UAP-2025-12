<x-app-layout>
    <div class="min-h-screen bg-gray-50 py-12">
        <div class="max-w-6xl mx-auto px-6">

            {{-- Header --}}
            <div class="text-center mb-10">
                <h1 class="text-4xl font-bold text-gray-900">Profil Toko</h1>
                <p class="text-gray-600 mt-2">Kelola informasi toko Anda agar lebih menarik bagi pembeli</p>
            </div>

            {{-- Main Content - Single Card --}}
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
                    
                    {{-- Logo Preview Section (Top) --}}
                    <div class="bg-gradient-to-br from-gray-900 to-gray-800 p-10">
                        <div class="text-center">
                            <div class="mb-6">
                                @php
                                    $logoPath = str_starts_with($store->logo, 'seed-')
                                        ? asset('assets/store/' . str_replace('seed-', '', $store->logo))
                                        : asset('storage/store/' . $store->logo);
                                @endphp
                                <img src="{{ $logoPath }}"
                                     onerror="this.src='https://api.dicebear.com/7.x/initials/svg?seed={{ $store->name }}';"
                                     class="w-32 h-32 rounded-full object-cover mx-auto border-4 border-white shadow-lg">
                            </div>
                            <h3 class="text-2xl font-bold text-white mb-2">{{ $store->name }}</h3>
                            <p class="text-gray-300 text-sm flex items-center justify-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                {{ $store->city }}
                            </p>
                        </div>
                    </div>

                    {{-- Form Section (Bottom) --}}
                    <div class="p-8">
                        
                        <form method="POST" enctype="multipart/form-data" action="{{ route('seller.profile.update') }}">
                            @csrf

                            {{-- Nama Toko --}}
                            <div class="mb-6">
                                <label class="flex items-center gap-2 font-semibold text-gray-900 mb-2">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    Nama Toko
                                </label>
                                <input type="text" name="name"
                                    value="{{ $store->name }}"
                                    placeholder="Masukkan nama toko Anda"
                                    class="w-full border-2 border-gray-200 px-4 py-3 rounded-xl focus:outline-none focus:border-black transition">
                            </div>

                            {{-- Tentang Toko --}}
                            <div class="mb-6">
                                <label class="flex items-center gap-2 font-semibold text-gray-900 mb-2">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Tentang Toko
                                </label>
                                <textarea name="about"
                                    placeholder="Ceritakan tentang toko Anda..."
                                    class="w-full border-2 border-gray-200 px-4 py-3 rounded-xl focus:outline-none focus:border-black transition"
                                    rows="4">{{ $store->about }}</textarea>
                            </div>

                            {{-- Nomor WhatsApp --}}
                            <div class="mb-6">
                                <label class="flex items-center gap-2 font-semibold text-gray-900 mb-2">
                                    <svg class="w-5 h-5 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"></path>
                                    </svg>
                                    Nomor WhatsApp
                                </label>
                                <input type="text" name="phone"
                                    value="{{ $store->phone }}"
                                    placeholder="08123456789"
                                    class="w-full border-2 border-gray-200 px-4 py-3 rounded-xl focus:outline-none focus:border-black transition">
                            </div>

                            {{-- Kota --}}
                            <div class="mb-6">
                                <label class="flex items-center gap-2 font-semibold text-gray-900 mb-2">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Kota
                                </label>
                                <input type="text" name="city"
                                    value="{{ $store->city }}"
                                    placeholder="Jakarta"
                                    class="w-full border-2 border-gray-200 px-4 py-3 rounded-xl focus:outline-none focus:border-black transition">
                            </div>

                            {{-- Alamat --}}
                            <div class="mb-6">
                                <label class="flex items-center gap-2 font-semibold text-gray-900 mb-2">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                                    </svg>
                                    Alamat Lengkap
                                </label>
                                <textarea name="address"
                                    placeholder="Jl. Contoh No. 123, Kecamatan, Kota"
                                    class="w-full border-2 border-gray-200 px-4 py-3 rounded-xl focus:outline-none focus:border-black transition"
                                    rows="2">{{ $store->address }}</textarea>
                            </div>

                            {{-- Logo Toko --}}
                            <div class="mb-8">
                                <label class="flex items-center gap-2 font-semibold text-gray-900 mb-2">
                                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                    Logo Toko
                                </label>
                                <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-gray-400 transition">
                                    <input type="file" name="logo" id="logoInput"
                                        accept="image/png, image/jpeg, image/jpg, image/webp"
                                        class="hidden">
                                    <label for="logoInput" class="cursor-pointer">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                            </svg>
                                            <p class="text-sm font-semibold text-gray-700 mb-1">Klik untuk upload logo</p>
                                            <p class="text-xs text-gray-500">JPG, PNG, WEBP — Max 2MB</p>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            {{-- Submit Button --}}
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="bg-black text-white px-8 py-3.5 rounded-xl hover:bg-gray-800 transition shadow-lg flex items-center gap-2 font-semibold">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Simpan Perubahan
                                </button>
                            </div>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script>
        // Show selected file name
        document.getElementById('logoInput').addEventListener('change', function(e) {
            const fileName = e.target.files[0]?.name;
            const label = document.querySelector('label[for="logoInput"] p.text-sm');
            if (fileName) {
                label.textContent = '✓ ' + fileName;
                label.classList.add('text-green-600');
                label.classList.remove('text-gray-700');
            }
        });
    </script>
</x-app-layout>