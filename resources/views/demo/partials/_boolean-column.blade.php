@props(['prefix' => 'a'])

<div class="space-y-6">
    <div class="prose dark:prose-invert max-w-none">
        <p class="text-gray-600 dark:text-gray-400">
            BooleanColumn displays true/false values with customizable icons and colors,
            perfect for status flags, enabled states, and binary options.
        </p>
    </div>

    {{-- Demo Examples --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Boolean Column Examples</h4>

        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left text-gray-700 dark:text-gray-200">Feature</th>
                        <th class="px-4 py-2 text-center text-gray-700 dark:text-gray-200">True</th>
                        <th class="px-4 py-2 text-center text-gray-700 dark:text-gray-200">False</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                    <tr>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">Default Icons</td>
                        <td class="px-4 py-3 text-center">
                            <span class="text-green-500 text-lg">✓</span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="text-red-500 text-lg">✗</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">Custom Colors (Blue/Gray)</td>
                        <td class="px-4 py-3 text-center">
                            <span class="text-blue-500 text-lg">✓</span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="text-gray-400 text-lg">✗</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">Heroicons</td>
                        <td class="px-4 py-3 text-center">
                            <svg class="w-5 h-5 mx-auto text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <svg class="w-5 h-5 mx-auto text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-4 py-3 text-gray-600 dark:text-gray-400">Text Labels</td>
                        <td class="px-4 py-3 text-center">
                            <span class="text-green-600 dark:text-green-400 font-medium">Active</span>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="text-red-600 dark:text-red-400 font-medium">Inactive</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    {{-- Code Example --}}
    <x-accelade::code-block language="php" title="BooleanColumn Usage">
use Accelade\Tables\Columns\BooleanColumn;

// Basic boolean column
BooleanColumn::make('is_active')
    ->label('Active');

// Custom icons
BooleanColumn::make('is_verified')
    ->icons(
        trueIcon: 'heroicon-o-check-badge',
        falseIcon: 'heroicon-o-x-mark'
    );

// Custom colors
BooleanColumn::make('is_published')
    ->colors(
        trueColor: 'primary',
        falseColor: 'gray'
    );

// Sortable and centered
BooleanColumn::make('is_featured')
    ->sortable()
    ->alignCenter();

// Combined customization
BooleanColumn::make('email_verified_at')
    ->label('Email Verified')
    ->icons(
        trueIcon: 'heroicon-o-shield-check',
        falseIcon: 'heroicon-o-shield-exclamation'
    )
    ->colors(
        trueColor: 'success',
        falseColor: 'warning'
    )
    ->getStateUsing(fn ($record) => $record->email_verified_at !== null);
    </x-accelade::code-block>
</div>
