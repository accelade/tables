<?php

declare(strict_types=1);

namespace Accelade\Tables\Columns;

/**
 * Boolean column for displaying true/false values.
 */
class BooleanColumn extends Column
{
    protected ?string $trueIcon = null;

    protected ?string $falseIcon = null;

    protected string $trueColor = 'success';

    protected string $falseColor = 'danger';

    /**
     * Set the icons.
     */
    public function icons(?string $trueIcon = null, ?string $falseIcon = null): static
    {
        $this->trueIcon = $trueIcon;
        $this->falseIcon = $falseIcon;

        return $this;
    }

    /**
     * Get the true icon.
     */
    public function getTrueIcon(): ?string
    {
        return $this->trueIcon;
    }

    /**
     * Get the false icon.
     */
    public function getFalseIcon(): ?string
    {
        return $this->falseIcon;
    }

    /**
     * Set the colors.
     */
    public function colors(string $trueColor, string $falseColor): static
    {
        $this->trueColor = $trueColor;
        $this->falseColor = $falseColor;

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
        return 'accelade::columns.boolean';
    }
}
