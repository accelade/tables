# Grids

The Grids package provides card-based grid layouts for displaying data in flexible, responsive layouts.

## Installation

```bash
composer require accelade/grids
```

## Basic Usage

```php
use Accelade\Grids\Grid;
use Accelade\Grids\Cards\Card;
use App\Models\Product;

$grid = Grid::make('products')
    ->query(Product::query())
    ->columns(3)
    ->card(
        Card::make()
            ->title(fn ($record) => $record->name)
            ->description(fn ($record) => $record->description)
            ->image(fn ($record) => $record->image_url)
            ->url(fn ($record) => route('products.show', $record))
    )
    ->fromRequest()
    ->paginate();
```

## Blade Component Usage

```blade
<x-accelade::grid :grid="$grid" />
```

## Card Configuration

### Basic Card

```php
Card::make()
    ->title('Product Name')
    ->description('A great product')
    ->image('/images/product.jpg')
    ->url('/products/1');
```

### Card with Sections

```php
Card::make()
    ->title(fn ($record) => $record->name)
    ->description(fn ($record) => $record->excerpt)
    ->sections([
        CardSection::make()
            ->label('Price')
            ->value(fn ($record) => '$' . number_format($record->price, 2)),
        CardSection::make()
            ->label('Stock')
            ->value(fn ($record) => $record->stock . ' available'),
    ]);
```

### Card with Actions

```php
Card::make()
    ->title(fn ($record) => $record->name)
    ->actions([
        ViewAction::make(),
        EditAction::make(),
        DeleteAction::make(),
    ], position: 'footer');
```

## Layout Options

### Columns

```php
// Fixed columns
$grid->columns(4);

// Responsive columns
$grid->columns([
    'default' => 1,
    'sm' => 2,
    'lg' => 3,
    'xl' => 4,
]);
```

### Gap

```php
$grid->gap('6'); // Uses Tailwind spacing scale
```

### Masonry

```php
$grid->masonry();
```

### List Layout

```php
$grid->list(); // Single column list
```

## Features

- **Responsive Layouts**: Automatic column adjustments for different screen sizes
- **Masonry Support**: Pinterest-style staggered layouts
- **Cards**: Flexible card templates with images, titles, descriptions
- **Actions**: Support for row actions on each card
- **Pagination**: Built-in pagination support
- **Filters**: Apply filters to narrow results
