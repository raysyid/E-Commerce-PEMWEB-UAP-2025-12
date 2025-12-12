<x-app-layout>
    <div class="max-w-7xl mx-auto py-10 px-6" x-data="{ showModal: false, modalType: '', modalId: null, modalAmount: '', modalStore: '' }">

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
                            {{ $withdrawal->bank_account_number }}
                        </td>
                        <td class="px-6 py-4 text-gray-700">
                            {{ $withdrawal->bank_account_name }}
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
                                <button @click="showModal = true; modalType = 'approve'; modalId = {{ $withdrawal->id }}; modalAmount = '{{ number_format($withdrawal->amount, 0, ',', '.') }}'; modalStore = '{{ $withdrawal->store->name }}'"
                                        class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition text-sm font-medium">
                                    ✓ Approve
                                </button>

                                {{-- Reject Button --}}
                                <button @click="showModal = true; modalType = 'reject'; modalId = {{ $withdrawal->id }}; modalAmount = '{{ number_format($withdrawal->amount, 0, ',', '.') }}'; modalStore = '{{ $withdrawal->store->name }}'"
                                        class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition text-sm font-medium">
                                    ✗ Reject
                                </button>
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

        {{-- MODAL CONFIRMATION --}}
        <div x-show="showModal" 
             x-cloak
             class="fixed inset-0 z-50 overflow-y-auto" 
             aria-labelledby="modal-title" 
             role="dialog" 
             aria-modal="true">
            <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                {{-- Background overlay --}}
                <div x-show="showModal" 
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" 
                     @click="showModal = false"></div>

                {{-- Modal panel --}}
                <div x-show="showModal"
                     x-transition:enter="ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="ease-in duration-200"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="inline-block align-bottom bg-white rounded-2xl text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    
                    <div class="bg-white px-6 pt-6 pb-4">
                        <div class="sm:flex sm:items-start">
                            <div :class="modalType === 'approve' ? 'bg-green-100' : 'bg-red-100'" 
                                 class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full sm:mx-0 sm:h-10 sm:w-10">
                                <span x-text="modalType === 'approve' ? '✓' : '✗'" 
                                      :class="modalType === 'approve' ? 'text-green-600' : 'text-red-600'"
                                      class="text-2xl font-bold"></span>
                            </div>
                            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left flex-1">
                                <h3 class="text-lg leading-6 font-bold text-gray-900" id="modal-title">
                                    <span x-text="modalType === 'approve' ? 'Approve Withdrawal?' : 'Reject Withdrawal?'"></span>
                                </h3>
                                <div class="mt-3">
                                    <p class="text-sm text-gray-600">
                                        <strong>Toko:</strong> <span x-text="modalStore"></span><br>
                                        <strong>Nominal:</strong> Rp <span x-text="modalAmount"></span>
                                    </p>
                                    <p class="text-sm text-gray-500 mt-3" x-show="modalType === 'approve'">
                                        Pastikan sudah transfer ke rekening seller sebelum approve!
                                    </p>
                                    <p class="text-sm text-gray-500 mt-3" x-show="modalType === 'reject'">
                                        Saldo akan dikembalikan ke seller.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="bg-gray-50 px-6 py-4 sm:flex sm:flex-row-reverse gap-3">
                        <form :action="modalType === 'approve' ? '{{ url('/admin/withdrawals') }}/' + modalId + '/approve' : '{{ url('/admin/withdrawals') }}/' + modalId + '/reject'" 
                              method="POST" class="w-full sm:w-auto">
                            @csrf
                            @method('PATCH')
                            <button type="submit" 
                                    :class="modalType === 'approve' ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700'"
                                    class="w-full inline-flex justify-center rounded-lg border border-transparent shadow-sm px-4 py-2 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-offset-2 sm:text-sm">
                                <span x-text="modalType === 'approve' ? 'Ya, Approve' : 'Ya, Reject'"></span>
                            </button>
                        </form>
                        <button type="button" 
                                @click="showModal = false"
                                class="mt-3 w-full inline-flex justify-center rounded-lg border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm">
                            Batal
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <style>
        [x-cloak] { display: none !important; }
    </style>
</x-app-layout>
