{{-- Tables JavaScript --}}
<script>
window.AcceladeTables = window.AcceladeTables || {
    init: function() {
        this.initSorting();
        this.initSelection();
    },

    initSorting: function() {
        document.querySelectorAll('[data-sort]').forEach(function(th) {
            th.addEventListener('click', function() {
                const url = th.getAttribute('data-sort-url');
                if (url) {
                    window.location.href = url;
                }
            });
        });
    },

    initSelection: function() {
        document.querySelectorAll('[data-select-all]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const table = checkbox.closest('table');
                const checkboxes = table.querySelectorAll('[data-select-row]');
                checkboxes.forEach(function(cb) {
                    cb.checked = checkbox.checked;
                });
                AcceladeTables.updateBulkActionsBar(table);
            });
        });

        document.querySelectorAll('[data-select-row]').forEach(function(checkbox) {
            checkbox.addEventListener('change', function() {
                const table = checkbox.closest('table');
                AcceladeTables.updateBulkActionsBar(table);
            });
        });
    },

    updateBulkActionsBar: function(table) {
        const container = table.closest('.accelade-table-container');
        const bulkActionsBar = container.querySelector('[data-bulk-actions]');
        const selectedCountEl = container.querySelector('[data-selected-count]');

        if (!bulkActionsBar) return;

        const selected = table.querySelectorAll('[data-select-row]:checked');
        const count = selected.length;

        if (count > 0) {
            bulkActionsBar.classList.remove('hidden');
            if (selectedCountEl) selectedCountEl.textContent = count;
        } else {
            bulkActionsBar.classList.add('hidden');
        }
    },

    getSelectedKeys: function(table) {
        const selected = table.querySelectorAll('[data-select-row]:checked');
        return Array.from(selected).map(function(cb) {
            return cb.value;
        });
    }
};

document.addEventListener('DOMContentLoaded', function() {
    window.AcceladeTables.init();
});

// Re-init after SPA navigation
if (window.Accelade) {
    window.Accelade.on('navigate:end', function() {
        window.AcceladeTables.init();
    });
}
</script>
