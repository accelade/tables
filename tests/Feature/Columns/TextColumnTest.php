<?php

declare(strict_types=1);

use Accelade\Tables\Columns\TextColumn;

it('can be created with make', function () {
    $column = TextColumn::make('name');

    expect($column)->toBeInstanceOf(TextColumn::class);
    expect($column->getName())->toBe('name');
});

it('auto-generates label from name', function () {
    $column = TextColumn::make('first_name');

    expect($column->getLabel())->toBe('First Name');
});

it('can set a custom label', function () {
    $column = TextColumn::make('name')
        ->label('Full Name');

    expect($column->getLabel())->toBe('Full Name');
});

it('can be made copyable', function () {
    $column = TextColumn::make('email')
        ->copyable();

    expect($column->isCopyable())->toBeTrue();
});

it('can set a copy message', function () {
    $column = TextColumn::make('email')
        ->copyable()
        ->copyMessage('Email copied!');

    expect($column->getCopyMessage())->toBe('Email copied!');
});

it('has default copy message', function () {
    $column = TextColumn::make('email');

    expect($column->getCopyMessage())->toBe('Copied!');
});

it('can limit characters', function () {
    $column = TextColumn::make('description')
        ->limit(50);

    expect($column->getLimit())->toBe(50);
});

it('can limit words', function () {
    $column = TextColumn::make('description')
        ->words(10);

    expect($column->getWords())->toBe(10);
});

it('can render as HTML', function () {
    $column = TextColumn::make('content')
        ->html();

    expect($column->isHtml())->toBeTrue();
});

it('can render as markdown', function () {
    $column = TextColumn::make('content')
        ->markdown();

    expect($column->isMarkdown())->toBeTrue();
});

it('can set text size', function () {
    $column = TextColumn::make('name')
        ->size('lg');

    expect($column->getSize())->toBe('lg');
});

it('has default text size of sm', function () {
    $column = TextColumn::make('name');

    expect($column->getSize())->toBe('sm');
});

it('can set font weight', function () {
    $column = TextColumn::make('name')
        ->weight('bold');

    expect($column->getWeight())->toBe('bold');
});

it('can use monospace font', function () {
    $column = TextColumn::make('code')
        ->mono();

    expect($column->isMono())->toBeTrue();
});

it('can be made sortable', function () {
    $column = TextColumn::make('name')
        ->sortable();

    expect($column->isSortable())->toBeTrue();
});

it('can be made searchable', function () {
    $column = TextColumn::make('name')
        ->searchable();

    expect($column->isSearchable())->toBeTrue();
});

it('can add prefix and suffix', function () {
    $column = TextColumn::make('price')
        ->prefix('$')
        ->suffix(' USD');

    expect($column->getPrefix())->toBe('$');
    expect($column->getSuffix())->toBe(' USD');
});

it('can set alignment', function () {
    $column = TextColumn::make('price')
        ->alignRight();

    expect($column->getAlignment())->toBe('right');
});

it('can set tooltip', function () {
    $column = TextColumn::make('name')
        ->tooltip('This is the user name');

    expect($column->getTooltip())->toBe('This is the user name');
});

it('can set placeholder', function () {
    $column = TextColumn::make('name')
        ->placeholder('No name');

    expect($column->getPlaceholder())->toBe('No name');
});

it('can enable text wrapping', function () {
    $column = TextColumn::make('description')
        ->wrap();

    expect($column->shouldWrap())->toBeTrue();
});

it('returns correct view name', function () {
    $column = TextColumn::make('name');

    expect($column->getView())->toBe('accelade::columns.text');
});
