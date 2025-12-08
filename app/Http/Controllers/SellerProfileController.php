<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SellerProfileController extends Controller
{
    public function index()
    {
        $store = Store::where('user_id', Auth::id())->first();

        if (!$store) {
            return redirect()->route('store.register')
                ->with('error', 'Kamu belum punya toko, silakan daftar dulu.');
        }

        return view('seller.profile', compact('store'));
    }

    public function update(Request $request)
    {
        $store = Store::where('user_id', Auth::id())->first();

        if (!$store) {
            return redirect()->route('store.register')
                ->with('error', 'Kamu belum punya toko.');
        }

        $request->validate([
            'name'   => 'required|string|max:255',
            'about'  => 'nullable|string|max:500',
            'phone'  => 'required|string|max:20',
            'city'   => 'required|string|max:100',
            'address'=> 'required|string',
            'logo'   => 'nullable|image|max:2048',
        ]);

        $store->update([
            'name'    => $request->name,
            'about'   => $request->about,
            'phone'   => $request->phone,
            'city'    => $request->city,
            'address' => $request->address,
        ]);

        // Upload logo jika ada
        if ($request->hasFile('logo')) {
            $file = $request->file('logo');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->storeAs('public/store_logo', $filename);

            $store->update(['logo' => $filename]);
        }

        return redirect()
            ->route('seller.dashboard')
            ->with('success', 'Profil toko berhasil diperbarui!');
    }
}