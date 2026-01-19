@props([
    'column' => null,
    'record' => null,
    'state' => null,
])

@php
    $icon = $column?->getIconForRecord($record);
    $color = $column?->getColor($record) ?? 'gray';
    $size = $column instanceof \Accelade\Tables\Columns\IconColumn ? $column->getSize() : 'md';

    $colorClasses = match($color) {
        'primary', 'blue' => 'text-blue-600 dark:text-blue-400',
        'success', 'green' => 'text-green-600 dark:text-green-400',
        'warning', 'yellow' => 'text-yellow-600 dark:text-yellow-400',
        'danger', 'red' => 'text-red-600 dark:text-red-400',
        'info', 'cyan' => 'text-cyan-600 dark:text-cyan-400',
        'purple' => 'text-purple-600 dark:text-purple-400',
        'pink' => 'text-pink-600 dark:text-pink-400',
        default => 'text-gray-600 dark:text-gray-400',
    };

    $sizeClasses = match($size) {
        'xs' => 'w-4 h-4',
        'sm' => 'w-5 h-5',
        'md' => 'w-6 h-6',
        'lg' => 'w-8 h-8',
        'xl' => 'w-10 h-10',
        default => 'w-6 h-6',
    };
@endphp

@if($icon)
    <div @class(['flex items-center justify-center', $colorClasses])>
        @if(str_starts_with($icon, '<'))
            {!! $icon !!}
        @elseif(str_starts_with($icon, 'heroicon-'))
            <x-dynamic-component :component="$icon" @class([$sizeClasses]) />
        @else
            <span @class([$sizeClasses, 'flex items-center justify-center'])>
                {!! $icon !!}
            </span>
        @endif
    </div>
@endif
