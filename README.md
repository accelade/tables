# Accelade Tables

Table components for Laravel with sorting, filtering, and pagination. Part of the Accelade ecosystem.

## Installation

```bash
composer require accelade/tables
```

## Documentation

- [Overview](docs/overview.md) - Introduction and basic usage
- [Text Column](docs/text-column.md) - Display text data
- [Badge Column](docs/badge-column.md) - Display badges with colors
- [Boolean Column](docs/boolean-column.md) - Display boolean values
- [Image Column](docs/image-column.md) - Display images
- [Icon Column](docs/icon-column.md) - Display icons
- [Color Column](docs/color-column.md) - Display colors
- [Select Column](docs/select-column.md) - Editable select inputs
- [Toggle Column](docs/toggle-column.md) - Toggle switches
- [Text Input Column](docs/text-input-column.md) - Editable text inputs
- [Checkbox Column](docs/checkbox-column.md) - Checkbox selections
- [Filters](docs/filters.md) - Filtering data
- [Sorting](docs/sorting.md) - Sorting columns
- [Actions](docs/actions.md) - Row and bulk actions
- [Pagination](docs/pagination.md) - Paginating results

## Basic Usage

```php
use Accelade\Tables\Table;
use Accelade\Tables\Columns\TextColumn;
use Accelade\Tables\Columns\BadgeColumn;
use Accelade\Tables\Columns\BooleanColumn;

$table = Table::make('users')
    ->query(User::class)
    ->columns([
        TextColumn::make('name')
            ->sortable()
            ->searchable(),
        TextColumn::make('email')
            ->sortable(),
        BadgeColumn::make('role')
            ->colors([
                'admin' => 'danger',
                'editor' => 'warning',
                'user' => 'success',
            ]),
        BooleanColumn::make('active')
            ->sortable(),
    ])
    ->striped()
    ->hoverable();
```

## Building Assets

The package includes TypeScript source files that need to be compiled:

```bash
cd packages/tables
npm install
npm run build
```

## Testing

```bash
composer test
```

## License

MIT License. See [LICENSE](LICENSE) for details.
