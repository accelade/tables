@props(['prefix' => 'a'])

@php
    use App\Models\User;
    use Accelade\Tables\Table;
    use Accelade\Tables\Columns\TextColumn;
    use Accelade\Tables\Columns\BadgeColumn;
    use Accelade\Tables\Columns\ImageColumn;
    use Accelade\Tables\Columns\BooleanColumn;
    use Accelade\Actions\ViewAction;
    use Accelade\Actions\EditAction;
    use Accelade\Actions\DeleteAction;
    use Accelade\Actions\CreateAction;
    use Accelade\Actions\DeleteBulkAction;
    use Accelade\Actions\ExportAction;
    use Accelade\Filters\Components\TextFilter;
    use Accelade\Filters\Components\SelectFilter;
    use Accelade\Filters\Components\BooleanFilter;
    use Accelade\Filters\Components\DateFilter;
    use Accelade\Filters\FilterPanel;
    use Accelade\Filters\Enums\FilterLayout;
    use Accelade\Filters\Enums\FilterWidth;

    // Build the table with User model
    $table = Table::make('users')
        ->query(User::query())
        ->heading('Users')
        ->description('Manage your team members and their account permissions.')
        ->searchable(['name', 'email'])
        ->columns([
            ImageColumn::make('avatar')
                ->label('')
                ->circular()
                ->size(40)
                ->defaultImageUrl('https://ui-avatars.com/api/?name=User&background=random'),

            TextColumn::make('name')
                ->label('Name')
                ->sortable()
                ->searchable(),

            TextColumn::make('email')
                ->label('Email')
                ->sortable()
                ->searchable(),

            BadgeColumn::make('role')
                ->label('Role')
                ->sortable()
                ->colors([
                    'admin' => 'primary',
                    'editor' => 'info',
                    'author' => 'warning',
                    'user' => 'gray',
                ]),

            BadgeColumn::make('status')
                ->label('Status')
                ->sortable()
                ->colors([
                    'active' => 'success',
                    'pending' => 'warning',
                    'inactive' => 'danger',
                ])
                ->icons([
                    'active' => 'heroicon-s-check-circle',
                    'pending' => 'heroicon-s-clock',
                    'inactive' => 'heroicon-s-x-circle',
                ]),

            BooleanColumn::make('email_verified_at')
                ->label('Verified')
                ->icons('heroicon-o-check-circle', 'heroicon-o-x-circle')
                ->colors('success', 'danger'),

            TextColumn::make('created_at')
                ->label('Joined')
                ->sortable()
                ->formatStateUsing(fn ($state) => $state?->diffForHumans()),
        ])
        ->filters([
            TextFilter::make('search')
                ->label('Search')
                ->placeholder('Search by name or email...'),

            SelectFilter::make('status')
                ->label('Status')
                ->placeholder('All statuses')
                ->options([
                    'active' => 'Active',
                    'pending' => 'Pending',
                    'inactive' => 'Inactive',
                ]),

            SelectFilter::make('role')
                ->label('Role')
                ->placeholder('All roles')
                ->options([
                    'admin' => 'Admin',
                    'editor' => 'Editor',
                    'author' => 'Author',
                    'user' => 'User',
                ]),

            BooleanFilter::make('email_verified_at')
                ->label('Email Verified')
                ->column('email_verified_at')
                ->trueLabel('Verified')
                ->falseLabel('Not verified')
                ->nullable(),
        ])
        ->actions([
            ViewAction::make('view')
                ->iconButton()
                ->tooltip('View details'),

            EditAction::make('edit')
                ->iconButton()
                ->tooltip('Edit user'),

            DeleteAction::make('delete')
                ->iconButton()
                ->tooltip('Delete user')
                ->requiresConfirmation(),
        ])
        ->bulkActions([
            DeleteBulkAction::make('bulk-delete')
                ->label('Delete Selected')
                ->color('danger')
                ->requiresConfirmation(),
        ])
        ->headerActions([
            ExportAction::make('export')
                ->label('Export')
                ->color('secondary')
                ->outlined(),

            CreateAction::make('create')
                ->label('New User')
                ->color('primary'),
        ])
        ->selectable()
        ->striped()
        ->hoverable()
        ->perPage(10)
        ->emptyStateHeading('No users found')
        ->emptyStateDescription('Try adjusting your search or filter to find what you\'re looking for.')
        ->emptyStateIcon('<svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" /></svg>')
        ->fromRequest();
@endphp

<div class="space-y-6">
    <div class="prose dark:prose-invert max-w-none">
        <p class="text-gray-600 dark:text-gray-400">
            A fully-featured data table with search, filters, sorting, pagination, row actions, and bulk actions.
            Styled to match Filament's beautiful design system. All interactions work without page reloads (SPA).
        </p>
    </div>

    {{-- Render the Table Component --}}
    <x-tables::table :table="$table" />

    {{-- Code Example --}}
    <x-accelade::code-block language="php" title="Usage Example">
use App\Models\User;
use Accelade\Tables\Table;
use Accelade\Tables\Columns\TextColumn;
use Accelade\Tables\Columns\BadgeColumn;
use Accelade\Tables\Columns\ImageColumn;
use Accelade\Tables\Columns\BooleanColumn;
use Accelade\Actions\ViewAction;
use Accelade\Actions\EditAction;
use Accelade\Actions\DeleteAction;
use Accelade\Actions\CreateAction;
use Accelade\Actions\DeleteBulkAction;
use Accelade\Actions\ExportAction;
use Accelade\Filters\Components\TextFilter;
use Accelade\Filters\Components\SelectFilter;
use Accelade\Filters\Components\BooleanFilter;

$table = Table::make('users')
    ->query(User::query())
    ->heading('Users')
    ->description('Manage your team members.')
    ->searchable(['name', 'email'])
    ->columns([
        ImageColumn::make('avatar')
            ->circular(),

        TextColumn::make('name')
            ->sortable()
            ->searchable(),

        TextColumn::make('email')
            ->sortable()
            ->searchable(),

        BadgeColumn::make('role')
            ->colors([
                'admin' => 'primary',
                'editor' => 'info',
                'author' => 'warning',
                'user' => 'gray',
            ]),

        BadgeColumn::make('status')
            ->colors([
                'active' => 'success',
                'pending' => 'warning',
                'inactive' => 'danger',
            ]),

        BooleanColumn::make('email_verified_at')
            ->label('Verified')
            ->icons('heroicon-o-check-circle', 'heroicon-o-x-circle'),
    ])
    ->filters([
        SelectFilter::make('status')
            ->options([
                'active' => 'Active',
                'pending' => 'Pending',
                'inactive' => 'Inactive',
            ]),

        SelectFilter::make('role')
            ->options([
                'admin' => 'Admin',
                'editor' => 'Editor',
                'user' => 'User',
            ]),

        BooleanFilter::make('email_verified_at')
            ->label('Email Verified'),
    ])
    ->actions([
        ViewAction::make()->iconButton(),
        EditAction::make()->iconButton(),
        DeleteAction::make()->iconButton(),
    ])
    ->bulkActions([
        DeleteBulkAction::make(),
        ExportAction::make(),
    ])
    ->headerActions([
        CreateAction::make()->label('New User'),
    ])
    ->selectable()
    ->striped()
    ->perPage(10)
    ->fromRequest();

// In your Blade template:
// &lt;x-tables::table :table="$table" /&gt;
    </x-accelade::code-block>
</div>
