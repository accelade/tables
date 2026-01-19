<?php

declare(strict_types=1);

use Accelade\Grids\Cards\Card;
use Accelade\Grids\Cards\CardSection;
use Accelade\Grids\Grid;
use Illuminate\Support\Facades\View;

it('registers the config', function () {
    expect(config('grids.enabled'))->toBeTrue();
    expect(config('grids.default_columns'))->toBe(3);
});

it('can create a grid instance', function () {
    $grid = Grid::make('products');

    expect($grid)->toBeInstanceOf(Grid::class);
    expect($grid->getName())->toBe('products');
});

it('can configure grid columns', function () {
    $grid = Grid::make('products')
        ->columns(4)
        ->gap('4');

    expect($grid->getColumns())->toBe(4);
    expect($grid->getGap())->toBe('4');
});

it('can create a card instance', function () {
    $card = Card::make()
        ->title('Product Name')
        ->description('Product description')
        ->image('/image.jpg');

    expect($card->getTitle())->toBe('Product Name');
    expect($card->getDescription())->toBe('Product description');
    expect($card->getImage())->toBe('/image.jpg');
});

it('can create card sections', function () {
    $section = CardSection::make()
        ->label('Price')
        ->value('$99.99')
        ->icon('💰');

    expect($section->getLabel())->toBe('Price');
    expect($section->getValue())->toBe('$99.99');
    expect($section->getIcon())->toBe('💰');
});

it('can configure grid layout', function () {
    $grid = Grid::make('gallery')
        ->columns(['default' => 1, 'sm' => 2, 'lg' => 3])
        ->masonry();

    expect($grid->getColumns())->toBe(['default' => 1, 'sm' => 2, 'lg' => 3]);
    expect($grid->isMasonry())->toBeTrue();
});

it('loads grid views', function () {
    expect(View::exists('grids::grid'))->toBeTrue();
    expect(View::exists('grids::card'))->toBeTrue();
});
