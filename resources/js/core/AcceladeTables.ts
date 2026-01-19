/**
 * Accelade Tables - Main Entry Point
 * Global table management and initialization
 */

import { TableManager } from './TableManager';
import type { AcceladeTablesInterface } from '../types';

/**
 * AcceladeTables global manager
 */
class AcceladeTablesClass implements AcceladeTablesInterface {
    private tables: Map<HTMLElement, TableManager> = new Map();
    private initialized = false;

    /**
     * Initialize all tables on the page
     */
    init(): void {
        this.initSorting();
        this.initSelection();
        this.initialized = true;
    }

    /**
     * Initialize sorting for all tables
     */
    initSorting(): void {
        document.querySelectorAll<HTMLElement>('[data-sort]').forEach((th) => {
            // Skip if already initialized
            if (th.dataset.sortInitialized) return;
            th.dataset.sortInitialized = 'true';

            th.style.cursor = 'pointer';
            th.addEventListener('click', () => {
                const url = th.dataset.sortUrl;
                if (url) {
                    window.location.href = url;
                }
            });
        });
    }

    /**
     * Initialize selection for all tables
     */
    initSelection(): void {
        // Select all checkboxes
        document.querySelectorAll<HTMLInputElement>('[data-select-all]').forEach((checkbox) => {
            // Skip if already initialized
            if (checkbox.dataset.selectInitialized) return;
            checkbox.dataset.selectInitialized = 'true';

            checkbox.addEventListener('change', () => {
                const table = checkbox.closest('table');
                if (!table) return;

                const checkboxes = table.querySelectorAll<HTMLInputElement>('[data-select-row]');
                checkboxes.forEach((cb) => {
                    cb.checked = checkbox.checked;
                });
                this.updateBulkActionsBar(table);
            });
        });

        // Individual row checkboxes
        document.querySelectorAll<HTMLInputElement>('[data-select-row]').forEach((checkbox) => {
            // Skip if already initialized
            if (checkbox.dataset.rowSelectInitialized) return;
            checkbox.dataset.rowSelectInitialized = 'true';

            checkbox.addEventListener('change', () => {
                const table = checkbox.closest('table');
                if (table) {
                    this.updateSelectAllState(table);
                    this.updateBulkActionsBar(table);
                }
            });
        });
    }

    /**
     * Update the select all checkbox state based on row selections
     */
    private updateSelectAllState(table: HTMLTableElement): void {
        const selectAll = table.querySelector<HTMLInputElement>('[data-select-all]');
        if (!selectAll) return;

        const rowCheckboxes = table.querySelectorAll<HTMLInputElement>('[data-select-row]');
        const checkedCount = table.querySelectorAll<HTMLInputElement>('[data-select-row]:checked').length;
        const totalCount = rowCheckboxes.length;

        selectAll.checked = checkedCount === totalCount && totalCount > 0;
        selectAll.indeterminate = checkedCount > 0 && checkedCount < totalCount;
    }

    /**
     * Update bulk actions bar visibility and count
     */
    updateBulkActionsBar(table: HTMLTableElement): void {
        const container = table.closest('.accelade-table-container') || table.parentElement;
        if (!container) return;

        const bulkActionsBar = container.querySelector<HTMLElement>('[data-bulk-actions]');
        const selectedCountEl = container.querySelector<HTMLElement>('[data-selected-count]');

        if (!bulkActionsBar) return;

        const selected = table.querySelectorAll<HTMLInputElement>('[data-select-row]:checked');
        const count = selected.length;

        if (count > 0) {
            bulkActionsBar.classList.remove('hidden');
            if (selectedCountEl) {
                selectedCountEl.textContent = String(count);
            }
        } else {
            bulkActionsBar.classList.add('hidden');
        }
    }

    /**
     * Get selected row keys from a table
     */
    getSelectedKeys(table: HTMLTableElement): string[] {
        const selected = table.querySelectorAll<HTMLInputElement>('[data-select-row]:checked');
        return Array.from(selected).map((cb) => cb.value);
    }

    /**
     * Get or create a TableManager for a container
     */
    getTableManager(container: HTMLElement): TableManager {
        if (!this.tables.has(container)) {
            const manager = new TableManager(container);
            manager.initSorting();
            manager.initSelection();
            this.tables.set(container, manager);
        }
        return this.tables.get(container)!;
    }

    /**
     * Clear a table's selection
     */
    clearSelection(table: HTMLTableElement): void {
        const checkboxes = table.querySelectorAll<HTMLInputElement>('[data-select-row]');
        checkboxes.forEach((cb) => {
            cb.checked = false;
        });

        const selectAll = table.querySelector<HTMLInputElement>('[data-select-all]');
        if (selectAll) {
            selectAll.checked = false;
            selectAll.indeterminate = false;
        }

        this.updateBulkActionsBar(table);
    }

    /**
     * Select specific rows by keys
     */
    selectRows(table: HTMLTableElement, keys: string[]): void {
        const checkboxes = table.querySelectorAll<HTMLInputElement>('[data-select-row]');
        checkboxes.forEach((cb) => {
            cb.checked = keys.includes(cb.value);
        });

        this.updateSelectAllState(table);
        this.updateBulkActionsBar(table);
    }

    /**
     * Refresh/reinitialize tables
     */
    refresh(): void {
        this.init();
    }

    /**
     * Check if initialized
     */
    isInitialized(): boolean {
        return this.initialized;
    }
}

// Create and export singleton instance
export const AcceladeTables = new AcceladeTablesClass();
