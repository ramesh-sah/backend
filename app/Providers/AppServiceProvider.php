<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
// use App\Models\Sanctum\PersonalAccessToken as PATClass;
// use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Use our customized personal access token model
        // Sanctum::usePersonalAccessTokenModel(
        //     PATClass::class
        // );
        Schema::defaultStringLength(191);
    }
}
