<?php

declare(strict_types=1);

namespace Accelade\Grids\Cards;

use Closure;
use Illuminate\Database\Eloquent\Model;

/**
 * Card section component.
 */
class CardSection
{
    protected string|Closure|null $label = null;

    protected string|Closure|null $value = null;

    protected ?string $icon = null;

    protected ?string $color = null;

    protected bool $hidden = false;

    /**
     * Create a new section instance.
     */
    public static function make(): static
    {
        return new static;
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
    public function getLabel(?Model $record = null): ?string
    {
        if ($this->label instanceof Closure) {
            return ($this->label)($record);
        }

        return $this->label;
    }

    /**
     * Set the value.
     */
    public function value(string|Closure $value): static
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Get the value.
     */
    public function getValue(?Model $record = null): ?string
    {
        if ($this->value instanceof Closure) {
            return ($this->value)($record);
        }

        return $this->value;
    }

    /**
     * Set the icon.
     */
    public function icon(?string $icon): static
    {
        $this->icon = $icon;

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
     * Set the color.
     */
    public function color(?string $color): static
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get the color.
     */
    public function getColor(): ?string
    {
        return $this->color;
    }

    /**
     * Hide the section.
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
}
