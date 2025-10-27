# Changelog

## 1.1.0 – 2025-10-27

- Replaced the custom Blade view with `TextColumn`'s native rendering so helpers
  like `alignment()`, `wrap()`, copyable state, descriptions, etc. keep working.
- Render the `<relative-time>` element through `formatStateUsing()` and return an
  `HtmlString`, ensuring HTML output is preserved.
- Removed the unused `partials/config` view and the plugin render hook that
  injected it.

## 1.0.0

- Initial release: Filament 4 `<relative-time>` column.
