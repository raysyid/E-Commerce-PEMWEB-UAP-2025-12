<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SellerProfileController extends Controller
{
    public function index()
    {
        $store = Auth::user()->store;

        if (!$store) {
            return redirect()->route('store.register')
                ->with('error', 'Kamu belum punya toko, silakan daftar dulu.');
        }

        return view('seller.profile', compact('store'));
    }

    public function update(Request $request)
    {
        $store = Auth::user()->store;

        if (!$store) {
            return redirect()->route('store.register');
        }

        $store->update($request->only(['name','about','phone','address','city','postal_code']));

        return back()->with('success', 'Profil toko berhasil diperbarui.');
    }
}