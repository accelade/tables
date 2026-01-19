# Toggle Column

The `ToggleColumn` is an editable column that displays a toggle switch for boolean values.

## Basic Usage

```php
use Accelade\Tables\Columns\ToggleColumn;

ToggleColumn::make('is_active')
```

## Colors

Customize the toggle colors:

```php
ToggleColumn::make('is_featured')
    ->onColor('success')
    ->offColor('danger')
```

## Icons

Add icons inside the toggle:

```php
ToggleColumn::make('is_visible')
    ->onIcon('heroicon-o-eye')
    ->offIcon('heroicon-o-eye-slash')
```

## Disabled

Disable the toggle:

```php
ToggleColumn::make('is_admin')
    ->disabled()
```

Or conditionally:

```php
ToggleColumn::make('is_active')
    ->disabled(fn ($record) => $record->is_locked)
```

## Custom Update Logic

Customize how the value is saved:

```php
ToggleColumn::make('is_published')
    ->updateStateUsing(function ($record, $state) {
        $record->update(['is_published' => $state]);

        if ($state) {
            $record->update(['published_at' => now()]);
        }
    })
```

## Available Colors

- `primary`
- `secondary`
- `success`
- `danger`
- `warning`
- `info`
- `gray`
