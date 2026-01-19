@props(['framework' => 'vanilla', 'prefix' => 'a', 'documentation' => null, 'hasDemo' => true])

@php
    app('accelade')->setFramework($framework);
@endphp

<x-accelade::layouts.docs :framework="$framework" section="tables-actions" :documentation="$documentation" :hasDemo="$hasDemo">
    @include('tables::demo.partials._actions', ['prefix' => $prefix])
</x-accelade::layouts.docs>
