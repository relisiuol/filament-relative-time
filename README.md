# Filament Relative Time

A Filament v4 table column powered by [`@github/relative-time-element`](https://github.com/github/relative-time-element),
bundled **locally** with esbuild. It renders relative, absolute (Intl)
or duration values in the user's time zone (or a forced IANA time zone), with a
SSR fallback.

**[Documentation](https://github.com/relisiuol/filament-relative-time/tree/v1.0.0/docs/index.md)**

## Quick install

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

## Column usage

```php
use Relisiuol\FilamentRelativeTime\Columns\RelativeTimeColumn as RT;

RT::make('created_at')
  ->label('Created')
  ->format('relative')          // relative | datetime | duration
  ->precision('minute')         // for relative/duration
  ->threshold('P30D')           // ISO8601 – switch to absolute after 30 days
  ->timeZone('auto')            // 'auto' (browser) or 'Europe/Paris'
  ->locale('en-GB')             // otherwise <html lang> / browser
  ->datetimeIntl([              // only when format='datetime'
    'year'           => 'numeric',
    'month'          => 'short',
    'day'            => '2-digit',
    'hour'           => '2-digit',
    'minute'         => '2-digit',
    'time-zone-name' => 'short',
  ])
  ->formatStyle('short')        // 'long' | 'short' | 'narrow'
  ->tense('auto')               // 'auto' | 'past' | 'future'
  ->absolutePrefix('on')        // override default absolute prefix
  ->noTitle()                   // drop <relative-time> title attribute
  ->elementAttributes(['aria-label'=>'Creation date']);
```

Need 12-hour output or no timezone suffix? Tweak `datetimeIntl()`, e.g. swap
`'hour' => '2-digit'` for `'hour' => 'numeric'`, add `'second' => '2-digit'`,
drop `'time-zone-name'`, or opt-in to `'date-style'` / `'time-style'` presets
if your target browsers support them.

> Global defaults come from `config/filament-relative-time.php`. Publish the
> config and set keys like `'format-style' => 'short'` or `'prefix' => ''` to
> apply them across every column.
> All options are defined as null, to use default options from [`@github/relative-time-element`](https://github.com/github/relative-time-element).

Other attributes from the Web Component (e.g. `prefix`, `format-style`,
`tense`, `no-title`) are mapped with dedicated helpers or fall back to
`elementAttributes([...])` for any edge-case attribute.

## Quality & submission

- Hosted on GitHub, distributed via Packagist.
- Public documentation in `docs/`.
- No CDN; CSP-friendly (serve the local bundle from your domain).

## License

MIT. Dependency: `@github/relative-time-element` (MIT).
