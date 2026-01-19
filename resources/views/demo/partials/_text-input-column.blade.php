@props(['prefix' => 'a'])

<div class="space-y-6">
    <div class="prose dark:prose-invert max-w-none">
        <p class="text-gray-600 dark:text-gray-400">
            TextInputColumn allows inline text editing directly in the table, supporting
            various input types like text, email, number, and tel.
        </p>
    </div>

    {{-- Demo Examples --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Text Input Column Examples</h4>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Name</th>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Email</th>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Quantity</th>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Price</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                    <tr>
                        <td class="px-4 py-3">
                            <input type="text" value="John Doe" class="block w-full px-2 py-1 text-sm rounded border border-gray-300 bg-white text-gray-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                        </td>
                        <td class="px-4 py-3">
                            <input type="email" value="john@example.com" class="block w-full px-2 py-1 text-sm rounded border border-gray-300 bg-white text-gray-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" value="10" min="0" step="1" class="block w-24 px-2 py-1 text-sm rounded border border-gray-300 bg-white text-gray-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" value="29.99" min="0" step="0.01" class="block w-24 px-2 py-1 text-sm rounded border border-gray-300 bg-white text-gray-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3">
                            <input type="text" value="Jane Smith" class="block w-full px-2 py-1 text-sm rounded border border-gray-300 bg-white text-gray-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                        </td>
                        <td class="px-4 py-3">
                            <input type="email" value="jane@example.com" class="block w-full px-2 py-1 text-sm rounded border border-gray-300 bg-white text-gray-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" value="5" min="0" step="1" class="block w-24 px-2 py-1 text-sm rounded border border-gray-300 bg-white text-gray-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" value="49.99" min="0" step="0.01" class="block w-24 px-2 py-1 text-sm rounded border border-gray-300 bg-white text-gray-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3">
                            <input type="text" value="Bob Wilson" readonly class="block w-full px-2 py-1 text-sm rounded border border-gray-300 bg-gray-100 text-gray-600 dark:border-gray-600 dark:bg-gray-800 dark:text-gray-400">
                        </td>
                        <td class="px-4 py-3">
                            <input type="email" value="bob@example.com" disabled class="block w-full px-2 py-1 text-sm rounded border border-gray-300 bg-gray-100 text-gray-500 cursor-not-allowed dark:border-gray-600 dark:bg-gray-800 dark:text-gray-500">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" value="0" min="0" step="1" class="block w-24 px-2 py-1 text-sm rounded border border-gray-300 bg-white text-gray-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                        </td>
                        <td class="px-4 py-3">
                            <input type="number" value="19.99" min="0" step="0.01" class="block w-24 px-2 py-1 text-sm rounded border border-gray-300 bg-white text-gray-900 focus:border-blue-500 focus:ring-1 focus:ring-blue-500/20 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-100">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="mt-3 text-xs text-gray-500 dark:text-gray-400">
            Changes are saved on blur or when pressing Enter.
        </p>
    </div>

    {{-- Code Example --}}
    <x-accelade::code-block language="php" title="TextInputColumn Usage">
use Accelade\Tables\Columns\TextInputColumn;

// Basic text input
TextInputColumn::make('name');

// Email input
TextInputColumn::make('email')
    ->email();

// Numeric input
TextInputColumn::make('quantity')
    ->numeric()
    ->min('0')
    ->step('1');

// Price with decimal
TextInputColumn::make('price')
    ->numeric()
    ->min('0')
    ->step('0.01');

// With placeholder
TextInputColumn::make('notes')
    ->inputPlaceholder('Enter notes...');

// With validation
TextInputColumn::make('sku')
    ->rules(['required', 'unique:products,sku'])
    ->maxLength(20);

// Conditionally disabled
TextInputColumn::make('email')
    ->disabled(fn ($record) => $record->is_verified);

// Read-only
TextInputColumn::make('created_by')
    ->readonly();

// With custom update logic
TextInputColumn::make('title')
    ->updateStateUsing(function ($record, $state) {
        $record->update([
            'title' => $state,
            'slug' => Str::slug($state),
        ]);
    });
    </x-accelade::code-block>
</div>
