@props(['prefix' => 'a'])

<div class="space-y-6">
    <div class="prose dark:prose-invert max-w-none">
        <p class="text-gray-600 dark:text-gray-400">
            ImageColumn displays images with configurable size, shape (circular or square),
            and support for stacked images when showing multiple related records.
        </p>
    </div>

    {{-- Demo Examples --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Image Column Examples</h4>

        <div class="space-y-6">
            {{-- Circular Images --}}
            <div>
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Circular (Avatars)</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600"></div>
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-teal-600"></div>
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-orange-500 to-red-600"></div>
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-pink-500 to-rose-600"></div>
                </div>
            </div>

            {{-- Square Images --}}
            <div>
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Square (Thumbnails)</p>
                <div class="flex items-center gap-3">
                    <div class="w-12 h-12 rounded bg-gradient-to-br from-indigo-400 to-indigo-600"></div>
                    <div class="w-12 h-12 rounded bg-gradient-to-br from-amber-400 to-amber-600"></div>
                    <div class="w-12 h-12 rounded bg-gradient-to-br from-emerald-400 to-emerald-600"></div>
                </div>
            </div>

            {{-- Different Sizes --}}
            <div>
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Different Sizes</p>
                <div class="flex items-end gap-3">
                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600"></div>
                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600"></div>
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600"></div>
                    <div class="w-16 h-16 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600"></div>
                </div>
            </div>

            {{-- Stacked Images --}}
            <div>
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Stacked (Team Members)</p>
                <div class="flex items-center">
                    <div class="flex -space-x-3">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-violet-500 to-purple-600 ring-2 ring-white dark:ring-gray-800"></div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-pink-500 to-rose-600 ring-2 ring-white dark:ring-gray-800"></div>
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-amber-500 to-orange-600 ring-2 ring-white dark:ring-gray-800"></div>
                        <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-600 ring-2 ring-white dark:ring-gray-800 flex items-center justify-center text-xs font-medium text-gray-600 dark:text-gray-300">+5</div>
                    </div>
                </div>
            </div>

            {{-- With Default/Fallback --}}
            <div>
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">With Default Image</p>
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-gray-200 dark:bg-gray-600 flex items-center justify-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <span class="text-sm text-gray-500 dark:text-gray-400">No avatar available</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Code Example --}}
    <x-accelade::code-block language="php" title="ImageColumn Usage">
use Accelade\Tables\Columns\ImageColumn;

// Basic circular avatar
ImageColumn::make('avatar')
    ->circular()
    ->size(40);

// Square thumbnail
ImageColumn::make('thumbnail')
    ->square()
    ->width(60)
    ->height(45);

// With default image
ImageColumn::make('photo')
    ->circular()
    ->defaultImageUrl('/images/default-avatar.png');

// Stacked images (for relationships)
ImageColumn::make('team.members.avatar')
    ->circular()
    ->stacked()
    ->stackLimit(4);

// Custom dimensions
ImageColumn::make('product_image')
    ->width(80)
    ->height(60)
    ->square();

// With URL link
ImageColumn::make('author.avatar')
    ->circular()
    ->size(32)
    ->url(fn ($record) => route('users.show', $record->author));
    </x-accelade::code-block>
</div>
