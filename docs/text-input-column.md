# Text Input Column

The `TextInputColumn` is an editable column that allows inline text editing.

## Basic Usage

```php
use Accelade\Tables\Columns\TextInputColumn;

TextInputColumn::make('name')
```

## Input Types

Set different input types:

```php
TextInputColumn::make('email')
    ->email()

TextInputColumn::make('quantity')
    ->numeric()

TextInputColumn::make('phone')
    ->tel()

TextInputColumn::make('website')
    ->urlType()
```

## Placeholder

Set placeholder text:

```php
TextInputColumn::make('nickname')
    ->inputPlaceholder('Enter nickname')
```

## Validation

### Length Constraints

```php
TextInputColumn::make('username')
    ->minLength(3)
    ->maxLength(20)
```

### Validation Rules

```php
TextInputColumn::make('email')
    ->rules(['required', 'email'])
```

## Numeric Options

For numeric inputs:

```php
TextInputColumn::make('price')
    ->numeric()
    ->step(0.01)
    ->min(0)
    ->max(10000)
```

## Input Mode

Set the virtual keyboard type on mobile:

```php
TextInputColumn::make('amount')
    ->inputMode('decimal')
```

Available modes: `text`, `decimal`, `numeric`, `tel`, `search`, `email`, `url`

## Read Only

Make the input read-only:

```php
TextInputColumn::make('id')
    ->readonly()
```

## Disabled

Disable the input:

```php
TextInputColumn::make('locked_field')
    ->disabled()
```

## Custom Update Logic

Customize how the value is saved:

```php
TextInputColumn::make('slug')
    ->updateStateUsing(function ($record, $state) {
        $record->update([
            'slug' => Str::slug($state),
        ]);
    })
```
