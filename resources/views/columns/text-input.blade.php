@props([
    'column' => null,
    'record' => null,
    'state' => null,
])

@php
    $disabled = $column instanceof \Accelade\Tables\Columns\TextInputColumn ? $column->isDisabled() : false;
    $readonly = $column instanceof \Accelade\Tables\Columns\TextInputColumn ? $column->isReadonly() : false;
    $type = $column instanceof \Accelade\Tables\Columns\TextInputColumn ? $column->getType() : 'text';
    $placeholder = $column instanceof \Accelade\Tables\Columns\TextInputColumn ? $column->getInputPlaceholder() : null;
    $maxLength = $column instanceof \Accelade\Tables\Columns\TextInputColumn ? $column->getMaxLength() : null;
    $minLength = $column instanceof \Accelade\Tables\Columns\TextInputColumn ? $column->getMinLength() : null;
    $inputMode = $column instanceof \Accelade\Tables\Columns\TextInputColumn ? $column->getInputMode() : null;
    $step = $column instanceof \Accelade\Tables\Columns\TextInputColumn ? $column->getStep() : null;
    $min = $column instanceof \Accelade\Tables\Columns\TextInputColumn ? $column->getMin() : null;
    $max = $column instanceof \Accelade\Tables\Columns\TextInputColumn ? $column->getMax() : null;
    $name = $column?->getName() ?? '';
    $recordKey = $record?->getKey() ?? '';
@endphp

<input
    type="{{ $type }}"
    name="{{ $name }}"
    value="{{ $state }}"
    data-record-id="{{ $recordKey }}"
    @if($placeholder) placeholder="{{ $placeholder }}" @endif
    @if($maxLength) maxlength="{{ $maxLength }}" @endif
    @if($minLength) minlength="{{ $minLength }}" @endif
    @if($inputMode) inputmode="{{ $inputMode }}" @endif
    @if($step) step="{{ $step }}" @endif
    @if($min) min="{{ $min }}" @endif
    @if($max) max="{{ $max }}" @endif
    @disabled($disabled)
    @readonly($readonly)
    class="block w-full px-2 py-1 text-sm rounded border border-gray-300 bg-white text-gray-900 placeholder-gray-400 focus:border-primary-500 focus:ring-1 focus:ring-primary-500/20 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-100 dark:placeholder-gray-500 disabled:opacity-50 disabled:cursor-not-allowed read-only:bg-gray-50 dark:read-only:bg-gray-900"
/>
