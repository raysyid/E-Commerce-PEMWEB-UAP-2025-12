<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    /**
     * Halaman form buat toko
     */
    public function create()
    {
        // Jika user sudah punya toko → arahkan ke dashboard seller
        if (Store::where('user_id', Auth::id())->exists()) {
            return redirect()->route('seller.dashboard');
        }

        return view('store.register');
    }

    /**
     * Simpan data toko baru
     */
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

        Store::create([
            'user_id'     => Auth::id(),
            'name'        => strtolower($request->name), // biar konsisten
            'logo'        => 'default.png',
            'about'       => $request->about,
            'phone'       => $request->phone,
            'address_id'  => 'ADDR01', // sementara hardcoded
            'city'        => $request->city,
            'address'     => $request->address,
            'postal_code' => $request->postal_code,
            'is_verified' => false,
        ]);

        return redirect()
            ->route('seller.dashboard')
            ->with('success', 'Toko berhasil dibuat!');
    }

    /**
     * Halaman daftar semua toko (untuk rekomendasi toko)
     */
    public function index()
    {
        $stores = Store::where('is_verified', true)->get();

        return view('store.index', compact('stores'));
    }

    /**
     * Halaman detail toko → /store/{name}
     */
    public function show($name)
    {
        $store = Store::where('name', $name)->firstOrFail();

        return view('store.show', compact('store'));
    }
}
