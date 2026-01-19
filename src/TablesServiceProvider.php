<?php

declare(strict_types=1);

namespace Accelade\Tables;

use Accelade\Docs\DocsRegistry;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class TablesServiceProvider extends ServiceProvider
{
    /**
     * Documentation sections configuration.
     *
     * @var array<int, array<string, mixed>>
     */
    private const DOCUMENTATION_SECTIONS = [
        // Main entry - no subgroup
        ['id' => 'tables-overview', 'label' => 'Overview', 'icon' => '📊', 'markdown' => 'overview.md', 'description' => 'Table components for displaying data', 'keywords' => ['table', 'data', 'list', 'grid'], 'view' => 'tables::docs.sections.overview'],
        // Structure
        ['id' => 'tables-sorting', 'label' => 'Sorting', 'icon' => '↕️', 'markdown' => 'sorting.md', 'description' => 'Sorting table columns', 'keywords' => ['sort', 'order', 'asc', 'desc'], 'view' => 'tables::docs.sections.sorting', 'subgroup' => 'structure'],
        ['id' => 'tables-pagination', 'label' => 'Pagination', 'icon' => '📄', 'markdown' => 'pagination.md', 'description' => 'Table pagination', 'keywords' => ['paginate', 'page', 'per page'], 'view' => 'tables::docs.sections.pagination', 'subgroup' => 'structure'],
        // Features
        ['id' => 'tables-filters', 'label' => 'Filters', 'icon' => '🎯', 'markdown' => 'filters.md', 'description' => 'Filtering table data', 'keywords' => ['filter', 'search', 'query'], 'view' => 'tables::docs.sections.filters', 'subgroup' => 'features'],
        ['id' => 'tables-actions', 'label' => 'Actions', 'icon' => '⚡', 'markdown' => 'actions.md', 'description' => 'Row and bulk actions', 'keywords' => ['action', 'button', 'bulk'], 'view' => 'tables::docs.sections.actions', 'subgroup' => 'features'],
    ];

    /**
     * Display column documentation sections configuration.
     *
     * @var array<int, array<string, mixed>>
     */
    private const DISPLAY_COLUMN_SECTIONS = [
        ['id' => 'tables-text-column', 'label' => 'Text Column', 'icon' => '📝', 'markdown' => 'text-column.md', 'description' => 'Display text content', 'keywords' => ['text', 'string', 'content'], 'view' => 'tables::docs.sections.text-column'],
        ['id' => 'tables-badge-column', 'label' => 'Badge Column', 'icon' => '🏷️', 'markdown' => 'badge-column.md', 'description' => 'Display values as badges', 'keywords' => ['badge', 'status', 'tag'], 'view' => 'tables::docs.sections.badge-column'],
        ['id' => 'tables-boolean-column', 'label' => 'Boolean Column', 'icon' => '✓', 'markdown' => 'boolean-column.md', 'description' => 'Display boolean values as icons', 'keywords' => ['boolean', 'yes', 'no', 'true', 'false'], 'view' => 'tables::docs.sections.boolean-column'],
        ['id' => 'tables-image-column', 'label' => 'Image Column', 'icon' => '🖼️', 'markdown' => 'image-column.md', 'description' => 'Display images', 'keywords' => ['image', 'photo', 'avatar', 'thumbnail'], 'view' => 'tables::docs.sections.image-column'],
        ['id' => 'tables-icon-column', 'label' => 'Icon Column', 'icon' => '🎯', 'markdown' => 'icon-column.md', 'description' => 'Display icons based on values', 'keywords' => ['icon', 'symbol', 'indicator'], 'view' => 'tables::docs.sections.icon-column'],
        ['id' => 'tables-color-column', 'label' => 'Color Column', 'icon' => '🎨', 'markdown' => 'color-column.md', 'description' => 'Display color swatches', 'keywords' => ['color', 'swatch', 'hex', 'rgb'], 'view' => 'tables::docs.sections.color-column'],
    ];

    /**
     * Editable column documentation sections configuration.
     *
     * @var array<int, array<string, mixed>>
     */
    private const EDITABLE_COLUMN_SECTIONS = [
        ['id' => 'tables-select-column', 'label' => 'Select Column', 'icon' => '📋', 'markdown' => 'select-column.md', 'description' => 'Editable dropdown select', 'keywords' => ['select', 'dropdown', 'editable'], 'view' => 'tables::docs.sections.select-column'],
        ['id' => 'tables-toggle-column', 'label' => 'Toggle Column', 'icon' => '🔘', 'markdown' => 'toggle-column.md', 'description' => 'Editable toggle switch', 'keywords' => ['toggle', 'switch', 'boolean', 'editable'], 'view' => 'tables::docs.sections.toggle-column'],
        ['id' => 'tables-text-input-column', 'label' => 'Text Input Column', 'icon' => '✏️', 'markdown' => 'text-input-column.md', 'description' => 'Editable text input', 'keywords' => ['input', 'text', 'editable', 'inline'], 'view' => 'tables::docs.sections.text-input-column'],
        ['id' => 'tables-checkbox-column', 'label' => 'Checkbox Column', 'icon' => '☑️', 'markdown' => 'checkbox-column.md', 'description' => 'Editable checkbox', 'keywords' => ['checkbox', 'check', 'boolean', 'editable'], 'view' => 'tables::docs.sections.checkbox-column'],
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/tables.php',
            'tables'
        );

        $this->app->bind('accelade.table', function () {
            return new Table;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Load views under 'accelade' namespace
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'accelade');

        // Also load under 'tables' namespace
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'tables');

        // Load routes
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');

        // Register Blade directives
        $this->registerBladeDirectives();

        // Inject scripts/styles into Accelade
        $this->injectAcceladeAssets();

        // Register documentation sections
        $this->registerDocumentation();

        if ($this->app->runningInConsole()) {
            // Publish config
            $this->publishes([
                __DIR__.'/../config/tables.php' => config_path('tables.php'),
            ], 'tables-config');

            // Publish views
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/accelade'),
            ], 'tables-views');
        }
    }

    /**
     * Register Blade directives for tables.
     */
    protected function registerBladeDirectives(): void
    {
        Blade::directive('tablesScripts', function () {
            return "<?php echo view('tables::scripts')->render(); ?>";
        });

        Blade::directive('tablesStyles', function () {
            return "<?php echo view('tables::styles')->render(); ?>";
        });
    }

    /**
     * Inject Tables scripts and styles into Accelade.
     */
    protected function injectAcceladeAssets(): void
    {
        if (! $this->app->bound('accelade')) {
            return;
        }

        /** @var \Accelade\Accelade $accelade */
        $accelade = $this->app->make('accelade');

        $accelade->registerScript('tables', function () {
            return view('tables::scripts')->render();
        });

        $accelade->registerStyle('tables', function () {
            return view('tables::styles')->render();
        });
    }

    /**
     * Register documentation sections with Accelade's DocsRegistry.
     */
    protected function registerDocumentation(): void
    {
        if (! $this->app->bound('accelade.docs')) {
            return;
        }

        /** @var DocsRegistry $registry */
        $registry = $this->app->make('accelade.docs');

        $registry->registerPackage('tables', __DIR__.'/../docs');
        $registry->registerGroup('tables', 'Tables', '📊', 55);

        // Register sub-groups within Tables
        $registry->registerSubgroup('tables', 'structure', '📋 Structure', '', 10);
        $registry->registerSubgroup('tables', 'features', '⚡ Features', '', 20);
        $registry->registerSubgroup('tables', 'columns-display', '👁️ Display Columns', '', 30);
        $registry->registerSubgroup('tables', 'columns-editable', '✏️ Editable Columns', '', 40);

        foreach ($this->getDocumentationSections() as $section) {
            $this->registerSection($registry, $section);
        }

        // Register display column sections
        foreach (self::DISPLAY_COLUMN_SECTIONS as $section) {
            $this->registerColumnSection($registry, $section, 'columns-display');
        }

        // Register editable column sections
        foreach (self::EDITABLE_COLUMN_SECTIONS as $section) {
            $this->registerColumnSection($registry, $section, 'columns-editable');
        }
    }

    /**
     * Register a single documentation section.
     *
     * @param  array<string, mixed>  $section
     */
    protected function registerSection(DocsRegistry $registry, array $section): void
    {
        $builder = $registry->section($section['id'])
            ->label($section['label'])
            ->icon($section['icon'])
            ->markdown($section['markdown'])
            ->description($section['description'])
            ->keywords($section['keywords'])
            ->demo()
            ->view($section['view'])
            ->package('tables')
            ->inGroup('tables');

        if (isset($section['subgroup'])) {
            $builder->inSubgroup($section['subgroup']);
        }

        $builder->register();
    }

    /**
     * Register a column documentation section.
     *
     * @param  array<string, mixed>  $section
     */
    protected function registerColumnSection(DocsRegistry $registry, array $section, string $subgroup): void
    {
        $registry->section($section['id'])
            ->label($section['label'])
            ->icon($section['icon'])
            ->markdown($section['markdown'])
            ->description($section['description'])
            ->keywords($section['keywords'])
            ->demo()
            ->view($section['view'])
            ->package('tables')
            ->inGroup('tables')
            ->inSubgroup($subgroup)
            ->register();
    }

    /**
     * Get documentation section definitions.
     *
     * @return array<int, array<string, mixed>>
     */
    protected function getDocumentationSections(): array
    {
        return self::DOCUMENTATION_SECTIONS;
    }
}
