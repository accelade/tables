/**
 * Accelade Tables - Table Manager
 * Handles table sorting, selection, and bulk actions
 */

import type {
    TableElements,
    SortHeaderElement,
    SelectionChangeHandler,
    BulkActionState,
} from '../types';

/**
 * TableManager handles individual table instances
 */
export class TableManager {
    private container: HTMLElement;
    private table: HTMLTableElement;
    private selectAllCheckbox: HTMLInputElement | null = null;
    private rowCheckboxes: NodeListOf<HTMLInputElement>;
    private bulkActionsBar: HTMLElement | null = null;
    private selectedCountElement: HTMLElement | null = null;
    private selectionChangeHandlers: SelectionChangeHandler[] = [];

    constructor(container: HTMLElement) {
        this.container = container;
        const table = container.querySelector('table');
        if (!table) {
            throw new Error('No table element found in container');
        }
        this.table = table;
        this.rowCheckboxes = this.table.querySelectorAll<HTMLInputElement>('[data-select-row]');
        this.initElements();
    }

    /**
     * Initialize element references
     */
    private initElements(): void {
        this.selectAllCheckbox = this.table.querySelector<HTMLInputElement>('[data-select-all]');
        this.bulkActionsBar = this.container.querySelector<HTMLElement>('[data-bulk-actions]');
        this.selectedCountElement = this.container.querySelector<HTMLElement>('[data-selected-count]');
    }

    /**
     * Initialize sorting functionality
     */
    initSorting(): void {
        const sortHeaders = this.table.querySelectorAll<SortHeaderElement>('[data-sort]');

        sortHeaders.forEach((th) => {
            th.style.cursor = 'pointer';
            th.addEventListener('click', () => this.handleSortClick(th));
        });
    }

    /**
     * Handle sort header click
     */
    private handleSortClick(th: SortHeaderElement): void {
        const url = th.dataset.sortUrl;
        if (url) {
            window.location.href = url;
        }
    }

    /**
     * Initialize row selection functionality
     */
    initSelection(): void {
        // Select all checkbox
        if (this.selectAllCheckbox) {
            this.selectAllCheckbox.addEventListener('change', () => {
                this.toggleSelectAll(this.selectAllCheckbox!.checked);
            });
        }

        // Individual row checkboxes
        this.rowCheckboxes.forEach((checkbox) => {
            checkbox.addEventListener('change', () => {
                this.updateSelectionState();
            });
        });
    }

    /**
     * Toggle select all rows
     */
    private toggleSelectAll(checked: boolean): void {
        this.rowCheckboxes.forEach((checkbox) => {
            checkbox.checked = checked;
        });
        this.updateSelectionState();
    }

    /**
     * Update selection state and UI
     */
    private updateSelectionState(): void {
        const selectedKeys = this.getSelectedKeys();
        const count = selectedKeys.length;
        const totalRows = this.rowCheckboxes.length;

        // Update select all checkbox state
        if (this.selectAllCheckbox) {
            this.selectAllCheckbox.checked = count === totalRows && totalRows > 0;
            this.selectAllCheckbox.indeterminate = count > 0 && count < totalRows;
        }

        // Update bulk actions bar
        this.updateBulkActionsBar(count);

        // Notify handlers
        this.selectionChangeHandlers.forEach((handler) => handler(selectedKeys));
    }

    /**
     * Update bulk actions bar visibility and count
     */
    private updateBulkActionsBar(count: number): void {
        if (!this.bulkActionsBar) return;

        if (count > 0) {
            this.bulkActionsBar.classList.remove('hidden');
            if (this.selectedCountElement) {
                this.selectedCountElement.textContent = String(count);
            }
        } else {
            this.bulkActionsBar.classList.add('hidden');
        }
    }

    /**
     * Get currently selected row keys
     */
    getSelectedKeys(): string[] {
        const selected = this.table.querySelectorAll<HTMLInputElement>('[data-select-row]:checked');
        return Array.from(selected).map((cb) => cb.value);
    }

    /**
     * Select rows by keys
     */
    selectRows(keys: string[]): void {
        this.rowCheckboxes.forEach((checkbox) => {
            checkbox.checked = keys.includes(checkbox.value);
        });
        this.updateSelectionState();
    }

    /**
     * Clear all selections
     */
    clearSelection(): void {
        this.rowCheckboxes.forEach((checkbox) => {
            checkbox.checked = false;
        });
        this.updateSelectionState();
    }

    /**
     * Register selection change handler
     */
    onSelectionChange(handler: SelectionChangeHandler): void {
        this.selectionChangeHandlers.push(handler);
    }

    /**
     * Get the table element
     */
    getTable(): HTMLTableElement {
        return this.table;
    }

    /**
     * Get the container element
     */
    getContainer(): HTMLElement {
        return this.container;
    }

    /**
     * Get selection state
     */
    getSelectionState(): BulkActionState {
        const selectedKeys = this.getSelectedKeys();
        return {
            selectedKeys,
            selectAll: selectedKeys.length === this.rowCheckboxes.length && this.rowCheckboxes.length > 0,
        };
    }
}
