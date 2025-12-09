<x-app-layout>
    <div class="max-w-5xl mx-auto py-8 px-6">

        <h1 class="text-3xl font-bold mb-6">Saldo Toko 💰</h1>

        {{-- Saldo Sekarang --}}
        <div class="p-6 bg-white shadow rounded-lg mb-8 border">
            <p class="text-gray-600">Saldo Anda Saat Ini</p>
            <h2 class="text-4xl font-bold text-green-600">
                Rp {{ number_format($balance->balance, 0, ',', '.') }}
            </h2>
        </div>

        {{-- Riwayat Saldo --}}
        <h2 class="text-xl font-semibold mb-4">Riwayat Perubahan Saldo</h2>

        @if($histories->isEmpty())
            <p class="text-gray-500">Belum ada riwayat saldo.</p>
        @else
            <div class="bg-white shadow rounded-lg border">
                <table class="w-full text-left table-auto">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 border">Tanggal</th>
                            <th class="px-4 py-3 border">Keterangan</th>
                            <th class="px-4 py-3 border">Jumlah</th>
                            <th class="px-4 py-3 border">Saldo Setelah</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($histories as $history)
                        <tr>
                            <td class="px-4 py-3 border">
                                {{ $history->created_at->format('d M Y H:i') }}
                            </td>

                            <td class="px-4 py-3 border">
                                {{ $history->description }}
                            </td>

                            <td class="px-4 py-3 border font-semibold 
                                {{ $history->amount < 0 ? 'text-red-600' : 'text-green-600' }}">
                                {{ $history->amount < 0 ? '-' : '+' }}
                                Rp {{ number_format(abs($history->amount), 0, ',', '.') }}
                            </td>

                            <td class="px-4 py-3 border">
                                Rp {{ number_format($history->balance_after, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

    </div>
</x-app-layout>
