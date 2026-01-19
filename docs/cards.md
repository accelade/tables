# Cards

Cards are the primary display component for grid items.

## Basic Usage

```php
use Accelade\Grids\Components\Card;

Card::make()
    ->title(fn ($record) => $record->name)
    ->description(fn ($record) => $record->description)
    ->image(fn ($record) => $record->image_url);
```

## Card Structure

Cards support the following sections:
- Header (image, badges)
- Body (title, description, content)
- Footer (actions, metadata)

## Custom Content

```php
Card::make()
    ->content(fn ($record) => view('cards.custom', ['record' => $record]));
```

## Blade Component

```blade
<x-accelade::grids.card
    :title="$item->name"
    :description="$item->description"
    :image="$item->image_url"
/>
```
