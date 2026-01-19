<?php

declare(strict_types=1);

namespace Accelade\Tables\Columns;

/**
 * Color column for displaying color swatches.
 */
class ColorColumn extends Column
{
    protected bool $copyable = false;

    protected ?string $copyMessage = null;

    protected int $size = 24;

    protected bool $rounded = true;

    /**
     * Make the color copyable.
     */
    public function copyable(bool $condition = true): static
    {
        $this->copyable = $condition;

        return $this;
    }

    /**
     * Check if copyable.
     */
    public function isCopyable(): bool
    {
        return $this->copyable;
    }

    /**
     * Set the copy message.
     */
    public function copyMessage(string $message): static
    {
        $this->copyMessage = $message;

        return $this;
    }

    /**
     * Get the copy message.
     */
    public function getCopyMessage(): string
    {
        return $this->copyMessage ?? 'Color copied!';
    }

    /**
     * Set the swatch size.
     */
    public function size(int $size): static
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get the swatch size.
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Make the swatch rounded.
     */
    public function rounded(bool $condition = true): static
    {
        $this->rounded = $condition;

        return $this;
    }

    /**
     * Check if rounded.
     */
    public function isRounded(): bool
    {
        return $this->rounded;
    }

    /**
     * Make the swatch square.
     */
    public function square(): static
    {
        $this->rounded = false;

        return $this;
    }

    /**
     * Get the view name.
     */
    public function getView(): string
    {
        return 'tables::columns.color';
    }
}
