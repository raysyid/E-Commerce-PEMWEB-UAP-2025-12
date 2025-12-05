<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function create()
    {
        if (Store::where('user_id', Auth::id())->exists()) {
            return redirect()->route('seller.dashboard');
        }

        return view('store.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'city' => 'required',
        ]);

        Store::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'logo' => 'default.png',
            'about' => $request->about,
            'phone' => $request->phone,
            'address_id' => 'ADDR01',
            'city' => $request->city,
            'address' => $request->address,
            'postal_code' => $request->postal_code,
            'is_verified' => false
        ]);

        return redirect()->route('seller.dashboard')->with('success', 'Toko berhasil dibuat!');
    }
}