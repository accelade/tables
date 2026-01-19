@props([
    'column' => null,
    'record' => null,
    'state' => null,
])

@php
    $copyable = $column instanceof \Accelade\Tables\Columns\ColorColumn && $column->isCopyable();
    $size = $column instanceof \Accelade\Tables\Columns\ColorColumn ? $column->getSize() : 24;
    $rounded = $column instanceof \Accelade\Tables\Columns\ColorColumn ? $column->isRounded() : true;
    $copyMessage = $column instanceof \Accelade\Tables\Columns\ColorColumn ? $column->getCopyMessage() : 'Color copied!';
@endphp

<div class="flex items-center gap-2">
    <div
        @class([
            'shrink-0 border border-gray-200 dark:border-gray-700',
            'rounded-full' => $rounded,
            'rounded' => !$rounded,
        ])
        style="width: {{ $size }}px; height: {{ $size }}px; background-color: {{ $state }};"
        @if($column?->getTooltip())
            title="{{ $column->getTooltip() }}"
        @else
            title="{{ $state }}"
        @endif
    ></div>

    @if($copyable)
        <button
            type="button"
            class="text-xs text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200"
            onclick="navigator.clipboard.writeText('{{ $state }}'); this.textContent = '{{ $copyMessage }}'; setTimeout(() => this.textContent = '{{ $state }}', 1500);"
        >
            {{ $state }}
        </button>
    @else
        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $state }}</span>
    @endif
</div>
