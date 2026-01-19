<?php

declare(strict_types=1);

namespace Accelade\Tables\Columns;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Traits\Conditionable;

/**
 * Base column class for tables.
 */
class Column
{
    use Conditionable;

    protected string $name;

    protected string|Closure|null $label = null;

    protected bool $sortable = false;

    protected bool $searchable = false;

    protected bool $hidden = false;

    protected bool $toggleable = true;

    protected ?string $width = null;

    protected ?string $alignment = null;

    protected Closure|string|null $formatUsing = null;

    protected ?Closure $getStateUsing = null;

    protected ?string $tooltip = null;

    protected array $extraAttributes = [];

    protected array $extraHeaderAttributes = [];

    protected ?Closure $url = null;

    protected bool $openUrlInNewTab = false;

    protected ?string $placeholder = null;

    protected bool $wrap = false;

    protected ?int $limit = null;

    protected ?string $prefix = null;

    protected ?string $suffix = null;

    protected ?Closure $color = null;

    protected ?string $icon = null;

    protected ?string $iconPosition = 'before';

    /**
     * Create a new column instance.
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * Create a new column instance.
     */
    public static function make(string $name): static
    {
        return new static($name);
    }

    /**
     * Get the column name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the label.
     */
    public function label(string|Closure $label): static
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get the label.
     */
    public function getLabel(): string
    {
        if ($this->label instanceof Closure) {
            return ($this->label)();
        }

        return $this->label ?? Str::headline($this->name);
    }

    /**
     * Make the column sortable.
     */
    public function sortable(bool $condition = true): static
    {
        $this->sortable = $condition;

        return $this;
    }

    /**
     * Check if sortable.
     */
    public function isSortable(): bool
    {
        return $this->sortable;
    }

    /**
     * Make the column searchable.
     */
    public function searchable(bool $condition = true): static
    {
        $this->searchable = $condition;

        return $this;
    }

    /**
     * Check if searchable.
     */
    public function isSearchable(): bool
    {
        return $this->searchable;
    }

    /**
     * Hide the column.
     */
    public function hidden(bool $condition = true): static
    {
        $this->hidden = $condition;

        return $this;
    }

    /**
     * Check if hidden.
     */
    public function isHidden(): bool
    {
        return $this->hidden;
    }

    /**
     * Make the column toggleable.
     */
    public function toggleable(bool $condition = true): static
    {
        $this->toggleable = $condition;

        return $this;
    }

    /**
     * Check if toggleable.
     */
    public function isToggleable(): bool
    {
        return $this->toggleable;
    }

    /**
     * Set the width.
     */
    public function width(string $width): static
    {
        $this->width = $width;

        return $this;
    }

    /**
     * Get the width.
     */
    public function getWidth(): ?string
    {
        return $this->width;
    }

    /**
     * Set the alignment.
     */
    public function alignment(string $alignment): static
    {
        $this->alignment = $alignment;

        return $this;
    }

    /**
     * Align left.
     */
    public function alignLeft(): static
    {
        return $this->alignment('left');
    }

    /**
     * Align center.
     */
    public function alignCenter(): static
    {
        return $this->alignment('center');
    }

    /**
     * Align right.
     */
    public function alignRight(): static
    {
        return $this->alignment('right');
    }

    /**
     * Get the alignment.
     */
    public function getAlignment(): string
    {
        return $this->alignment ?? 'left';
    }

    /**
     * Set the format callback.
     */
    public function formatStateUsing(Closure|string $callback): static
    {
        $this->formatUsing = $callback;

        return $this;
    }

    /**
     * Set how to get the state.
     */
    public function getStateUsing(Closure $callback): static
    {
        $this->getStateUsing = $callback;

        return $this;
    }

    /**
     * Get the state from a record.
     */
    public function getState(Model $record): mixed
    {
        if ($this->getStateUsing !== null) {
            return ($this->getStateUsing)($record);
        }

        // Handle relationship columns (e.g., 'user.name')
        $value = $record;
        foreach (explode('.', $this->name) as $segment) {
            if ($value === null) {
                return null;
            }
            $value = data_get($value, $segment);
        }

        return $value;
    }

