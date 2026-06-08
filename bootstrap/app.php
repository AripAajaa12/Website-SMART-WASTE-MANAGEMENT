<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php', // 1. SEKARANG JALUR API SUDAH DIAKTIFKAN!
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // 2. MENDAFTARKAN ALIAS CUSTOM MIDDLEWARE ANDA DI LARAVEL 11
        $middleware->alias([
            'auth.apikey' => \App\Http\Middleware\ApiKeyAuth::class,
            'auth.basic.custom' => \App\Http\Middleware\CustomBasicAuth::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->shouldRenderJsonWhen(
            fn (Request $request) => $request->is('api/*'),
        );
    })->create();