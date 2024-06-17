<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        $middleware->alias([
            'Admin' => \App\Http\middleware\Admin::class,
            'Sale' => \App\Http\Middleware\Sale::class,
            'Produksi' => \App\Http\Middleware\Produksi::class,
            'Gudang' => \App\Http\Middleware\Gudang::class,
            'Purchase' => \App\Http\Middleware\Purchase::class,
            
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
