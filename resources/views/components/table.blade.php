@props([
    'table' => null,
    'records' => null,
])

@php
    $styles = config('tables.styles');
    $records = $records ?? $table?->getRecords();
    $columns = $table->getVisibleColumns();
    $hasActions = $table->hasActions();
    $hasBulkActions = $table->hasBulkActions();
    $isSelectable = $table->isSelectable();
    $striped = $table->isStriped();
    $hoverable = $table->isHoverable();
    $compact = $table->isCompact();

    // Get framework prefix
    $framework = app('accelade')->getFramework();
@endphp

<div {{ $attributes->class(['accelade-table-container', $styles['container'] ?? '']) }}>
    {{-- Header --}}
    @if($table->getHeading() || $table->hasHeaderActions() || $table->shouldShowSearchInHeader())
        <div class="px-6 py-4 border-b border-gray-200 dark:border-gray-700">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    @if($table->getHeading())
                        <h2 class="text-lg font-semibold text-gray-900 dark:text-white">
                            {{ $table->getHeading() }}
                        </h2>
                    @endif
                    @if($table->getDescription())
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                            {{ $table->getDescription() }}
                        </p>
                    @endif
                </div>

                <div class="flex items-center gap-4">
                    {{-- Search --}}
                    @if($table->shouldShowSearchInHeader() && !empty($table->getSearchColumns()))
                        <div class="relative">
                            <input
                                type="text"
                                name="{{ $table->getSearchInputName() }}"
                                value="{{ $table->getSearchTerm() }}"
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
                    @if($table->hasHeaderActions())
                        <div class="flex items-center gap-2">
                            @foreach($table->getHeaderActions() as $action)
                                {!! $action->render() !!}
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            {{-- Filters --}}
            @if($table->shouldShowFiltersInHeader() && !empty($table->getFilters()))
                <div class="mt-4 flex flex-wrap gap-4">
                    @foreach($table->getFilters() as $filter)
                        @if(!$filter->isHidden())
                            {!! $filter->render() !!}
                        @endif
                    @endforeach
                </div>
            @endif
        </div>
    @endif

    {{-- Bulk Actions Bar --}}
    @if($hasBulkActions)
        <div class="hidden px-6 py-3 bg-blue-50 dark:bg-blue-900/20 border-b border-blue-200 dark:border-blue-800" data-bulk-actions>
            <div class="flex items-center gap-4">
                <span class="text-sm text-blue-700 dark:text-blue-300">
                    <span data-selected-count>0</span> selected
                </span>
                <div class="flex items-center gap-2">
                    @foreach($table->getVisibleBulkActions() as $action)
                        {!! $action->render() !!}
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    {{-- Table --}}
    <div class="overflow-x-auto">
        <table class="{{ $styles['table'] ?? '' }}">
            <thead class="{{ $styles['thead'] ?? '' }}">
                <tr>
                    {{-- Checkbox Column --}}
                    @if($isSelectable)
                        <th scope="col" class="relative px-6 py-3 w-12">
                            <input
                                type="checkbox"
                                class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                data-select-all
                            />
                        </th>
                    @endif

                    {{-- Data Columns --}}
                    @foreach($columns as $column)
                        <th
                            scope="col"
                            @class([
                                $styles['th'] ?? '',
                                $styles['th_sortable'] ?? '' => $column->isSortable(),
                                'text-left' => $column->getAlignment() === 'left',
                                'text-center' => $column->getAlignment() === 'center',
                                'text-right' => $column->getAlignment() === 'right',
                            ])
                            @if($column->getWidth()) style="width: {{ $column->getWidth() }}" @endif
                            @if($column->isSortable())
                                data-sort="{{ $column->getName() }}"
                                data-sort-url="{{ $table->getSortUrl($column->getName()) }}"
                            @endif
                        >
                            <div class="flex items-center gap-1">
                                <span>{{ $column->getLabel() }}</span>
                                @if($column->isSortable())
                                    <span class="ml-1">
                                        @if($table->isSortedAsc($column->getName()))
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 15.75l7.5-7.5 7.5 7.5" />
                                            </svg>
                                        @elseif($table->isSortedDesc($column->getName()))
                                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                            </svg>
                                        @else
                                            <svg class="h-4 w-4 opacity-30" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9" />
                                            </svg>
                                        @endif
                                    </span>
                                @endif
                            </div>
                        </th>
                    @endforeach

                    {{-- Actions Column --}}
                    @if($hasActions && !$table->isActionsColumnHidden())
                        <th scope="col" class="{{ $styles['th'] ?? '' }} text-right">
                            {{ $table->getActionsColumnLabel() }}
                        </th>
                    @endif
                </tr>
            </thead>

            <tbody class="{{ $styles['tbody'] ?? '' }}">
                @forelse($records as $record)
                    @php
                        $recordKey = data_get($record, $table->getRecordKey());
                        $recordUrl = $table->getRecordUrl($record);
                    @endphp
                    <tr
                        data-record-key="{{ $recordKey }}"
                        @class([
                            $styles['tr'] ?? '',
                            $styles['tr_hover'] ?? '' => $hoverable,
                            $styles['tr_striped'] ?? '' => $striped,
                            'cursor-pointer' => $recordUrl,
                        ])
                        @if($recordUrl) onclick="window.location='{{ $recordUrl }}'" @endif
                    >
                        {{-- Checkbox --}}
                        @if($isSelectable)
                            <td class="relative px-6 py-4 w-12" onclick="event.stopPropagation()">
                                <input
                                    type="checkbox"
                                    value="{{ $recordKey }}"
                                    class="absolute left-4 top-1/2 -mt-2 h-4 w-4 rounded border-gray-300 text-blue-600 focus:ring-blue-500"
                                    data-select-row
                                />
                            </td>
                        @endif

                        {{-- Data Cells --}}
                        @foreach($columns as $column)
                            <td
                                @class([
                                    $styles['td'] ?? '',
                                    'py-2' => $compact,
                                    'text-left' => $column->getAlignment() === 'left',
                                    'text-center' => $column->getAlignment() === 'center',
                                    'text-right' => $column->getAlignment() === 'right',
                                    'whitespace-normal' => $column->shouldWrap(),
                                ])
                            >
                                {!! $column->render($record) !!}
                            </td>
                        @endforeach

                        {{-- Actions --}}
                        @if($hasActions && !$table->isActionsColumnHidden())
                            <td class="{{ $styles['td'] ?? '' }} text-right" onclick="event.stopPropagation()">
                                <div class="flex items-center justify-end gap-2">
                                    @foreach($table->getVisibleActions($record) as $action)
                                        {!! $action->render($record) !!}
                                    @endforeach
                                </div>
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td
                            colspan="{{ count($columns) + ($isSelectable ? 1 : 0) + ($hasActions ? 1 : 0) }}"
                            class="{{ $styles['empty_state'] ?? '' }}"
                        >
                            @if($table->getEmptyStateIcon())
                                <div class="mx-auto h-12 w-12 text-gray-400 mb-4">
                                    {!! $table->getEmptyStateIcon() !!}
                                </div>
                            @endif
                            <h3 class="text-sm font-medium text-gray-900 dark:text-white">
                                {{ $table->getEmptyStateHeading() }}
                            </h3>
                            @if($table->getEmptyStateDescription())
                                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                                    {{ $table->getEmptyStateDescription() }}
                                </p>
                            @endif
                            @if($table->hasEmptyStateActions())
                                <div class="mt-4 flex justify-center gap-2">
                                    @foreach($table->getEmptyStateActions() as $action)
                                        {!! $action->render() !!}
                                    @endforeach
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($table->isPaginationEnabled() && $records instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator && $records->hasPages())
        <div class="{{ $styles['pagination'] ?? '' }}">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div class="text-sm text-gray-700 dark:text-gray-300">
                    Showing
                    <span class="font-medium">{{ $records->firstItem() }}</span>
                    to
                    <span class="font-medium">{{ $records->lastItem() }}</span>
                    of
                    <span class="font-medium">{{ $records->total() }}</span>
                    results
                </div>

                <div>
                    {{ $records->links() }}
                </div>
            </div>
        </div>
    @endif
</div>
