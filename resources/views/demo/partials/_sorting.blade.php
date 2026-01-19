@props(['prefix' => 'a'])

<div class="space-y-6">
    <div class="prose dark:prose-invert max-w-none">
        <p class="text-gray-600 dark:text-gray-400">
            Enable sorting on columns to allow users to order data by clicking on column headers.
        </p>
    </div>

    {{-- Sorting Demo --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
            <thead class="bg-gray-50 dark:bg-gray-800">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700">
                        Name
                        <span class="ml-1">&#8593;</span>
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700">
                        Created At
                        <span class="ml-1 opacity-30">&#8645;</span>
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700">
                <tr><td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">Alice</td><td class="px-6 py-4 text-sm text-gray-500">2024-01-15</td></tr>
                <tr><td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">Bob</td><td class="px-6 py-4 text-sm text-gray-500">2024-01-10</td></tr>
                <tr><td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-100">Charlie</td><td class="px-6 py-4 text-sm text-gray-500">2024-01-05</td></tr>
            </tbody>
        </table>
    </div>

    {{-- Code Example --}}
    <x-accelade::code-block language="php" title="Sortable Columns">
use Accelade\Tables\Columns\TextColumn;

// Enable sorting on a column
TextColumn::make('name')
    ->sortable();

// Set default sort
$table = Table::make('users')
    ->defaultSort('created_at', 'desc')
    ->columns([
        TextColumn::make('name')->sortable(),
        TextColumn::make('created_at')->sortable(),
    ]);
    </x-accelade::code-block>
</div>
