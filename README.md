# Accelade Grids

<p align="center">
<strong>Card-based Grid Layouts for Laravel. Zero Complexity.</strong>
</p>

<p align="center">
<a href="https://github.com/accelade/grids/actions/workflows/tests.yml"><img src="https://github.com/accelade/grids/actions/workflows/tests.yml/badge.svg" alt="Tests"></a>
<a href="https://packagist.org/packages/accelade/grids"><img src="https://img.shields.io/packagist/v/accelade/grids" alt="Latest Version"></a>
<a href="https://packagist.org/packages/accelade/grids"><img src="https://img.shields.io/packagist/dt/accelade/grids" alt="Total Downloads"></a>
<a href="LICENSE"><img src="https://img.shields.io/badge/license-MIT-blue.svg" alt="License"></a>
</p>

---

Build beautiful, responsive card grids with minimal code. Accelade Grids provides powerful components for displaying data in cards, masonry layouts, and responsive grids.

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

**That's it.** Render with `<x-grids::grid :grid="$grid" />`.

---

## Why Accelade Grids?

- **Filament-Compatible API** - Familiar syntax if you use Filament
- **Responsive Layouts** - Automatic column adjustments for different screen sizes
- **Masonry Support** - Pinterest-style staggered layouts
- **Cards** - Flexible card templates with images, titles, descriptions, badges
- **Card Sections** - Display key-value pairs within cards
- **Actions** - Support for row actions on each card
- **Pagination** - Built-in pagination support
- **Filters** - Apply filters to narrow results (via Query Builder)
- **Search** - Full-text search support
- **Sorting** - Sortable columns
- **Dark Mode** - Built-in dark mode support

---

## Quick Start

```bash
composer require accelade/grids
```

The service provider will be automatically registered.

### Publish Configuration

```bash
php artisan vendor:publish --tag=grids-config
```

---

## Features at a Glance

### Basic Grid

```php
use Accelade\Grids\Grid;
use Accelade\Grids\Cards\Card;
use App\Models\Product;

$grid = Grid::make('products')
    ->query(Product::query())
    ->columns(4)
    ->gap('6')
    ->card(
        Card::make()
            ->title(fn ($record) => $record->name)
            ->description(fn ($record) => Str::limit($record->description, 100))
            ->image(fn ($record) => $record->image_url)
            ->url(fn ($record) => route('products.show', $record))
    );
```

### Card with Sections

```php
use Accelade\Grids\Cards\Card;
use Accelade\Grids\Cards\CardSection;

Card::make()
    ->title(fn ($record) => $record->name)
    ->description(fn ($record) => $record->excerpt)
    ->sections([
        CardSection::make()
            ->label('Price')
            ->value(fn ($record) => '$' . number_format($record->price, 2))
            ->icon('heroicon-o-currency-dollar')
            ->color('success'),

        CardSection::make()
            ->label('Stock')
            ->value(fn ($record) => $record->stock . ' available')
            ->icon('heroicon-o-cube'),
    ]);
```

### Card with Badge and Actions

```php
use Accelade\Grids\Cards\Card;
use Accelade\Actions\ViewAction;
use Accelade\Actions\EditAction;
use Accelade\Actions\DeleteAction;

Card::make()
    ->title(fn ($record) => $record->name)
    ->badge(fn ($record) => $record->is_featured ? 'Featured' : null, 'primary')
    ->actions([
        ViewAction::make(),
        EditAction::make(),
        DeleteAction::make(),
    ], position: 'footer');
```

### Responsive Columns

```php
// Fixed columns
$grid->columns(4);

// Responsive columns
$grid->columns([
    'default' => 1,
    'sm' => 2,
    'md' => 3,
    'lg' => 4,
    'xl' => 5,
]);
```

### Masonry Layout

```php
$grid = Grid::make('gallery')
    ->query(Photo::query())
    ->masonry()
    ->columns(4);
```

### List Layout

```php
$grid = Grid::make('articles')
    ->query(Article::query())
    ->list(); // Single column list
```

### With Header

```php
$grid = Grid::make('products')
    ->heading('Product Gallery')
    ->description('Browse our collection')
    ->headerActions([
        CreateAction::make(),
        ExportAction::make(),
    ]);
```

### Empty State

```php
$grid = Grid::make('products')
    ->emptyStateHeading('No products found')
    ->emptyStateDescription('Try adjusting your search or filters')
    ->emptyStateIcon('heroicon-o-cube')
    ->emptyStateActions([
        CreateAction::make()->label('Create Product'),
    ]);
```

### Blade Component

```blade
<x-grids::grid :grid="$grid" />
```

---

## Requirements

- PHP 8.2+
- Laravel 11.x or 12.x
- accelade/accelade ^1.0
- accelade/query-builder ^1.0
- accelade/filters ^1.0
- accelade/actions ^1.0

---

## Documentation

| Guide | Description |
|-------|-------------|
| [Overview](docs/overview.md) | Introduction and basic concepts |
| [Cards](docs/cards.md) | Card component configuration |
| [Layouts](docs/layouts.md) | Grid layout options |
| [Filters](docs/filters.md) | Filtering and search |

---

## Accelade Ecosystem

Accelade Grids is part of the Accelade ecosystem:

| Package | Description |
|---------|-------------|
| **[accelade/accelade](https://github.com/accelade/accelade)** | Core reactive Blade components |
| **[accelade/schemas](https://github.com/accelade/schemas)** | Schema-based layouts |
| **[accelade/forms](https://github.com/accelade/forms)** | Form builder with validation |
| **[accelade/infolists](https://github.com/accelade/infolists)** | Display read-only data |
| **[accelade/tables](https://github.com/accelade/tables)** | Data tables with filtering |
| **[accelade/actions](https://github.com/accelade/actions)** | Action buttons with modals |
| **[accelade/widgets](https://github.com/accelade/widgets)** | Dashboard widgets |
| **[accelade/grids](https://github.com/accelade/grids)** | Card-based grids (this package) |
| **[accelade/query-builder](https://github.com/accelade/query-builder)** | Query builder utilities |
| **[accelade/filters](https://github.com/accelade/filters)** | Filter components |

---

## License

MIT License. See [LICENSE](LICENSE) for details.
