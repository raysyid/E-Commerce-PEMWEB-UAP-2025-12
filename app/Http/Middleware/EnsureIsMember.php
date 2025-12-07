<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsMember
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Hanya member yang BELUM punya toko
        if ($user->role !== 'member' || $user->store) {
            return abort(403, 'Akses khusus member yang belum memiliki toko');
        }

        return $next($request);
    }
}
