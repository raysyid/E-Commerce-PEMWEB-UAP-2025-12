<?php

namespace App\Http\Controllers;

use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class AdminVerificationController extends Controller
{
    public function index()
    {
        $stores = Store::where('is_verified', false)->get();
        return view('admin.verification', compact('stores'));
    }

    public function approve($id)
    {
        Store::where('id', $id)->update([
            'is_verified' => true
        ]);

        return back()->with('success', 'Toko berhasil diverifikasi');
    }

    public function reject($id)
    {
        $store = Store::findOrFail($id);
        $user = $store->user;

        // hapus toko
        $store->delete();

        // reset role ke member
        $user->role = 'member';
        $user->save();

        return redirect()->back()->with('success', 'Toko ditolak dan user dikembalikan menjadi member.');
    }
}
