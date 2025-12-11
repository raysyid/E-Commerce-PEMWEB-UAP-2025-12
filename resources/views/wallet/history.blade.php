@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-10">

    <div class="bg-white p-6 rounded-2xl shadow-lg">
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Riwayat Top Up</h2>

        @if($topups->count() > 0)
            <div class="space-y-3">
                @foreach($topups as $topup)
                    <div class="p-4 border-2 border-gray-200 rounded-xl hover:border-blue-300 transition">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-2">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center
                                        {{ $topup->status === 'success' ? 'bg-green-100' : ($topup->status === 'pending' ? 'bg-yellow-100' : 'bg-red-100') }}">
                                        @if($topup->status === 'success')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                                            </svg>
                                        @elseif($topup->status === 'pending')
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        @else
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                            </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-800">Top Up Saldo</h3>
                                        <p class="text-sm text-gray-500">{{ $topup->created_at->format('d M Y, H:i') }}</p>
                                    </div>
                                </div>
                                
                                <div class="ml-12">
                                    <p class="text-xs text-gray-500 mb-1">Kode VA:</p>
                                    <p class="font-mono text-sm font-semibold text-blue-600">{{ $topup->va_code }}</p>
                                </div>
                            </div>

                            <div class="text-right">
                                <p class="text-xl font-bold text-green-600">
                                    + Rp {{ number_format($topup->amount, 0, ',', '.') }}
                                </p>
                                <span class="inline-block px-2 py-1 text-xs font-semibold rounded-full mt-1
                                    {{ $topup->status === 'success' ? 'bg-green-100 text-green-800' : ($topup->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                    {{ $topup->status === 'success' ? 'Berhasil' : ($topup->status === 'pending' ? 'Menunggu' : 'Gagal') }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Riwayat</h3>
                <p class="text-gray-500 mb-6">Kamu belum pernah melakukan top-up saldo</p>
                
                <a href="{{ route('wallet.topup') }}" 
                   class="inline-block bg-gradient-to-r from-blue-600 to-blue-800 text-white font-bold px-6 py-3 rounded-xl hover:from-blue-700 hover:to-blue-900 transition shadow-lg">
                    Top Up Sekarang
                </a>
            </div>
        @endif

        <a href="{{ route('wallet.index') }}" 
           class="block text-center mt-6 text-gray-600 hover:text-gray-800 font-semibold transition">
            ← Kembali ke Dompet
        </a>
    </div>

</div>
@endsection
