@props([
    'column' => null,
    'record' => null,
    'state' => null,
])

@php
    $value = (bool) $column?->getState($record);
    $trueIcon = $column?->getTrueIcon();
    $falseIcon = $column?->getFalseIcon();
    $trueColor = $column?->getTrueColor() ?? 'success';
    $falseColor = $column?->getFalseColor() ?? 'danger';

    $color = $value ? $trueColor : $falseColor;

    $colorClasses = match($color) {
        'primary', 'blue' => 'text-blue-600 dark:text-blue-400',
        'success', 'green' => 'text-green-600 dark:text-green-400',
        'warning', 'yellow' => 'text-yellow-600 dark:text-yellow-400',
        'danger', 'red' => 'text-red-600 dark:text-red-400',
        'info', 'cyan' => 'text-cyan-600 dark:text-cyan-400',
        default => 'text-gray-600 dark:text-gray-400',
    };
@endphp

<div class="{{ $colorClasses }}">
    @if($value)
        @if($trueIcon)
            {!! $trueIcon !!}
        @else
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
        @endif
    @else
        @if($falseIcon)
            {!! $falseIcon !!}
        @else
            <svg class="h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
            </svg>
        @endif
    @endif
</div>
