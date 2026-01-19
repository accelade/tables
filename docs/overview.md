# Tables

The Tables package provides powerful data table components with sorting, filtering, pagination, and actions.

## Installation

```bash
composer require accelade/tables
```

## Basic Usage

```php
use Accelade\Tables\Table;
use Accelade\Tables\Columns\TextColumn;
use Accelade\Tables\Columns\BadgeColumn;
use App\Models\User;

$table = Table::make('users')
    ->query(User::query())
    ->columns([
        TextColumn::make('name')
            ->sortable()
            ->searchable(),
        TextColumn::make('email')
            ->copyable(),
        BadgeColumn::make('status')
            ->colors([
                'active' => 'success',
                'inactive' => 'danger',
            ]),
    ])
    ->fromRequest()
    ->paginate();
```

## Blade Component Usage

```blade
<x-accelade::table :table="$table" />
```

## Column Types

### TextColumn
Display text values with optional formatting.

```php
TextColumn::make('name')
    ->label('Full Name')
    ->sortable()
    ->searchable()
    ->copyable()
    ->limit(50)
    ->url(fn ($record) => route('users.show', $record));
```

### BadgeColumn
Display values as colored badges.

```php
BadgeColumn::make('status')
    ->colors([
        'active' => 'success',
        'pending' => 'warning',
        'inactive' => 'danger',
    ]);
```

### BooleanColumn
Display true/false values with icons.

```php
BooleanColumn::make('is_active')
    ->trueIcon('✓')
    ->falseIcon('✗')
    ->colors('success', 'danger');
```

### ImageColumn
Display images with various styles.

```php
ImageColumn::make('avatar')
    ->circular()
    ->size(40)
    ->defaultImageUrl('/default-avatar.png');
```

## Features

- **Sorting**: Click column headers to sort
- **Search**: Global search across columns
- **Filters**: Apply filters to narrow results
- **Pagination**: Built-in pagination support
- **Actions**: Row actions and bulk actions
- **Selection**: Checkbox selection for bulk operations
