@props(['prefix' => 'a'])

<div class="space-y-6">
    <div class="prose dark:prose-invert max-w-none">
        <p class="text-gray-600 dark:text-gray-400">
            ToggleColumn provides a switch/toggle for inline boolean editing, perfect for
            enabling/disabling features, publish states, and other on/off settings.
        </p>
    </div>

    {{-- Demo Examples --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Toggle Column Examples</h4>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Name</th>
                        <th class="px-4 py-2 text-center text-gray-700 dark:text-gray-200">Active</th>
                        <th class="px-4 py-2 text-center text-gray-700 dark:text-gray-200">Published</th>
                        <th class="px-4 py-2 text-center text-gray-700 dark:text-gray-200">Featured</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                    <tr>
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100">Product A</td>
                        <td class="px-4 py-3 text-center">
                            <button type="button" class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-blue-600 transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                <span class="translate-x-5 inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                            </button>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <button type="button" class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-green-600 transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                <span class="translate-x-5 inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                            </button>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <button type="button" class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-gray-200 dark:bg-gray-700 transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                <span class="translate-x-0 inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100">Product B</td>
                        <td class="px-4 py-3 text-center">
                            <button type="button" class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-gray-200 dark:bg-gray-700 transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                <span class="translate-x-0 inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                            </button>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <button type="button" class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-green-600 transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                <span class="translate-x-5 inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                            </button>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <button type="button" class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-yellow-500 transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                <span class="translate-x-5 inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100">Product C</td>
                        <td class="px-4 py-3 text-center">
                            <button type="button" disabled class="relative inline-flex h-6 w-11 shrink-0 cursor-not-allowed rounded-full border-2 border-transparent bg-gray-200 dark:bg-gray-700 opacity-50 transition-colors duration-200 ease-in-out">
                                <span class="translate-x-0 inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                            </button>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <button type="button" class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-gray-200 dark:bg-gray-700 transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                <span class="translate-x-0 inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                            </button>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <button type="button" class="relative inline-flex h-6 w-11 shrink-0 cursor-pointer rounded-full border-2 border-transparent bg-gray-200 dark:bg-gray-700 transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">
                                <span class="translate-x-0 inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"></span>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
            Click toggles to change state. Changes are saved automatically.
        </p>
    </div>

    {{-- Code Example --}}
    <x-accelade::code-block language="php" title="ToggleColumn Usage">
use Accelade\Tables\Columns\ToggleColumn;

// Basic toggle
ToggleColumn::make('is_active');

// Custom on/off colors
ToggleColumn::make('is_published')
    ->onColor('success')
    ->offColor('gray');

// Conditionally disabled
ToggleColumn::make('is_featured')
    ->disabled(fn ($record) => !$record->is_published);

// With custom update logic
ToggleColumn::make('notifications_enabled')
    ->updateStateUsing(function ($record, $state) {
        $record->update(['notifications_enabled' => $state]);

        if ($state) {
            // Subscribe to notifications
        } else {
            // Unsubscribe from notifications
        }
    });

// Featured with custom color
ToggleColumn::make('is_featured')
    ->onColor('warning')
    ->offColor('gray')
    ->label('Featured');
    </x-accelade::code-block>
</div>
