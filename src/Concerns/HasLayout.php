<?php

declare(strict_types=1);

namespace Accelade\Grids\Concerns;

/**
 * Trait for grid layout configuration.
 */
trait HasLayout
{
    protected int|array $columns = 3;

    protected string $gap = '6';

    protected string $layout = 'grid';

    protected bool $masonry = false;

    /**
     * Set the number of columns.
     *
     * @param  int|array<string, int>  $columns
     */
    public function columns(int|array $columns): static
    {
        $this->columns = $columns;

        return $this;
    }

    /**
     * Get the columns configuration.
     */
    public function getColumns(): int|array
    {
        return $this->columns;
    }

    /**
     * Get responsive column classes.
     */
    public function getColumnClasses(): string
    {
        if (is_int($this->columns)) {
            return match ($this->columns) {
                1 => 'grid-cols-1',
                2 => 'grid-cols-1 sm:grid-cols-2',
                3 => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3',
                4 => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-4',
                5 => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5',
                6 => 'grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6',
                default => "grid-cols-{$this->columns}",
            };
        }

        // Handle responsive array configuration
        return collect($this->columns)
            ->map(fn ($cols, $breakpoint) => $breakpoint === 'default'
                ? "grid-cols-{$cols}"
                : "{$breakpoint}:grid-cols-{$cols}")
            ->implode(' ');
    }

    /**
     * Set the gap between items.
     */
    public function gap(string $gap): static
    {
        $this->gap = $gap;

        return $this;
    }

    /**
     * Get the gap.
     */
    public function getGap(): string
    {
        return $this->gap;
    }

    /**
     * Get gap classes.
     */
    public function getGapClasses(): string
    {
        return "gap-{$this->gap}";
    }

    /**
     * Set the layout type.
     */
    public function layout(string $layout): static
    {
        $this->layout = $layout;

        return $this;
    }

    /**
     * Get the layout type.
     */
    public function getLayout(): string
    {
        return $this->layout;
    }

    /**
     * Use masonry layout.
     */
    public function masonry(bool $condition = true): static
    {
        $this->masonry = $condition;

        return $this;
    }

    /**
     * Check if masonry layout.
     */
    public function isMasonry(): bool
    {
        return $this->masonry;
    }

    /**
     * Use list layout.
     */
    public function list(): static
    {
        $this->layout = 'list';
        $this->columns = 1;

        return $this;
    }

    /**
     * Check if list layout.
     */
    public function isList(): bool
    {
        return $this->layout === 'list';
    }
}
