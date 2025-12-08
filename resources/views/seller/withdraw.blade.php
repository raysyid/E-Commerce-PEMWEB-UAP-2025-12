<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6">

        {{-- HEADER --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight">Penarikan Dana 💸</h1>
            <p class="text-gray-500 mt-1">Kelola permintaan penarikan saldo tokomu</p>
        </div>

        {{-- INFO SALDO --}}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">

    <div class="bg-gradient-to-r from-black to-gray-800 text-white p-6 rounded-xl shadow">
        <p class="text-sm text-gray-300">Saldo Tersedia</p>
        <h2 class="text-3xl font-bold mt-1">
            Rp {{ number_format($balance->balance ?? 0) }}
        </h2>
    </div>

    <div class="p-6 rounded-xl border bg-white shadow-sm">
        <p class="text-sm text-gray-500">Total Withdraw</p>
        <h2 class="text-2xl font-semibold mt-1">
            Rp {{ number_format($withdrawals->where('status','approved')->sum('amount')) }}
        </h2>
    </div>

    <div class="p-6 rounded-xl border bg-white shadow-sm">
        <p class="text-sm text-gray-500">Pending</p>
        <h2 class="text-2xl font-semibold mt-1 text-yellow-500">
            Rp {{ number_format($withdrawals->where('status','pending')->sum('amount')) }}
        </h2>
    </div>
</div>


        {{-- FORM WITHDRAW --}}
        <div class="bg-white rounded-xl shadow-sm border p-8 mb-10">
            <h2 class="text-xl font-semibold mb-6">Ajukan Penarikan</h2>

            <form action="{{ route('seller.withdrawals.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf

                {{-- Nominal --}}
                <div>
                    <label class="block font-medium mb-1">Nominal Penarikan</label>
                    <input type="number" name="amount" required
                        class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-black/20"
                        placeholder="Contoh: 100000">
                </div>

                {{-- Bank --}}
                <div>
                    <label class="block font-medium mb-1">Nama Bank</label>
                    <select name="bank" required
                        class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-black/20">
                        <option value="">Pilih Bank</option>
                        <option>BCA</option>
                        <option>BNI</option>
                        <option>BRI</option>
                        <option>Mandiri</option>
                        <option>Seabank</option>
                    </select>
                </div>

                {{-- Rekening --}}
                <div>
                    <label class="block font-medium mb-1">Nomor Rekening</label>
                    <input type="text" name="account_number" required
                        class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-black/20"
                        placeholder="1234567890">
                </div>

                {{-- Atas Nama --}}
                <div>
                    <label class="block font-medium mb-1">Atas Nama</label>
                    <input type="text" name="account_name" required
                        class="w-full border rounded-lg px-4 py-2 focus:ring focus:ring-black/20"
                        placeholder="Nama sesuai rekening">
                </div>

                <div class="md:col-span-2">
                    <button
                        class="w-full bg-black text-white py-3 rounded-xl font-semibold hover:bg-gray-800 transition">
                        Ajukan Withdraw
                    </button>
                </div>
            </form>
        </div>

        {{-- RIWAYAT WITHDRAW --}}
        <div class="bg-white rounded-xl shadow-sm border p-8">
            <h2 class="text-xl font-semibold mb-6">Riwayat Penarikan</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead class="text-gray-500 border-b">
                        <tr>
                            <th class="py-3">Tanggal</th>
                            <th>Bank</th>
                            <th>Rekening</th>
                            <th>Nominal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($withdrawals as $item)
                        <tr class="border-b">
                            <td class="py-3">{{ $item->created_at->format('d M Y') }}</td>
                            <td>{{ $item->bank_name }}</td>
                            <td>**** {{ substr($item->bank_account_number, -4) }}</td>
                            <td>Rp {{ number_format($item->amount) }}</td>
                            <td class="
        @if($item->status == 'pending') text-yellow-500
        @elseif($item->status == 'approved') text-green-600
        @else text-red-500
        @endif
        font-medium
    ">
                                {{ ucfirst($item->status) }}
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-6 text-gray-500">
                                Belum ada riwayat penarikan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>
        </div>

    </div>
</x-app-layout>