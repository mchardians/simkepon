<?php

namespace App\Providers;

use App\Services\Contracts\PengeluaranService;
use App\Services\Implementations\PengeluaranServiceImp;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class PengeluaranServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        PengeluaranService::class => PengeluaranServiceImp::class
    ];

    public function provides(): array {
        return [PengeluaranService::class];
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
