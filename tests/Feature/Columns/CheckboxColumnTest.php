<?php

declare(strict_types=1);

use Accelade\Tables\Columns\CheckboxColumn;
use Tests\TestCase;

uses(TestCase::class);

it('can be created with make', function () {
    $column = CheckboxColumn::make('is_completed');

    expect($column)->toBeInstanceOf(CheckboxColumn::class);
    expect($column->getName())->toBe('is_completed');
});

it('can be disabled', function () {
    $column = CheckboxColumn::make('is_completed')
        ->disabled();

    expect($column->isDisabled())->toBeTrue();
});

it('is not disabled by default', function () {
    $column = CheckboxColumn::make('is_completed');

    expect($column->isDisabled())->toBeFalse();
});

it('can set update callback', function () {
    $callback = fn ($record, $state) => $record->update(['is_completed' => $state]);

    $column = CheckboxColumn::make('is_completed')
        ->updateStateUsing($callback);

    expect($column->getUpdateCallback())->toBe($callback);
});

it('can set a custom label', function () {
    $column = CheckboxColumn::make('is_completed')
        ->label('Completed');

    expect($column->getLabel())->toBe('Completed');
});

it('can be made sortable', function () {
    $column = CheckboxColumn::make('is_completed')
        ->sortable();

    expect($column->isSortable())->toBeTrue();
});

it('can set alignment', function () {
    $column = CheckboxColumn::make('is_completed')
        ->alignCenter();

    expect($column->getAlignment())->toBe('center');
});

it('can set tooltip', function () {
    $column = CheckboxColumn::make('is_completed')
        ->tooltip('Mark as completed');

    expect($column->getTooltip())->toBe('Mark as completed');
});

it('returns correct view name', function () {
    $column = CheckboxColumn::make('is_completed');

    expect($column->getView())->toBe('tables::columns.checkbox');
});
