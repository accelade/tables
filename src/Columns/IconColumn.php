<?php

declare(strict_types=1);

namespace Accelade\Tables\Columns;

use Closure;
use Illuminate\Database\Eloquent\Model;

/**
 * Icon column for displaying icons based on state.
 */
class IconColumn extends Column
{
    protected Closure|string|null $displayIcon = null;

    /**
     * @var array<string, string>
     */
    protected array $icons = [];

    protected Closure|string|null $iconColor = null;

    /**
     * @var array<string, string>
     */
    protected array $colors = [];

    protected string $size = 'md';

    protected bool $boolean = false;

    protected string $trueIcon = 'heroicon-o-check-circle';

    protected string $falseIcon = 'heroicon-o-x-circle';

    protected string $trueColor = 'success';

    protected string $falseColor = 'danger';

    /**
     * Set the display icon or icon callback.
     */
    public function displayIcon(Closure|string $icon): static
    {
        $this->displayIcon = $icon;

        return $this;
    }

    /**
     * Set icons for different values.
     *
     * @param  array<string, string>  $icons
     */
    public function icons(array $icons): static
    {
        $this->icons = $icons;

        return $this;
    }

    /**
     * Get the icon for a record.
     */
    public function getIconForRecord(Model $record): ?string
    {
        $state = $this->getState($record);

        if ($this->boolean) {
            return $state ? $this->trueIcon : $this->falseIcon;
        }

        if ($this->displayIcon instanceof Closure) {
            return ($this->displayIcon)($state, $record);
        }

        if (! empty($this->icons)) {
            return $this->icons[$state] ?? null;
        }

        return $this->displayIcon;
    }

    /**
     * Set the icon color or callback.
     */
    public function iconColor(Closure|string $color): static
    {
        $this->iconColor = $color;

        return $this;
    }

    /**
     * Set colors for different values.
     *
     * @param  array<string, string>  $colors
     */
    public function colors(array $colors): static
    {
        $this->colors = $colors;

        return $this;
    }

    /**
     * Get the color for a record.
     */
    public function getColor(Model $record): ?string
    {
        $state = $this->getState($record);

        if ($this->boolean) {
            return $state ? $this->trueColor : $this->falseColor;
        }

        if ($this->iconColor instanceof Closure) {
            return ($this->iconColor)($state, $record);
        }

        if (! empty($this->colors)) {
            return $this->colors[$state] ?? 'gray';
        }

        return $this->iconColor ?? 'gray';
    }

    /**
     * Set the icon size.
     */
    public function size(string $size): static
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get the icon size.
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * Display as boolean (check/X icons).
     */
    public function boolean(bool $condition = true): static
    {
        $this->boolean = $condition;

        return $this;
    }

    /**
     * Check if boolean mode.
     */
    public function isBoolean(): bool
    {
        return $this->boolean;
    }

    /**
     * Set the true icon.
     */
    public function trueIcon(string $icon): static
    {
        $this->trueIcon = $icon;

        return $this;
    }

    /**
     * Get the true icon.
     */
    public function getTrueIcon(): string
    {
        return $this->trueIcon;
    }

    /**
     * Set the false icon.
     */
    public function falseIcon(string $icon): static
    {
        $this->falseIcon = $icon;

        return $this;
    }

    /**
     * Get the false icon.
     */
    public function getFalseIcon(): string
    {
        return $this->falseIcon;
    }

    /**
     * Set the true color.
     */
    public function trueColor(string $color): static
    {
        $this->trueColor = $color;

        return $this;
    }

    /**
     * Get the true color.
     */
    public function getTrueColor(): string
    {
        return $this->trueColor;
    }

    /**
     * Set the false color.
     */
    public function falseColor(string $color): static
    {
        $this->falseColor = $color;

        return $this;
    }

    /**
     * Get the false color.
     */
    public function getFalseColor(): string
    {
        return $this->falseColor;
    }

    /**
     * Get the view name.
     */
    public function getView(): string
    {
        return 'tables::columns.icon';
    }
}
