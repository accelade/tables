/**
 * Accelade Tables Type Definitions
 */

/**
 * Table configuration options
 */
export interface TableConfig {
    striped?: boolean;
    hoverable?: boolean;
    bordered?: boolean;
    compact?: boolean;
    pollingInterval?: string | null;
    deferLoading?: boolean;
}

/**
 * Sort configuration
 */
export interface SortConfig {
    column: string;
    direction: 'asc' | 'desc';
}

/**
 * Column configuration
 */
export interface ColumnConfig {
    name: string;
    label: string;
    sortable: boolean;
    searchable: boolean;
    hidden: boolean;
    toggleable: boolean;
    width?: string;
    alignment: 'left' | 'center' | 'right';
}

/**
 * Bulk action state
 */
export interface BulkActionState {
    selectedKeys: string[];
    selectAll: boolean;
}

/**
 * Table element references
 */
export interface TableElements {
    container: HTMLElement;
    table: HTMLTableElement;
    selectAllCheckbox?: HTMLInputElement;
    rowCheckboxes: NodeListOf<HTMLInputElement>;
    bulkActionsBar?: HTMLElement;
    selectedCountElement?: HTMLElement;
}

/**
 * Sort header element
 */
export interface SortHeaderElement extends HTMLElement {
    dataset: DOMStringMap & {
        sort?: string;
        sortUrl?: string;
        sortColumn?: string;
        sortDirection?: string;
    };
}

/**
 * Event handler types
 */
export type SelectionChangeHandler = (selectedKeys: string[]) => void;
export type SortChangeHandler = (column: string, direction: 'asc' | 'desc') => void;

/**
 * Global Accelade interface extension
 */
declare global {
    interface Window {
        AcceladeTables: AcceladeTablesInterface;
        Accelade?: {
            on: (event: string, callback: () => void) => void;
        };
    }
}

/**
 * Main AcceladeTables interface
 */
export interface AcceladeTablesInterface {
    init(): void;
    initSorting(): void;
    initSelection(): void;
    updateBulkActionsBar(table: HTMLTableElement): void;
    getSelectedKeys(table: HTMLTableElement): string[];
}
