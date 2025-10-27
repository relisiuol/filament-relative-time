# Usage

## Basic relative column

```php
use Relisiuol\FilamentRelativeTime\Columns\RelativeTimeColumn as RT;

RT::make('created_at')->label('Created')->format('relative');
```

## Absolute (Intl) formatting

```php
RT::make('updated_at')
  ->format('datetime')
  ->datetimeIntl([
    'year'           => 'numeric',
    'month'          => 'short',
    'day'            => '2-digit',
    'hour'           => '2-digit',
    'minute'         => '2-digit',
    'time-zone-name' => 'short',
  ]);

> Tip: tweak `datetimeIntl()` to suit your locale, e.g. add
>`'second' => '2-digit'`, drop `'time-zone-name'` to hide GMT, or supply
>`'hour-cycle' => 'h23'` / `'h12'`. Newer browser stacks also support
>`'date-style'` / `'time-style'` if you prefer the `Intl.DateTimeFormat`
> presets.
```

## Relative-only options

```php
RT::make('published_at')
  ->format('relative')
  ->formatStyle('narrow') // long | short | narrow
  ->tense('past')         // auto | past | future
  ->absolutePrefix('since') // override absolute-date prefix
  ->noTitle();            // remove title="" attribute
```

> Publish the config if you want these to be the default everywhere, e.g.
>`'format-style' => 'narrow'` or `'prefix' => ''` in
>`config/filament-relative-time.php`.

## Duration

```php
RT::make('duration_seconds')->format('duration')->precision('second');
```

## Time zone & locale

```php
RT::make('created_at')
  ->timeZone('auto')   // browser; or 'Europe/Paris'
  ->locale('en-GB');   // otherwise <html lang> / browser
```

## Extra attributes

```php
RT::make('created_at')
  ->elementAttributes(['aria-label' => 'Creation date']);
```
