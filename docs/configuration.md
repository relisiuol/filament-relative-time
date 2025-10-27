# Configuration

`config/filament-relative-time.php` (as published):

```php
return [
  'defaults' => [
    'format'          => null, // 'relative' | 'datetime' | 'duration' ; default: 'auto'
    'tense'           => null, // 'auto' | 'past' | 'future' ; default: 'auto'
    'precision'       => null, // 'year' | 'month' | 'day' | 'hour' | 'minute' | 'second'; default: 'second'
    'threshold'       => null, // default: 'P30D' (30 days)
    'prefix'          => null, // default: 'on'
    'format-style'    => null, // 'long' | 'short' | 'narrow' ; default: 'short' for 'relative' or 'datetime' format, 'long' otherwise
    'datetime-intl'   => [
        'second'         => null, // 'numeric' | '2-digit' | undefined ; default: undefined
        'minute'         => null, // 'numeric' | '2-digit' | undefined ; default: undefined
        'hour'           => null, // 'numeric' | '2-digit' | undefined ; default: undefined
        'weekday'        => null, // 'short' | 'long' | 'narrow' | undefined ; default: same value as 'formatStyle' whenever 'format' is 'datetime', otherwise it will be undefined
        'day'            => null, // 'numeric' | '2-digit' | undefined ; default: 'numeric'
        'month'          => null, // 'numeric' | '2-digit' | 'short' | 'long' | 'narrow' | undefined ; same value as 'formatStyle' whenever 'format' is 'datetime', otherwise it will be 'short'
        'year'           => null, // 'numeric' | '2-digit' | undefined ; 'numeric' if 'datetime' represents the same year as the current year, otherwise undefined
        'time-zone-name' => null, // 'short' | 'long' | 'shortOffset' | 'longOffset' | 'shortGeneric' | 'longGeneric' | undefined ; default: undefined
    ],
    'time-zone'       => null, // default: browser time zone
    'locale'          => null, // default: traverse upwards in the tree to find the closest element that does have a locale set, or default the lang to 'en'
    'no-title'        => null, // default: false
  ],
];
```

Set any of these entries to a value (instead of `null`) to override the
web-component defaults globally. For example, change `'format' => 'relative'`
to force relative mode everywhere, or set `'format-style' => 'short'` to align
with your locale preferences.

When `'time-zone'` is defined here, every `<relative-time>` emitted by the
column receives that attribute automatically unless you override it per-column
with `->timeZone(...)`.

- Add `'hour-cycle' => 'h23'` to force 24-hour output regardless of locale.
- Drop `'time-zone-name'` if you prefer hiding the GMT/offset suffix.
- Set `'prefix' => ''` to remove the absolute-date "on" prefix, or configure
  `'no-title' => true` to remove the fallback tooltip entirely.
