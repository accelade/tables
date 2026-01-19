<?php

declare(strict_types=1);

namespace Accelade\Tables\Columns;

use Closure;

/**
 * Checkbox column for inline boolean editing.
 */
class CheckboxColumn extends Column
{
    protected bool $disabled = false;

    protected ?Closure $updateUsing = null;

    /**
     * Disable the checkbox.
     */
    public function disabled(bool $condition = true): static
    {
        $this->disabled = $condition;

        return $this;
    }

    /**
     * Check if disabled.
     */
    public function isDisabled(): bool
    {
        return $this->disabled;
    }

    /**
     * Set the update callback.
     */
    public function updateStateUsing(Closure $callback): static
    {
        $this->updateUsing = $callback;

        return $this;
    }

    /**
     * Get the update callback.
     */
    public function getUpdateCallback(): ?Closure
    {
        return $this->updateUsing;
    }

    /**
     * Get the view name.
     */
    public function getView(): string
    {
        return 'tables::columns.checkbox';
    }
}
