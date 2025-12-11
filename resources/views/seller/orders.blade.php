<x-app-layout>
    <div class="max-w-6xl mx-auto py-8 px-6">
        <h1 class="text-3xl font-bold mb-6">Daftar Pesanan Masuk</h1>

        @if(session('success'))
        <div class="mb-4 p-3 bg-green-100 text-green-700 rounded">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
            {{ session('error') }}
        </div>
        @endif

        <div class="bg-white border rounded-lg shadow-sm p-6">
            <table class="w-full border-collapse text-center">
                <thead>
                    <tr class="bg-gray-200 font-semibold">
                        <th class="p-3">Kode</th>
                        <th class="p-3">Pembeli</th>
                        <th class="p-3">Produk</th>
                        <th class="p-3">Total</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Nomor Resi</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr class="border-t">
                        <td class="p-3 font-semibold">{{ $order->code }}</td>
                        <td class="p-3">{{ $order->buyer->name ?? '-' }}</td>
                        <td class="p-3">
                            <div class="text-sm">
                                @foreach($order->transactionDetails as $d)
                                    <div class="mb-1">{{ $d->product->name }}</div>
                                @endforeach
                            </div>
                        </td>
                        <td class="p-3">Rp {{ number_format($order->grand_total,0,',','.') }}</td>

                        <td class="p-3">
                            <span class="px-3 py-1 text-sm font-semibold rounded-full
                                    {{ $order->payment_status == 'unpaid' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700' }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </td>

                        <td class="p-3">
                            @if($order->tracking_number)
                                <span class="font-mono font-semibold text-blue-600">{{ $order->tracking_number }}</span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </td>

                        <td class="p-3">
                            @if($order->payment_status === 'paid' && !$order->tracking_number)
                                <form action="{{ route('seller.orders.update', $order->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition">
                                        📦 Kirim
                                    </button>
                                </form>
                            @elseif($order->tracking_number)
                                <span class="px-3 py-1 text-xs bg-gray-100 text-gray-600 rounded-full">Terkirim</span>
                            @else
                                <span class="text-gray-400 text-sm">Menunggu Pembayaran</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 p-4">Belum ada pesanan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</x-app-layout>