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
                        <th class="p-3">Resi</th>
                        <th class="p-3">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr class="border-t">
                        <td class="p-3 font-semibold">{{ $order->code }}</td>
                        <td class="p-3">{{ $order->buyer->name ?? '-' }}</td>
                        <td class="p-3">
                            <table class="mx-auto text-sm">
                                @foreach($order->transactionDetails as $d)
                                <tr>
                                    <td>{{ $d->product->name }}</td>
                                    <td class="px-2">x{{ $d->qty }}</td>
                                </tr>
                                @endforeach
                            </table>
                        </td>
                        <td class="p-3">Rp {{ number_format($order->grand_total,0,',','.') }}</td>

                        <td class="p-3">
                            <span class="px-2 py-1 text-sm rounded
                                    @if($order->payment_status == 'unpaid') bg-red-100 text-red-600
                                    @elseif($order->payment_status == 'paid') bg-yellow-100 text-yellow-700
                                    @elseif($order->payment_status == 'processing') bg-blue-100 text-blue-700
                                    @elseif($order->payment_status == 'shipped') bg-indigo-100 text-indigo-700
                                    @else bg-green-100 text-green-700 @endif">
                                {{ $order->payment_status }}
                            </span>
                        </td>

                        <td class="p-3">{{ $order->tracking_number ?? '-' }}</td>

                        <td class="p-3">
                            <button
                                class="px-3 py-1 {{ $order->payment_status == 'unpaid' ? 'bg-gray-400 cursor-not-allowed' : 'bg-black hover:bg-gray-800 btn-edit' }} text-white rounded"
                                {{ $order->payment_status == 'unpaid' ? 'disabled' : '' }}
                                data-id="{{ $order->id }}"
                                data-status="{{ $order->payment_status }}">
                                Update
                            </button>
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

    {{-- MODAL UPDATE --}}
    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center">
        <div class="bg-white p-6 rounded-lg w-80">
            <h2 class="text-xl font-bold mb-4 text-center">Update Pesanan</h2>

            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="font-medium text-center block mb-2">Status Pesanan</label>
                    <select name="payment_status" id="editStatus" class="w-full border p-2 rounded text-center">
                        {{-- opsi akan diisi lewat JS --}}
                    </select>
                </div>

                <p class="text-sm text-gray-600 mb-4 text-center">
                    * Nomor resi akan dibuat otomatis saat status menjadi <strong>Dikirim</strong>
                </p>

                <div class="flex justify-center gap-3">
                    <button type="button" onclick="closeEdit()" class="px-3 py-1 bg-gray-300 rounded">Batal</button>
                    <button class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Simpan</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            document.querySelectorAll('.btn-edit').forEach(btn => {
                btn.addEventListener('click', () => {
                    const id = btn.dataset.id;
                    const status = btn.dataset.status;
                    const form = document.getElementById('editForm');
                    const select = document.getElementById('editStatus');

                    form.action = `/seller/orders/${id}`;
                    select.innerHTML = '';

                    const flow = {
                        'paid': 'processing',
                        'processing': 'shipped',
                        'shipped': 'completed'
                    };

                    if (flow[status]) {
                        const opt = document.createElement('option');
                        opt.value = flow[status];
                        opt.textContent = flow[status].charAt(0).toUpperCase() + flow[status].slice(1);
                        select.appendChild(opt);
                    }

                    document.getElementById('editModal').classList.remove('hidden');
                });
            });
        });

        function closeEdit() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>

</x-app-layout>