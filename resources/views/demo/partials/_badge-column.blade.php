@props(['prefix' => 'a'])

<div class="space-y-6">
    <div class="prose dark:prose-invert max-w-none">
        <p class="text-gray-600 dark:text-gray-400">
            BadgeColumn displays values as colored badges, perfect for statuses, categories, tags, and other
            values that benefit from visual distinction.
        </p>
    </div>

    {{-- Demo Examples --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h4 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Badge Column Examples</h4>

        <div class="space-y-4">
            {{-- Status Badges --}}
            <div>
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Status Badges</p>
                <div class="flex flex-wrap gap-2">
                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">Active</span>
                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400">Pending</span>
                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">Inactive</span>
                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400">Draft</span>
                </div>
            </div>

            {{-- Badge with Icons --}}
            <div>
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Badges with Icons</p>
                <div class="flex flex-wrap gap-2">
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                        Published
                    </span>
                    <span class="inline-flex items-center gap-1 px-2.5 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/></svg>
                        Reviewing
                    </span>
                </div>
            </div>

            {{-- Badge Sizes --}}
            <div>
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Badge Sizes</p>
                <div class="flex flex-wrap items-center gap-2">
                    <span class="inline-flex items-center px-1.5 py-0.5 text-xs font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">XS</span>
                    <span class="inline-flex items-center px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">SM</span>
                    <span class="inline-flex items-center px-2.5 py-1 text-sm font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">MD</span>
                    <span class="inline-flex items-center px-3 py-1.5 text-sm font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">LG</span>
                </div>
            </div>

            {{-- All Colors --}}
            <div>
                <p class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Available Colors</p>
                <div class="flex flex-wrap gap-2">
                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800 dark:bg-gray-900/30 dark:text-gray-400">Gray</span>
                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400">Primary</span>
                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400">Success</span>
                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400">Warning</span>
                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400">Danger</span>
                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-cyan-100 text-cyan-800 dark:bg-cyan-900/30 dark:text-cyan-400">Info</span>
                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800 dark:bg-purple-900/30 dark:text-purple-400">Purple</span>
                    <span class="inline-flex items-center px-2.5 py-1 text-xs font-medium rounded-full bg-pink-100 text-pink-800 dark:bg-pink-900/30 dark:text-pink-400">Pink</span>
                </div>
            </div>
        </div>
    </div>

    {{-- Code Example --}}
    <x-accelade::code-block language="php" title="BadgeColumn Usage">
use Accelade\Tables\Columns\BadgeColumn;

// Basic badge with color mapping
BadgeColumn::make('status')
    ->colors([
        'draft' => 'gray',
        'pending' => 'warning',
        'published' => 'success',
        'rejected' => 'danger',
    ]);

// With dynamic color callback
BadgeColumn::make('priority')
    ->color(fn (string $state): string => match ($state) {
        'low' => 'gray',
        'medium' => 'warning',
        'high' => 'danger',
        'critical' => 'danger',
        default => 'gray',
    });

// With icons for each value
BadgeColumn::make('status')
    ->icons([
        'draft' => 'heroicon-o-pencil',
        'pending' => 'heroicon-o-clock',
        'published' => 'heroicon-o-check-circle',
    ])
    ->colors([
        'draft' => 'gray',
        'pending' => 'warning',
        'published' => 'success',
    ]);

// Custom size
BadgeColumn::make('role')
    ->size('lg')
    ->colors([
        'admin' => 'danger',
        'editor' => 'warning',
        'user' => 'primary',
    ]);

// Sortable badge
BadgeColumn::make('category')
    ->sortable()
    ->colors([
        'technology' => 'blue',
        'design' => 'purple',
        'marketing' => 'green',
    ]);
    </x-accelade::code-block>
</div>
