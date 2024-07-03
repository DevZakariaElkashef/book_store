<?php

namespace App\Providers;

use App\Exceptions\FallbackHandler;
use App\Models\Order;
use App\Models\Setting;
use App\Models\Slider;
use App\Observers\OrderObserver;
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
        Order::observe(OrderObserver::class);

        view()->share('app', Setting::first());
        view()->share('footerImage', Slider::where('key', 'footer-section')->first()->image);
    }
}
