<?php

declare(strict_types=1);

use Accelade\Tables\Columns\Column;

it('can be created with make', function () {
    $column = Column::make('name');

    expect($column)->toBeInstanceOf(Column::class);
    expect($column->getName())->toBe('name');
});

it('auto-generates label from snake_case name', function () {
    $column = Column::make('first_name');

    expect($column->getLabel())->toBe('First Name');
});

it('auto-generates label from camelCase name', function () {
    $column = Column::make('firstName');

    expect($column->getLabel())->toBe('First Name');
});

it('can set a custom label', function () {
    $column = Column::make('name')
        ->label('Custom Label');

    expect($column->getLabel())->toBe('Custom Label');
});

it('can set label with closure', function () {
    $column = Column::make('name')
        ->label(fn () => 'Dynamic Label');

    expect($column->getLabel())->toBe('Dynamic Label');
});

it('can be made sortable', function () {
    $column = Column::make('name')
        ->sortable();

    expect($column->isSortable())->toBeTrue();
});

it('is not sortable by default', function () {
    $column = Column::make('name');

    expect($column->isSortable())->toBeFalse();
});

it('can be made searchable', function () {
    $column = Column::make('name')
        ->searchable();

    expect($column->isSearchable())->toBeTrue();
});

it('is not searchable by default', function () {
    $column = Column::make('name');

    expect($column->isSearchable())->toBeFalse();
});

it('can be hidden', function () {
    $column = Column::make('name')
        ->hidden();

    expect($column->isHidden())->toBeTrue();
});

it('is not hidden by default', function () {
    $column = Column::make('name');

    expect($column->isHidden())->toBeFalse();
});

it('can be made toggleable', function () {
    $column = Column::make('name')
        ->toggleable();

    expect($column->isToggleable())->toBeTrue();
});

it('is toggleable by default', function () {
    $column = Column::make('name');

    expect($column->isToggleable())->toBeTrue();
});

it('can disable toggleable', function () {
    $column = Column::make('name')
        ->toggleable(false);

    expect($column->isToggleable())->toBeFalse();
});

it('can set width', function () {
    $column = Column::make('name')
        ->width('200px');

    expect($column->getWidth())->toBe('200px');
});

it('can set alignment', function () {
    $column = Column::make('name')
        ->alignment('center');

    expect($column->getAlignment())->toBe('center');
});

it('can align left', function () {
    $column = Column::make('name')
        ->alignLeft();

    expect($column->getAlignment())->toBe('left');
});

it('can align center', function () {
    $column = Column::make('name')
        ->alignCenter();

    expect($column->getAlignment())->toBe('center');
});

it('can align right', function () {
    $column = Column::make('name')
        ->alignRight();

    expect($column->getAlignment())->toBe('right');
});

it('has default alignment of left', function () {
    $column = Column::make('name');

    expect($column->getAlignment())->toBe('left');
});

it('can set tooltip', function () {
    $column = Column::make('name')
        ->tooltip('This is a tooltip');

    expect($column->getTooltip())->toBe('This is a tooltip');
});

it('can set extra attributes', function () {
    $column = Column::make('name')
        ->extraAttributes(['data-id' => '123', 'class' => 'custom-class']);

    expect($column->getExtraAttributes())->toBe(['data-id' => '123', 'class' => 'custom-class']);
});

it('can set extra header attributes', function () {
    $column = Column::make('name')
        ->extraHeaderAttributes(['data-sortable' => 'true']);

    expect($column->getExtraHeaderAttributes())->toBe(['data-sortable' => 'true']);
});

it('can set placeholder for null values', function () {
    $column = Column::make('name')
        ->placeholder('N/A');

    expect($column->getPlaceholder())->toBe('N/A');
});

it('can enable text wrapping', function () {
    $column = Column::make('description')
        ->wrap();

    expect($column->shouldWrap())->toBeTrue();
});

it('does not wrap by default', function () {
    $column = Column::make('description');

    expect($column->shouldWrap())->toBeFalse();
});

it('can set character limit', function () {
    $column = Column::make('description')
        ->limit(100);

    expect($column->getLimit())->toBe(100);
});

it('can set prefix', function () {
    $column = Column::make('price')
        ->prefix('$');

    expect($column->getPrefix())->toBe('$');
});

it('can set suffix', function () {
    $column = Column::make('price')
        ->suffix(' USD');

    expect($column->getSuffix())->toBe(' USD');
});

it('can set icon', function () {
    $column = Column::make('email')
        ->icon('heroicon-o-envelope');

    expect($column->getIcon())->toBe('heroicon-o-envelope');
});

it('can set icon position', function () {
    $column = Column::make('email')
        ->icon('heroicon-o-envelope', 'after');

    expect($column->getIcon())->toBe('heroicon-o-envelope');
    expect($column->getIconPosition())->toBe('after');
});

it('has default icon position of before', function () {
    $column = Column::make('email')
        ->icon('heroicon-o-envelope');

    expect($column->getIconPosition())->toBe('before');
});

it('can serialize to array', function () {
    $column = Column::make('name')
        ->label('Full Name')
        ->sortable()
        ->searchable()
        ->width('200px')
        ->alignCenter();

    $array = $column->toArray();

    expect($array['name'])->toBe('name');
    expect($array['label'])->toBe('Full Name');
    expect($array['sortable'])->toBeTrue();
    expect($array['searchable'])->toBeTrue();
    expect($array['width'])->toBe('200px');
    expect($array['alignment'])->toBe('center');
});

it('can set format callback', function () {
    $column = Column::make('price')
        ->formatStateUsing(fn ($state) => '$'.number_format($state, 2));

    expect($column)->toBeInstanceOf(Column::class);
});

it('can set format string', function () {
    $column = Column::make('price')
        ->formatStateUsing('$%s');

    expect($column)->toBeInstanceOf(Column::class);
});

it('can set get state callback', function () {
    $column = Column::make('full_name')
        ->getStateUsing(fn ($record) => $record->first_name.' '.$record->last_name);

    expect($column)->toBeInstanceOf(Column::class);
});

it('can set color', function () {
    $column = Column::make('status')
        ->color('primary');

    expect($column)->toBeInstanceOf(Column::class);
});

it('can set color with callback', function () {
    $column = Column::make('status')
        ->color(fn ($state) => $state === 'active' ? 'success' : 'danger');

    expect($column)->toBeInstanceOf(Column::class);
});

it('can set url', function () {
    $column = Column::make('name')
        ->url(fn ($record) => route('users.show', $record));

    expect($column)->toBeInstanceOf(Column::class);
    expect($column->shouldOpenUrlInNewTab())->toBeFalse();
});

it('can set url to open in new tab', function () {
    $column = Column::make('name')
        ->url(fn ($record) => route('users.show', $record), openInNewTab: true);

    expect($column->shouldOpenUrlInNewTab())->toBeTrue();
});

it('returns correct view name', function () {
    $column = Column::make('name');

    expect($column->getView())->toBe('accelade::columns.text');
});
