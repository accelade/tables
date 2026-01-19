<?php

declare(strict_types=1);

use Accelade\Tables\Columns\BadgeColumn;
use Accelade\Tables\Columns\Column;
use Accelade\Tables\Columns\TextColumn;
use Accelade\Tables\Table;
use Illuminate\Support\Facades\View;
use Tests\TestCase;

uses(TestCase::class);

it('registers the config', function () {
    expect(config('tables.enabled'))->toBeTrue();
    expect(config('tables.per_page'))->toBe(15);
});

it('can create a table instance', function () {
    $table = Table::make('users');

    expect($table)->toBeInstanceOf(Table::class);
    expect($table->getName())->toBe('users');
});

it('can create columns', function () {
    $column = Column::make('name')
        ->label('Name')
        ->sortable()
        ->searchable();

    expect($column->getName())->toBe('name');
    expect($column->getLabel())->toBe('Name');
    expect($column->isSortable())->toBeTrue();
    expect($column->isSearchable())->toBeTrue();
});

it('can create text columns', function () {
    $column = TextColumn::make('email')
        ->copyable()
        ->limit(50);

    expect($column)->toBeInstanceOf(TextColumn::class);
    expect($column->isCopyable())->toBeTrue();
    expect($column->getLimit())->toBe(50);
});

it('can create badge columns', function () {
    $column = BadgeColumn::make('status')
        ->colors([
            'active' => 'success',
            'inactive' => 'danger',
        ]);

    expect($column)->toBeInstanceOf(BadgeColumn::class);
});

it('can configure table with columns', function () {
    $table = Table::make('users')
        ->columns([
            Column::make('name')->sortable(),
            Column::make('email')->searchable(),
        ]);

    expect($table->getColumns())->toHaveCount(2);
    expect($table->getSortableColumns())->toHaveKey('name');
    expect($table->getSearchColumns())->toContain('email');
});

it('loads table views', function () {
    expect(View::exists('tables::table'))->toBeTrue();
    expect(View::exists('tables::columns.text'))->toBeTrue();
    expect(View::exists('tables::columns.badge'))->toBeTrue();
    expect(View::exists('tables::columns.boolean'))->toBeTrue();
});
