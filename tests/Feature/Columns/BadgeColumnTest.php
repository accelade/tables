<?php

declare(strict_types=1);

use Accelade\Tables\Columns\BadgeColumn;
use Tests\TestCase;

uses(TestCase::class);

it('can be created with make', function () {
    $column = BadgeColumn::make('status');

    expect($column)->toBeInstanceOf(BadgeColumn::class);
    expect($column->getName())->toBe('status');
});

it('can set colors for different values', function () {
    $column = BadgeColumn::make('status')
        ->colors([
            'active' => 'success',
            'pending' => 'warning',
            'inactive' => 'danger',
        ]);

    expect($column)->toBeInstanceOf(BadgeColumn::class);
});

it('can set icons for different values', function () {
    $column = BadgeColumn::make('status')
        ->icons([
            'active' => 'heroicon-o-check',
            'pending' => 'heroicon-o-clock',
        ]);

    expect($column)->toBeInstanceOf(BadgeColumn::class);
});

it('can set badge size', function () {
    $column = BadgeColumn::make('status')
        ->size('lg');

    expect($column->getSize())->toBe('lg');
});

it('has default badge size of sm', function () {
    $column = BadgeColumn::make('status');

    expect($column->getSize())->toBe('sm');
});

it('can be made sortable', function () {
    $column = BadgeColumn::make('status')
        ->sortable();

    expect($column->isSortable())->toBeTrue();
});

it('can be made searchable', function () {
    $column = BadgeColumn::make('status')
        ->searchable();

    expect($column->isSearchable())->toBeTrue();
});

it('can set alignment', function () {
    $column = BadgeColumn::make('status')
        ->alignCenter();

    expect($column->getAlignment())->toBe('center');
});

it('can set tooltip', function () {
    $column = BadgeColumn::make('status')
        ->tooltip('Current status');

    expect($column->getTooltip())->toBe('Current status');
});

it('returns correct view name', function () {
    $column = BadgeColumn::make('status');

    expect($column->getView())->toBe('accelade::columns.badge');
});
