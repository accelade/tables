<?php

declare(strict_types=1);

namespace Accelade\Tables\Concerns;

use Accelade\Actions\BulkAction;

/**
 * Trait for tables that have bulk actions.
 */
trait HasBulkActions
{
    /**
     * @var array<BulkAction>
     */
    protected array $bulkActions = [];

    protected bool $selectable = false;

    protected string $selectAllMode = 'page';

    /**
     * Set the bulk actions.
     *
     * @param  array<BulkAction>  $actions
     */
    public function bulkActions(array $actions): static
    {
        $this->bulkActions = $actions;
        $this->selectable = ! empty($actions);

        return $this;
    }

    /**
     * Get the bulk actions.
     *
     * @return array<BulkAction>
     */
    public function getBulkActions(): array
    {
        return $this->bulkActions;
    }

    /**
     * Check if table has bulk actions.
     */
    public function hasBulkActions(): bool
    {
        return ! empty($this->bulkActions);
    }

    /**
     * Enable row selection.
     */
    public function selectable(bool $condition = true): static
    {
        $this->selectable = $condition;

        return $this;
    }

    /**
     * Check if selectable.
     */
    public function isSelectable(): bool
    {
        return $this->selectable;
    }

    /**
     * Set the select all mode.
     */
    public function selectAllMode(string $mode): static
    {
        $this->selectAllMode = $mode;

        return $this;
    }

    /**
     * Get the select all mode.
     */
    public function getSelectAllMode(): string
    {
        return $this->selectAllMode;
    }

    /**
     * Get visible bulk actions.
     *
     * @return array<BulkAction>
     */
    public function getVisibleBulkActions(): array
    {
        return array_filter(
            $this->bulkActions,
            fn (BulkAction $action) => ! $action->isHidden()
        );
    }
}
