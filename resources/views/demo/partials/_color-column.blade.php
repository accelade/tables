@props(['prefix' => 'a'])

<div class="space-y-6">
    <div class="prose dark:prose-invert max-w-none">
        <p class="text-gray-600 dark:text-gray-400">
            ColorColumn displays color swatches from CSS color values (HEX, RGB, HSL),
            perfect for design systems, product variants, and theme settings.
        </p>
    </div>

    {{-- Demo Examples --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Color Column Examples</h4>

        <div class="space-y-6">
            {{-- Basic Color Swatches --}}
            <div>
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Color Swatches</p>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full border border-gray-200 dark:border-gray-600" style="background-color: #3b82f6;"></div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">#3b82f6</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full border border-gray-200 dark:border-gray-600" style="background-color: #10b981;"></div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">#10b981</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full border border-gray-200 dark:border-gray-600" style="background-color: #f59e0b;"></div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">#f59e0b</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full border border-gray-200 dark:border-gray-600" style="background-color: #ef4444;"></div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">#ef4444</span>
                    </div>
                </div>
            </div>

            {{-- Square Swatches --}}
            <div>
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Square Swatches</p>
                <div class="flex items-center gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded border border-gray-200 dark:border-gray-600" style="background-color: #8b5cf6;"></div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">#8b5cf6</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded border border-gray-200 dark:border-gray-600" style="background-color: #ec4899;"></div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">#ec4899</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded border border-gray-200 dark:border-gray-600" style="background-color: #06b6d4;"></div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">#06b6d4</span>
                    </div>
                </div>
            </div>

            {{-- Different Sizes --}}
            <div>
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Different Sizes</p>
                <div class="flex items-end gap-4">
                    <div class="text-center">
                        <div class="w-4 h-4 rounded-full border border-gray-200 dark:border-gray-600 mx-auto" style="background-color: #6366f1;"></div>
                        <span class="text-xs text-gray-500 mt-1">16px</span>
                    </div>
                    <div class="text-center">
                        <div class="w-6 h-6 rounded-full border border-gray-200 dark:border-gray-600 mx-auto" style="background-color: #6366f1;"></div>
                        <span class="text-xs text-gray-500 mt-1">24px</span>
                    </div>
                    <div class="text-center">
                        <div class="w-8 h-8 rounded-full border border-gray-200 dark:border-gray-600 mx-auto" style="background-color: #6366f1;"></div>
                        <span class="text-xs text-gray-500 mt-1">32px</span>
                    </div>
                    <div class="text-center">
                        <div class="w-10 h-10 rounded-full border border-gray-200 dark:border-gray-600 mx-auto" style="background-color: #6366f1;"></div>
                        <span class="text-xs text-gray-500 mt-1">40px</span>
                    </div>
                </div>
            </div>

            {{-- Color Formats --}}
            <div>
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Supported Formats</p>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full border border-gray-200 dark:border-gray-600" style="background-color: #3b82f6;"></div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">HEX</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full border border-gray-200 dark:border-gray-600" style="background-color: rgb(59, 130, 246);"></div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">RGB</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full border border-gray-200 dark:border-gray-600" style="background-color: rgba(59, 130, 246, 0.8);"></div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">RGBA</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-6 h-6 rounded-full border border-gray-200 dark:border-gray-600" style="background-color: hsl(217, 91%, 60%);"></div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">HSL</span>
                    </div>
                </div>
            </div>

            {{-- Copyable --}}
            <div>
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Copyable Colors</p>
                <div class="flex items-center gap-2">
                    <div class="w-6 h-6 rounded-full border border-gray-200 dark:border-gray-600" style="background-color: #22c55e;"></div>
                    <button class="text-xs text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 cursor-pointer">#22c55e</button>
                    <span class="text-xs text-gray-400">(click to copy)</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Code Example --}}
    <x-accelade::code-block language="php" title="ColorColumn Usage">
use Accelade\Tables\Columns\ColorColumn;

// Basic color column
ColorColumn::make('color');

// With copyable
ColorColumn::make('brand_color')
    ->copyable()
    ->copyMessage('Color copied!');

// Custom size
ColorColumn::make('theme_color')
    ->size(32);

// Square swatch
ColorColumn::make('accent_color')
    ->square();

// With tooltip
ColorColumn::make('background_color')
    ->tooltip('Click to copy');

// Aligned center
ColorColumn::make('primary_color')
    ->alignCenter();
    </x-accelade::code-block>
</div>
