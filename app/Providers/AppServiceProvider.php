<?php

namespace App\Providers;

use App\Models\Suivi;
use App\Policies\SuiviPolicy;
use Illuminate\Support\Facades\Gate;
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
        Gate::policy(Suivi::class, SuiviPolicy::class);
    }
}