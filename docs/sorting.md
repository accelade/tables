# Sorting

Enable sorting on columns to allow users to order data by clicking on column headers.

## Making Columns Sortable

```php
use Accelade\Tables\Columns\TextColumn;

TextColumn::make('name')
    ->sortable();

TextColumn::make('created_at')
    ->sortable();
```

## Default Sort

Set a default sort order for your table:

```php
$table = Table::make('users')
    ->defaultSort('created_at', 'desc')
    ->columns([
        TextColumn::make('name')->sortable(),
        TextColumn::make('created_at')->sortable(),
    ]);
```

## Custom Sort Logic

```php
TextColumn::make('full_name')
    ->sortable(function ($query, $direction) {
        return $query->orderBy('first_name', $direction)
            ->orderBy('last_name', $direction);
    });
```
