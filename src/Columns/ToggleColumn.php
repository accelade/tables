<?php

declare(strict_types=1);

namespace Accelade\Tables\Columns;

use Closure;

/**
 * Toggle column for inline boolean editing.
 */
class ToggleColumn extends Column
{
    protected string $onColor = 'primary';

    protected string $offColor = 'gray';

    protected ?string $onIcon = null;

    protected ?string $offIcon = null;

    protected bool $disabled = false;

    protected ?Closure $updateUsing = null;

    /**
     * Set the on color.
     */
    public function onColor(string $color): static
    {
        $this->onColor = $color;

        return $this;
    }

    /**
     * Get the on color.
     */
    public function getOnColor(): string
    {
        return $this->onColor;
    }

    /**
     * Set the off color.
     */
    public function offColor(string $color): static
    {
        $this->offColor = $color;

        return $this;
    }

    /**
     * Get the off color.
     */
    public function getOffColor(): string
    {
        return $this->offColor;
    }

    /**
     * Set the on icon.
     */
    public function onIcon(?string $icon): static
    {
        $this->onIcon = $icon;

        return $this;
    }

    /**
     * Get the on icon.
     */
    public function getOnIcon(): ?string
    {
        return $this->onIcon;
    }

    /**
     * Set the off icon.
     */
    public function offIcon(?string $icon): static
    {
        $this->offIcon = $icon;

        return $this;
    }

    /**
     * Get the off icon.
     */
    public function getOffIcon(): ?string
    {
        return $this->offIcon;
    }

    /**
     * Disable the toggle.
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
        return 'tables::columns.toggle';
    }
}
