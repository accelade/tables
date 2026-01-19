@props([
    'column' => null,
    'record' => null,
    'state' => null,
])

@php
    $disabled = $column instanceof \Accelade\Tables\Columns\CheckboxColumn ? $column->isDisabled() : false;
    $name = $column?->getName() ?? '';
    $recordKey = $record?->getKey() ?? '';
    $isChecked = (bool) $state;
@endphp

<div class="flex items-center justify-center">
    <input
        type="checkbox"
        name="{{ $name }}"
        data-record-id="{{ $recordKey }}"
        @checked($isChecked)
        @disabled($disabled)
        class="h-4 w-4 rounded border-gray-300 text-primary-600 focus:ring-primary-500 dark:border-gray-600 dark:bg-gray-800 dark:checked:bg-primary-500 dark:focus:ring-offset-gray-900 disabled:opacity-50 disabled:cursor-not-allowed"
    />
</div>
