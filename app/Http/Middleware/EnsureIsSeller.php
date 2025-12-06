<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Store;

class EnsureIsSeller
{
    public function handle(Request $request, Closure $next)
    {
        $userId = Auth::id();

        $store = Store::where('user_id', $userId)->first();

        if ($userId && $store) {
            return $next($request);
        }

        return abort(403, 'AKSES KHUSUS SELLER');
    }
}