<?php

declare(strict_types=1);

namespace Accelade\Tables\Concerns;

use Closure;

/**
 * Trait for tables that have empty state configuration.
 */
trait HasEmptyState
{
    protected string|Closure|null $emptyStateHeading = null;

    protected string|Closure|null $emptyStateDescription = null;

    protected ?string $emptyStateIcon = null;

    /**
     * @var array<\Accelade\Actions\Action>
     */
    protected array $emptyStateActions = [];

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

        return $this->emptyStateHeading ?? 'No records found';
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
     *
     * @return array<\Accelade\Actions\Action>
     */
    public function getEmptyStateActions(): array
    {
        return $this->emptyStateActions;
    }

    /**
     * Check if table has empty state actions.
     */
    public function hasEmptyStateActions(): bool
    {
        return ! empty($this->emptyStateActions);
    }
}
