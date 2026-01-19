@extends('accelade::components.layouts.demo')

@section('title', 'Tables Demo')

@section('content')
<div class="space-y-8">
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Tables Demo</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">
            A fully-featured data table with search, filters, sorting, pagination, row actions, and bulk actions.
            Using real User data from the database.
        </p>
    </div>

    {{-- Live Table Component --}}
    <x-tables::table :table="$table" />

    {{-- Code Example --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Usage Example</h2>
        <x-accelade::code-block language="php" title="Controller">
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
use Accelade\Filters\Components\DateRangeFilter;

$table = Table::make('users')
    ->query(User::query())
    ->heading('Users')
    ->description('Manage your team members.')
    ->searchInHeader()
    ->filtersInHeader()
    ->columns([
        ImageColumn::make('avatar')
            ->circular()
            ->size(40),

        TextColumn::make('name')
            ->sortable()
            ->searchable(),

        TextColumn::make('email')
            ->sortable()
            ->searchable()
            ->copyable(),

        BadgeColumn::make('role')
            ->sortable()
            ->colors([
                'admin' => 'primary',
                'editor' => 'info',
                'author' => 'warning',
                'user' => 'gray',
            ]),

        BadgeColumn::make('status')
            ->sortable()
            ->colors([
                'active' => 'success',
                'pending' => 'warning',
                'inactive' => 'danger',
            ]),

        BooleanColumn::make('email_verified_at')
            ->label('Verified')
            ->trueColor('success')
            ->falseColor('danger'),

        TextColumn::make('created_at')
            ->sortable()
            ->formatStateUsing(fn ($state) => $state?->diffForHumans()),
    ])
    ->filters([
        SelectFilter::make('role')
            ->options([
                'admin' => 'Admin',
                'editor' => 'Editor',
                'author' => 'Author',
                'user' => 'User',
            ]),

        SelectFilter::make('status')
            ->options([
                'active' => 'Active',
                'pending' => 'Pending',
                'inactive' => 'Inactive',
            ]),

        BooleanFilter::make('email_verified')
            ->column('email_verified_at'),

        DateRangeFilter::make('created_at')
            ->label('Created Date'),
    ])
    ->actions([
        ViewAction::make()->iconButton(),
        EditAction::make()->iconButton(),
        DeleteAction::make()->iconButton()->requiresConfirmation(),
    ])
    ->bulkActions([
        DeleteBulkAction::make()->deselectRecordsAfterCompletion(),
        ExportAction::make()->formats(['csv', 'xlsx', 'pdf']),
    ])
    ->headerActions([
        CreateAction::make()->label('New User'),
    ])
    ->selectable()
    ->striped()
    ->hoverable()
    ->defaultSort('created_at', 'desc')
    ->perPage(15)
    ->fromRequest();

return view('users.index', ['table' => $table]);
        </x-accelade::code-block>

        <x-accelade::code-block language="blade" title="Blade Template" class="mt-4">
{{-- In your Blade view --}}
&lt;x-tables::table :table="$table" /&gt;
        </x-accelade::code-block>
    </div>
</div>
@endsection
