<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Enable/Disable Grids
    |--------------------------------------------------------------------------
    |
    | Enable or disable the grids package.
    |
    */
    'enabled' => true,

    /*
    |--------------------------------------------------------------------------
    | Default Columns
    |--------------------------------------------------------------------------
    |
    | The default number of columns in the grid.
    |
    */
    'default_columns' => 3,

    /*
    |--------------------------------------------------------------------------
    | Default Gap
    |--------------------------------------------------------------------------
    |
    | The default gap between grid items (Tailwind spacing scale).
    |
    */
    'default_gap' => '6',

    /*
    |--------------------------------------------------------------------------
    | Default Per Page
    |--------------------------------------------------------------------------
    |
    | The default number of items per page.
    |
    */
    'per_page' => 12,

    /*
    |--------------------------------------------------------------------------
    | Per Page Options
    |--------------------------------------------------------------------------
    |
    | The available per-page options.
    |
    */
    'per_page_options' => [12, 24, 48, 96],

    /*
    |--------------------------------------------------------------------------
    | Default Styles
    |--------------------------------------------------------------------------
    |
    | Default Tailwind CSS classes for grid and card components.
    |
    */
    'styles' => [
        'grid' => 'grid',
        'card' => 'bg-white dark:bg-gray-800 rounded-lg overflow-hidden',
        'card_bordered' => 'ring-1 ring-gray-200 dark:ring-gray-700',
        'card_shadow' => 'shadow-sm',
        'card_hoverable' => 'transition-shadow hover:shadow-md',
        'card_image' => 'aspect-video object-cover w-full',
        'card_body' => 'p-4',
        'card_title' => 'text-lg font-semibold text-gray-900 dark:text-white',
        'card_description' => 'mt-1 text-sm text-gray-500 dark:text-gray-400',
        'card_footer' => 'px-4 py-3 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-200 dark:border-gray-700',
    ],

    /*
    |--------------------------------------------------------------------------
    | Empty State
    |--------------------------------------------------------------------------
    |
    | Default empty state configuration.
    |
    */
    'empty_state' => [
        'heading' => 'No items found',
        'description' => 'Try adjusting your search or filter to find what you\'re looking for.',
        'icon' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | Demo Routes
    |--------------------------------------------------------------------------
    |
    | Enable demo routes for testing grids.
    |
    */
    'demo' => [
        'enabled' => env('GRIDS_DEMO_ENABLED', env('APP_ENV') !== 'production'),
        'prefix' => 'grids-demo',
        'middleware' => ['web'],
    ],
];
