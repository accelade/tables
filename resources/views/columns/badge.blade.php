@props([
    'column' => null,
    'record' => null,
    'state' => null,
])

@php
    $color = $column?->getColor($record) ?? 'gray';
    $icon = $column?->getIconForRecord($record);
    $size = $column instanceof \Accelade\Tables\Columns\BadgeColumn ? $column->getSize() : 'sm';

    $colorClasses = match($color) {
        'primary', 'blue' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
        'success', 'green' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
        'warning', 'yellow' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
        'danger', 'red' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
        'info', 'cyan' => 'bg-cyan-100 text-cyan-800 dark:bg-cyan-900/30 dark:text-cyan-400',
        'purple' => 'bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400',
        'pink' => 'bg-pink-100 text-pink-800 dark:bg-pink-900/30 dark:text-pink-400',
        default => 'bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400',
    };

    $sizeClasses = match($size) {
        'xs' => 'px-1.5 py-0.5 text-xs',
        'sm' => 'px-2 py-1 text-xs',
        'md' => 'px-2.5 py-1 text-sm',
        'lg' => 'px-3 py-1.5 text-sm',
        default => 'px-2 py-1 text-xs',
    };
@endphp

<span @class([
    'inline-flex items-center gap-1 font-medium rounded-full',
    $colorClasses,
    $sizeClasses,
])>
    @if($icon)
        <span class="shrink-0">{!! $icon !!}</span>
    @endif
    {{ $state }}
</span>
