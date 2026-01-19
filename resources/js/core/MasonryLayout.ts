import type { MasonryItem, ResponsiveColumns } from './types';

/**
 * MasonryLayout handles Pinterest-style staggered grid layouts.
 * It calculates positions for items of varying heights.
 */
export class MasonryLayout {
    private container: HTMLElement;
    private items: MasonryItem[] = [];
    private columnHeights: number[] = [];
    private columnCount: number = 3;
    private gap: number = 16;
    private resizeObserver: ResizeObserver | null = null;
    private mutationObserver: MutationObserver | null = null;

    constructor(container: HTMLElement, options: {
        columns?: number | ResponsiveColumns;
        gap?: number;
    } = {}) {
        this.container = container;
        this.gap = options.gap ?? 16;

        if (typeof options.columns === 'number') {
            this.columnCount = options.columns;
        } else if (options.columns) {
            this.columnCount = this.getResponsiveColumns(options.columns);
        }

        this.init();
    }

    /**
     * Initialize the masonry layout
     */
    private init(): void {
        this.setupContainer();
        this.observeResize();
        this.observeMutations();
        this.layout();
    }

    /**
     * Setup container styles
     */
    private setupContainer(): void {
        this.container.style.position = 'relative';
    }

    /**
     * Get responsive column count based on viewport width
     */
    private getResponsiveColumns(columns: ResponsiveColumns): number {
        const width = window.innerWidth;

        if (width >= 1536 && columns['2xl']) return columns['2xl'];
        if (width >= 1280 && columns.xl) return columns.xl;
        if (width >= 1024 && columns.lg) return columns.lg;
        if (width >= 768 && columns.md) return columns.md;
        if (width >= 640 && columns.sm) return columns.sm;

        return columns.default ?? 1;
    }

    /**
     * Observe container resize
     */
    private observeResize(): void {
        this.resizeObserver = new ResizeObserver(() => {
            this.layout();
        });

        this.resizeObserver.observe(this.container);
    }

    /**
     * Observe DOM mutations for dynamically added items
     */
    private observeMutations(): void {
        this.mutationObserver = new MutationObserver((mutations) => {
            let needsLayout = false;

            for (const mutation of mutations) {
                if (mutation.type === 'childList') {
                    needsLayout = true;
                    break;
                }
            }

            if (needsLayout) {
                this.layout();
            }
        });

        this.mutationObserver.observe(this.container, {
            childList: true,
            subtree: false,
        });
    }

    /**
     * Calculate and apply masonry layout
     */
    layout(): void {
        const children = Array.from(this.container.children) as HTMLElement[];

        if (children.length === 0) return;

        // Reset column heights
        this.columnHeights = new Array(this.columnCount).fill(0);
        this.items = [];

        // Calculate container width and column width
        const containerWidth = this.container.offsetWidth;
        const totalGap = this.gap * (this.columnCount - 1);
        const columnWidth = (containerWidth - totalGap) / this.columnCount;

        // Position each item
        children.forEach((child) => {
            // Find the shortest column
            const shortestColumn = this.getShortestColumn();
            const x = shortestColumn * (columnWidth + this.gap);
            const y = this.columnHeights[shortestColumn];

            // Position the item
            child.style.position = 'absolute';
            child.style.width = `${columnWidth}px`;
            child.style.left = `${x}px`;
            child.style.top = `${y}px`;
            child.style.transition = 'all 0.3s ease';

            // Get item height after positioning
            const height = child.offsetHeight;

            // Update column height
            this.columnHeights[shortestColumn] += height + this.gap;

            // Store item data
            this.items.push({
                element: child,
                height,
                column: shortestColumn,
                top: y,
            });
        });

        // Set container height
        const maxHeight = Math.max(...this.columnHeights);
        this.container.style.height = `${maxHeight}px`;
    }

    /**
     * Get the index of the shortest column
     */
    private getShortestColumn(): number {
        let minHeight = Infinity;
        let shortestColumn = 0;

        this.columnHeights.forEach((height, index) => {
            if (height < minHeight) {
                minHeight = height;
                shortestColumn = index;
            }
        });

        return shortestColumn;
    }

    /**
     * Update column count
     */
    setColumns(columns: number | ResponsiveColumns): void {
        if (typeof columns === 'number') {
            this.columnCount = columns;
        } else {
            this.columnCount = this.getResponsiveColumns(columns);
        }
        this.layout();
    }

    /**
     * Update gap
     */
    setGap(gap: number): void {
        this.gap = gap;
        this.layout();
    }

    /**
     * Get items data
     */
    getItems(): MasonryItem[] {
        return this.items;
    }

    /**
     * Refresh layout (recalculate all positions)
     */
    refresh(): void {
        this.layout();
    }

    /**
     * Destroy the masonry layout
     */
    destroy(): void {
        if (this.resizeObserver) {
            this.resizeObserver.disconnect();
            this.resizeObserver = null;
        }

        if (this.mutationObserver) {
            this.mutationObserver.disconnect();
            this.mutationObserver = null;
        }

        // Reset container styles
        this.container.style.position = '';
        this.container.style.height = '';

        // Reset item styles
        this.items.forEach((item) => {
            item.element.style.position = '';
            item.element.style.width = '';
            item.element.style.left = '';
            item.element.style.top = '';
            item.element.style.transition = '';
        });

        this.items = [];
        this.columnHeights = [];
    }
}
