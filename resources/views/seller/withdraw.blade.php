<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-6">

        {{-- HEADER --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Penarikan Dana 💸</h1>
            <p class="text-gray-600 mt-2">Kelola permintaan penarikan saldo tokomu</p>
        </div>

        {{-- INFO SALDO --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-gradient-to-br from-gray-900 to-gray-700 text-white p-6 rounded-xl shadow-lg">
                <p class="text-sm text-gray-300 mb-1">Saldo Tersedia</p>
                <h2 class="text-4xl font-bold">
                    Rp {{ number_format($balance->balance ?? 0, 0, ',', '.') }}
                </h2>
            </div>

            <div class="p-6 rounded-xl border-2 border-gray-100 bg-white shadow-sm hover:shadow-md transition">
                <p class="text-sm text-gray-500 mb-1">Total Withdraw</p>
                <h2 class="text-3xl font-bold text-green-600">
                    Rp {{ number_format($withdrawals->where('status','approved')->sum('amount'), 0, ',', '.') }}
                </h2>
            </div>

            <div class="p-6 rounded-xl border-2 border-gray-100 bg-white shadow-sm hover:shadow-md transition">
                <p class="text-sm text-gray-500 mb-1">Pending</p>
                <h2 class="text-3xl font-bold text-yellow-500">
                    Rp {{ number_format($withdrawals->where('status','pending')->sum('amount'), 0, ',', '.') }}
                </h2>
            </div>
        </div>

        {{-- FORM WITHDRAW --}}
        <div class="bg-white rounded-xl shadow-sm border-2 border-gray-100 p-8 mb-8">
            <h2 class="text-2xl font-bold mb-8 text-center text-gray-900">Ajukan Penarikan</h2>

            <form action="{{ route('seller.withdrawals.store') }}" method="POST" class="space-y-5 max-w-2xl mx-auto">
                @csrf

                {{-- Nominal --}}
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Nominal Penarikan</label>
                    <input type="number" name="amount" required min="10000"
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-gray-900 focus:border-transparent transition"
                        placeholder="Minimal Rp 10.000">
                    <p class="text-xs text-gray-500 mt-2">💰 Saldo tersedia: Rp {{ number_format($balance->balance ?? 0, 0, ',', '.') }}</p>
                </div>

                {{-- Bank --}}
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Nama Bank</label>
                    <select name="bank" required
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-gray-900 focus:border-transparent transition">
                        <option value="">Pilih Bank</option>
                        <option>BCA</option>
                        <option>BNI</option>
                        <option>BRI</option>
                        <option>Mandiri</option>
                        <option>Seabank</option>
                        <option>CIMB Niaga</option>
                    </select>
                </div>

                {{-- Nomor Rekening --}}
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Nomor Rekening</label>
                    <input type="text" name="account_number" required
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-gray-900 focus:border-transparent transition"
                        placeholder="Contoh: 1234567890">
                </div>

                {{-- Atas Nama --}}
                <div>
                    <label class="block font-semibold text-gray-700 mb-2">Atas Nama</label>
                    <input type="text" name="account_name" required
                        class="w-full border-2 border-gray-200 rounded-lg px-4 py-3 focus:ring-2 focus:ring-gray-900 focus:border-transparent transition"
                        placeholder="Nama sesuai rekening">
                </div>

                <button type="submit"
                    class="w-full bg-gray-900 text-white py-3.5 rounded-xl font-bold hover:bg-gray-800 transition shadow-lg hover:shadow-xl mt-6">
                    💸 Ajukan Withdraw
                </button>
            </form>
        </div>

        {{-- RIWAYAT WITHDRAW --}}
        <div class="bg-white rounded-xl shadow-sm border-2 border-gray-100 p-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-900">Riwayat Penarikan</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b-2 border-gray-200">
                            <th class="py-4 text-left font-semibold text-gray-700">Tanggal</th>
                            <th class="text-left font-semibold text-gray-700">Bank</th>
                            <th class="text-left font-semibold text-gray-700">Rekening</th>
                            <th class="text-left font-semibold text-gray-700">Nominal</th>
                            <th class="text-left font-semibold text-gray-700">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($withdrawals as $item)
                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                            <td class="py-4 text-gray-700">{{ $item->created_at->format('d M Y') }}</td>
                            <td class="text-gray-900 font-medium">{{ $item->bank_name }}</td>
                            <td class="text-gray-600">**** {{ substr($item->bank_account_number, -4) }}</td>
                            <td class="text-gray-900 font-semibold">Rp {{ number_format($item->amount, 0, ',', '.') }}</td>
                            <td>
                                <span class="px-3 py-1 rounded-full text-xs font-bold
                                    @if($item->status == 'pending') bg-yellow-100 text-yellow-700
                                    @elseif($item->status == 'approved') bg-green-100 text-green-700
                                    @else bg-red-100 text-red-700
                                    @endif
                                ">
                                    {{ ucfirst($item->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-12 text-gray-400">
                                <div class="text-5xl mb-3">📭</div>
                                <p class="text-base">Belum ada riwayat penarikan</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>