<?php

namespace App\Providers;

use App\Enums\UserType;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class CustomDirectivesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::if('admin', function () {
            return auth()->check() && auth()->user()->user_type === UserType::ADMIN;
        });
    }
}
