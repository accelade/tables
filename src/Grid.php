<?php

declare(strict_types=1);

namespace Accelade\Grids;

use Accelade\Grids\Cards\Card;
use Accelade\Grids\Concerns\HasLayout;
use Accelade\QueryBuilder\Concerns\HasFilters;
use Accelade\QueryBuilder\Concerns\HasPagination;
use Accelade\QueryBuilder\Concerns\HasSearch;
use Accelade\QueryBuilder\Concerns\HasSorting;
use Closure;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Traits\Conditionable;

/**
 * Main grid class for displaying data in card layouts.
 */
class Grid
{
    use Conditionable;
    use HasFilters;
    use HasLayout;
    use HasPagination;
    use HasSearch;
    use HasSorting;

    protected ?string $name = null;

    protected ?Builder $query = null;

    protected ?Card $card = null;

    protected ?Closure $cardUsing = null;

    protected string|Closure|null $heading = null;

    protected string|Closure|null $description = null;

    /**
     * @var array<\Accelade\Actions\Action>
     */
    protected array $headerActions = [];

    protected string|Closure|null $emptyStateHeading = null;

    protected string|Closure|null $emptyStateDescription = null;

    protected ?string $emptyStateIcon = null;

    /**
     * @var array<\Accelade\Actions\Action>
     */
    protected array $emptyStateActions = [];

    protected array $extraAttributes = [];

    /**
     * Create a new grid instance.
     */
    public function __construct(?string $name = null)
    {
        $this->name = $name;
    }

    /**
     * Create a new grid instance.
     */
    public static function make(?string $name = null): static
    {
        return new static($name);
    }

    /**
     * Get the grid name.
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
     * Set the card template.
     */
    public function card(Card $card): static
    {
        $this->card = $card;

        return $this;
    }

    /**
     * Get the card template.
     */
    public function getCard(): ?Card
    {
        return $this->card;
    }

    /**
     * Set a callback to build the card for each record.
     */
    public function cardUsing(Closure $callback): static
    {
        $this->cardUsing = $callback;

        return $this;
    }

    /**
     * Get the card for a specific record.
     */
    public function getCardForRecord(Model $record): Card
    {
        if ($this->cardUsing !== null) {
            return ($this->cardUsing)($record);
        }

        if ($this->card !== null) {
            return (clone $this->card)->record($record);
        }

        return Card::make()->record($record);
    }

    /**
     * Set the grid heading.
     */
    public function heading(string|Closure $heading): static
    {
        $this->heading = $heading;

        return $this;
    }

    /**
     * Get the heading.
     */
    public function getHeading(): ?string
    {
        if ($this->heading instanceof Closure) {
            return ($this->heading)();
        }

        return $this->heading;
    }

    /**
     * Set the grid description.
     */
    public function description(string|Closure $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the description.
     */
    public function getDescription(): ?string
    {
        if ($this->description instanceof Closure) {
            return ($this->description)();
        }

        return $this->description;
    }

    /**
     * Set the header actions.
     *
     * @param  array<\Accelade\Actions\Action>  $actions
     */
    public function headerActions(array $actions): static
    {
        $this->headerActions = $actions;

        return $this;
    }

    /**
     * Get the header actions.
     */
    public function getHeaderActions(): array
    {
        return $this->headerActions;
    }

    /**
     * Check if grid has header actions.
     */
    public function hasHeaderActions(): bool
    {
        return ! empty($this->headerActions);
    }

    /**
     * Set the empty state heading.
     */
    public function emptyStateHeading(string|Closure $heading): static
    {
        $this->emptyStateHeading = $heading;

        return $this;
    }

    /**
     * Get the empty state heading.
     */
    public function getEmptyStateHeading(): string
    {
        if ($this->emptyStateHeading instanceof Closure) {
            return ($this->emptyStateHeading)();
        }

        return $this->emptyStateHeading ?? 'No items found';
    }

    /**
     * Set the empty state description.
     */
    public function emptyStateDescription(string|Closure $description): static
    {
        $this->emptyStateDescription = $description;

        return $this;
    }

    /**
     * Get the empty state description.
     */
    public function getEmptyStateDescription(): ?string
    {
        if ($this->emptyStateDescription instanceof Closure) {
            return ($this->emptyStateDescription)();
        }

        return $this->emptyStateDescription;
    }

    /**
     * Set the empty state icon.
     */
    public function emptyStateIcon(?string $icon): static
    {
        $this->emptyStateIcon = $icon;

        return $this;
    }

    /**
     * Get the empty state icon.
     */
    public function getEmptyStateIcon(): ?string
    {
        return $this->emptyStateIcon;
    }

    /**
     * Set the empty state actions.
     *
     * @param  array<\Accelade\Actions\Action>  $actions
     */
    public function emptyStateActions(array $actions): static
    {
        $this->emptyStateActions = $actions;

        return $this;
    }

    /**
     * Get the empty state actions.
     */
    public function getEmptyStateActions(): array
    {
        return $this->emptyStateActions;
    }

    /**
     * Check if grid has empty state actions.
     */
    public function hasEmptyStateActions(): bool
    {
        return ! empty($this->emptyStateActions);
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
        $data = $data ?? request()->all();

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
     * Get the view name.
     */
    public function getView(): string
    {
        return 'accelade::grid';
    }

    /**
     * Render the grid.
     */
    public function render(): string
    {
        return view($this->getView(), [
            'grid' => $this,
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
            'columns' => $this->columns,
            'gap' => $this->gap,
            'layout' => $this->layout,
            'search_columns' => $this->searchColumns,
            'sortable_columns' => array_keys($this->sortableColumns),
            'per_page' => $this->perPage,
        ];
    }
}