    /**
     * Get the formatted state.
     */
    public function getFormattedState(Model $record): mixed
    {
        $state = $this->getState($record);

        if ($state === null && $this->placeholder !== null) {
            return $this->placeholder;
        }

        if ($this->formatUsing !== null) {
            if ($this->formatUsing instanceof Closure) {
                $state = ($this->formatUsing)($state, $record);
            } else {
                $state = sprintf($this->formatUsing, $state);
            }
        }

        if ($this->limit !== null && is_string($state)) {
            $state = Str::limit($state, $this->limit);
        }

        if ($this->prefix !== null) {
            $state = $this->prefix.$state;
        }

        if ($this->suffix !== null) {
            $state = $state.$this->suffix;
        }

        return $state;
    }

    /**
     * Set the tooltip.
     */
    public function tooltip(?string $tooltip): static
    {
        $this->tooltip = $tooltip;

        return $this;
    }

    /**
     * Get the tooltip.
     */
    public function getTooltip(): ?string
    {
        return $this->tooltip;
    }

    /**
     * Add extra HTML attributes for the cell.
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
     * Add extra HTML attributes for the header.
     */
    public function extraHeaderAttributes(array $attributes): static
    {
        $this->extraHeaderAttributes = array_merge($this->extraHeaderAttributes, $attributes);

        return $this;
    }

    /**
     * Get extra header attributes.
     */
    public function getExtraHeaderAttributes(): array
    {
        return $this->extraHeaderAttributes;
    }

    /**
     * Set the URL for the cell.
     */
    public function url(Closure $callback, bool $openInNewTab = false): static
    {
        $this->url = $callback;
        $this->openUrlInNewTab = $openInNewTab;

        return $this;
    }

    /**
     * Get the URL for a record.
     */
    public function getUrl(Model $record): ?string
    {
        if ($this->url === null) {
            return null;
        }

        return ($this->url)($record);
    }

    /**
     * Check if URL should open in new tab.
     */
    public function shouldOpenUrlInNewTab(): bool
    {
        return $this->openUrlInNewTab;
    }

    /**
     * Set the placeholder for null values.
     */
    public function placeholder(string $placeholder): static
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * Get the placeholder.
     */
    public function getPlaceholder(): ?string
    {
        return $this->placeholder;
    }

    /**
     * Enable text wrapping.
     */
    public function wrap(bool $condition = true): static
    {
        $this->wrap = $condition;

        return $this;
    }

    /**
     * Check if wrap is enabled.
     */
    public function shouldWrap(): bool
    {
        return $this->wrap;
    }

    /**
     * Set the character limit.
     */
    public function limit(?int $limit): static
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Get the limit.
     */
    public function getLimit(): ?int
    {
        return $this->limit;
    }

    /**
     * Set the prefix.
     */
    public function prefix(string $prefix): static
    {
        $this->prefix = $prefix;

        return $this;
    }

    /**
     * Get the prefix.
     */
    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    /**
     * Set the suffix.
     */
    public function suffix(string $suffix): static
    {
        $this->suffix = $suffix;

        return $this;
    }

    /**
     * Get the suffix.
     */
    public function getSuffix(): ?string
    {
        return $this->suffix;
    }

    /**
     * Set the color callback.
     */
    public function color(Closure|string $color): static
    {
        $this->color = is_string($color) ? fn () => $color : $color;

        return $this;
    }

    /**
     * Get the color for a record.
     */
    public function getColor(Model $record): ?string
    {
        if ($this->color === null) {
            return null;
        }

        return ($this->color)($this->getState($record), $record);
    }

    /**
     * Set the icon.
     */
    public function icon(?string $icon, string $position = 'before'): static
    {
        $this->icon = $icon;
        $this->iconPosition = $position;

        return $this;
    }

    /**
     * Get the icon.
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * Get the icon position.
     */
    public function getIconPosition(): string
    {
        return $this->iconPosition;
    }

    /**
     * Get the view name.
     */
    public function getView(): string
    {
        return 'accelade::columns.text';
    }

    /**
     * Render the column cell.
     */
    public function render(Model $record): string
    {
        return view($this->getView(), [
            'column' => $this,
            'record' => $record,
            'state' => $this->getFormattedState($record),
        ])->render();
    }

    /**
     * Serialize to array.
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'label' => $this->getLabel(),
            'sortable' => $this->sortable,
            'searchable' => $this->searchable,
            'hidden' => $this->hidden,
            'toggleable' => $this->toggleable,
            'width' => $this->width,
            'alignment' => $this->getAlignment(),
        ];
    }
}
