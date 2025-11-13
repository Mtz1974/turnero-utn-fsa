<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // ...

    protected $middlewareAliases = [
        'auth'       => \App\Http\Middleware\Authenticate::class,
        'guest'      => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'verified'   => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'throttle'   => \Illuminate\Routing\Middleware\ThrottleRequests::class,

        // 👇 nuestro alias de roles (¡clave!)
        'role'       => \App\Http\Middleware\Role::class,
    ];

    // ...
}
