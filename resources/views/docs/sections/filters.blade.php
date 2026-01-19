@props(['framework' => 'vanilla', 'prefix' => 'a', 'documentation' => null, 'hasDemo' => true])

@php
    app('accelade')->setFramework($framework);
@endphp

<x-accelade::layouts.docs :framework="$framework" section="tables-filters" :documentation="$documentation" :hasDemo="$hasDemo">
    @include('tables::demo.partials._filters', ['prefix' => $prefix])
</x-accelade::layouts.docs>
