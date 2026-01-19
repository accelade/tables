<?php

declare(strict_types=1);

use Accelade\Tables\Columns\TextInputColumn;

it('can be created with make', function () {
    $column = TextInputColumn::make('name');

    expect($column)->toBeInstanceOf(TextInputColumn::class);
    expect($column->getName())->toBe('name');
});

it('has default type of text', function () {
    $column = TextInputColumn::make('name');

    expect($column->getType())->toBe('text');
});

it('can set input type', function () {
    $column = TextInputColumn::make('name')
        ->type('password');

    expect($column->getType())->toBe('password');
});

it('can be set to email type', function () {
    $column = TextInputColumn::make('email')
        ->email();

    expect($column->getType())->toBe('email');
    expect($column->getInputMode())->toBe('email');
});

it('can be set to numeric type', function () {
    $column = TextInputColumn::make('quantity')
        ->numeric();

    expect($column->getType())->toBe('number');
    expect($column->getInputMode())->toBe('numeric');
});

it('can be set to tel type', function () {
    $column = TextInputColumn::make('phone')
        ->tel();

    expect($column->getType())->toBe('tel');
    expect($column->getInputMode())->toBe('tel');
});

it('can be set to url type', function () {
    $column = TextInputColumn::make('website')
        ->urlType();

    expect($column->getType())->toBe('url');
    expect($column->getInputMode())->toBe('url');
});

it('can set input placeholder', function () {
    $column = TextInputColumn::make('name')
        ->inputPlaceholder('Enter name');

    expect($column->getInputPlaceholder())->toBe('Enter name');
});

it('can set max length', function () {
    $column = TextInputColumn::make('name')
        ->maxLength(100);

    expect($column->getMaxLength())->toBe(100);
});

it('can set min length', function () {
    $column = TextInputColumn::make('name')
        ->minLength(3);

    expect($column->getMinLength())->toBe(3);
});

it('can be disabled', function () {
    $column = TextInputColumn::make('name')
        ->disabled();

    expect($column->isDisabled())->toBeTrue();
});

it('is not disabled by default', function () {
    $column = TextInputColumn::make('name');

    expect($column->isDisabled())->toBeFalse();
});

it('can be made readonly', function () {
    $column = TextInputColumn::make('name')
        ->readonly();

    expect($column->isReadonly())->toBeTrue();
});

it('is not readonly by default', function () {
    $column = TextInputColumn::make('name');

    expect($column->isReadonly())->toBeFalse();
});

it('can set update callback', function () {
    $callback = fn ($record, $state) => $record->update(['name' => $state]);

    $column = TextInputColumn::make('name')
        ->updateStateUsing($callback);

    expect($column->getUpdateCallback())->toBe($callback);
});

it('can set validation rules', function () {
    $column = TextInputColumn::make('email')
        ->rules(['required', 'email', 'max:255']);

    expect($column->getRules())->toBe(['required', 'email', 'max:255']);
});

it('can set input mode', function () {
    $column = TextInputColumn::make('name')
        ->inputMode('decimal');

    expect($column->getInputMode())->toBe('decimal');
});

it('can set step for numeric inputs', function () {
    $column = TextInputColumn::make('price')
        ->numeric()
        ->step('0.01');

    expect($column->getStep())->toBe('0.01');
});

it('can set min value for numeric inputs', function () {
    $column = TextInputColumn::make('quantity')
        ->numeric()
        ->min('0');

    expect($column->getMin())->toBe('0');
});

it('can set max value for numeric inputs', function () {
    $column = TextInputColumn::make('quantity')
        ->numeric()
        ->max('1000');

    expect($column->getMax())->toBe('1000');
});

it('can be made sortable', function () {
    $column = TextInputColumn::make('name')
        ->sortable();

    expect($column->isSortable())->toBeTrue();
});

it('can set alignment', function () {
    $column = TextInputColumn::make('name')
        ->alignLeft();

    expect($column->getAlignment())->toBe('left');
});

it('can set tooltip', function () {
    $column = TextInputColumn::make('name')
        ->tooltip('Edit name');

    expect($column->getTooltip())->toBe('Edit name');
});

it('returns correct view name', function () {
    $column = TextInputColumn::make('name');

    expect($column->getView())->toBe('tables::columns.text-input');
});
