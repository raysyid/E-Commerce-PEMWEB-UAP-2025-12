<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Store;

class EnsureIsSeller
{
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan login dulu
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Pastikan role member
        if ($request->user()->role !== 'member') {
            abort(403, 'Akses khusus seller (member dengan toko)');
        }

        // Pastikan sudah punya store
        $hasStore = Store::where('user_id', $request->user()->id)->exists();
        if (!$hasStore) {
            return redirect()->route('store.register')
                ->with('error', 'Kamu harus membuat toko dulu.');
        }

        return $next($request);
    }
}