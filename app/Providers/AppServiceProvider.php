<?php

namespace App\Providers;

use App\Exceptions\FallbackHandler;
use App\Observers\RoleNotifyObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Spatie\Permission\Models\Role;

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
        Paginator::useBootstrapFive();

        Role::observe(RoleNotifyObserver::class);
    }
}
