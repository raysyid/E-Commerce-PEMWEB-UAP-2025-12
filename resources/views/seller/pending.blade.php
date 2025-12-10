<x-app-layout>
    <div class="flex justify-center items-center min-h-[70vh] px-4">
        <div class="bg-white border rounded-xl shadow-md p-10 w-full max-w-md text-center">

            {{-- icon wait --}}
            <div class="flex justify-center mb-4">
                ⏳
            </div>

            <h1 class="text-2xl font-bold mb-3">Menunggu Verifikasi Admin</h1>

            <p class="text-gray-600 leading-relaxed mb-4">
                Terima kasih sudah mendaftar sebagai penjual.
                Admin saat ini sedang meninjau informasi dan kelengkapan tokomu.
            </p>

            <p class="text-sm text-gray-500 mb-8">
                Kamu akan mendapatkan akses penuh ke dashboard seller
                setelah proses verifikasi selesai.
            </p>

            {{-- Tombol kembali ke homepage --}}
            <a href="{{ route('home') }}"
                class="inline-block bg-black text-white px-5 py-2 rounded hover:bg-gray-800 transition">
                Kembali ke Beranda
            </a>
        </div>
    </div>
    <script>
        setInterval(() => {
            fetch("{{ route('seller.dashboard') }}", {
                    method: "GET"
                })
                .then(r => {
                    if (r.status === 200) {
                        window.location.href = "{{ route('seller.dashboard') }}";
                    }
                });
        }, 3000);
    </script>
</x-app-layout>