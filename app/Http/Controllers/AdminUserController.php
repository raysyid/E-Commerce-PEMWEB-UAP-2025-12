<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::with('store')
            ->orderBy('id', 'DESC')
            ->paginate(10); // ⬅️ bukan get()

        return view('admin.users', compact('users'));
    }

    public function deleteStore($id)
    {
        $store = Store::findOrFail($id);
        $user = $store->user;

        $store->delete();
        $user->role = 'member';
        $user->save();

        return back()->with('success', 'Toko dihapus & user kembali menjadi member.');
    }
}
