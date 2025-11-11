<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

// 1. TAMBAHKAN 'use' INI DI BAGIAN ATAS
use App\Http\Middleware\CheckRole; 

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        
        // 2. TAMBAHKAN 'alias' INI DI DALAM FUNGSI 'withMiddleware'
        $middleware->alias([
            'role' => CheckRole::class,
        ]);

        // (Mungkin ada middleware lain di sini, biarkan saja)

    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();