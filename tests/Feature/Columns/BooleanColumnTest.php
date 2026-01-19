<?php

declare(strict_types=1);

use Accelade\Tables\Columns\BooleanColumn;

it('can be created with make', function () {
    $column = BooleanColumn::make('is_active');

    expect($column)->toBeInstanceOf(BooleanColumn::class);
    expect($column->getName())->toBe('is_active');
});

it('can set custom icons', function () {
    $column = BooleanColumn::make('is_active')
        ->icons('heroicon-o-check', 'heroicon-o-x-mark');

    expect($column->getTrueIcon())->toBe('heroicon-o-check');
    expect($column->getFalseIcon())->toBe('heroicon-o-x-mark');
});

it('can set custom colors', function () {
    $column = BooleanColumn::make('is_active')
        ->colors('green', 'red');

    expect($column->getTrueColor())->toBe('green');
    expect($column->getFalseColor())->toBe('red');
});

it('has default colors', function () {
    $column = BooleanColumn::make('is_active');

    expect($column->getTrueColor())->toBe('success');
    expect($column->getFalseColor())->toBe('danger');
});

it('can be made sortable', function () {
    $column = BooleanColumn::make('is_active')
        ->sortable();

    expect($column->isSortable())->toBeTrue();
});

it('can set alignment', function () {
    $column = BooleanColumn::make('is_active')
        ->alignCenter();

    expect($column->getAlignment())->toBe('center');
});

it('can set tooltip', function () {
    $column = BooleanColumn::make('is_active')
        ->tooltip('User status');

    expect($column->getTooltip())->toBe('User status');
});

it('returns correct view name', function () {
    $column = BooleanColumn::make('is_active');

    expect($column->getView())->toBe('accelade::columns.boolean');
});
