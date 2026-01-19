<?php

declare(strict_types=1);

namespace Accelade\Tables\Columns;

use Closure;

/**
 * Select column for inline editing with dropdown.
 */
class SelectColumn extends Column
{
    /**
     * @var array<string, string>|Closure
     */
    protected array|Closure $options = [];

    protected bool $searchable = false;

    protected ?string $placeholder = null;

    protected bool $native = true;

    protected bool $disabled = false;

    protected ?Closure $updateUsing = null;

    /**
     * Set the options.
     *
     * @param  array<string, string>|Closure  $options
     */
    public function options(array|Closure $options): static
    {
        $this->options = $options;

        return $this;
    }

    /**
     * Get the options.
     *
     * @return array<string, string>
     */
    public function getOptions(): array
    {
        if ($this->options instanceof Closure) {
            return ($this->options)();
        }

        return $this->options;
    }

    /**
     * Make the select searchable.
     */
    public function searchable(bool $condition = true): static
    {
        $this->searchable = $condition;

        return $this;
    }

    /**
     * Check if searchable.
     */
    public function isSearchable(): bool
    {
        return $this->searchable;
    }

    /**
     * Set the placeholder.
     */
    public function placeholder(?string $placeholder): static
    {
        $this->placeholder = $placeholder;

        return $this;
    }

    /**
     * Get the placeholder.
     */
    public function getPlaceholder(): ?string
    {
        return $this->placeholder;
    }

    /**
     * Use native select.
     */
    public function native(bool $condition = true): static
    {
        $this->native = $condition;

        return $this;
    }

    /**
     * Check if native.
     */
    public function isNative(): bool
    {
        return $this->native;
    }

    /**
     * Disable the select.
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
        return 'tables::columns.select';
    }
}
