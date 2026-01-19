# Color Column

The `ColorColumn` displays color values as visual swatches.

## Basic Usage

```php
use Accelade\Tables\Columns\ColorColumn;

ColorColumn::make('brand_color')
```

## Size

Set the swatch size in pixels:

```php
ColorColumn::make('color')
    ->size(32) // Default is 24
```

## Shape

Display rounded or square swatches:

```php
ColorColumn::make('color')
    ->rounded() // Default - circular/rounded

ColorColumn::make('color')
    ->square() // Square shape
```

## Copyable

Allow users to copy the color value:

```php
ColorColumn::make('hex_color')
    ->copyable()
    ->copyMessage('Color copied!')
```

The default copy message is "Color copied!".

## Tooltip

Show the color value on hover:

```php
ColorColumn::make('color')
    ->tooltip(fn ($record) => $record->color)
```

## Supported Formats

The column supports various color formats:
- Hex: `#FF5733`
- RGB: `rgb(255, 87, 51)`
- RGBA: `rgba(255, 87, 51, 0.5)`
- HSL: `hsl(11, 100%, 60%)`
- Named colors: `red`, `blue`, `green`
