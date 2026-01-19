{{-- Grids CSS --}}
<style>
.accelade-grid-container {
    /* Container styles */
}

/* Masonry layout using CSS columns */
.masonry {
    column-gap: 1.5rem;
}

.masonry > * {
    break-inside: avoid;
    margin-bottom: 1.5rem;
}

@media (min-width: 640px) {
    .masonry.grid-cols-1.sm\:grid-cols-2 {
        column-count: 2;
    }
}

@media (min-width: 1024px) {
    .masonry.grid-cols-1.sm\:grid-cols-2.lg\:grid-cols-3 {
        column-count: 3;
    }
    .masonry.grid-cols-1.sm\:grid-cols-2.lg\:grid-cols-4 {
        column-count: 4;
    }
}

/* Card hover effects */
.accelade-card-hoverable {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.accelade-card-hoverable:hover {
    transform: translateY(-2px);
}
</style>
