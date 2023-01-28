<?php

namespace App\Providers;

use App\Services\EventService;
use App\Services\Impl\EventServiceInterface;
use App\Services\Impl\ReservationServiceInterface;
use App\Services\ReservationService;
use Illuminate\Support\ServiceProvider;
use Reliese\Coders\CodersServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        if ($this->app->environment() === 'local') {
            $this->app->register(CodersServiceProvider::class);
        }

        $this->app->singleton(EventServiceInterface::class, EventService::class);
        $this->app->singleton(ReservationServiceInterface::class, ReservationService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
