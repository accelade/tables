@props([
    'column' => null,
    'record' => null,
    'state' => null,
])

@php
    $url = $column?->getUrl($record);
    $color = $column?->getColor($record);
    $icon = $column?->getIcon();
    $iconPosition = $column?->getIconPosition() ?? 'before';
    $copyable = $column instanceof \Accelade\Tables\Columns\TextColumn && $column->isCopyable();
    $mono = $column instanceof \Accelade\Tables\Columns\TextColumn && $column->isMono();
    $html = $column instanceof \Accelade\Tables\Columns\TextColumn && $column->isHtml();

    $colorClasses = match($color) {
        'primary' => 'text-blue-600 dark:text-blue-400',
        'success' => 'text-green-600 dark:text-green-400',
        'warning' => 'text-yellow-600 dark:text-yellow-400',
        'danger' => 'text-red-600 dark:text-red-400',
        'info' => 'text-cyan-600 dark:text-cyan-400',
        'gray' => 'text-gray-600 dark:text-gray-400',
        default => '',
    };
@endphp

<div @class(['flex items-center gap-1.5', $colorClasses, 'font-mono' => $mono])>
    @if($icon && $iconPosition === 'before')
        <span class="shrink-0">{!! $icon !!}</span>
    @endif

    @if($url)
        <a
            href="{{ $url }}"
            @if($column->shouldOpenUrlInNewTab()) target="_blank" rel="noopener noreferrer" @endif
            class="hover:underline"
        >
            @if($html)
                {!! $state !!}
            @else
                {{ $state }}
            @endif
        </a>
    @else
        @if($html)
            <span>{!! $state !!}</span>
        @else
            <span>{{ $state }}</span>
        @endif
    @endif

    @if($icon && $iconPosition === 'after')
        <span class="shrink-0">{!! $icon !!}</span>
    @endif

    @if($copyable)
        <button
            type="button"
            class="ml-1 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300"
            onclick="navigator.clipboard.writeText('{{ addslashes($state) }}'); this.innerHTML = '✓'; setTimeout(() => this.innerHTML = '📋', 1500);"
            title="Copy to clipboard"
        >
            📋
        </button>
    @endif
</div>
