<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Contracts\WaliSantriService;
use App\Services\Implementations\WaliSantriServiceImp;
use Illuminate\Contracts\Support\DeferrableProvider;

class WaliSantriServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        WaliSantriService::class => WaliSantriServiceImp::class
    ];

    public function provides(): array {
        return [WaliSantriService::class];
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
