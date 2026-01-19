# Filtering Grids

Grids support filtering to help users find specific items.

## Adding Filters

```php
use Accelade\Grids\Grid;
use Accelade\Grids\Filters\SelectFilter;
use Accelade\Grids\Filters\TextFilter;

Grid::make()
    ->filters([
        TextFilter::make('search')
            ->placeholder('Search items...'),
        SelectFilter::make('category')
            ->options(Category::pluck('name', 'id')),
    ]);
```

## Filter Position

```php
Grid::make()
    ->filtersPosition('top') // 'top', 'sidebar'
    ->filters([...]);
```

## Blade Component

```blade
<x-accelade::grids.grid :filters="$filters">
    @foreach($items as $item)
        <x-accelade::grids.card :record="$item" />
    @endforeach
</x-accelade::grids.grid>
```
