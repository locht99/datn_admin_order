<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Inertia\Inertia::setRootView('name');

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
