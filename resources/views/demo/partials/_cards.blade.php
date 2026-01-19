@props(['prefix' => 'a'])

<div class="space-y-6">
    <div class="prose dark:prose-invert max-w-none">
        <p class="text-gray-600 dark:text-gray-400">
            Cards are the building blocks of grids. Configure title, description, image, sections, and actions.
        </p>
    </div>

    {{-- Card Examples --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        {{-- Basic Card --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
            <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Basic Card</h4>
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4">
                <h5 class="font-medium text-gray-900 dark:text-white">Card Title</h5>
                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Card description text goes here.</p>
            </div>
        </div>

        {{-- Card with Image --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
            <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Card with Image</h4>
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden">
                <div class="h-32 bg-gradient-to-br from-green-400 to-blue-500"></div>
                <div class="p-4">
                    <h5 class="font-medium text-gray-900 dark:text-white">Product Name</h5>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Product description</p>
                </div>
            </div>
        </div>

        {{-- Card with Sections --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
            <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Card with Sections</h4>
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 space-y-2">
                <h5 class="font-medium text-gray-900 dark:text-white">Item Name</h5>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Price:</span>
                    <span class="text-gray-900 dark:text-white font-medium">$99.99</span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-500">Stock:</span>
                    <span class="text-green-600">In Stock</span>
                </div>
            </div>
        </div>

        {{-- Card with Actions --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-4">
            <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Card with Actions</h4>
            <div class="bg-gray-50 dark:bg-gray-700 rounded-lg overflow-hidden">
                <div class="p-4">
                    <h5 class="font-medium text-gray-900 dark:text-white">Action Card</h5>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">With footer actions</p>
                </div>
                <div class="px-4 py-3 bg-gray-100 dark:bg-gray-600 flex justify-end gap-2">
                    <button class="text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400">Edit</button>
                    <button class="text-sm text-red-600 hover:text-red-800 dark:text-red-400">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <x-accelade::code-block language="php" title="Card Configuration">
use Accelade\Grids\Cards\Card;
use Accelade\Grids\Cards\CardSection;

Card::make()
    ->title(fn ($record) => $record->name)
    ->description(fn ($record) => $record->description)
    ->image(fn ($record) => $record->image_url)
    ->sections([
        CardSection::make()->label('Price')->value(fn ($r) => '$' . $r->price),
        CardSection::make()->label('Stock')->value(fn ($r) => $r->stock > 0 ? 'In Stock' : 'Out of Stock'),
    ])
    ->actions([
        Action::make('edit')->icon('pencil'),
        Action::make('delete')->icon('trash')->color('danger'),
    ]);
    </x-accelade::code-block>
</div>
