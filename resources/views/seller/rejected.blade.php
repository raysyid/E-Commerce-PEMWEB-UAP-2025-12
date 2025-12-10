<x-app-layout>
    <div class="flex justify-center items-center min-h-[70vh] px-4">
        <div class="bg-white border border-red-300 rounded-xl shadow-md p-10 w-full max-w-md text-center">
            <div class="text-red-600 text-4xl mb-3">❌</div>

            <h1 class="text-2xl font-bold mb-2 text-red-700">Pendaftaran Ditolak</h1>

            <p class="text-gray-600 mb-6">
                Maaf, pengajuan tokomu tidak disetujui admin.
            </p>

            <a href="{{ route('home') }}"
                class="inline-block bg-black text-white px-5 py-2 rounded hover:bg-gray-800 transition text-sm">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</x-app-layout>