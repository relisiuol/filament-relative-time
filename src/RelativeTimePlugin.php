<?php

declare(strict_types=1);

namespace Relisiuol\FilamentRelativeTime;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Assets\Js;
use Filament\View\PanelsRenderHook;

class RelativeTimePlugin implements Plugin
{
    public static function make(): static
    {
        return new static();
    }

    public function getId(): string
    {
        return 'relisiuol-relative-time';
    }

    public function register(Panel $panel): void
    {
        $public = public_path('vendor/relisiuol/filament-relative-time/relative-time.bundle.js');

        if (file_exists($public)) {
            $panel->assets([
                Js::make('relative-time', asset('vendor/relisiuol/filament-relative-time/relative-time.bundle.js')),
            ]);
        }
    }

    public function boot(Panel $panel): void
    {
        $panel->renderHook(
            PanelsRenderHook::BODY_START,
            fn () => view('filament-relative-time::partials.config', [
                'timeZone' => config('filament-relative-time.defaults.time-zone'),
            ])
        );
    }
}
