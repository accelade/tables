<?php

declare(strict_types=1);

use Accelade\Tables\Columns\ToggleColumn;

it('can be created with make', function () {
    $column = ToggleColumn::make('is_active');

    expect($column)->toBeInstanceOf(ToggleColumn::class);
    expect($column->getName())->toBe('is_active');
});

it('can set on color', function () {
    $column = ToggleColumn::make('is_active')
        ->onColor('success');

    expect($column->getOnColor())->toBe('success');
});

it('has default on color of primary', function () {
    $column = ToggleColumn::make('is_active');

    expect($column->getOnColor())->toBe('primary');
});

it('can set off color', function () {
    $column = ToggleColumn::make('is_active')
        ->offColor('danger');

    expect($column->getOffColor())->toBe('danger');
});

it('has default off color of gray', function () {
    $column = ToggleColumn::make('is_active');

    expect($column->getOffColor())->toBe('gray');
});

it('can set on icon', function () {
    $column = ToggleColumn::make('is_active')
        ->onIcon('heroicon-o-check');

    expect($column->getOnIcon())->toBe('heroicon-o-check');
});

it('can set off icon', function () {
    $column = ToggleColumn::make('is_active')
        ->offIcon('heroicon-o-x-mark');

    expect($column->getOffIcon())->toBe('heroicon-o-x-mark');
});

it('has no icons by default', function () {
    $column = ToggleColumn::make('is_active');

    expect($column->getOnIcon())->toBeNull();
    expect($column->getOffIcon())->toBeNull();
});

it('can be disabled', function () {
    $column = ToggleColumn::make('is_active')
        ->disabled();

    expect($column->isDisabled())->toBeTrue();
});

it('is not disabled by default', function () {
    $column = ToggleColumn::make('is_active');

    expect($column->isDisabled())->toBeFalse();
});

it('can set update callback', function () {
    $callback = fn ($record, $state) => $record->update(['is_active' => $state]);

    $column = ToggleColumn::make('is_active')
        ->updateStateUsing($callback);

    expect($column->getUpdateCallback())->toBe($callback);
});

it('can be made sortable', function () {
    $column = ToggleColumn::make('is_active')
        ->sortable();

    expect($column->isSortable())->toBeTrue();
});

it('can set alignment', function () {
    $column = ToggleColumn::make('is_active')
        ->alignCenter();

    expect($column->getAlignment())->toBe('center');
});

it('can set tooltip', function () {
    $column = ToggleColumn::make('is_active')
        ->tooltip('Toggle active status');

    expect($column->getTooltip())->toBe('Toggle active status');
});

it('returns correct view name', function () {
    $column = ToggleColumn::make('is_active');

    expect($column->getView())->toBe('tables::columns.toggle');
});
