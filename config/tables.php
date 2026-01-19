<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Enable/Disable Tables
    |--------------------------------------------------------------------------
    |
    | Enable or disable the tables package.
    |
    */
    'enabled' => true,

    /*
    |--------------------------------------------------------------------------
    | Default Per Page
    |--------------------------------------------------------------------------
    |
    | The default number of items per page.
    |
    */
    'per_page' => 15,

    /*
    |--------------------------------------------------------------------------
    | Per Page Options
    |--------------------------------------------------------------------------
    |
    | The available per-page options.
    |
    */
    'per_page_options' => [10, 15, 25, 50, 100],

    /*
    |--------------------------------------------------------------------------
    | Default Styles
    |--------------------------------------------------------------------------
    |
    | Default Tailwind CSS classes for table components.
    |
    */
    'styles' => [
        'container' => 'overflow-hidden rounded-lg shadow ring-1 ring-black/5 dark:ring-white/10',
        'table' => 'min-w-full divide-y divide-gray-200 dark:divide-gray-700',
        'thead' => 'bg-gray-50 dark:bg-gray-800',
        'th' => 'px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-400 uppercase tracking-wider',
        'th_sortable' => 'cursor-pointer hover:bg-gray-100 dark:hover:bg-gray-700',
        'tbody' => 'bg-white dark:bg-gray-900 divide-y divide-gray-200 dark:divide-gray-700',
        'tr' => '',
        'tr_hover' => 'hover:bg-gray-50 dark:hover:bg-gray-800',
        'tr_striped' => 'even:bg-gray-50 dark:even:bg-gray-800',
        'td' => 'px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100',
        'empty_state' => 'px-6 py-12 text-center',
        'pagination' => 'px-6 py-4 border-t border-gray-200 dark:border-gray-700',
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
        'heading' => 'No records found',
        'description' => 'Try adjusting your search or filter to find what you\'re looking for.',
        'icon' => null,
    ],

    /*
    |--------------------------------------------------------------------------
    | Demo Routes
    |--------------------------------------------------------------------------
    |
    | Enable demo routes for testing tables.
    |
    */
    'demo' => [
        'enabled' => env('TABLES_DEMO_ENABLED', env('APP_ENV') !== 'production'),
        'prefix' => 'tables-demo',
        'middleware' => ['web'],
    ],
];
