<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Middleware untuk CORS agar frontend bisa akses API
        $middleware->append(\App\Http\Middleware\CorsMiddleware::class);

        // Middleware Sanctum agar cookie bisa dikirim dari frontend
        $middleware->append(EnsureFrontendRequestsAreStateful::class);

        // Tambahkan middleware sesi jika menggunakan fitur session
        $middleware->append(EncryptCookies::class);
        $middleware->append(AddQueuedCookiesToResponse::class);
        $middleware->append(StartSession::class);

        // Middleware tambahan
        $middleware->append(SubstituteBindings::class);
        $middleware->append(ThrottleRequests::class.':api');
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
