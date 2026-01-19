<?php

declare(strict_types=1);

namespace Accelade\Tables\Columns;

/**
 * Image column for displaying images.
 */
class ImageColumn extends Column
{
    protected int $imageWidth = 40;

    protected int $imageHeight = 40;

    protected bool $circular = false;

    protected bool $square = true;

    protected ?string $defaultImageUrl = null;

    protected bool $stacked = false;

    protected int $stackLimit = 3;

    protected int $stackRemainder = 0;

    /**
     * Set the dimensions.
     */
    public function size(int $size): static
    {
        $this->imageWidth = $size;
        $this->imageHeight = $size;

        return $this;
    }

    /**
     * Set the image width.
     */
    public function imageWidth(int $width): static
    {
        $this->imageWidth = $width;

        return $this;
    }

    /**
     * Get the image width.
     */
    public function getImageWidth(): int
    {
        return $this->imageWidth;
    }

    /**
     * Set the image height.
     */
    public function imageHeight(int $height): static
    {
        $this->imageHeight = $height;

        return $this;
    }

    /**
     * Get the image height.
     */
    public function getImageHeight(): int
    {
        return $this->imageHeight;
    }

    /**
     * Make the image circular.
     */
    public function circular(bool $condition = true): static
    {
        $this->circular = $condition;
        $this->square = ! $condition;

        return $this;
    }

    /**
     * Check if circular.
     */
    public function isCircular(): bool
    {
        return $this->circular;
    }

    /**
     * Make the image square.
     */
    public function square(bool $condition = true): static
    {
        $this->square = $condition;
        $this->circular = ! $condition;

        return $this;
    }

    /**
     * Check if square.
     */
    public function isSquare(): bool
    {
        return $this->square;
    }

    /**
     * Set the default image URL.
     */
    public function defaultImageUrl(?string $url): static
    {
        $this->defaultImageUrl = $url;

        return $this;
    }

    /**
     * Get the default image URL.
     */
    public function getDefaultImageUrl(): ?string
    {
        return $this->defaultImageUrl;
    }

    /**
     * Enable stacked images.
     */
    public function stacked(bool $condition = true): static
    {
        $this->stacked = $condition;

        return $this;
    }

    /**
     * Check if stacked.
     */
    public function isStacked(): bool
    {
        return $this->stacked;
    }

    /**
     * Set the stack limit.
     */
    public function stackLimit(int $limit): static
    {
        $this->stackLimit = $limit;

        return $this;
    }

    /**
     * Get the stack limit.
     */
    public function getStackLimit(): int
    {
        return $this->stackLimit;
    }

    /**
     * Get the view name.
     */
    public function getView(): string
    {
        return 'accelade::columns.image';
    }
}
