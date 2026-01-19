{{-- Grids JavaScript --}}
<script>
window.AcceladeGrids = window.AcceladeGrids || {
    init: function() {
        this.initMasonry();
    },

    initMasonry: function() {
        // Simple masonry layout using CSS columns
        document.querySelectorAll('.masonry').forEach(function(grid) {
            // Masonry is handled via CSS, but we can add JS enhancements here if needed
        });
    },

    refresh: function() {
        this.init();
    }
};

document.addEventListener('DOMContentLoaded', function() {
    window.AcceladeGrids.init();
});

// Re-init after SPA navigation
if (window.Accelade) {
    window.Accelade.on('navigate:end', function() {
        window.AcceladeGrids.init();
    });
}
</script>
