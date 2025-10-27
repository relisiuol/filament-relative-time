# Installation

```bash
composer require relisiuol/filament-relative-time
php artisan vendor:publish --tag=filament-relative-time
```

Enable the plugin on your panel:

```php
use Relisiuol\FilamentRelativeTime\RelativeTimePlugin;

public function panel(\Filament\Panel $panel): Panel
{
    return $panel->plugins([
        RelativeTimePlugin::make(),
    ]);
}
```

## For maintainers / contributors

```bash
npm i
npm run build   # produces dist/relative-time.bundle.js
```

Commit the updated `dist/` and tag a release. The CI workflow ensures `dist/` is up-to-date.
