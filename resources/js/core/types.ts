/**
 * Grid configuration options
 */
export interface GridConfig {
    /** Grid container element or selector */
    container: HTMLElement | string;
    /** Enable masonry layout */
    masonry?: boolean;
    /** Enable infinite scroll */
    infiniteScroll?: boolean;
    /** Items per page for infinite scroll */
    itemsPerPage?: number;
    /** URL for loading more items */
    loadMoreUrl?: string;
    /** Gap between items (Tailwind spacing scale) */
    gap?: string;
    /** Column configuration */
    columns?: number | ResponsiveColumns;
    /** Animation settings */
    animation?: AnimationConfig;
    /** Callback when items are loaded */
    onItemsLoaded?: (items: HTMLElement[]) => void;
    /** Callback when grid is initialized */
    onInit?: () => void;
}

/**
 * Responsive column configuration
 */
export interface ResponsiveColumns {
    default?: number;
    sm?: number;
    md?: number;
    lg?: number;
    xl?: number;
    '2xl'?: number;
}

/**
 * Animation configuration
 */
export interface AnimationConfig {
    /** Enable animations */
    enabled?: boolean;
    /** Animation duration in milliseconds */
    duration?: number;
    /** Animation easing function */
    easing?: string;
    /** Stagger delay between items */
    stagger?: number;
}

/**
 * Filter configuration
 */
export interface FilterConfig {
    /** Filter name/key */
    name: string;
    /** Filter value */
    value: string | number | boolean | string[];
    /** Filter operator */
    operator?: 'eq' | 'neq' | 'gt' | 'gte' | 'lt' | 'lte' | 'like' | 'in';
}

/**
 * Sort configuration
 */
export interface SortConfig {
    /** Column to sort by */
    column: string;
    /** Sort direction */
    direction: 'asc' | 'desc';
}

/**
 * Grid state
 */
export interface GridState {
    /** Current page */
    page: number;
    /** Items per page */
    perPage: number;
    /** Active filters */
    filters: FilterConfig[];
    /** Active sort */
    sort?: SortConfig;
    /** Search term */
    search?: string;
    /** Whether more items are available */
    hasMore: boolean;
    /** Whether loading is in progress */
    loading: boolean;
}

/**
 * Masonry item data
 */
export interface MasonryItem {
    element: HTMLElement;
    height: number;
    column: number;
    top: number;
}

/**
 * Event types
 */
export type GridEventType =
    | 'init'
    | 'destroy'
    | 'refresh'
    | 'filter:change'
    | 'sort:change'
    | 'search:change'
    | 'page:change'
    | 'items:load'
    | 'items:loaded'
    | 'layout:change';

/**
 * Event listener callback
 */
export type GridEventCallback = (event: CustomEvent) => void;

/**
 * Global Accelade interface extension
 */
declare global {
    interface Window {
        Accelade?: {
            on: (event: string, callback: () => void) => void;
            off: (event: string, callback: () => void) => void;
            emit: (event: string, data?: unknown) => void;
        };
        AcceladeGrids?: GridManager;
    }
}

/**
 * Grid manager interface
 */
export interface GridManager {
    init: () => void;
    refresh: () => void;
    destroy: () => void;
    createGrid: (config: GridConfig) => Grid;
    getGrid: (id: string) => Grid | undefined;
}

/**
 * Grid instance interface
 */
export interface Grid {
    id: string;
    container: HTMLElement;
    config: GridConfig;
    state: GridState;
    init: () => void;
    destroy: () => void;
    refresh: () => void;
    loadMore: () => Promise<void>;
    filter: (filters: FilterConfig[]) => void;
    sort: (sort: SortConfig) => void;
    search: (term: string) => void;
    on: (event: GridEventType, callback: GridEventCallback) => void;
    off: (event: GridEventType, callback: GridEventCallback) => void;
}
