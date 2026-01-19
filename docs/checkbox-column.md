# Checkbox Column

The `CheckboxColumn` is an editable column that displays a checkbox for boolean values.

## Basic Usage

```php
use Accelade\Tables\Columns\CheckboxColumn;

CheckboxColumn::make('is_completed')
```

## Label

Add a label next to the checkbox:

```php
CheckboxColumn::make('terms_accepted')
    ->label('Accepted')
```

## Disabled

Disable the checkbox:

```php
CheckboxColumn::make('is_admin')
    ->disabled()
```

Or conditionally:

```php
CheckboxColumn::make('is_verified')
    ->disabled(fn ($record) => ! $record->can_be_modified)
```

## Custom Update Logic

Customize how the value is saved:

```php
CheckboxColumn::make('is_complete')
    ->updateStateUsing(function ($record, $state) {
        $record->update(['is_complete' => $state]);

        if ($state) {
            $record->update(['completed_at' => now()]);
        }
    })
```

## Alignment

Center-align the checkbox:

```php
CheckboxColumn::make('is_selected')
    ->alignCenter()
```

## Tooltip

Add a tooltip:

```php
CheckboxColumn::make('is_active')
    ->tooltip('Toggle active status')
```

## Sortable

Make the column sortable:

```php
CheckboxColumn::make('is_featured')
    ->sortable()
```
