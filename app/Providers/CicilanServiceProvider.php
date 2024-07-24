<?php

namespace App\Providers;

use App\Services\Contracts\CicilanService;
use App\Services\Implementations\CicilanServiceImp;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class CicilanServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        CicilanService::class => CicilanServiceImp::class
    ];

    public function provides(): array {
        return [CicilanService::class];
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
