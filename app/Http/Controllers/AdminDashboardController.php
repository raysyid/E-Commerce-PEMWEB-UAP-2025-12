<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Store;
use App\Models\Withdrawal;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => User::count(),
            'pending_stores' => Store::where('is_verified', false)->count(),
            'pending_withdrawals' => Withdrawal::where('status', 'pending')->count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }
}
