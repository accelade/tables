@props(['prefix' => 'a'])

<div class="space-y-6">
    <div class="prose dark:prose-invert max-w-none">
        <p class="text-gray-600 dark:text-gray-400">
            Filter your table data using various filter components. Tables integrate seamlessly with the Filters package.
        </p>
    </div>

    {{-- Filter Demo --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
        <form class="flex flex-wrap gap-4 items-end">
            <div class="min-w-[150px]">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search</label>
                <input type="text" placeholder="Search..." class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            <div class="min-w-[150px]">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Status</label>
                <select class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">All</option>
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>
            <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Apply</button>
            <button type="button" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 dark:bg-gray-600 dark:text-white">Clear</button>
        </form>
    </div>

    {{-- Code Example --}}
    <x-accelade::code-block language="php" title="Adding Filters">
use Accelade\Tables\Table;
use Accelade\Filters\Components\TextFilter;
use Accelade\Filters\Components\SelectFilter;

$table = Table::make('users')
    ->query(User::query())
    ->filters([
        TextFilter::make('search')
            ->label('Search')
            ->placeholder('Search users...'),
        SelectFilter::make('status')
            ->label('Status')
            ->options([
                'active' => 'Active',
                'inactive' => 'Inactive',
            ]),
    ])
    ->columns([...])
    ->fromRequest();
    </x-accelade::code-block>
</div>
