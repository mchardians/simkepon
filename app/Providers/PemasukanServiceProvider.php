<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Contracts\PemasukanService;
use Illuminate\Contracts\Support\DeferrableProvider;
use App\Services\Implementations\PemasukanServiceImp;

class PemasukanServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        PemasukanService::class => PemasukanServiceImp::class
    ];

    public function provides(): array {
        return [PemasukanService::class];
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
