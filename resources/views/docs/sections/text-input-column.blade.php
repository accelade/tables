@props(['framework' => 'vanilla', 'prefix' => 'a', 'documentation' => null, 'hasDemo' => true])

@php
    app('accelade')->setFramework($framework);
@endphp

<x-accelade::layouts.docs :framework="$framework" section="tables-text-input-column" :documentation="$documentation" :hasDemo="$hasDemo">
    @include('tables::demo.partials._text-input-column', ['prefix' => $prefix])
</x-accelade::layouts.docs>
