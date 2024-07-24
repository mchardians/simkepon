<?php

namespace App\Providers;

use App\Services\Contracts\IuranService;
use App\Services\Implementations\IuranServiceImp;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class IuranServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        IuranService::class => IuranServiceImp::class
    ];

    public function provides(): array {
        return [IuranService::class];
    }
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
        //
    }
}
