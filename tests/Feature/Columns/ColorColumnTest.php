<?php

declare(strict_types=1);

use Accelade\Tables\Columns\ColorColumn;
use Tests\TestCase;

uses(TestCase::class);

it('can be created with make', function () {
    $column = ColorColumn::make('color');

    expect($column)->toBeInstanceOf(ColorColumn::class);
    expect($column->getName())->toBe('color');
});

it('can be made copyable', function () {
    $column = ColorColumn::make('color')
        ->copyable();

    expect($column->isCopyable())->toBeTrue();
});

it('can set copy message', function () {
    $column = ColorColumn::make('color')
        ->copyable()
        ->copyMessage('Color code copied!');

    expect($column->getCopyMessage())->toBe('Color code copied!');
});

it('has default copy message', function () {
    $column = ColorColumn::make('color');

    expect($column->getCopyMessage())->toBe('Color copied!');
});

it('can set swatch size', function () {
    $column = ColorColumn::make('color')
        ->size(32);

    expect($column->getSize())->toBe(32);
});

it('has default swatch size of 24', function () {
    $column = ColorColumn::make('color');

    expect($column->getSize())->toBe(24);
});

it('can be made rounded', function () {
    $column = ColorColumn::make('color')
        ->rounded();

    expect($column->isRounded())->toBeTrue();
});

it('is rounded by default', function () {
    $column = ColorColumn::make('color');

    expect($column->isRounded())->toBeTrue();
});

it('can be made square', function () {
    $column = ColorColumn::make('color')
        ->square();

    expect($column->isRounded())->toBeFalse();
});

it('can be made sortable', function () {
    $column = ColorColumn::make('color')
        ->sortable();

    expect($column->isSortable())->toBeTrue();
});

it('can set alignment', function () {
    $column = ColorColumn::make('color')
        ->alignCenter();

    expect($column->getAlignment())->toBe('center');
});

it('can set tooltip', function () {
    $column = ColorColumn::make('color')
        ->tooltip('Brand color');

    expect($column->getTooltip())->toBe('Brand color');
});

it('returns correct view name', function () {
    $column = ColorColumn::make('color');

    expect($column->getView())->toBe('tables::columns.color');
});
