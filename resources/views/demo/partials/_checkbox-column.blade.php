@props(['prefix' => 'a'])

<div class="space-y-6">
    <div class="prose dark:prose-invert max-w-none">
        <p class="text-gray-600 dark:text-gray-400">
            CheckboxColumn displays a checkbox for inline boolean editing, useful for quick
            toggling of boolean states with a familiar checkbox interface.
        </p>
    </div>

    {{-- Demo Examples --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Checkbox Column Examples</h4>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Task</th>
                        <th class="px-4 py-2 text-center text-gray-700 dark:text-gray-200">Completed</th>
                        <th class="px-4 py-2 text-center text-gray-700 dark:text-gray-200">Urgent</th>
                        <th class="px-4 py-2 text-center text-gray-700 dark:text-gray-200">Archived</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                    <tr>
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100">Review pull request</td>
                        <td class="px-4 py-3 text-center">
                            <input type="checkbox" checked class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700">
                        </td>
                        <td class="px-4 py-3 text-center">
                            <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700">
                        </td>
                        <td class="px-4 py-3 text-center">
                            <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700">
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100">Update documentation</td>
                        <td class="px-4 py-3 text-center">
                            <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700">
                        </td>
                        <td class="px-4 py-3 text-center">
                            <input type="checkbox" checked class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700">
                        </td>
                        <td class="px-4 py-3 text-center">
                            <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700">
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100">Deploy to production</td>
                        <td class="px-4 py-3 text-center">
                            <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700">
                        </td>
                        <td class="px-4 py-3 text-center">
                            <input type="checkbox" checked class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700">
                        </td>
                        <td class="px-4 py-3 text-center">
                            <input type="checkbox" disabled class="h-4 w-4 rounded border-gray-300 text-blue-600 opacity-50 cursor-not-allowed dark:border-gray-600 dark:bg-gray-700">
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100">Old migration task</td>
                        <td class="px-4 py-3 text-center">
                            <input type="checkbox" checked class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700">
                        </td>
                        <td class="px-4 py-3 text-center">
                            <input type="checkbox" class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700">
                        </td>
                        <td class="px-4 py-3 text-center">
                            <input type="checkbox" checked class="h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500 dark:border-gray-600 dark:bg-gray-700">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
            Click checkboxes to toggle state. Changes are saved automatically.
        </p>
    </div>

    {{-- Code Example --}}
    <x-accelade::code-block language="php" title="CheckboxColumn Usage">
use Accelade\Tables\Columns\CheckboxColumn;

// Basic checkbox
CheckboxColumn::make('is_completed');

// With label
CheckboxColumn::make('is_urgent')
    ->label('Urgent');

// Conditionally disabled
CheckboxColumn::make('is_archived')
    ->disabled(fn ($record) => !$record->is_completed);

// With custom update logic
CheckboxColumn::make('is_approved')
    ->updateStateUsing(function ($record, $state) {
        $record->update(['is_approved' => $state]);

        if ($state) {
            $record->approved_at = now();
            $record->approved_by = auth()->id();
            $record->save();
        }
    });

// Aligned center
CheckboxColumn::make('email_verified')
    ->alignCenter();
    </x-accelade::code-block>
</div>
