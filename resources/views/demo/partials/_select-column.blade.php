@props(['prefix' => 'a'])

<div class="space-y-6">
    <div class="prose dark:prose-invert max-w-none">
        <p class="text-gray-600 dark:text-gray-400">
            SelectColumn allows inline editing with a dropdown select, enabling users to update
            records directly in the table without opening a modal or navigating to another page.
        </p>
    </div>

    {{-- Demo Examples --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Select Column Examples</h4>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Name</th>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Status</th>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Role</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                    <tr>
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100">John Doe</td>
                        <td class="px-4 py-3">
                            <select class="block w-full px-2 py-1 text-sm rounded border border-gray-300 bg-white text-gray-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                                <option value="active" selected>Active</option>
                                <option value="pending">Pending</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </td>
                        <td class="px-4 py-3">
                            <select class="block w-full px-2 py-1 text-sm rounded border border-gray-300 bg-white text-gray-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                                <option value="admin">Admin</option>
                                <option value="editor" selected>Editor</option>
                                <option value="viewer">Viewer</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100">Jane Smith</td>
                        <td class="px-4 py-3">
                            <select class="block w-full px-2 py-1 text-sm rounded border border-gray-300 bg-white text-gray-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                                <option value="active">Active</option>
                                <option value="pending" selected>Pending</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </td>
                        <td class="px-4 py-3">
                            <select class="block w-full px-2 py-1 text-sm rounded border border-gray-300 bg-white text-gray-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                                <option value="admin" selected>Admin</option>
                                <option value="editor">Editor</option>
                                <option value="viewer">Viewer</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100">Bob Wilson</td>
                        <td class="px-4 py-3">
                            <select disabled class="block w-full px-2 py-1 text-sm rounded border border-gray-300 bg-gray-100 text-gray-500 cursor-not-allowed dark:border-gray-600 dark:bg-gray-800 dark:text-gray-500">
                                <option value="inactive" selected>Inactive</option>
                            </select>
                        </td>
                        <td class="px-4 py-3">
                            <select class="block w-full px-2 py-1 text-sm rounded border border-gray-300 bg-white text-gray-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                                <option value="admin">Admin</option>
                                <option value="editor">Editor</option>
                                <option value="viewer" selected>Viewer</option>
                            </select>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
            Changes are saved automatically when selecting a new value.
        </p>
    </div>

    {{-- Code Example --}}
    <x-accelade::code-block language="php" title="SelectColumn Usage">
use Accelade\Tables\Columns\SelectColumn;

// Basic select column
SelectColumn::make('status')
    ->options([
        'active' => 'Active',
        'pending' => 'Pending',
        'inactive' => 'Inactive',
    ]);

// With placeholder
SelectColumn::make('category_id')
    ->options(Category::pluck('name', 'id'))
    ->placeholder('Select category...');

// Conditionally disabled
SelectColumn::make('role')
    ->options([
        'admin' => 'Admin',
        'editor' => 'Editor',
        'viewer' => 'Viewer',
    ])
    ->disabled(fn ($record) => $record->is_locked);

// With custom update logic
SelectColumn::make('priority')
    ->options([
        'low' => 'Low',
        'medium' => 'Medium',
        'high' => 'High',
    ])
    ->updateStateUsing(function ($record, $state) {
        $record->update(['priority' => $state]);
        // Optionally send notification
    });

// Searchable (for many options)
SelectColumn::make('country_id')
    ->options(Country::pluck('name', 'id'))
    ->searchable();
    </x-accelade::code-block>
</div>
