<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6">

        {{-- HEADER --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Kelola Penarikan Dana</h1>
            <p class="text-gray-600 mt-2">Review dan approve/reject withdrawal request dari seller</p>
        </div>

        {{-- ALERTS --}}
        @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-700 border border-green-300 rounded-xl">
            {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 text-red-700 border border-red-300 rounded-xl">
            {{ session('error') }}
        </div>
        @endif

        {{-- WITHDRAWALS TABLE --}}
        <div class="bg-white rounded-xl shadow-sm border overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-50 border-b">
                    <tr>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Toko</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Nominal</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Bank</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">No Rekening</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Nama Rekening</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Status</th>
                        <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Tanggal</th>
                        <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y">
                    @forelse($withdrawals as $withdrawal)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">{{ $withdrawal->store->name }}</div>
                            <div class="text-sm text-gray-500">{{ $withdrawal->store->city }}</div>
                        </td>
                        <td class="px-6 py-4 font-semibold text-gray-900">
                            Rp {{ number_format($withdrawal->amount, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 text-gray-700">
                            {{ $withdrawal->bank_name }}
                        </td>
                        <td class="px-6 py-4 text-gray-700 font-mono">
                            {{ $withdrawal->account_number }}
                        </td>
                        <td class="px-6 py-4 text-gray-700">
                            {{ $withdrawal->account_name }}
                        </td>
                        <td class="px-6 py-4">
                            @if($withdrawal->status === 'pending')
                                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-semibold">
                                    Pending
                                </span>
                            @elseif($withdrawal->status === 'approved')
                                <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-semibold">
                                    Approved
                                </span>
                            @else
                                <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-semibold">
                                    Rejected
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $withdrawal->created_at->format('d M Y H:i') }}
                        </td>
                        <td class="px-6 py-4">
                            @if($withdrawal->status === 'pending')
                            <div class="flex gap-2 justify-center">
                                {{-- Approve Button --}}
                                <form action="{{ route('admin.withdrawals.approve', $withdrawal->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" 
                                            onclick="return confirm('Approve withdrawal ini? Pastikan sudah transfer ke rekening seller!')"
                                            class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition text-sm font-medium">
                                        ✓ Approve
                                    </button>
                                </form>

                                {{-- Reject Button --}}
                                <form action="{{ route('admin.withdrawals.reject', $withdrawal->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            onclick="return confirm('Reject withdrawal ini? Saldo akan dikembalikan ke seller.')"
                                            class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition text-sm font-medium">
                                        ✗ Reject
                                    </button>
                                </form>
                            </div>
                            @else
                            <div class="text-center text-sm text-gray-400">
                                -
                            </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                            Belum ada withdrawal request
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- PAGINATION --}}
        <div class="mt-6">
            {{ $withdrawals->links() }}
        </div>

    </div>
</x-app-layout>
