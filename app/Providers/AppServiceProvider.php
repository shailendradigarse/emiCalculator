<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(\App\Repositories\LoanDetailRepositoryInterface::class, \App\Repositories\LoanDetailRepository::class);
        $this->app->bind(\App\Services\EmiServiceInterface::class, \App\Services\EmiService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
