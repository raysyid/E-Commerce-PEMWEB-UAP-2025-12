<?php

namespace App\Http\Controllers;

use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class SellerProfileController extends Controller
{
    public function index()
    {
        $store = Auth::user()->store;
        return view('seller.profile', compact('store'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'   => 'required|string|max:255',
            'phone'  => 'required|string|max:20',
            'city'   => 'required|string|max:100',
            'address' => 'required|string',
            'about'  => 'nullable|string|max:500',
            'logo'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $store = Auth::user()->store;

        // 🔥 Extra Security Check (mencegah file disamarkan jadi .jpg padahal bukan gambar)
        if ($request->hasFile('logo')) {
            if (!in_array($request->logo->getMimeType(), ['image/jpeg', 'image/png', 'image/webp'])) {
                return back()->with('error', 'Format logo tidak valid.');
            }
        }

        // Update field biasa
        $store->update([
            'name'    => $request->name,
            'about'   => $request->about,
            'phone'   => $request->phone,
            'city'    => $request->city,
            'address' => $request->address,
        ]);

        // 🔥 Jika upload logo baru → hapus lama dan simpan baru
        if ($request->hasFile('logo')) {

            // hapus file lama jika bukan default.png
            if ($store->logo && $store->logo !== 'default.png') {
                Storage::delete('store/' . $store->logo);
            }

            // simpan logo baru
            $newLogo = time() . '.' . $request->logo->extension();
            $request->logo->storeAs('store', $newLogo);

            $store->logo = $newLogo;
            $store->save();
        }

        return redirect()->route('seller.dashboard')
            ->with('success', 'Profil toko berhasil diperbarui!');
    }
}