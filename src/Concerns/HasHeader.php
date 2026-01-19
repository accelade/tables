<?php

declare(strict_types=1);

namespace Accelade\Tables\Concerns;

use Closure;

/**
 * Trait for tables that have header configuration.
 */
trait HasHeader
{
    protected string|Closure|null $heading = null;

    protected string|Closure|null $description = null;

    /**
     * @var array<\Accelade\Actions\Action>
     */
    protected array $headerActions = [];

    protected bool $filtersInHeader = true;

    protected bool $searchInHeader = true;

    /**
     * Set the table heading.
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
     * Set the table description.
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
     *
     * @return array<\Accelade\Actions\Action>
     */
    public function getHeaderActions(): array
    {
        return $this->headerActions;
    }

    /**
     * Check if table has header actions.
     */
    public function hasHeaderActions(): bool
    {
        return ! empty($this->headerActions);
    }

    /**
     * Show filters in header.
     */
    public function filtersInHeader(bool $condition = true): static
    {
        $this->filtersInHeader = $condition;

        return $this;
    }

    /**
     * Check if filters should be in header.
     */
    public function shouldShowFiltersInHeader(): bool
    {
        return $this->filtersInHeader;
    }

    /**
     * Show search in header.
     */
    public function searchInHeader(bool $condition = true): static
    {
        $this->searchInHeader = $condition;

        return $this;
    }

    /**
     * Check if search should be in header.
     */
    public function shouldShowSearchInHeader(): bool
    {
        return $this->searchInHeader;
    }
}
