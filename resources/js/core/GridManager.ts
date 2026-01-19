import type {
    GridConfig,
    GridState,
    FilterConfig,
    SortConfig,
    GridEventType,
    GridEventCallback,
    Grid,
} from './types';
import { MasonryLayout } from './MasonryLayout';
import { InfiniteScroll } from './InfiniteScroll';

/**
 * Grid instance implementation
 */
class GridInstance implements Grid {
    id: string;
    container: HTMLElement;
    config: GridConfig;
    state: GridState;

    private masonry: MasonryLayout | null = null;
    private infiniteScroll: InfiniteScroll | null = null;
    private eventListeners: Map<GridEventType, Set<GridEventCallback>> = new Map();
    private initialized: boolean = false;

    constructor(container: HTMLElement, config: GridConfig) {
        this.container = container;
        this.config = config;
        this.id = container.id || `grid-${Date.now()}`;

        this.state = {
            page: 1,
            perPage: config.itemsPerPage ?? 12,
            filters: [],
            hasMore: true,
            loading: false,
        };
    }

    /**
     * Initialize the grid
     */
    init(): void {
        if (this.initialized) return;

        // Setup masonry if enabled
        if (this.config.masonry) {
            this.masonry = new MasonryLayout(this.container, {
                columns: this.config.columns,
                gap: this.config.gap ? parseInt(this.config.gap) * 4 : 16, // Convert Tailwind scale
            });
        }

        // Setup infinite scroll if enabled
        if (this.config.infiniteScroll && this.config.loadMoreUrl) {
            this.infiniteScroll = new InfiniteScroll(this.container, {
                loadMoreUrl: this.config.loadMoreUrl,
                onLoad: (items) => {
                    // Refresh masonry after new items
                    if (this.masonry) {
                        this.masonry.refresh();
                    }
                    this.config.onItemsLoaded?.(items);
                },
            });
        }

        // Setup animations
        if (this.config.animation?.enabled !== false) {
            this.setupAnimations();
        }

        this.initialized = true;
        this.emit('init');
        this.config.onInit?.();
    }

    /**
     * Setup item animations
     */
    private setupAnimations(): void {
        const items = this.container.querySelectorAll('.accelade-grid-item');
        const { duration = 300, easing = 'ease-out', stagger = 50 } = this.config.animation ?? {};

        items.forEach((item, index) => {
            const element = item as HTMLElement;
            element.style.opacity = '0';
            element.style.transform = 'translateY(20px)';
            element.style.transition = `opacity ${duration}ms ${easing}, transform ${duration}ms ${easing}`;

            setTimeout(() => {
                element.style.opacity = '1';
                element.style.transform = 'translateY(0)';
            }, index * stagger);
        });
    }

    /**
     * Destroy the grid
     */
    destroy(): void {
        if (this.masonry) {
            this.masonry.destroy();
            this.masonry = null;
        }

        if (this.infiniteScroll) {
            this.infiniteScroll.destroy();
            this.infiniteScroll = null;
        }

        this.eventListeners.clear();
        this.initialized = false;
        this.emit('destroy');
    }

    /**
     * Refresh the grid
     */
    refresh(): void {
        if (this.masonry) {
            this.masonry.refresh();
        }
        this.emit('refresh');
    }

    /**
     * Load more items
     */
    async loadMore(): Promise<void> {
        if (!this.infiniteScroll) return;

        this.state.loading = true;
        await this.infiniteScroll.loadMore();
        this.state.loading = false;
        this.state.page = this.infiniteScroll.getPage();
        this.state.hasMore = this.infiniteScroll.hasMoreItems();
    }

    /**
     * Apply filters
     */
    filter(filters: FilterConfig[]): void {
        this.state.filters = filters;

        if (this.infiniteScroll) {
            this.infiniteScroll.reset();
        }

        this.emit('filter:change', { filters });
        this.reloadContent();
    }

    /**
     * Apply sort
     */
    sort(sort: SortConfig): void {
        this.state.sort = sort;

        if (this.infiniteScroll) {
            this.infiniteScroll.reset();
        }

        this.emit('sort:change', { sort });
        this.reloadContent();
    }

    /**
     * Apply search
     */
    search(term: string): void {
        this.state.search = term;

        if (this.infiniteScroll) {
            this.infiniteScroll.reset();
        }

        this.emit('search:change', { search: term });
        this.reloadContent();
    }

