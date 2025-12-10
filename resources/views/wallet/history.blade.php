@extends('layout.main')

@section('content')
<div class="max-w-md mx-auto mt-10 bg-white p-6 rounded-xl shadow">

    <h2 class="text-xl font-bold mb-4">History Transaksi</h2>

    <div class="space-y-4">

        @foreach ($transactions as $trx)
        <div class="p-4 bg-gray-100 rounded-lg flex justify-between">
            <span>{{ $trx['type'] }}</span>

            @if ($trx['amount'] > 0)
                <span class="font-bold text-green-600">+ Rp {{ number_format($trx['amount'], 0, ',', '.') }}</span>
            @else
                <span class="font-bold text-red-600">- Rp {{ number_format(abs($trx['amount']), 0, ',', '.') }}</span>
            @endif
        </div>
        @endforeach

    </div>

    <a href="{{ route('wallet.index') }}"
       class="block mt-6 bg-gray-800 text-white py-3 rounded-xl text-center hover:bg-gray-700">
       Kembali
    </a>

</div>
@endsection
