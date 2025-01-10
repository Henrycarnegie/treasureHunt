<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Http;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {

        $response = Http::get('https://api.cloudflare.com/client/v4/ips');

        if ($response->successful()) {
            $ipv4 = $response->json('result.ipv4_cidrs');
            $ipv6 = $response->json('result.ipv6_cidrs');

            // Gabungkan daftar IP
            $allIps = array_merge($ipv4, $ipv6);

            // Percayai hanya daftar IP dari Cloudflare
            $middleware->trustProxies(at: $allIps);
        } else {
            // Tangani kesalahan jika API gagal
            throw new Exception('Gagal mendapatkan daftar IP dari Cloudflare.');
        }

        $middleware->alias([
            'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
            'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
