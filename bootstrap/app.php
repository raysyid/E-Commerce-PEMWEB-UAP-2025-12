<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// Tambahkan import default middleware
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\Middleware\EnsureEmailIsVerified;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {

        // 📌 daftar alias middleware
        $middleware->alias([
            'auth'      => Authenticate::class,
            'verified'  => EnsureEmailIsVerified::class,
            'isSeller'  => \App\Http\Middleware\EnsureIsSeller::class,
            'isMember'  => \App\Http\Middleware\EnsureIsMember::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })
    ->create();