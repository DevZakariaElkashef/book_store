<?php

namespace App\Providers;

use App\Exceptions\FallbackHandler;
use App\Models\Order;
use App\Models\Setting;
use App\Models\Slider;
use App\Observers\OrderObserver;
use App\Observers\RoleNotifyObserver;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Gate;
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
        Gate::after(function($user, $ability) {
            if($user->hasRole('super-admin')) {
                return true;
            }
        });

        Blade::if('canany', function (array $permissions) {
            foreach ($permissions as $permission) {
                if (auth()->user()->can($permission)) {
                    return true;
                }
            }
            return false;
        });

        Paginator::useBootstrapFive();

        Role::observe(RoleNotifyObserver::class);
        Order::observe(OrderObserver::class);

        view()->share('app', Setting::first());
        view()->share('footerImage', Slider::where('key', 'footer-section')->first()->image);
    }
}
