<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureIsSeller
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== 'seller') {
            return redirect()->route('home')
                ->with('error', 'Akses khusus untuk seller');
        }

        return $next($request);
    }
}
