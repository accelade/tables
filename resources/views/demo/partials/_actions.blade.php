@props(['prefix' => 'a'])

<div class="space-y-6">
    <div class="prose dark:prose-invert max-w-none">
        <p class="text-gray-600 dark:text-gray-400">
            Add row actions and bulk actions to your tables for user interactions.
        </p>
    </div>

    {{-- Actions Demo --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
        {{-- Bulk Actions --}}
        <div class="px-6 py-3 bg-gray-50 dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700">
            <div class="flex items-center gap-4">
                <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                <span class="text-sm text-gray-600 dark:text-gray-400">3 selected</span>
                <button class="text-sm text-red-600 hover:text-red-800 dark:text-red-400">Delete Selected</button>
                <button class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400">Export Selected</button>
            </div>
        </div>
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-6 py-3 w-12"><input type="checkbox" class="rounded border-gray-300 text-blue-600"></th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Name</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 dark:text-gray-400 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                <tr>
                    <td class="px-6 py-4"><input type="checkbox" class="rounded border-gray-300 text-blue-600" checked></td>
                    <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">John Doe</td>
                    <td class="px-6 py-4 text-right">
                        <button class="text-blue-600 hover:text-blue-800 dark:text-blue-400">View</button>
                        <button class="ml-2 text-gray-600 hover:text-gray-800 dark:text-gray-400">Edit</button>
                        <button class="ml-2 text-red-600 hover:text-red-800 dark:text-red-400">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- Code Example --}}
    <x-accelade::code-block language="php" title="Row and Bulk Actions">
use Accelade\Tables\Table;
use Accelade\Actions\Action;
use Accelade\Actions\BulkAction;

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
    ])
    ->bulkActions([
        BulkAction::make('delete')
            ->label('Delete Selected')
            ->requiresConfirmation(),
        BulkAction::make('export')
            ->label('Export Selected'),
    ]);
    </x-accelade::code-block>
</div>
