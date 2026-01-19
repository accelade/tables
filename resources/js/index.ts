/**
 * Accelade Tables
 * Table components for Laravel with sorting, filtering, and pagination
 *
 * @package accelade/tables
 */

// Export types
export type {
    TableConfig,
    SortConfig,
    ColumnConfig,
    BulkActionState,
    TableElements,
    SortHeaderElement,
    SelectionChangeHandler,
    SortChangeHandler,
    AcceladeTablesInterface,
} from './types';

// Export core modules
export { TableManager } from './core/TableManager';
export { AcceladeTables } from './core/AcceladeTables';

// Import for side effects (global registration)
import { AcceladeTables } from './core/AcceladeTables';

// Register globally
if (typeof window !== 'undefined') {
    window.AcceladeTables = AcceladeTables;

    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', () => {
            AcceladeTables.init();
        });
    } else {
        AcceladeTables.init();
    }

    // Re-init after SPA navigation (for Accelade core integration)
    if (window.Accelade) {
        window.Accelade.on('navigate:end', () => {
            AcceladeTables.init();
        });
    }

    // Also listen for custom events for other SPA frameworks
    document.addEventListener('accelade:navigate:end', () => {
        AcceladeTables.init();
    });
}
