<?php

declare(strict_types=1);

use Accelade\Tables\Columns\SelectColumn;
use Tests\TestCase;

uses(TestCase::class);

it('can be created with make', function () {
    $column = SelectColumn::make('status');

    expect($column)->toBeInstanceOf(SelectColumn::class);
    expect($column->getName())->toBe('status');
});

it('can set options as array', function () {
    $column = SelectColumn::make('status')
        ->options([
            'draft' => 'Draft',
            'pending' => 'Pending',
            'published' => 'Published',
        ]);

    expect($column->getOptions())->toBe([
        'draft' => 'Draft',
        'pending' => 'Pending',
        'published' => 'Published',
    ]);
});

it('can set options as closure', function () {
    $column = SelectColumn::make('status')
        ->options(fn () => ['active' => 'Active', 'inactive' => 'Inactive']);

    expect($column->getOptions())->toBe(['active' => 'Active', 'inactive' => 'Inactive']);
});

it('can be made searchable', function () {
    $column = SelectColumn::make('status')
        ->searchable();

    expect($column->isSearchable())->toBeTrue();
});

it('is not searchable by default', function () {
    $column = SelectColumn::make('status');

    expect($column->isSearchable())->toBeFalse();
});

it('can set placeholder', function () {
    $column = SelectColumn::make('status')
        ->placeholder('Select a status');

    expect($column->getPlaceholder())->toBe('Select a status');
});

it('can be set to native select', function () {
    $column = SelectColumn::make('status')
        ->native();

    expect($column->isNative())->toBeTrue();
});

it('is native by default', function () {
    $column = SelectColumn::make('status');

    expect($column->isNative())->toBeTrue();
});

it('can be disabled', function () {
    $column = SelectColumn::make('status')
        ->disabled();

    expect($column->isDisabled())->toBeTrue();
});

it('is not disabled by default', function () {
    $column = SelectColumn::make('status');

    expect($column->isDisabled())->toBeFalse();
});

it('can set update callback', function () {
    $callback = fn ($record, $state) => $record->update(['status' => $state]);

    $column = SelectColumn::make('status')
        ->updateStateUsing($callback);

    expect($column->getUpdateCallback())->toBe($callback);
});

it('can be made sortable', function () {
    $column = SelectColumn::make('status')
        ->sortable();

    expect($column->isSortable())->toBeTrue();
});

it('can set alignment', function () {
    $column = SelectColumn::make('status')
        ->alignCenter();

    expect($column->getAlignment())->toBe('center');
});

it('can set tooltip', function () {
    $column = SelectColumn::make('status')
        ->tooltip('Change status');

    expect($column->getTooltip())->toBe('Change status');
});

it('returns correct view name', function () {
    $column = SelectColumn::make('status');

    expect($column->getView())->toBe('tables::columns.select');
});
