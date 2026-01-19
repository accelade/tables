@props([
    'column' => null,
    'record' => null,
    'state' => null,
])

@php
    $options = $column instanceof \Accelade\Tables\Columns\SelectColumn ? $column->getOptions() : [];
    $placeholder = $column instanceof \Accelade\Tables\Columns\SelectColumn ? $column->getPlaceholder() : null;
    $disabled = $column instanceof \Accelade\Tables\Columns\SelectColumn ? $column->isDisabled() : false;
    $name = $column?->getName() ?? '';
    $recordKey = $record?->getKey() ?? '';
@endphp

<select
    name="{{ $name }}"
    data-record-id="{{ $recordKey }}"
    @disabled($disabled)
    class="block w-full px-2 py-1 text-sm rounded border border-gray-300 bg-white text-gray-900 focus:border-primary-500 focus:ring-1 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 disabled:opacity-50 disabled:cursor-not-allowed"
>
    @if($placeholder)
        <option value="">{{ $placeholder }}</option>
    @endif

    @foreach($options as $value => $label)
        <option value="{{ $value }}" @selected($state == $value)>
            {{ $label }}
        </option>
    @endforeach
</select>