    /**
     * Reload grid content
     */
    private async reloadContent(): Promise<void> {
        // Build URL with filters, sort, and search
        const url = new URL(window.location.href);

        // Add filters
        this.state.filters.forEach((filter) => {
            url.searchParams.set(`filter[${filter.name}]`, String(filter.value));
        });

        // Add sort
        if (this.state.sort) {
            url.searchParams.set('sort', this.state.sort.column);
            url.searchParams.set('direction', this.state.sort.direction);
        }

        // Add search
        if (this.state.search) {
            url.searchParams.set('search', this.state.search);
        }

        // Reset page
        url.searchParams.set('page', '1');

        // If using Accelade SPA navigation
        if (window.Accelade) {
            window.history.pushState({}, '', url.toString());
            window.Accelade.emit('navigate', url.toString());
        } else {
            // Full page navigation
            window.location.href = url.toString();
        }
    }

    /**
     * Add event listener
     */
    on(event: GridEventType, callback: GridEventCallback): void {
        if (!this.eventListeners.has(event)) {
            this.eventListeners.set(event, new Set());
        }
        this.eventListeners.get(event)!.add(callback);
    }

    /**
     * Remove event listener
     */
    off(event: GridEventType, callback: GridEventCallback): void {
        this.eventListeners.get(event)?.delete(callback);
    }

    /**
     * Emit event
     */
    private emit(event: GridEventType, detail?: Record<string, unknown>): void {
        const customEvent = new CustomEvent(event, { detail });

        this.eventListeners.get(event)?.forEach((callback) => {
            callback(customEvent);
        });

        // Also dispatch on container
        this.container.dispatchEvent(new CustomEvent(`grid:${event}`, { detail }));
    }
}

/**
 * GridManager handles multiple grid instances
 */
export class GridManager {
    private grids: Map<string, Grid> = new Map();
    private initialized: boolean = false;

    /**
     * Initialize all grids on the page
     */
    init(): void {
        if (this.initialized) return;

        // Find all grid containers
        document.querySelectorAll('[data-accelade-grid]').forEach((container) => {
            const element = container as HTMLElement;
            const config = this.parseConfig(element);
            this.createGrid(config);
        });

        // Initialize masonry grids
        this.initMasonry();

        this.initialized = true;
    }

    /**
     * Initialize masonry layouts
     */
    private initMasonry(): void {
        document.querySelectorAll('.masonry').forEach((grid) => {
            const element = grid as HTMLElement;

            if (!element.dataset.acceladeGrid) {
                // Simple masonry without full grid features
                new MasonryLayout(element, {
                    columns: parseInt(element.dataset.columns ?? '3'),
                    gap: parseInt(element.dataset.gap ?? '4') * 4,
                });
            }
        });
    }

    /**
     * Parse grid configuration from data attributes
     */
    private parseConfig(element: HTMLElement): GridConfig {
        return {
            container: element,
            masonry: element.dataset.masonry === 'true',
            infiniteScroll: element.dataset.infiniteScroll === 'true',
            itemsPerPage: element.dataset.perPage ? parseInt(element.dataset.perPage) : undefined,
            loadMoreUrl: element.dataset.loadMoreUrl,
            gap: element.dataset.gap,
            columns: element.dataset.columns ? parseInt(element.dataset.columns) : undefined,
            animation: {
                enabled: element.dataset.animate !== 'false',
                duration: element.dataset.animationDuration ? parseInt(element.dataset.animationDuration) : undefined,
                stagger: element.dataset.animationStagger ? parseInt(element.dataset.animationStagger) : undefined,
            },
        };
    }

    /**
     * Create a new grid instance
     */
    createGrid(config: GridConfig): Grid {
        const container = typeof config.container === 'string'
            ? document.querySelector(config.container) as HTMLElement
            : config.container;

        if (!container) {
            throw new Error('Grid container not found');
        }

        const grid = new GridInstance(container, config);
        grid.init();

        this.grids.set(grid.id, grid);
        return grid;
    }

    /**
     * Get a grid instance by ID
     */
    getGrid(id: string): Grid | undefined {
        return this.grids.get(id);
    }

    /**
     * Refresh all grids
     */
    refresh(): void {
        this.grids.forEach((grid) => {
            grid.refresh();
        });
    }

    /**
     * Destroy all grids
     */
    destroy(): void {
        this.grids.forEach((grid) => {
            grid.destroy();
        });
        this.grids.clear();
        this.initialized = false;
    }
}
