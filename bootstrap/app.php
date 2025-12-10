<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// 🔹 import middleware bawaan
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;

// 🔹 import middleware custom
use App\Http\Middleware\EnsureIsSeller;
use App\Http\Middleware\EnsureIsMember;
use App\Http\Middleware\EnsureIsAdmin;
use App\Http\Middleware\EnsureStoreIsVerified;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // 📌 daftar alias middleware resmi
        $middleware->alias([
            'auth'      => Authenticate::class,
            'verified'  => EnsureEmailIsVerified::class,

            // 📌 middleware custom role
            'isSeller'  => EnsureIsSeller::class,
            'isMember'  => EnsureIsMember::class,
            'isAdmin'   => EnsureIsAdmin::class,
            'storeVerified' => EnsureStoreIsVerified::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();