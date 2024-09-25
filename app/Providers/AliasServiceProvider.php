<?php

namespace App\Providers;

// use Maatwebsite\Excel\Facades\Excel;
// use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class AliasServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        // $loader = AliasLoader::getInstance();
        // $loader->alias('Excel',Excel::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
