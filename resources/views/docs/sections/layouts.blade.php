@props(['framework' => 'vanilla', 'prefix' => 'a', 'documentation' => null, 'hasDemo' => true])

@php
    app('accelade')->setFramework($framework);
@endphp

<x-accelade::layouts.docs :framework="$framework" section="grids-layouts" :documentation="$documentation" :hasDemo="$hasDemo">
    @include('grids::demo.partials._layouts', ['prefix' => $prefix])
</x-accelade::layouts.docs>
