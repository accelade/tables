# Text Column

The `TextColumn` is the most common column type for displaying text content from your database records.

## Basic Usage

```php
use Accelade\Tables\Columns\TextColumn;

TextColumn::make('name')
```

## Customizing Content

### Limiting Text

You can limit the number of characters displayed:

```php
TextColumn::make('description')
    ->limit(50)
```

Or limit by number of words:

```php
TextColumn::make('description')
    ->words(10)
```

### Text Formatting

Apply various text formatting options:

```php
TextColumn::make('name')
    ->size('lg')      // sm, md, lg, xl
    ->weight('bold')  // normal, medium, semibold, bold
    ->mono()          // Monospace font
```

### HTML & Markdown

Render HTML or Markdown content:

```php
TextColumn::make('content')
    ->html()

TextColumn::make('content')
    ->markdown()
```

## Copyable

Make the column content copyable to clipboard:

```php
TextColumn::make('api_key')
    ->copyable()
    ->copyMessage('API key copied!')
```

## Prefix & Suffix

Add prefix or suffix text:

```php
TextColumn::make('price')
    ->prefix('$')
    ->suffix(' USD')
```

## Placeholder

Show placeholder text when the value is empty:

```php
TextColumn::make('nickname')
    ->placeholder('No nickname set')
```

## Wrapping

Control text wrapping behavior:

```php
TextColumn::make('description')
    ->wrap()
```
