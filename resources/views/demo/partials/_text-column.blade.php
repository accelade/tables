@props(['prefix' => 'a'])

<div class="space-y-6">
    <div class="prose dark:prose-invert max-w-none">
        <p class="text-gray-600 dark:text-gray-400">
            TextColumn is the most commonly used column type, displaying text values with optional formatting,
            truncation, URL linking, copy functionality, and more.
        </p>
    </div>

    {{-- Demo Examples --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Text Column Examples</h4>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Feature</th>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Example</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                    <tr>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">Basic Text</td>
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100">John Doe</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">With Color</td>
                        <td class="px-4 py-3 text-blue-600 dark:text-blue-400">john.doe@example.com</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">Truncated (limit 20)</td>
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100">Lorem ipsum dolor s...</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">Monospace</td>
                        <td class="px-4 py-3 font-mono text-gray-900 dark:text-gray-100">SKU-12345-XYZ</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">With Prefix</td>
                        <td class="px-4 py-3 text-gray-900 dark:text-gray-100">$1,250.00</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">Bold Weight</td>
                        <td class="px-4 py-3 font-bold text-gray-900 dark:text-gray-100">Important Title</td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">Copyable</td>
                        <td class="px-4 py-3">
                            <span class="text-gray-900 dark:text-gray-100">Copy this text</span>
                            <button class="ml-2 text-gray-400 hover:text-gray-600">📋</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Code Example --}}
    <x-accelade::code-block language="php" title="TextColumn Usage">
use Accelade\Tables\Columns\TextColumn;

// Basic text column
TextColumn::make('name')
    ->label('Full Name')
    ->sortable()
    ->searchable();

// With character limit
TextColumn::make('description')
    ->limit(50)
    ->tooltip(fn ($record) => $record->description);

// With URL
TextColumn::make('email')
    ->url(fn ($record) => "mailto:{$record->email}")
    ->color('primary');

// Copyable
TextColumn::make('api_key')
    ->copyable()
    ->copyMessage('API Key copied!');

// Currency formatting
TextColumn::make('price')
    ->prefix('$')
    ->formatStateUsing(fn ($state) => number_format($state, 2));

// Monospace for codes
TextColumn::make('sku')
    ->mono()
    ->searchable();

// With weight
TextColumn::make('title')
    ->weight('bold')
    ->size('lg');

// Date formatting
TextColumn::make('created_at')
    ->formatStateUsing(fn ($state) => $state->format('M j, Y'));
    </x-accelade::code-block>
</div>
