<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureStoreIsVerified
{
    public function handle($request, Closure $next)
    {
        $store = Auth::user()->store;

        // seller tapi belum verified
        if (!$store->is_verified) {
            return redirect()->route('seller.pending');
        }

        return $next($request);
    }
}