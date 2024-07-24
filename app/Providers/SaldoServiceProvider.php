<?php

namespace App\Providers;

use App\Services\Contracts\SaldoService;
use App\Services\Implementations\SaldoServiceImp;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class SaldoServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons = [
        SaldoService::class => SaldoServiceImp::class
    ];

    public function provides(): array {
        return [SaldoService::class];
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
