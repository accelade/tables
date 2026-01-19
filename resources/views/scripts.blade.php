{{-- Tables JavaScript - Compiled from TypeScript --}}
<script data-accelade-tables-script>
@php
    $distPath = __DIR__ . '/../../dist/tables.iife.js';
    if (file_exists($distPath)) {
        echo file_get_contents($distPath);
    } else {
        echo '// Accelade Tables: Please run "npm run build" in packages/tables directory';
    }
@endphp
</script>
