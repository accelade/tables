{{-- Tables CSS --}}
<style>
.accelade-table-container {
    /* Container styles */
}

/* Sortable column hover */
[data-sort] {
    transition: background-color 0.15s ease;
}

/* Row selection highlight */
tr:has([data-select-row]:checked) {
    background-color: rgb(239 246 255) !important;
}

.dark tr:has([data-select-row]:checked) {
    background-color: rgb(30 58 138 / 0.2) !important;
}

/* Responsive table */
@media (max-width: 640px) {
    .accelade-table-container table {
        display: block;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }
}
</style>
