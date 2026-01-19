# Icon Column

The `IconColumn` displays icons based on record values, useful for visual status indicators.

## Basic Usage

```php
use Accelade\Tables\Columns\IconColumn;

IconColumn::make('status')
    ->displayIcon('heroicon-o-check-circle')
```

## Dynamic Icons

Map different values to different icons:

```php
IconColumn::make('status')
    ->icons([
        'heroicon-o-pencil' => 'draft',
        'heroicon-o-clock' => 'pending',
        'heroicon-o-check-circle' => 'published',
        'heroicon-o-x-circle' => 'rejected',
    ])
```

## Colors

Set icon colors based on state:

```php
IconColumn::make('status')
    ->colors([
        'gray' => 'draft',
        'warning' => 'pending',
        'success' => 'published',
        'danger' => 'rejected',
    ])
```

Or set a single color:

```php
IconColumn::make('type')
    ->iconColor('primary')
```

## Size

Control the icon size:

```php
IconColumn::make('status')
    ->size('lg') // sm, md, lg, xl
```

## Boolean Mode

Use the column as a boolean indicator:

```php
IconColumn::make('is_active')
    ->boolean()
    ->trueIcon('heroicon-o-check-circle')
    ->falseIcon('heroicon-o-x-circle')
    ->trueColor('success')
    ->falseColor('danger')
```

## Available Colors

- `primary`
- `secondary`
- `success`
- `danger`
- `warning`
- `info`
- `gray`
