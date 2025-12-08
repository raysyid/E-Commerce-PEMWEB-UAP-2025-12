<x-app-layout>
    <div class="max-w-6xl mx-auto py-10">

        <h1 class="text-2xl font-bold mb-6">Pesanan Masuk</h1>

        @if(session('success'))
            <div class="p-4 bg-green-100 text-green-700 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full border rounded shadow-sm">
            <thead class="bg-gray-100 border-b">
                <tr>
                    <th class="p-3">Invoice</th>
                    <th class="p-3">Pembeli</th>
                    <th class="p-3">Total</th>
                    <th class="p-3">Status</th>
                    <th class="p-3">Tracking</th>
                    <th class="p-3">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse($orders as $order)
                <tr class="border-b">
                    <td class="p-3">{{ $order->invoice }}</td>
                    <td class="p-3">{{ $order->user->name }}</td>
                    <td class="p-3">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                    
                    <td class="p-3 font-medium">{{ ucfirst($order->status) }}</td>

                    <td class="p-3">{{ $order->tracking_number ?? '-' }}</td>

                    <td class="p-3">
                        <form action="{{ route('seller.orders.update', $order->id) }}" method="POST">
                            @method('PATCH')
                            @csrf

                            <select name="status" class="border p-1 rounded">
                                <option value="pending"   @selected($order->status=='pending')>Pending</option>
                                <option value="processed" @selected($order->status=='processed')>Diproses</option>
                                <option value="shipping"  @selected($order->status=='shipping')>Dikirim</option>
                                <option value="completed" @selected($order->status=='completed')>Selesai</option>
                            </select>

                            <input type="text" name="tracking_number"
                                   placeholder="Nomor Resi"
                                   value="{{ $order->tracking_number }}"
                                   class="border p-1 rounded w-32">

                            <button class="bg-black text-white px-3 py-1 rounded text-sm">
                                Simpan
                            </button>
                        </form>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-6 text-gray-500">
                        Belum ada pesanan baru
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>