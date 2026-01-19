@props(['prefix' => 'a'])

<div class="space-y-6">
    <div class="prose dark:prose-invert max-w-none">
        <p class="text-gray-600 dark:text-gray-400">
            Configure grid layouts with responsive columns, gaps, and masonry mode.
        </p>
    </div>

    {{-- Layout Examples --}}
    <div class="space-y-8">
        {{-- 3 Columns --}}
        <div>
            <h4 class="font-semibold text-gray-900 dark:text-white mb-3">3 Column Grid</h4>
            <div class="grid grid-cols-3 gap-4">
                @for($i = 1; $i <= 3; $i++)
                <div class="bg-blue-100 dark:bg-blue-900/30 rounded-lg p-4 text-center text-blue-800 dark:text-blue-200">Item {{ $i }}</div>
                @endfor
            </div>
        </div>

        {{-- Responsive Columns --}}
        <div>
            <h4 class="font-semibold text-gray-900 dark:text-white mb-3">Responsive Grid (1/2/4 columns)</h4>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                @for($i = 1; $i <= 4; $i++)
                <div class="bg-green-100 dark:bg-green-900/30 rounded-lg p-4 text-center text-green-800 dark:text-green-200">Item {{ $i }}</div>
                @endfor
            </div>
        </div>

        {{-- Different Gap --}}
        <div>
            <h4 class="font-semibold text-gray-900 dark:text-white mb-3">Large Gap (gap-8)</h4>
            <div class="grid grid-cols-3 gap-8">
                @for($i = 1; $i <= 3; $i++)
                <div class="bg-purple-100 dark:bg-purple-900/30 rounded-lg p-4 text-center text-purple-800 dark:text-purple-200">Item {{ $i }}</div>
                @endfor
            </div>
        </div>
    </div>

    <x-accelade::code-block language="php" title="Layout Configuration">
use Accelade\Grids\Grid;

// Fixed columns
Grid::make('products')->columns(3)->gap('4');

// Responsive columns
Grid::make('products')
    ->columns([
        'default' => 1,
        'sm' => 2,
        'md' => 3,
        'lg' => 4,
    ])
    ->gap('6');

// Masonry layout
Grid::make('gallery')
    ->columns(3)
    ->masonry();

// List view
Grid::make('items')
    ->columns(1)
    ->gap('2');
    </x-accelade::code-block>
</div>
