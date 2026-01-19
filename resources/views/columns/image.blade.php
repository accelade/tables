@props([
    'column' => null,
    'record' => null,
    'state' => null,
])

@php
    $src = $state ?? $column?->getDefaultImageUrl();
    $width = $column?->getImageWidth() ?? 40;
    $height = $column?->getImageHeight() ?? 40;
    $circular = $column?->isCircular() ?? false;
    $square = $column?->isSquare() ?? true;
@endphp

@if($src)
    <img
        src="{{ $src }}"
        alt=""
        @class([
            'object-cover',
            'rounded-full' => $circular,
            'rounded' => $square && !$circular,
        ])
        style="width: {{ $width }}px; height: {{ $height }}px;"
        loading="lazy"
    />
@else
    <div
        @class([
            'bg-gray-200 dark:bg-gray-700 flex items-center justify-center',
            'rounded-full' => $circular,
            'rounded' => $square && !$circular,
        ])
        style="width: {{ $width }}px; height: {{ $height }}px;"
    >
        <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
        </svg>
    </div>
@endif
