<?php

declare(strict_types=1);

namespace Accelade\Tables\Columns;

/**
 * Text column for displaying text values.
 */
class TextColumn extends Column
{
    protected bool $copyable = false;

    protected ?string $copyMessage = null;

    protected ?int $words = null;

    protected bool $html = false;

    protected bool $markdown = false;

    protected string $size = 'sm';

    protected ?string $weight = null;

    protected bool $mono = false;

    /**
     * Make the text copyable.
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
        return $this->copyMessage ?? 'Copied!';
    }

    /**
     * Limit by word count.
     */
    public function words(?int $words): static
    {
        $this->words = $words;

        return $this;
    }

    /**
     * Get the word limit.
     */
    public function getWords(): ?int
    {
        return $this->words;
    }

    /**
     * Render as HTML.
     */
    public function html(bool $condition = true): static
    {
        $this->html = $condition;

        return $this;
    }

    /**
     * Check if HTML.
     */
    public function isHtml(): bool
    {
        return $this->html;
    }

    /**
     * Render as Markdown.
     */
    public function markdown(bool $condition = true): static
    {
        $this->markdown = $condition;

        return $this;
    }

    /**
     * Check if Markdown.
     */
    public function isMarkdown(): bool
    {
        return $this->markdown;
    }

    /**
     * Set the text size.
     */
    public function size(string $size): static
    {
        $this->size = $size;

        return $this;
    }

    /**
     * Get the text size.
     */
    public function getSize(): string
    {
        return $this->size;
    }

    /**
     * Set the font weight.
     */
    public function weight(?string $weight): static
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get the font weight.
     */
    public function getWeight(): ?string
    {
        return $this->weight;
    }

    /**
     * Use monospace font.
     */
    public function mono(bool $condition = true): static
    {
        $this->mono = $condition;

        return $this;
    }

    /**
     * Check if mono.
     */
    public function isMono(): bool
    {
        return $this->mono;
    }

    /**
     * Get the view name.
     */
    public function getView(): string
    {
        return 'accelade::columns.text';
    }
}
