<?php

declare(strict_types=1);

use Accelade\Grids\Cards\Card;
use Accelade\Grids\Cards\CardSection;

it('can be created with make', function () {
    $card = Card::make();

    expect($card)->toBeInstanceOf(Card::class);
});

it('can set title as string', function () {
    $card = Card::make()
        ->title('Product Name');

    expect($card->getTitle())->toBe('Product Name');
});

it('can set title as closure', function () {
    $card = Card::make()
        ->title(fn () => 'Dynamic Title');

    expect($card->getTitle())->toBe('Dynamic Title');
});

it('can set description as string', function () {
    $card = Card::make()
        ->description('Product description text');

    expect($card->getDescription())->toBe('Product description text');
});

it('can set description as closure', function () {
    $card = Card::make()
        ->description(fn () => 'Dynamic description');

    expect($card->getDescription())->toBe('Dynamic description');
});

it('can set image with default position', function () {
    $card = Card::make()
        ->image('/images/product.jpg');

    expect($card->getImage())->toBe('/images/product.jpg');
    expect($card->getImagePosition())->toBe('top');
});

it('can set image with custom position', function () {
    $card = Card::make()
        ->image('/images/product.jpg', 'left');

    expect($card->getImage())->toBe('/images/product.jpg');
    expect($card->getImagePosition())->toBe('left');
});

it('can set image as closure', function () {
    $card = Card::make()
        ->image(fn () => '/dynamic/image.jpg');

    expect($card->getImage())->toBe('/dynamic/image.jpg');
});

it('can set url', function () {
    $card = Card::make()
        ->url('/products/123');

    expect($card->getUrl())->toBe('/products/123');
    expect($card->shouldOpenInNewTab())->toBeFalse();
});

it('can set url to open in new tab', function () {
    $card = Card::make()
        ->url('/products/123', true);

    expect($card->getUrl())->toBe('/products/123');
    expect($card->shouldOpenInNewTab())->toBeTrue();
});

it('can set url as closure', function () {
    $card = Card::make()
        ->url(fn () => '/dynamic/url');

    expect($card->getUrl())->toBe('/dynamic/url');
});

it('can set sections', function () {
    $sections = [
        CardSection::make()->label('Price')->value('$99.99'),
        CardSection::make()->label('Stock')->value('In Stock'),
    ];

    $card = Card::make()
        ->sections($sections);

    expect($card->getSections())->toBe($sections);
    expect($card->getSections())->toHaveCount(2);
});

it('can set actions', function () {
    $actions = ['edit', 'delete'];

    $card = Card::make()
        ->actions($actions);

    expect($card->getActions())->toBe($actions);
    expect($card->hasActions())->toBeTrue();
    expect($card->getActionsPosition())->toBe('footer');
});

it('can set actions with custom position', function () {
    $card = Card::make()
        ->actions(['edit'], 'header');

    expect($card->getActionsPosition())->toBe('header');
});

it('has no actions by default', function () {
    $card = Card::make();

    expect($card->hasActions())->toBeFalse();
});

it('can set badge', function () {
    $card = Card::make()
        ->badge('New');

    expect($card->getBadge())->toBe('New');
    expect($card->getBadgeColor())->toBe('gray');
});

it('can set badge with color', function () {
    $card = Card::make()
        ->badge('Sale', 'red');

    expect($card->getBadge())->toBe('Sale');
    expect($card->getBadgeColor())->toBe('red');
});

it('is hoverable by default', function () {
    $card = Card::make();

    expect($card->isHoverable())->toBeTrue();
});

it('can disable hoverable', function () {
    $card = Card::make()
        ->hoverable(false);

    expect($card->isHoverable())->toBeFalse();
});

it('is bordered by default', function () {
    $card = Card::make();

    expect($card->isBordered())->toBeTrue();
});

it('can disable bordered', function () {
    $card = Card::make()
        ->bordered(false);

    expect($card->isBordered())->toBeFalse();
});

it('has shadow by default', function () {
    $card = Card::make();

    expect($card->hasShadow())->toBeTrue();
});

it('can disable shadow', function () {
    $card = Card::make()
        ->shadow(false);

    expect($card->hasShadow())->toBeFalse();
});

it('can set extra attributes', function () {
    $card = Card::make()
        ->extraAttributes(['data-id' => '123', 'class' => 'custom-card']);

    expect($card->getExtraAttributes())->toBe([
        'data-id' => '123',
        'class' => 'custom-card',
    ]);
});

it('can merge extra attributes', function () {
    $card = Card::make()
        ->extraAttributes(['data-id' => '123'])
        ->extraAttributes(['data-type' => 'product']);

    expect($card->getExtraAttributes())->toBe([
        'data-id' => '123',
        'data-type' => 'product',
    ]);
});

it('returns correct view name', function () {
    $card = Card::make();

    expect($card->getView())->toBe('accelade::card');
});

it('returns null for title when not set', function () {
    $card = Card::make();

    expect($card->getTitle())->toBeNull();
});

it('returns null for description when not set', function () {
    $card = Card::make();

    expect($card->getDescription())->toBeNull();
});

it('returns null for image when not set', function () {
    $card = Card::make();

    expect($card->getImage())->toBeNull();
});

it('returns null for url when not set', function () {
    $card = Card::make();

    expect($card->getUrl())->toBeNull();
});

it('returns null for record when not set', function () {
    $card = Card::make();

    expect($card->getRecord())->toBeNull();
});
