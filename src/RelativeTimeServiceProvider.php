<?php

declare(strict_types=1);

namespace Relisiuol\FilamentRelativeTime;

use Illuminate\Support\ServiceProvider;

class RelativeTimeServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Load config
        $this->mergeConfigFrom(__DIR__ . '/../config/filament-relative-time.php', 'filament-relative-time');
    }

    public function boot(): void
    {
        // Publish config and asset
        $this->publishes([
            __DIR__ . '/../config/filament-relative-time.php' => config_path('filament-relative-time.php'),
            __DIR__ . '/../dist/relative-time.bundle.js' =>
                public_path('vendor/relisiuol/filament-relative-time/relative-time.bundle.js'),
        ], 'filament-relative-time');
    }
}
