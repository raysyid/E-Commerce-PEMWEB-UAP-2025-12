<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function create()
    {
        return view('seller.store-register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'phone'       => 'required|string|max:20',
            'address'     => 'required|string',
            'city'        => 'required|string|max:100',
            'postal_code' => 'nullable|string|max:10',
            'about'       => 'nullable|string|max:500',
        ]);

        $userId = Auth::id();
        $addressCode = 'ADDR-' . str_pad($userId, 3, '0', STR_PAD_LEFT);

        // SIMPAN DATA TOKO
        Store::create([
            'user_id'     => $userId,
            'name'        => strtolower($request->name),
            'logo'        => 'default.png',
            'about'       => $request->about ?? '-',
            'phone'       => $request->phone,
            'city'        => $request->city,
            'address'     => $request->address,
            'postal_code' => $request->postal_code ?? '-',
            'address_id'  => $addressCode,
            'is_verified' => false,
        ]);

        // UPDATE ROLE USER MENJADI SELLER
        User::where('id', $userId)->update([
            'role' => 'seller'
        ]);

        return redirect()->route('seller.dashboard')
            ->with('success', 'Toko berhasil dibuat, selamat berjualan!');
    }
}
