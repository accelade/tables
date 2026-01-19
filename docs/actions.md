# Actions

Add row actions and bulk actions to your tables for user interactions.

## Row Actions

```php
use Accelade\Tables\Table;
use Accelade\Actions\Action;

$table = Table::make('users')
    ->actions([
        Action::make('view')
            ->icon('eye')
            ->url(fn ($record) => route('users.show', $record)),
        Action::make('edit')
            ->icon('pencil')
            ->url(fn ($record) => route('users.edit', $record)),
        Action::make('delete')
            ->icon('trash')
            ->color('danger')
            ->requiresConfirmation(),
    ]);
```

## Bulk Actions

```php
use Accelade\Actions\BulkAction;

$table = Table::make('users')
    ->bulkActions([
        BulkAction::make('delete')
            ->label('Delete Selected')
            ->requiresConfirmation(),
        BulkAction::make('export')
            ->label('Export Selected'),
    ]);
```
