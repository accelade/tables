# Image Column

The `ImageColumn` displays images from URLs or storage paths.

## Basic Usage

```php
use Accelade\Tables\Columns\ImageColumn;

ImageColumn::make('avatar')
```

## Size

Set the image dimensions:

```php
ImageColumn::make('avatar')
    ->size(64) // Sets both width and height

ImageColumn::make('thumbnail')
    ->imageWidth(100)
    ->imageHeight(75)
```

## Shape

Display circular or square images:

```php
ImageColumn::make('avatar')
    ->circular()

ImageColumn::make('product_image')
    ->square()
```

## Default Image

Show a placeholder when no image exists:

```php
ImageColumn::make('avatar')
    ->defaultImageUrl('/images/default-avatar.png')
```

## Stacked Images

Display multiple images in a stacked layout:

```php
ImageColumn::make('team_members')
    ->stacked()
    ->stackLimit(3) // Show max 3 images
```

## Accessing Storage

For images stored in Laravel's filesystem:

```php
ImageColumn::make('photo')
    ->disk('public')
```

## Visibility

Control image visibility:

```php
ImageColumn::make('private_photo')
    ->visibility('private')
```
