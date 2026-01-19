# Grids Package

This package provides card-based grid layouts for displaying data.

## Package Overview

- **Namespace**: `Accelade\Grids`
- **Service Provider**: `GridsServiceProvider`
- **Facade**: `Grid`
- **View Namespace**: `grids::` and `accelade::`

## Key Components

### Grid Class
Main class for building grids.

```php
use Accelade\Grids\Grid;
use Accelade\Grids\Cards\Card;

$grid = Grid::make('products')
    ->query(Product::query())
    ->columns(3)
    ->card(
        Card::make()
            ->title(fn ($r) => $r->name)
            ->description(fn ($r) => $r->description)
            ->image(fn ($r) => $r->image_url)
    )
    ->fromRequest();
```

### Card Class
Template for grid items.

```php
Card::make()
    ->title('Title')
    ->description('Description')
    ->image('/image.jpg')
    ->url('/view')
    ->badge('New', 'success')
    ->sections([...])
    ->actions([...]);
```

### CardSection
Additional content sections in cards.

```php
CardSection::make()
    ->label('Price')
    ->value(fn ($r) => '$' . $r->price)
    ->icon('💰');
```

### Layout Options
- Grid columns (responsive)
- Gap spacing
- Masonry layout
- List layout

### Blade Component
```blade
<x-accelade::grid :grid="$grid" />
```

## Testing
```bash
cd packages/grids
composer test
```

## Dependencies
- `accelade/accelade`
- `accelade/query-builder`
- `accelade/filters`
- `accelade/actions`
