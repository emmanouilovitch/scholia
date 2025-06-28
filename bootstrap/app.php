<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\EnsureEmailIsVerified;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Spatie\Permission\Middlewares\RoleMiddleware;
use Spatie\Permission\Middlewares\PermissionMiddleware;
use Spatie\Permission\Middlewares\RoleOrPermissionMiddleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
           // 'auth' => Authenticate::class,
            'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
           // 'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
           // 'password.confirm' => \App\Http\Middleware\RequirePasswordConfirmation::class,
            'throttle' => ThrottleRequests::class,
           // 'verified' => EnsureEmailIsVerified::class,
           // 'role' => RoleMiddleware::class,
            //'permission' => PermissionMiddleware::class,
           // 'role_or_permission' => RoleOrPermissionMiddleware::class,
        ]);

        // Si vous utilisez Inertia.js (ce n'est pas le cas pour l'instant, mais pour référence)
        // $middleware->web(append: [
        //     \App\Http\Middleware\HandleInertiaRequests::class,
        //     \Illuminate\Http\Middleware\AddLinkHeadersForPreloadedAssets::class,
        // ]);

        // Si vous utilisiez l'API avec Sanctum et voulez des fonctionnalités Stateful (nous n'en avons pas besoin pour l'instant)
        // $middleware->api(prepend: [
        //     \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        // ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();