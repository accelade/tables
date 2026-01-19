# Filters

Tables integrate seamlessly with the Filters package to provide data filtering.

## Adding Filters

```php
use Accelade\Tables\Table;
use Accelade\Filters\Components\TextFilter;
use Accelade\Filters\Components\SelectFilter;

$table = Table::make('users')
    ->query(User::query())
    ->filters([
        TextFilter::make('search')
            ->label('Search')
            ->placeholder('Search users...'),
        SelectFilter::make('status')
            ->label('Status')
            ->options([
                'active' => 'Active',
                'inactive' => 'Inactive',
            ]),
    ])
    ->columns([...])
    ->fromRequest();
```

## Filter Types

- **TextFilter** - Text/search input
- **SelectFilter** - Dropdown select
- **BooleanFilter** - Yes/No toggle
- **DateFilter** - Single date picker
- **DateRangeFilter** - Date range (from/to)
- **NumberFilter** - Numeric input
