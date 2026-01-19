# Layouts

Grid layouts control how cards are arranged and displayed.

## Available Layouts

### Grid Layout (Default)

```php
use Accelade\Grids\Grid;

Grid::make()
    ->columns(3)
    ->gap(4);
```

### Responsive Columns

```php
Grid::make()
    ->columns([
        'default' => 1,
        'sm' => 2,
        'md' => 3,
        'lg' => 4,
    ]);
```

### Masonry Layout

```php
Grid::make()
    ->masonry()
    ->columns(3);
```

## Blade Component

```blade
<x-accelade::grids.grid
    :columns="3"
    :gap="4"
>
    @foreach($items as $item)
        <x-accelade::grids.card :record="$item" />
    @endforeach
</x-accelade::grids.grid>
```
