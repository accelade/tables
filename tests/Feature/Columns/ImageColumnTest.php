<?php

declare(strict_types=1);

use Accelade\Tables\Columns\ImageColumn;
use Tests\TestCase;

uses(TestCase::class);

it('can be created with make', function () {
    $column = ImageColumn::make('avatar');

    expect($column)->toBeInstanceOf(ImageColumn::class);
    expect($column->getName())->toBe('avatar');
});

it('can set size', function () {
    $column = ImageColumn::make('avatar')
        ->size(60);

    expect($column->getImageWidth())->toBe(60);
    expect($column->getImageHeight())->toBe(60);
});

it('can set width and height separately', function () {
    $column = ImageColumn::make('avatar')
        ->imageWidth(80)
        ->imageHeight(60);

    expect($column->getImageWidth())->toBe(80);
    expect($column->getImageHeight())->toBe(60);
});

it('has default dimensions', function () {
    $column = ImageColumn::make('avatar');

    expect($column->getImageWidth())->toBe(40);
    expect($column->getImageHeight())->toBe(40);
});

it('can be made circular', function () {
    $column = ImageColumn::make('avatar')
        ->circular();

    expect($column->isCircular())->toBeTrue();
    expect($column->isSquare())->toBeFalse();
});

it('can be made square', function () {
    $column = ImageColumn::make('avatar')
        ->square();

    expect($column->isSquare())->toBeTrue();
    expect($column->isCircular())->toBeFalse();
});

it('is square by default', function () {
    $column = ImageColumn::make('avatar');

    expect($column->isSquare())->toBeTrue();
});

it('can set default image URL', function () {
    $column = ImageColumn::make('avatar')
        ->defaultImageUrl('/images/default-avatar.png');

    expect($column->getDefaultImageUrl())->toBe('/images/default-avatar.png');
});

it('can enable stacked images', function () {
    $column = ImageColumn::make('avatars')
        ->stacked();

    expect($column->isStacked())->toBeTrue();
});

it('can set stack limit', function () {
    $column = ImageColumn::make('avatars')
        ->stacked()
        ->stackLimit(5);

    expect($column->getStackLimit())->toBe(5);
});

it('has default stack limit of 3', function () {
    $column = ImageColumn::make('avatars');

    expect($column->getStackLimit())->toBe(3);
});

it('can set alignment', function () {
    $column = ImageColumn::make('avatar')
        ->alignCenter();

    expect($column->getAlignment())->toBe('center');
});

it('can set tooltip', function () {
    $column = ImageColumn::make('avatar')
        ->tooltip('User avatar');

    expect($column->getTooltip())->toBe('User avatar');
});

it('returns correct view name', function () {
    $column = ImageColumn::make('avatar');

    expect($column->getView())->toBe('accelade::columns.image');
});
