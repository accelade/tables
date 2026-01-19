@props([
    'column' => null,
    'record' => null,
    'state' => null,
])

@php
    $disabled = $column instanceof \Accelade\Tables\Columns\ToggleColumn ? $column->isDisabled() : false;
    $onColor = $column instanceof \Accelade\Tables\Columns\ToggleColumn ? $column->getOnColor() : 'primary';
    $offColor = $column instanceof \Accelade\Tables\Columns\ToggleColumn ? $column->getOffColor() : 'gray';
    $name = $column?->getName() ?? '';
    $recordKey = $record?->getKey() ?? '';
    $isOn = (bool) $state;

    $trackColorClasses = $isOn
        ? match($onColor) {
            'primary', 'blue' => 'bg-blue-600 dark:bg-blue-500',
            'success', 'green' => 'bg-green-600 dark:bg-green-500',
            'warning', 'yellow' => 'bg-yellow-500 dark:bg-yellow-400',
            'danger', 'red' => 'bg-red-600 dark:bg-red-500',
            'info', 'cyan' => 'bg-cyan-600 dark:bg-cyan-500',
            default => 'bg-blue-600 dark:bg-blue-500',
        }
        : match($offColor) {
            'gray' => 'bg-gray-200 dark:bg-gray-700',
            default => 'bg-gray-200 dark:bg-gray-700',
        };
@endphp

<button
    type="button"
    role="switch"
    aria-checked="{{ $isOn ? 'true' : 'false' }}"
    data-record-id="{{ $recordKey }}"
    data-column="{{ $name }}"
    @disabled($disabled)
    @class([
        'relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900',
        $trackColorClasses,
        'opacity-50 cursor-not-allowed' => $disabled,
    ])
>
    <span class="sr-only">Toggle {{ $name }}</span>
    <span
        @class([
            'pointer-events-none inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out',
            'translate-x-5' => $isOn,
            'translate-x-0' => !$isOn,
        ])
    ></span>
</button>
