<?php

declare(strict_types=1);

namespace Accelade\Grids;

use Accelade\Docs\DocsRegistry;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class GridsServiceProvider extends ServiceProvider
{
    /**
     * Documentation sections configuration.
     *
     * @var array<int, array<string, mixed>>
     */
    private const DOCUMENTATION_SECTIONS = [
        // Main entry - no subgroup
        ['id' => 'grids-overview', 'label' => 'Overview', 'icon' => '⊞', 'markdown' => 'overview.md', 'description' => 'Grid components for displaying data in cards', 'keywords' => ['grid', 'card', 'gallery', 'masonry'], 'view' => 'grids::docs.sections.overview'],
        // Components
        ['id' => 'grids-cards', 'label' => 'Cards', 'icon' => '🃏', 'markdown' => 'cards.md', 'description' => 'Card templates for grid items', 'keywords' => ['card', 'template', 'item'], 'view' => 'grids::docs.sections.cards', 'subgroup' => 'components'],
        ['id' => 'grids-layouts', 'label' => 'Layouts', 'icon' => '📐', 'markdown' => 'layouts.md', 'description' => 'Grid layout configurations', 'keywords' => ['layout', 'columns', 'masonry', 'list'], 'view' => 'grids::docs.sections.layouts', 'subgroup' => 'components'],
        // Features
        ['id' => 'grids-filters', 'label' => 'Filters', 'icon' => '🎯', 'markdown' => 'filters.md', 'description' => 'Filtering grid data', 'keywords' => ['filter', 'search', 'query'], 'view' => 'grids::docs.sections.filters', 'subgroup' => 'features'],
    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/grids.php',
            'grids'
        );

        $this->app->bind('accelade.grid', function () {
            return new Grid;
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Load views under 'accelade' namespace
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'accelade');

        // Also load under 'grids' namespace
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'grids');

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
                __DIR__.'/../config/grids.php' => config_path('grids.php'),
            ], 'grids-config');

            // Publish views
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/accelade'),
            ], 'grids-views');
        }
    }

    /**
     * Register Blade directives for grids.
     */
    protected function registerBladeDirectives(): void
    {
        Blade::directive('gridsScripts', function () {
            return "<?php echo view('grids::scripts')->render(); ?>";
        });

        Blade::directive('gridsStyles', function () {
            return "<?php echo view('grids::styles')->render(); ?>";
        });
    }

    /**
     * Inject Grids scripts and styles into Accelade.
     */
    protected function injectAcceladeAssets(): void
    {
        if (! $this->app->bound('accelade')) {
            return;
        }

        /** @var \Accelade\Accelade $accelade */
        $accelade = $this->app->make('accelade');

        $accelade->registerScript('grids', function () {
            return view('grids::scripts')->render();
        });

        $accelade->registerStyle('grids', function () {
            return view('grids::styles')->render();
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

        $registry->registerPackage('grids', __DIR__.'/../docs');
        $registry->registerGroup('grids', 'Grids', '⊞', 60);

        // Register sub-groups within Grids
        $registry->registerSubgroup('grids', 'components', '🃏 Components', '', 10);
        $registry->registerSubgroup('grids', 'features', '⚡ Features', '', 20);

        foreach ($this->getDocumentationSections() as $section) {
            $this->registerSection($registry, $section);
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
            ->package('grids')
            ->inGroup('grids');

        if (isset($section['subgroup'])) {
            $builder->inSubgroup($section['subgroup']);
        }

        $builder->register();
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
