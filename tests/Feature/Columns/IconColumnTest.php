<?php

declare(strict_types=1);

use Accelade\Tables\Columns\IconColumn;

it('can be created with make', function () {
    $column = IconColumn::make('type');

    expect($column)->toBeInstanceOf(IconColumn::class);
    expect($column->getName())->toBe('type');
});

it('can set a single icon', function () {
    $column = IconColumn::make('type')
        ->displayIcon('heroicon-o-document');

    expect($column)->toBeInstanceOf(IconColumn::class);
});

it('can set icons for different values', function () {
    $column = IconColumn::make('type')
        ->icons([
            'document' => 'heroicon-o-document',
            'image' => 'heroicon-o-photo',
            'video' => 'heroicon-o-film',
        ]);

    expect($column)->toBeInstanceOf(IconColumn::class);
});

it('can set colors for different values', function () {
    $column = IconColumn::make('type')
        ->colors([
            'document' => 'primary',
            'image' => 'success',
            'video' => 'warning',
        ]);

    expect($column)->toBeInstanceOf(IconColumn::class);
});

it('can set icon color', function () {
    $column = IconColumn::make('type')
        ->iconColor('primary');

    expect($column)->toBeInstanceOf(IconColumn::class);
});

it('can set icon size', function () {
    $column = IconColumn::make('type')
        ->size('lg');

    expect($column->getSize())->toBe('lg');
});

it('has default icon size of md', function () {
    $column = IconColumn::make('type');

    expect($column->getSize())->toBe('md');
});

it('can be set to boolean mode', function () {
    $column = IconColumn::make('is_published')
        ->boolean();

    expect($column->isBoolean())->toBeTrue();
});

it('can set true icon', function () {
    $column = IconColumn::make('is_published')
        ->boolean()
        ->trueIcon('heroicon-o-check-circle');

    expect($column->getTrueIcon())->toBe('heroicon-o-check-circle');
});

it('can set false icon', function () {
    $column = IconColumn::make('is_published')
        ->boolean()
        ->falseIcon('heroicon-o-x-circle');

    expect($column->getFalseIcon())->toBe('heroicon-o-x-circle');
});

it('has default true and false icons', function () {
    $column = IconColumn::make('is_published')
        ->boolean();

    expect($column->getTrueIcon())->toBe('heroicon-o-check-circle');
    expect($column->getFalseIcon())->toBe('heroicon-o-x-circle');
});

it('can set true color', function () {
    $column = IconColumn::make('is_published')
        ->boolean()
        ->trueColor('green');

    expect($column->getTrueColor())->toBe('green');
});

it('can set false color', function () {
    $column = IconColumn::make('is_published')
        ->boolean()
        ->falseColor('red');

    expect($column->getFalseColor())->toBe('red');
});

it('has default true and false colors', function () {
    $column = IconColumn::make('is_published')
        ->boolean();

    expect($column->getTrueColor())->toBe('success');
    expect($column->getFalseColor())->toBe('danger');
});

it('can be made sortable', function () {
    $column = IconColumn::make('type')
        ->sortable();

    expect($column->isSortable())->toBeTrue();
});

it('can set alignment', function () {
    $column = IconColumn::make('type')
        ->alignCenter();

    expect($column->getAlignment())->toBe('center');
});

it('can set tooltip', function () {
    $column = IconColumn::make('type')
        ->tooltip('File type');

    expect($column->getTooltip())->toBe('File type');
});

it('returns correct view name', function () {
    $column = IconColumn::make('type');

    expect($column->getView())->toBe('tables::columns.icon');
});
