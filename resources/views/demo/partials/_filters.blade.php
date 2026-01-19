@props(['prefix' => 'a'])

<div class="space-y-6">
    <div class="prose dark:prose-invert max-w-none">
        <p class="text-gray-600 dark:text-gray-400">
            Grids integrate with the Filters package to provide filtering capabilities for your card-based views.
        </p>
    </div>

    {{-- Filter Demo --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4 mb-6">
        <form class="flex flex-wrap gap-4 items-end">
            <div class="flex-1 min-w-[200px]">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Search</label>
                <input type="text" placeholder="Search products..." class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
            </div>
            <div class="min-w-[150px]">
                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                <select class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <option value="">All Categories</option>
                    <option value="electronics">Electronics</option>
                    <option value="clothing">Clothing</option>
                    <option value="books">Books</option>
                </select>
            </div>
            <button type="button" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">Filter</button>
        </form>
    </div>

    {{-- Filtered Grid --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @for($i = 1; $i <= 3; $i++)
        <div class="bg-white dark:bg-gray-700 rounded-lg shadow-sm p-4">
            <h5 class="font-medium text-gray-900 dark:text-white">Filtered Result {{ $i }}</h5>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Matching your criteria</p>
        </div>
        @endfor
    </div>

    <x-accelade::code-block language="php" title="Grid with Filters">
use Accelade\Grids\Grid;
use Accelade\Filters\Components\TextFilter;
use Accelade\Filters\Components\SelectFilter;

$grid = Grid::make('products')
    ->query(Product::query())
    ->filters([
        TextFilter::make('search')
            ->label('Search')
            ->placeholder('Search products...'),
        SelectFilter::make('category')
            ->label('Category')
            ->options(Category::pluck('name', 'id')),
    ])
    ->columns(3)
    ->card(...)
    ->fromRequest();
    </x-accelade::code-block>
</div>
