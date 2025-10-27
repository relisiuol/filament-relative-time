@php
    $isoUtc      = $getIsoUtcState();
    $fallback    = $getServerFallback();
    $format      = $getResolvedFormat();
    $precision   = $getResolvedPrecision();
    $threshold   = $getResolvedThreshold();
    $tz          = $getResolvedTimeZone();
    $locale      = $getResolvedLocale();
    $intl        = $getResolvedDatetimeIntl();
    $attrs       = $getResolvedElementAttributes() ?? [];
    $formatStyle = $getResolvedFormatStyle();
    $tense       = $getResolvedTense();
    $prefix      = $getResolvedAbsolutePrefix();
    $noTitle     = $getResolvedNoTitle();
@endphp

@if ($isoUtc)
    @php
        $base = [
            'datetime' => $isoUtc,
            'title'    => $fallback,
            'class'    => 'whitespace-nowrap',
        ];

        if ($format) {
            $base['format'] = $format;
        }

        if ($precision) $base['precision'] = $precision;
        if ($threshold) $base['threshold'] = $threshold;
        if ($locale)    $base['lang']      = $locale;
        if ($tz && $tz !== 'auto') $base['time-zone'] = $tz;
        if ($formatStyle) $base['format-style'] = $formatStyle;
        if ($tense) $base['tense'] = $tense;
        if ($prefix !== null && in_array($format, ['relative', 'auto', null], true)) {
            $base['prefix'] = $prefix;
        }
        if ($noTitle) $base['no-title'] = true;

        if ($intl && ($format === 'datetime')) {
            foreach ($intl as $k => $v) { $base[$k] = $v; }
        }

        $allAttrs = array_merge($base, $attrs);
        $attrStr = collect($allAttrs)
            ->map(function ($v, $k) {
                if ($v === null) {
                    return null;
                }

                if ($v === true) {
                    return $k;
                }

                return $k.'="'.e((string)$v).'"';
            })
            ->filter()
            ->implode(' ');
    @endphp

    <relative-time {!! $attrStr !!}>{{ $fallback }}</relative-time>
@else
    <span class="text-gray-400">—</span>
@endif
