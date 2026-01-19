<?php

declare(strict_types=1);

namespace Accelade\Tables\Columns;

use Closure;
use Illuminate\Database\Eloquent\Model;

/**
 * Badge column for displaying values as badges.
 */
class BadgeColumn extends Column
{
    /**
     * @var array<string, string>
     */
    protected array $colors = [];

    /**
     * @var array<string, string>
     */
    protected array $icons = [];

    protected string $size = 'sm';

    /**
     * Set colors for different values.
     *
     * @param  array<string, string>|Closure  $colors
     */
    public function colors(array|Closure $colors): static
    {
        if ($colors instanceof Closure) {
            $this->color = $colors;
        } else {
            $this->colors = $colors;
        }

        return $this;
    }

    /**
     * Get the color for a value.
     */
    public function getColor(Model $record): ?string
    {
        $state = $this->getState($record);

        if ($this->color !== null) {
            return ($this->color)($state, $record);
        }

        return $this->colors[$state] ?? $this->colors['default'] ?? 'gray';
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
     * Get the icon for a value.
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * Get the icon for a record.
     */
    public function getIconForRecord(Model $record): ?string
    {
        $state = $this->getState($record);

        return $this->icons[$state] ?? $this->icon ?? null;
    }

    /**
     * Set the badge size.
     */
    public function size(string $size): static
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get the badge size.
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * Get the view name.
     */
    public function getView(): string
    {
        return 'accelade::columns.badge';
    }
}
