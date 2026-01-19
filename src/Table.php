<?php

declare(strict_types=1);

namespace Accelade\Tables;

use Accelade\QueryBuilder\Concerns\HasFilters;
use Accelade\QueryBuilder\Concerns\HasPagination;
use Accelade\QueryBuilder\Concerns\HasSearch;
use Accelade\QueryBuilder\Concerns\HasSorting;
use Accelade\Tables\Columns\Column;
use Accelade\Tables\Concerns\HasActions;
use Accelade\Tables\Concerns\HasBulkActions;
use Accelade\Tables\Concerns\HasEmptyState;
use Accelade\Tables\Concerns\HasHeader;
use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Conditionable;

/**
 * Main table class.
 */
class Table
{
    use Conditionable;
    use HasActions;
    use HasBulkActions;
    use HasEmptyState;
    use HasFilters;
    use HasHeader;
    use HasPagination;
    use HasSearch;
    use HasSorting;

    protected ?string $name = null;

    protected ?Builder $query = null;

    /**
     * @var array<Column>
     */
    protected array $columns = [];

    protected ?string $recordKey = 'id';

    protected ?Closure $recordUrl = null;

    protected bool $striped = false;

    protected bool $hoverable = true;

    protected bool $bordered = false;

    protected bool $compact = false;

    protected ?string $pollingInterval = null;

    protected bool $deferLoading = false;

    protected array $extraAttributes = [];

    /**
     * Create a new table instance.
     */
    public function __construct(?string $name = null)
    {
        $this->name = $name;
    }

    /**
     * Create a new table instance.
     */
    public static function make(?string $name = null): static
    {
        return new static($name);
    }

    /**
     * Get the table name.
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Set the query.
     *
     * @param  Builder|class-string<Model>  $query
     */
    public function query(Builder|string $query): static
    {
        if (is_string($query)) {
            $query = $query::query();
        }

        $this->query = $query;

        return $this;
    }

    /**
     * Get the query.
     */
    public function getQuery(): ?Builder
    {
        return $this->query;
    }

    /**
     * Set the columns.
     *
     * @param  array<Column>  $columns
     */
    public function columns(array $columns): static
    {
        $this->columns = $columns;

        // Auto-configure sortable columns from column definitions
        foreach ($columns as $column) {
            if ($column->isSortable()) {
                $this->sortableColumns[$column->getName()] = true;
            }
            if ($column->isSearchable()) {
                $this->searchColumns[] = $column->getName();
            }
        }

        return $this;
    }

    /**
     * Get the columns.
     *
     * @return array<Column>
     */
    public function getColumns(): array
    {
        return $this->columns;
    }

    /**
     * Get visible columns.
     *
     * @return array<Column>
     */
    public function getVisibleColumns(): array
    {
        return array_filter($this->columns, fn (Column $column) => ! $column->isHidden());
    }

    /**
     * Set the record key.
     */
    public function recordKey(string $key): static
    {
        $this->recordKey = $key;

        return $this;
    }

    /**
     * Get the record key.
     */
    public function getRecordKey(): string
    {
        return $this->recordKey ?? 'id';
    }

    /**
     * Set the record URL callback.
     */
    public function recordUrl(Closure $callback): static
    {
        $this->recordUrl = $callback;

        return $this;
    }

    /**
     * Get the URL for a record.
     */
    public function getRecordUrl(mixed $record): ?string
    {
        if ($this->recordUrl === null) {
            return null;
        }

        return ($this->recordUrl)($record);
    }

    /**
     * Enable striped rows.
     */
    public function striped(bool $condition = true): static
    {
        $this->striped = $condition;

        return $this;
    }

    /**
     * Check if striped.
     */
    public function isStriped(): bool
    {
        return $this->striped;
    }

    /**
     * Enable hoverable rows.
     */
    public function hoverable(bool $condition = true): static
    {
        $this->hoverable = $condition;

        return $this;
    }

    /**
     * Check if hoverable.
     */
    public function isHoverable(): bool
    {
        return $this->hoverable;
    }

