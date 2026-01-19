@props([
    'grid' => null,
    'records' => null,
])

@php
    $styles = config('grids.styles');
    $records = $records ?? $grid?->getRecords();
    $columnClasses = $grid->getColumnClasses();
    $gapClasses = $grid->getGapClasses();
    $isMasonry = $grid->isMasonry();
    $isList = $grid->isList();
@endphp

<div {{ $attributes->class(['accelade-grid-container']) }}>
    {{-- Header --}}
    @if($grid->getHeading() || $grid->hasHeaderActions())
        <div class="mb-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    @if($grid->getHeading())
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $grid->getHeading() }}
                        </h2>
                    @endif
                    @if($grid->getDescription())
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            {{ $grid->getDescription() }}
                        </p>
                    @endif
                </div>

                <div class="flex items-center gap-4">
                    {{-- Search --}}
                    @if(!empty($grid->getSearchColumns()))
                        <div class="relative">
                            <input
                                type="text"
                                name="{{ $grid->getSearchInputName() }}"
                                value="{{ $grid->getSearchTerm() }}"
                                placeholder="Search..."
                                class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm dark:bg-gray-800 dark:border-gray-600 dark:text-white pl-10"
                            />
                            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                                <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                                </svg>
                            </div>
                        </div>
                    @endif

                    {{-- Header Actions --}}
                    @if($grid->hasHeaderActions())
                        <div class="flex items-center gap-2">
                            @foreach($grid->getHeaderActions() as $action)
                                {!! $action->render() !!}
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- Filters --}}
            @if(!empty($grid->getFilters()))
                <div class="mt-4 flex flex-wrap gap-4">
                    @foreach($grid->getFilters() as $filter)
                        @if(!$filter->isHidden())
                            {!! $filter->render() !!}
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    @endif

    {{-- Grid Content --}}
    @if($records->count() > 0)
        <div @class([
            $styles['grid'] ?? 'grid',
            $columnClasses,
            $gapClasses,
            'masonry' => $isMasonry,
        ])>
            @foreach($records as $record)
                {!! $grid->getCardForRecord($record)->render() !!}
            @endforeach
        </div>
    @else
        {{-- Empty State --}}
        <div class="text-center py-12">
            @if($grid->getEmptyStateIcon())
                <div class="mx-auto h-12 w-12 text-gray-400 mb-4">
                    {!! $grid->getEmptyStateIcon() !!}
                </div>
            @else
                <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 13.5h3.86a2.25 2.25 0 012.012 1.244l.256.512a2.25 2.25 0 002.013 1.244h3.218a2.25 2.25 0 002.013-1.244l.256-.512a2.25 2.25 0 012.013-1.244h3.859m-19.5.338V18a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18v-4.162c0-.224-.034-.447-.1-.661L19.24 5.338a2.25 2.25 0 00-2.15-1.588H6.911a2.25 2.25 0 00-2.15 1.588L2.35 13.177a2.25 2.25 0 00-.1.661z" />
                </svg>
            @endif
            <h3 class="text-sm font-medium text-gray-900 dark:text-white">
                {{ $grid->getEmptyStateHeading() }}
            </h3>
            @if($grid->getEmptyStateDescription())
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    {{ $grid->getEmptyStateDescription() }}
                </p>
            @endif
            @if($grid->hasEmptyStateActions())
                <div class="mt-4 flex justify-center gap-2">
                    @foreach($grid->getEmptyStateActions() as $action)
                        {!! $action->render() !!}
                    @endforeach
                </div>
            @endif
        </div>
    @endif

    {{-- Pagination --}}
    @if($grid->isPaginationEnabled() && $records instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator && $records->hasPages())
        <div class="mt-6">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="text-sm text-gray-700 dark:text-gray-300">
                    Showing
                    <span class="font-medium">{{ $records->firstItem() }}</span>
                    to
                    <span class="font-medium">{{ $records->lastItem() }}</span>
                    of
                    <span class="font-medium">{{ $records->total() }}</span>
                    items
                </div>

                <div>
                    {{ $records->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
