# Boolean Column

The `BooleanColumn` displays boolean values as icons, perfect for yes/no, active/inactive states.

## Basic Usage

```php
use Accelade\Tables\Columns\BooleanColumn;

BooleanColumn::make('is_active')
```

## Custom Icons

Customize the icons for true and false states:

```php
BooleanColumn::make('is_featured')
    ->trueIcon('heroicon-o-star')
    ->falseIcon('heroicon-o-x-mark')
```

## Custom Colors

Set colors for each state:

```php
BooleanColumn::make('is_verified')
    ->trueColor('success')
    ->falseColor('danger')
```

## Default Colors

By default:
- True state: `success` (green)
- False state: `danger` (red)

You can customize the default colors used when no explicit color is set:

```php
BooleanColumn::make('is_active')
    ->defaultTrueColor('primary')
    ->defaultFalseColor('gray')
```

## Alignment

Center-align the boolean icon:

```php
BooleanColumn::make('is_active')
    ->alignCenter()
```

## Available Colors

- `primary`
- `secondary`
- `success`
- `danger`
- `warning`
- `info`
- `gray`
