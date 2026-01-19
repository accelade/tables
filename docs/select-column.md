# Select Column

The `SelectColumn` is an editable column that allows users to change values using a dropdown select.

## Basic Usage

```php
use Accelade\Tables\Columns\SelectColumn;

SelectColumn::make('status')
    ->options([
        'draft' => 'Draft',
        'pending' => 'Pending',
        'published' => 'Published',
    ])
```

## Dynamic Options

Use a closure to generate options dynamically:

```php
SelectColumn::make('category_id')
    ->options(fn () => Category::pluck('name', 'id')->toArray())
```

## Placeholder

Set a placeholder for the empty state:

```php
SelectColumn::make('status')
    ->options([...])
    ->placeholder('Select a status')
```

## Searchable

Enable searching within options:

```php
SelectColumn::make('user_id')
    ->options(User::pluck('name', 'id')->toArray())
    ->searchable()
```

## Native Select

Use the browser's native select element:

```php
SelectColumn::make('priority')
    ->options([...])
    ->native() // Default is native
```

## Disabled

Disable the select:

```php
SelectColumn::make('status')
    ->options([...])
    ->disabled()
```

Or conditionally:

```php
SelectColumn::make('status')
    ->options([...])
    ->disabled(fn ($record) => $record->is_locked)
```

## Custom Update Logic

Customize how the value is saved:

```php
SelectColumn::make('status')
    ->options([...])
    ->updateStateUsing(function ($record, $state) {
        $record->update(['status' => $state]);

        // Additional logic
        if ($state === 'published') {
            $record->notify(new PublishedNotification());
        }
    })
```
