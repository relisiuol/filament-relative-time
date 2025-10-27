<?php

declare(strict_types=1);

namespace Relisiuol\FilamentRelativeTime\Columns;

use Closure;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class RelativeTimeColumn extends TextColumn
{
    protected string $view = 'filament-relative-time::filament.tables.columns.relative-time';

    /** @var string|Closure|null 'relative' | 'datetime' | 'duration' */
    protected string|Closure|null $format = null;

    /** @var string|Closure|null e.g. 'second'|'minute'|'hour' */
    protected string|Closure|null $precision = null;

    /** @var string|Closure|null ISO 8601 duration e.g. 'P30D' */
    protected string|Closure|null $threshold = null;

    /** @var string|Closure|null IANA zone (e.g. 'Europe/Paris') or 'auto' */
    protected string|Closure|null $timeZone = null;

    /** @var string|Closure|null e.g. 'en-GB' */
    protected string|Closure|null $locale = null;

    /** @var array<string,string>|Closure|null Intl options when format='datetime' */
    protected array|Closure|null $datetimeIntl = null;

    /** @var array<string,string>|Closure|null Extra attributes for the element */
    protected array|Closure|null $elementAttributes = null;

    /** @var string|Closure|null 'long'|'short'|'narrow' */
    protected string|Closure|null $formatStyle = null;

    /** @var string|Closure|null 'auto'|'past'|'future' */
    protected string|Closure|null $tense = null;

    /** @var string|Closure|null Custom label prefix when switching to absolute */
    protected string|Closure|null $absolutePrefix = null;

    /** @var bool|Closure|null Toggle no-title attribute */
    protected bool|Closure|null $noTitle = null;

    // ---- Fluent API

    public function format(string|Closure|null $format): static
    {
        $this->format = $format;
        return $this;
    }

    public function precision(string|Closure|null $precision): static
    {
        $this->precision = $precision;
        return $this;
    }

    public function threshold(string|Closure|null $threshold): static
    {
        $this->threshold = $threshold;
        return $this;
    }

    public function timeZone(string|Closure|null $tz): static
    {
        $this->timeZone = $tz;
        return $this;
    }

    public function locale(string|Closure|null $locale): static
    {
        $this->locale = $locale;
        return $this;
    }

    /** @param array<string,string>|Closure|null $options */
    public function datetimeIntl(array|Closure|null $options): static
    {
        $this->datetimeIntl = $options;
        return $this;
    }

    /** @param array<string,string>|Closure|null $attrs */
    public function elementAttributes(array|Closure|null $attrs): static
    {
        $this->elementAttributes = $attrs;
        return $this;
    }

    public function formatStyle(string|Closure|null $style): static
    {
        $this->formatStyle = $style;
        return $this;
    }

    public function tense(string|Closure|null $tense): static
    {
        $this->tense = $tense;
        return $this;
    }

    public function absolutePrefix(string|Closure|null $prefix): static
    {
        $this->absolutePrefix = $prefix;
        return $this;
    }

    public function noTitle(bool|Closure|null $state = true): static
    {
        $this->noTitle = $state;
        return $this;
    }

    // ---- Helpers/Resolvers

    public function getIsoUtcState(): ?string
    {
        $state = $this->getState();
        if (blank($state)) {
            return null;
        }

        try {
            return Carbon::parse($state)->utc()->toIso8601String();
        } catch (\Throwable) {
            return null;
        }
    }

    public function getServerFallback(): string
    {
        $iso = $this->getIsoUtcState();
        return $iso ? ($iso . ' UTC') : '—';
    }

    public function getResolvedFormat(): ?string
    {
        /** @phpstan-ignore-next-line */
        return $this->evaluate($this->format) ?? config('filament-relative-time.defaults.format');
    }

    public function getResolvedPrecision(): ?string
    {
        /** @phpstan-ignore-next-line */
        return $this->evaluate($this->precision) ?? config('filament-relative-time.defaults.precision');
    }

    public function getResolvedThreshold(): ?string
    {
        /** @phpstan-ignore-next-line */
        return $this->evaluate($this->threshold) ?? config('filament-relative-time.defaults.threshold');
    }

    public function getResolvedTimeZone(): ?string
    {
        /** @phpstan-ignore-next-line */
        return $this->evaluate($this->timeZone) ?? config('filament-relative-time.defaults.time-zone');
    }

    public function getResolvedFormatStyle(): ?string
    {
        /** @phpstan-ignore-next-line */
        return $this->evaluate($this->formatStyle) ?? config('filament-relative-time.defaults.format-style');
    }

    public function getResolvedTense(): ?string
    {
        /** @phpstan-ignore-next-line */
        return $this->evaluate($this->tense) ?? config('filament-relative-time.defaults.tense');
    }

    public function getResolvedAbsolutePrefix(): ?string
    {
        /** @phpstan-ignore-next-line */
        return $this->evaluate($this->absolutePrefix) ?? config('filament-relative-time.defaults.prefix');
    }

    public function getResolvedNoTitle(): bool
    {
        /** @phpstan-ignore-next-line */
        $value = $this->evaluate($this->noTitle);
        if ($value === null) {
            $value = config('filament-relative-time.defaults.no-title', false);
        }

        return (bool) $value;
    }

    public function getResolvedLocale(): ?string
    {
        /** @phpstan-ignore-next-line */
        return $this->evaluate($this->locale) ?? config('filament-relative-time.defaults.locale');
    }

    /** @return array<string,string>|null */
    public function getResolvedDatetimeIntl(): ?array
    {
        /** @phpstan-ignore-next-line */
        $opts = $this->evaluate($this->datetimeIntl) ?? config('filament-relative-time.defaults.datetime-intl');
        return $opts ? Arr::where($opts, fn ($v) => $v !== null) : null;
    }

    /** @return array<string,string>|null */
    public function getResolvedElementAttributes(): ?array
    {
        /** @phpstan-ignore-next-line */
        $attrs = $this->evaluate($this->elementAttributes);
        return $attrs ? Arr::where($attrs, fn ($v) => $v !== null && $v !== '') : null;
    }
}
