# Badge Column

The `BadgeColumn` displays values as styled badges, perfect for status indicators and categories.

## Basic Usage

```php
use Accelade\Tables\Columns\BadgeColumn;

BadgeColumn::make('status')
```

## Colors

Set badge colors based on state:

```php
BadgeColumn::make('status')
    ->colors([
        'gray' => 'draft',
        'yellow' => 'pending',
        'green' => 'published',
        'red' => 'rejected',
    ])
```

Using a closure for dynamic colors:

```php
BadgeColumn::make('status')
    ->color(fn (string $state): string => match ($state) {
        'draft' => 'gray',
        'pending' => 'yellow',
        'published' => 'green',
        'rejected' => 'red',
    })
```

## Icons

Add icons to badges:

```php
BadgeColumn::make('status')
    ->icons([
        'heroicon-o-pencil' => 'draft',
        'heroicon-o-clock' => 'pending',
        'heroicon-o-check-circle' => 'published',
    ])
```

Or set a single icon:

```php
BadgeColumn::make('priority')
    ->icon('heroicon-o-flag')
```

## Size

Control the badge size:

```php
BadgeColumn::make('status')
    ->size('lg') // sm, md, lg
```

## Available Colors

- `primary`
- `secondary`
- `success`
- `danger`
- `warning`
- `info`
- `gray`
