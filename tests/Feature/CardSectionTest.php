<?php

declare(strict_types=1);

use Accelade\Grids\Cards\CardSection;

it('can be created with make', function () {
    $section = CardSection::make();

    expect($section)->toBeInstanceOf(CardSection::class);
});

it('can set label as string', function () {
    $section = CardSection::make()
        ->label('Price');

    expect($section->getLabel())->toBe('Price');
});

it('can set label as closure', function () {
    $section = CardSection::make()
        ->label(fn () => 'Dynamic Label');

    expect($section->getLabel())->toBe('Dynamic Label');
});

it('can set value as string', function () {
    $section = CardSection::make()
        ->value('$99.99');

    expect($section->getValue())->toBe('$99.99');
});

it('can set value as closure', function () {
    $section = CardSection::make()
        ->value(fn () => '$199.99');

    expect($section->getValue())->toBe('$199.99');
});

it('can set icon', function () {
    $section = CardSection::make()
        ->icon('💰');

    expect($section->getIcon())->toBe('💰');
});

it('can set icon to null', function () {
    $section = CardSection::make()
        ->icon('💰')
        ->icon(null);

    expect($section->getIcon())->toBeNull();
});

it('can set color', function () {
    $section = CardSection::make()
        ->color('green');

    expect($section->getColor())->toBe('green');
});

it('can set color to null', function () {
    $section = CardSection::make()
        ->color('green')
        ->color(null);

    expect($section->getColor())->toBeNull();
});

it('is not hidden by default', function () {
    $section = CardSection::make();

    expect($section->isHidden())->toBeFalse();
});

it('can be hidden', function () {
    $section = CardSection::make()
        ->hidden();

    expect($section->isHidden())->toBeTrue();
});

it('can be hidden conditionally', function () {
    $section = CardSection::make()
        ->hidden(false);

    expect($section->isHidden())->toBeFalse();

    $section->hidden(true);

    expect($section->isHidden())->toBeTrue();
});

it('returns null for label when not set', function () {
    $section = CardSection::make();

    expect($section->getLabel())->toBeNull();
});

it('returns null for value when not set', function () {
    $section = CardSection::make();

    expect($section->getValue())->toBeNull();
});

it('returns null for icon when not set', function () {
    $section = CardSection::make();

    expect($section->getIcon())->toBeNull();
});

it('returns null for color when not set', function () {
    $section = CardSection::make();

    expect($section->getColor())->toBeNull();
});

it('can be fully configured with fluent api', function () {
    $section = CardSection::make()
        ->label('Status')
        ->value('Active')
        ->icon('✓')
        ->color('success');

    expect($section->getLabel())->toBe('Status');
    expect($section->getValue())->toBe('Active');
    expect($section->getIcon())->toBe('✓');
    expect($section->getColor())->toBe('success');
    expect($section->isHidden())->toBeFalse();
});
