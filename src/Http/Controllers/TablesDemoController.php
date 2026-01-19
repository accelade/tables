<?php

declare(strict_types=1);

namespace Accelade\Tables\Http\Controllers;

use Accelade\Actions\CreateAction;
use Accelade\Actions\DeleteAction;
use Accelade\Actions\DeleteBulkAction;
use Accelade\Actions\EditAction;
use Accelade\Actions\ExportAction;
use Accelade\Actions\ViewAction;
use Accelade\Filters\Components\BooleanFilter;
use Accelade\Filters\Components\DateRangeFilter;
use Accelade\Filters\Components\SelectFilter;
use Accelade\Filters\Components\TextFilter;
use Accelade\Tables\Columns\BadgeColumn;
use Accelade\Tables\Columns\BooleanColumn;
use Accelade\Tables\Columns\ImageColumn;
use Accelade\Tables\Columns\TextColumn;
use Accelade\Tables\Table;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class TablesDemoController extends Controller
{
    public function index(Request $request)
    {
        $table = $this->buildTable();

        return view('tables::demo.index', [
            'table' => $table,
        ]);
    }

    public function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'role' => 'required|in:admin,editor,author,user',
            'status' => 'required|in:active,pending,inactive',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'role' => $validated['role'],
            'status' => $validated['status'],
            'password' => bcrypt('password'),
            'avatar' => 'https://ui-avatars.com/api/?name='.urlencode($validated['name']).'&background=random',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'User created successfully',
            'user' => $user,
        ]);
    }

    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'role' => 'required|in:admin,editor,author,user',
            'status' => 'required|in:active,pending,inactive',
        ]);

        $user->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'User updated successfully',
            'user' => $user,
        ]);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User deleted successfully',
        ]);
    }

    public function bulkDelete(Request $request)
    {
        $validated = $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:users,id',
        ]);

        User::whereIn('id', $validated['ids'])->delete();

        return response()->json([
            'success' => true,
            'message' => count($validated['ids']).' users deleted successfully',
        ]);
    }

    public function export(Request $request)
    {
        $format = $request->input('format', 'csv');
        $ids = $request->input('ids', []);

        $query = User::query();

        if (! empty($ids)) {
            $query->whereIn('id', $ids);
        }

        $users = $query->get(['id', 'name', 'email', 'role', 'status', 'created_at']);

        if ($format === 'json') {
            return response()->json($users);
        }

        $filename = 'users_export_'.now()->format('Y-m-d_His').'.'.$format;

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"',
        ];

        $callback = function () use ($users) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Name', 'Email', 'Role', 'Status', 'Created At']);

            foreach ($users as $user) {
                fputcsv($handle, [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->role,
                    $user->status,
                    $user->created_at->format('Y-m-d H:i:s'),
                ]);
            }

            fclose($handle);
        };

        return response()->stream($callback, 200, $headers);
    }

    protected function buildTable(): Table
    {
        return Table::make('users')
            ->query(User::query())
            ->heading('Users')
            ->description('Manage your team members and their account permissions.')
            ->searchInHeader()
            ->filtersInHeader()
            ->columns([
                ImageColumn::make('avatar')
                    ->label('')
                    ->circular()
                    ->size(40)
                    ->defaultImageUrl('https://ui-avatars.com/api/?name=User&background=random'),

                TextColumn::make('name')
                    ->sortable()
                    ->searchable()
                    ->label('Name'),

                TextColumn::make('email')
                    ->sortable()
                    ->searchable()
                    ->copyable()
                    ->label('Email'),

                BadgeColumn::make('role')
                    ->sortable()
                    ->label('Role')
                    ->colors([
                        'admin' => 'primary',
                        'editor' => 'info',
                        'author' => 'warning',
                        'user' => 'gray',
                    ]),

                BadgeColumn::make('status')
                    ->sortable()
                    ->label('Status')
                    ->colors([
                        'active' => 'success',
                        'pending' => 'warning',
                        'inactive' => 'danger',
                    ]),

                BooleanColumn::make('email_verified_at')
                    ->label('Verified')
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-x-circle')
                    ->trueColor('success')
                    ->falseColor('danger'),

                TextColumn::make('created_at')
                    ->sortable()
                    ->label('Created')
                    ->formatStateUsing(fn ($state) => $state?->diffForHumans()),
            ])
            ->filters([
                TextFilter::make('search')
                    ->label('Search')
                    ->placeholder('Search by name or email...')
                    ->column('name'),

                SelectFilter::make('role')
                    ->label('Role')
                    ->options([
                        'admin' => 'Admin',
                        'editor' => 'Editor',
                        'author' => 'Author',
                        'user' => 'User',
                    ])
                    ->placeholder('All Roles'),

                SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Active',
                        'pending' => 'Pending',
                        'inactive' => 'Inactive',
                    ])
                    ->placeholder('All Statuses'),

                BooleanFilter::make('email_verified')
                    ->label('Email Verified')
                    ->column('email_verified_at')
                    ->trueLabel('Verified')
                    ->falseLabel('Not Verified'),

                DateRangeFilter::make('created_at')
                    ->label('Created Date'),
            ])
            ->actions([
                ViewAction::make()
                    ->iconButton()
                    ->modalHeading(fn ($record) => 'View '.$record->name)
                    ->modalDescription(fn ($record) => $record->email),

                EditAction::make()
                    ->iconButton()
                    ->modalHeading(fn ($record) => 'Edit '.$record->name)
                    ->successNotificationTitle('User updated successfully'),

                DeleteAction::make()
                    ->iconButton()
                    ->requiresConfirmation()
                    ->modalHeading('Delete User')
                    ->modalDescription('Are you sure you want to delete this user? This action cannot be undone.')
                    ->successNotificationTitle('User deleted successfully'),
            ])
            ->bulkActions([
                DeleteBulkAction::make()
                    ->label('Delete Selected')
                    ->requiresConfirmation()
                    ->modalHeading('Delete Selected Users')
                    ->modalDescription('Are you sure you want to delete the selected users? This action cannot be undone.')
                    ->deselectRecordsAfterCompletion(),

                ExportAction::make()
                    ->label('Export Selected')
                    ->formats(['csv', 'xlsx', 'pdf']),
            ])
            ->headerActions([
                CreateAction::make()
                    ->label('New User')
                    ->modalHeading('Create New User')
                    ->successNotificationTitle('User created successfully'),
            ])
            ->selectable()
            ->striped()
            ->hoverable()
            ->defaultSort('created_at', 'desc')
            ->perPage(15)
            ->fromRequest();
    }
}
