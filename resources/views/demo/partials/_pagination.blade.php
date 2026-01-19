@props(['prefix' => 'a'])

<div class="space-y-6">
    <div class="prose dark:prose-invert max-w-none">
        <p class="text-gray-600 dark:text-gray-400">
            Tables support pagination with configurable items per page and various pagination styles.
        </p>
    </div>

    {{-- Pagination Demo --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden">
        <div class="px-6 py-4 border-t border-gray-200 dark:border-gray-700">
            <div class="flex items-center justify-between">
                <div class="text-sm text-gray-600 dark:text-gray-400">
                    Showing <span class="font-medium">1</span> to <span class="font-medium">10</span> of <span class="font-medium">97</span> results
                </div>
                <div class="flex items-center gap-2">
                    <select class="rounded-md border-gray-300 shadow-sm text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <option>10 per page</option>
                        <option>25 per page</option>
                        <option>50 per page</option>
                    </select>
                    <nav class="flex items-center gap-1">
                        <button class="px-3 py-1 rounded border border-gray-300 text-sm text-gray-500 dark:border-gray-600">&laquo; Previous</button>
                        <button class="px-3 py-1 rounded bg-blue-600 text-white text-sm">1</button>
                        <button class="px-3 py-1 rounded border border-gray-300 text-sm text-gray-700 dark:border-gray-600 dark:text-gray-300">2</button>
                        <button class="px-3 py-1 rounded border border-gray-300 text-sm text-gray-700 dark:border-gray-600 dark:text-gray-300">3</button>
                        <span class="px-2 text-gray-500">...</span>
                        <button class="px-3 py-1 rounded border border-gray-300 text-sm text-gray-700 dark:border-gray-600 dark:text-gray-300">10</button>
                        <button class="px-3 py-1 rounded border border-gray-300 text-sm text-gray-700 dark:border-gray-600 dark:text-gray-300">Next &raquo;</button>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    {{-- Code Example --}}
    <x-accelade::code-block language="php" title="Pagination Configuration">
use Accelade\Tables\Table;

$table = Table::make('users')
    ->query(User::query())
    ->perPage(15)
    ->perPageOptions([10, 15, 25, 50, 100])
    ->columns([...])
    ->paginate();

// In Blade
&lt;x-accelade::table :table="$table" /&gt;
    </x-accelade::code-block>
</div>
