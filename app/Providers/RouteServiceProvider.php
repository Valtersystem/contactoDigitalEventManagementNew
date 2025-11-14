<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        parent::boot();

        // Carregar rotas WEB
        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        // Carregar rotas API
        Route::prefix('api')
            ->middleware('api')
            ->group(base_path('routes/api.php'));
    }
}
