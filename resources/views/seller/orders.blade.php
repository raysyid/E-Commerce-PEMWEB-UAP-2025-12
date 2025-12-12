<x-app-layout title="Daftar Pesanan - Thriftsy">
    <div class="max-w-6xl mx-auto py-10 px-6">

        {{-- HEADER --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">📋 Daftar Pesanan Masuk</h1>
            <p class="text-gray-600 mt-2">Kelola dan proses pesanan dari pembeli</p>
        </div>

        {{-- ALERTS --}}
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-700 border border-green-300 rounded-xl shadow-sm">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 text-red-700 border border-red-300 rounded-xl shadow-sm">
            {{ session('error') }}
        </div>
        @endif

        {{-- ORDERS TABLE --}}
        <div class="bg-white rounded-xl shadow-sm border-2 border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-50 border-b-2 border-gray-200">
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Kode Order</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Pembeli</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Produk</th>
                            <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Total</th>
                            <th class="px-6 py-4 text-center text-sm font-bold text-gray-700">Status</th>
                            <th class="px-6 py-4 text-center text-sm font-bold text-gray-700">Resi</th>
                            <th class="px-6 py-4 text-center text-sm font-bold text-gray-700">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($orders as $order)
                        <tr class="hover:bg-gray-50 transition">
                            {{-- Order Code --}}
                            <td class="px-6 py-4">
                                <p class="font-mono font-bold text-gray-900">{{ $order->code }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $order->created_at->format('d M Y') }}</p>
                            </td>

                            {{-- Buyer --}}
                            <td class="px-6 py-4">
                                <p class="font-semibold text-gray-900">{{ $order->buyer->name ?? '-' }}</p>
                                <p class="text-xs text-gray-500 mt-1">{{ $order->buyer->email ?? '-' }}</p>
                            </td>

                            {{-- Products --}}
                            <td class="px-6 py-4">
                                <div class="space-y-1">
                                    @foreach($order->transactionDetails as $detail)
                                        <div class="text-sm">
                                            <span class="text-gray-900">{{ $detail->product->name }}</span>
                                            <span class="text-gray-500">× {{ $detail->quantity }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </td>

                            {{-- Total --}}
                            <td class="px-6 py-4">
                                <p class="font-bold text-gray-900">Rp {{ number_format($order->grand_total, 0, ',', '.') }}</p>
                            </td>

                            {{-- Payment Status --}}
                            <td class="px-6 py-4 text-center">
                                @if($order->payment_status === 'paid')
                                    <span class="px-3 py-1.5 bg-green-100 text-green-700 rounded-lg text-sm font-semibold">
                                        ✓ Lunas
                                    </span>
                                @else
                                    <span class="px-3 py-1.5 bg-yellow-100 text-yellow-700 rounded-lg text-sm font-semibold">
                                        ⏳ Belum Bayar
                                    </span>
                                @endif
                            </td>

                            {{-- Tracking Number --}}
                            <td class="px-6 py-4 text-center">
                                @if($order->tracking_number)
                                    <div class="inline-block px-3 py-1.5 bg-blue-50 rounded-lg">
                                        <p class="font-mono font-semibold text-blue-600 text-sm">{{ $order->tracking_number }}</p>
                                    </div>
                                @else
                                    <span class="text-gray-400 text-sm">-</span>
                                @endif
                            </td>

                            {{-- Actions --}}
                            <td class="px-6 py-4">
                                <div class="flex justify-center">
                                    @if($order->payment_status === 'paid' && !$order->tracking_number)
                                        <form action="{{ route('seller.orders.update', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition text-sm font-semibold">
                                                📦 Kirim
                                            </button>
                                        </form>
                                    @elseif($order->tracking_number)
                                        <span class="px-4 py-2 bg-gray-100 text-gray-600 rounded-lg text-sm font-semibold">
                                            ✓ Terkirim
                                        </span>
                                    @else
                                        <span class="px-4 py-2 bg-gray-50 text-gray-400 rounded-lg text-sm">
                                            Menunggu
                                        </span>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-6 py-16 text-center">
                                <div class="text-6xl mb-4">📋</div>
                                <p class="text-gray-500 text-lg font-medium">Belum ada pesanan</p>
                                <p class="text-gray-400 text-sm mt-2">Pesanan akan muncul di sini setelah ada pembeli</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</x-app-layout>