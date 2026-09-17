<?php

namespace App\Providers;

use App\Models\AutorisationProche;
use App\Models\DemandeSuivi;
use App\Models\RendezVous;
use App\Models\Suivi;
use App\Policies\AutorisationProchePolicy;
use App\Policies\DemandeSuiviPolicy;
use App\Policies\RendezVousPolicy;
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
        Gate::policy(RendezVous::class, RendezVousPolicy::class);
        Gate::policy(AutorisationProche::class, AutorisationProchePolicy::class);
        Gate::policy(DemandeSuivi::class, DemandeSuiviPolicy::class);
    }
}
