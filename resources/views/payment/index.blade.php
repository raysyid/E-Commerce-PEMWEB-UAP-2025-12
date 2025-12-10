@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto mt-10 bg-white shadow p-6 rounded-xl">
    <h2 class="text-2xl font-bold mb-4">Pembayaran Virtual Account</h2>

    @if(session('error'))
        <div class="bg-red-200 text-red-700 p-3 rounded mb-3">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('payment.check') }}" method="POST">
        @csrf

        <label class="font-semibold">Masukkan Kode VA:</label>
        <input type="text" name="va_code" 
               class="w-full border p-2 rounded mt-2" 
               placeholder="Contoh: VA1023123">

        <button class="mt-4 w-full bg-blue-600 text-white py-2 rounded">
            Cek Kode VA
        </button>
    </form>
</div>
@endsection
