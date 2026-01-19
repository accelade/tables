# Pagination

Tables support pagination with configurable items per page.

## Basic Pagination

```php
use Accelade\Tables\Table;

$table = Table::make('users')
    ->query(User::query())
    ->columns([...])
    ->paginate();
```

## Configuration

```php
$table = Table::make('users')
    ->perPage(15)
    ->perPageOptions([10, 15, 25, 50, 100]);
```

## In Blade

```blade
<x-accelade::table :table="$table" />
```

The pagination links will automatically be rendered at the bottom of the table.
