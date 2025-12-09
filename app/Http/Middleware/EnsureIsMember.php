<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class EnsureIsMember
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->role !== 'member') {
            return redirect()->route('home')
                ->with('error', 'Akses khusus untuk member');
        }

        return $next($request);
    }
}