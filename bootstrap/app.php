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
        // Register alias middleware
        $middleware->alias([
            'already.voted' => \App\Http\Middleware\AlreadyVoted::class,
            'admin.access' => \App\Http\Middleware\AdminAccess::class,
        ]);

        // Middleware groups (jika perlu custom)
        $middleware->web(append: [
            // Tambahkan middleware khusus web di sini jika perlu
        ]);

        $middleware->api(append: [
            // Tambahkan middleware khusus api di sini jika perlu
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Custom exception handling (opsional)
    })->create();
