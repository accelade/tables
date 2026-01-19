# Tables Package

This package provides data table components for displaying sortable, filterable, and paginated data.

## Package Overview

- **Namespace**: `Accelade\Tables`
- **Service Provider**: `TablesServiceProvider`
- **Facade**: `Table`
- **View Namespace**: `tables::` and `accelade::`

## Key Components

### Table Class
Main class for building tables.

```php
use Accelade\Tables\Table;
use Accelade\Tables\Columns\TextColumn;
use Accelade\Tables\Columns\BadgeColumn;

$table = Table::make('users')
    ->query(User::query())
    ->columns([
        TextColumn::make('name')
            ->sortable()
            ->searchable(),
        BadgeColumn::make('status')
            ->colors(['active' => 'success', 'inactive' => 'danger']),
    ])
    ->fromRequest();
```

### Column Types
- `Column` - Base column
- `TextColumn` - Text display with copy, limit, etc.
- `BadgeColumn` - Colored badges
- `BooleanColumn` - True/false with icons
- `ImageColumn` - Image thumbnails

### Concerns (Traits)
- `HasActions` - Row actions
- `HasBulkActions` - Bulk selection/actions
- `HasHeader` - Table header with search
- `HasEmptyState` - Empty state display

### Blade Component
```blade
<x-accelade::table :table="$table" />
```

## Testing
```bash
cd packages/tables
composer test
```

## Dependencies
- `accelade/accelade`
- `accelade/query-builder`
- `accelade/filters`
- `accelade/actions`
