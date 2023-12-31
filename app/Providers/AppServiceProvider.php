<?php

namespace App\Providers;

use App\Models\Config;
use App\Models\PersonalAccessToken;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\Sanctum;

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
        Schema::defaultStringLength(191);
        Sanctum::usePersonalAccessTokenModel(PersonalAccessToken::class);
        view()->composer('*', function ($view) {
            $config = Config::query()->pluck('value', 'name');
            $assign = compact('config');
            $view->with($assign);
        });
    }
}
