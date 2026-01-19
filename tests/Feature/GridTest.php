<?php

declare(strict_types=1);

use Accelade\Grids\Cards\Card;
use Accelade\Grids\Grid;

it('can be created with make', function () {
    $grid = Grid::make('products');

    expect($grid)->toBeInstanceOf(Grid::class);
    expect($grid->getName())->toBe('products');
});

it('can be created without name', function () {
    $grid = Grid::make();

    expect($grid)->toBeInstanceOf(Grid::class);
    expect($grid->getName())->toBeNull();
});

it('can set columns as integer', function () {
    $grid = Grid::make('products')
        ->columns(4);

    expect($grid->getColumns())->toBe(4);
});

it('can set columns as array for responsive breakpoints', function () {
    $grid = Grid::make('products')
        ->columns(['default' => 1, 'sm' => 2, 'md' => 3, 'lg' => 4]);

    expect($grid->getColumns())->toBe([
        'default' => 1,
        'sm' => 2,
        'md' => 3,
        'lg' => 4,
    ]);
});

it('can set gap', function () {
    $grid = Grid::make('products')
        ->gap('6');

    expect($grid->getGap())->toBe('6');
});

it('can enable masonry layout', function () {
    $grid = Grid::make('gallery')
        ->masonry();

    expect($grid->isMasonry())->toBeTrue();
});

it('is not masonry by default', function () {
    $grid = Grid::make('products');

    expect($grid->isMasonry())->toBeFalse();
});

it('can set heading as string', function () {
    $grid = Grid::make('products')
        ->heading('Product Gallery');

    expect($grid->getHeading())->toBe('Product Gallery');
});

it('can set heading as closure', function () {
    $grid = Grid::make('products')
        ->heading(fn () => 'Dynamic Heading');

    expect($grid->getHeading())->toBe('Dynamic Heading');
});

it('can set description as string', function () {
    $grid = Grid::make('products')
        ->description('Browse our products');

    expect($grid->getDescription())->toBe('Browse our products');
});

it('can set description as closure', function () {
    $grid = Grid::make('products')
        ->description(fn () => 'Dynamic description');

    expect($grid->getDescription())->toBe('Dynamic description');
});

it('can set header actions', function () {
    $actions = ['create', 'export'];

    $grid = Grid::make('products')
        ->headerActions($actions);

    expect($grid->getHeaderActions())->toBe($actions);
    expect($grid->hasHeaderActions())->toBeTrue();
});

it('has no header actions by default', function () {
    $grid = Grid::make('products');

    expect($grid->hasHeaderActions())->toBeFalse();
});

it('can set empty state heading', function () {
    $grid = Grid::make('products')
        ->emptyStateHeading('No products found');

    expect($grid->getEmptyStateHeading())->toBe('No products found');
});

it('can set empty state heading as closure', function () {
    $grid = Grid::make('products')
        ->emptyStateHeading(fn () => 'Dynamic empty heading');

    expect($grid->getEmptyStateHeading())->toBe('Dynamic empty heading');
});

it('has default empty state heading', function () {
    $grid = Grid::make('products');

    expect($grid->getEmptyStateHeading())->toBe('No items found');
});

it('can set empty state description', function () {
    $grid = Grid::make('products')
        ->emptyStateDescription('Try adjusting your search or filters');

    expect($grid->getEmptyStateDescription())->toBe('Try adjusting your search or filters');
});

it('can set empty state description as closure', function () {
    $grid = Grid::make('products')
        ->emptyStateDescription(fn () => 'Dynamic empty description');

    expect($grid->getEmptyStateDescription())->toBe('Dynamic empty description');
});

it('can set empty state icon', function () {
    $grid = Grid::make('products')
        ->emptyStateIcon('📦');

    expect($grid->getEmptyStateIcon())->toBe('📦');
});

it('can set empty state actions', function () {
    $actions = ['create'];

    $grid = Grid::make('products')
        ->emptyStateActions($actions);

    expect($grid->getEmptyStateActions())->toBe($actions);
    expect($grid->hasEmptyStateActions())->toBeTrue();
});

it('has no empty state actions by default', function () {
    $grid = Grid::make('products');

    expect($grid->hasEmptyStateActions())->toBeFalse();
});

it('can set extra attributes', function () {
    $grid = Grid::make('products')
        ->extraAttributes(['data-grid' => 'products', 'class' => 'custom-grid']);

    expect($grid->getExtraAttributes())->toBe([
        'data-grid' => 'products',
        'class' => 'custom-grid',
    ]);
});

it('can merge extra attributes', function () {
    $grid = Grid::make('products')
        ->extraAttributes(['data-grid' => 'products'])
        ->extraAttributes(['data-type' => 'gallery']);

    expect($grid->getExtraAttributes())->toBe([
        'data-grid' => 'products',
        'data-type' => 'gallery',
    ]);
});

it('can set card template', function () {
    $card = Card::make()->title('Test');

    $grid = Grid::make('products')
        ->card($card);

    expect($grid->getCard())->toBe($card);
});

it('returns correct view name', function () {
    $grid = Grid::make('products');

    expect($grid->getView())->toBe('accelade::grid');
});

it('can convert to array', function () {
    $grid = Grid::make('products')
        ->columns(3)
        ->gap('4');

    $array = $grid->toArray();

    expect($array)->toHaveKey('name');
    expect($array)->toHaveKey('columns');
    expect($array)->toHaveKey('gap');
    expect($array['name'])->toBe('products');
    expect($array['columns'])->toBe(3);
    expect($array['gap'])->toBe('4');
});

it('returns null for heading when not set', function () {
    $grid = Grid::make('products');

    expect($grid->getHeading())->toBeNull();
});

it('returns null for description when not set', function () {
    $grid = Grid::make('products');

    expect($grid->getDescription())->toBeNull();
});

it('returns null for empty state description when not set', function () {
    $grid = Grid::make('products');

    expect($grid->getEmptyStateDescription())->toBeNull();
});

it('returns null for empty state icon when not set', function () {
    $grid = Grid::make('products');

    expect($grid->getEmptyStateIcon())->toBeNull();
});

it('returns null for card when not set', function () {
    $grid = Grid::make('products');

    expect($grid->getCard())->toBeNull();
});

it('returns null for query when not set', function () {
    $grid = Grid::make('products');

    expect($grid->getQuery())->toBeNull();
});
