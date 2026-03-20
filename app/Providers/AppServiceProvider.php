<?php

namespace App\Providers;

use App\Models\RegistroFalla;
use App\Observers\RegistroFallaObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Registrar el observer para RegistroFalla
        RegistroFalla::observe(RegistroFallaObserver::class);
    }
}