    /**
     * Enable bordered table.
     */
    public function bordered(bool $condition = true): static
    {
        $this->bordered = $condition;

        return $this;
    }

    /**
     * Check if bordered.
     */
    public function isBordered(): bool
    {
        return $this->bordered;
    }

    /**
     * Enable compact mode.
     */
    public function compact(bool $condition = true): static
    {
        $this->compact = $condition;

        return $this;
    }

    /**
     * Check if compact.
     */
    public function isCompact(): bool
    {
        return $this->compact;
    }

    /**
     * Set polling interval.
     */
    public function poll(?string $interval): static
    {
        $this->pollingInterval = $interval;

        return $this;
    }

    /**
     * Get polling interval.
     */
    public function getPollingInterval(): ?string
    {
        return $this->pollingInterval;
    }

    /**
     * Enable deferred loading.
     */
    public function deferLoading(bool $condition = true): static
    {
        $this->deferLoading = $condition;

        return $this;
    }

    /**
     * Check if deferred loading.
     */
    public function isDeferLoading(): bool
    {
        return $this->deferLoading;
    }

    /**
     * Add extra HTML attributes.
     */
    public function extraAttributes(array $attributes): static
    {
        $this->extraAttributes = array_merge($this->extraAttributes, $attributes);

        return $this;
    }

    /**
     * Get extra attributes.
     */
    public function getExtraAttributes(): array
    {
        return $this->extraAttributes;
    }

    /**
     * Apply request data.
     */
    public function fromRequest(?array $data = null): static
    {
        $data ??= request()->all();

        // Apply search
        if (isset($data[$this->getSearchInputName()])) {
            $this->search($data[$this->getSearchInputName()]);
        }

        // Apply sort
        if (isset($data['sort'])) {
            $this->sort($data['sort'], $data['direction'] ?? 'asc');
        }

        // Apply per page
        if (isset($data['per_page'])) {
            $this->perPage((int) $data['per_page']);
        }

        // Apply filters
        $this->setFilterValues($data);

        return $this;
    }

    /**
     * Apply all configurations to query.
     */
    protected function applyToQuery(): Builder
    {
        $query = $this->getQuery();

        if ($query === null) {
            throw new \RuntimeException('No query has been set.');
        }

        // Apply search
        $query = $this->applySearch($query);

        // Apply filters
        $query = $this->applyFilters($query);

        // Apply sorting
        $query = $this->applySorting($query);

        return $query;
    }

    /**
     * Get paginated records.
     */
    public function getRecords(): LengthAwarePaginator
    {
        return $this->applyPagination($this->applyToQuery());
    }

    /**
     * Get all records without pagination.
     */
    public function getAllRecords(): Collection
    {
        return $this->applyToQuery()->get();
    }

    /**
     * Get the total count.
     */
    public function getRecordsCount(): int
    {
        return $this->applyToQuery()->count();
    }

    /**
     * Get the view name.
     */
    public function getView(): string
    {
        return 'accelade::table';
    }

    /**
     * Render the table.
     */
    public function render(): string
    {
        return view($this->getView(), [
            'table' => $this,
        ])->render();
    }

    /**
     * Convert to string.
     */
    public function __toString(): string
    {
        return $this->render();
    }

    /**
     * Serialize to array.
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'columns' => array_map(fn ($col) => $col->toArray(), $this->columns),
            'filters' => array_map(fn ($filter) => $filter->toArray(), $this->filters),
            'actions' => array_map(fn ($action) => $action->toArray(), $this->actions),
            'bulk_actions' => array_map(fn ($action) => $action->toArray(), $this->bulkActions),
            'search_columns' => $this->searchColumns,
            'sortable_columns' => array_keys($this->sortableColumns),
            'per_page' => $this->perPage,
            'striped' => $this->striped,
            'hoverable' => $this->hoverable,
            'bordered' => $this->bordered,
            'compact' => $this->compact,
        ];
    }
}
