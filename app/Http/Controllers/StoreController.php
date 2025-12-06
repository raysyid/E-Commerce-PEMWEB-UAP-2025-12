<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function store(Request $request)
    {
        $userId = Auth::id(); // 🔥 pasti angka, aman

        Store::create([
            'user_id'     => $userId,
            'name'        => strtolower($request->name),
            'logo'        => 'default.png',
            'about'       => $request->about,
            'phone'       => $request->phone,
            'city'        => $request->city,
            'address'     => $request->address,
            'postal_code' => $request->postal_code,
            'is_verified' => false,
        ]);

        // FIX: update role tanpa pakai $user->update()
        User::where('id', $userId)->update([
            'role' => 'seller'
        ]);

        return redirect()->route('seller.dashboard')
            ->with('success', 'Toko berhasil dibuat, selamat berjualan!');
    }
}
