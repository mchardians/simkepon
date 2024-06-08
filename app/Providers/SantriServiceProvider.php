<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Contracts\SantriService;
use App\Services\Implementations\SantriServiceImp;
use Illuminate\Contracts\Support\DeferrableProvider;

class SantriServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        SantriService::class => SantriServiceImp::class
    ];

    public function provides(): array {
        return [SantriService::class];
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
