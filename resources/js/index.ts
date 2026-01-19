/**
 * Accelade Grids - Card-based grid layouts for Laravel
 *
 * @package @accelade/grids
 */

import { GridManager } from './core/GridManager';
import { MasonryLayout } from './core/MasonryLayout';
import { InfiniteScroll } from './core/InfiniteScroll';

// Export types
export type {
    GridConfig,
    GridState,
    FilterConfig,
    SortConfig,
    GridEventType,
    GridEventCallback,
    Grid,
    GridManager as GridManagerInterface,
    ResponsiveColumns,
    AnimationConfig,
    MasonryItem,
} from './core/types';

// Export classes
export { GridManager, MasonryLayout, InfiniteScroll };

// Create global instance
const gridsManager = new GridManager();

// Auto-initialize on DOM ready
if (typeof document !== 'undefined') {
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            gridsManager.init();
        });
    } else {
        gridsManager.init();
    }

    // Re-init after SPA navigation
    if (window.Accelade) {
        window.Accelade.on('navigate:end', () => {
            gridsManager.refresh();
        });
    }
}

// Expose global API
window.AcceladeGrids = gridsManager;

// Default export
export default gridsManager;
