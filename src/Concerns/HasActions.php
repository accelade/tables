<?php

declare(strict_types=1);

namespace Accelade\Tables\Concerns;

use Accelade\Actions\Action;

/**
 * Trait for tables that have row actions.
 */
trait HasActions
{
    /**
     * @var array<Action>
     */
    protected array $actions = [];

    protected string $actionsPosition = 'end';

    protected ?string $actionsColumnLabel = 'Actions';

    protected bool $actionsColumnHidden = false;

    /**
     * Set the row actions.
     *
     * @param  array<Action>  $actions
     */
    public function actions(array $actions, string $position = 'end'): static
    {
        $this->actions = $actions;
        $this->actionsPosition = $position;

        return $this;
    }

    /**
     * Get the row actions.
     *
     * @return array<Action>
     */
    public function getActions(): array
    {
        return $this->actions;
    }

    /**
     * Check if table has actions.
     */
    public function hasActions(): bool
    {
        return ! empty($this->actions);
    }

    /**
     * Get the actions position.
     */
    public function getActionsPosition(): string
    {
        return $this->actionsPosition;
    }

    /**
     * Set the actions column label.
     */
    public function actionsColumnLabel(?string $label): static
    {
        $this->actionsColumnLabel = $label;

        return $this;
    }

    /**
     * Get the actions column label.
     */
    public function getActionsColumnLabel(): ?string
    {
        return $this->actionsColumnLabel;
    }

    /**
     * Hide the actions column.
     */
    public function actionsColumnHidden(bool $condition = true): static
    {
        $this->actionsColumnHidden = $condition;

        return $this;
    }

    /**
     * Check if actions column is hidden.
     */
    public function isActionsColumnHidden(): bool
    {
        return $this->actionsColumnHidden;
    }

    /**
     * Get visible actions for a record.
     *
     * @return array<Action>
     */
    public function getVisibleActions(mixed $record): array
    {
        return array_filter(
            $this->actions,
            fn (Action $action) => ! $action->isHidden()
        );
    }
}
