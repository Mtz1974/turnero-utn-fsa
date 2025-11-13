<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // 👇 Registramos el alias 'role' acá, en tiempo de arranque
        Route::aliasMiddleware('role', \App\Http\Middleware\Role::class);

        parent::boot();
    }
}
