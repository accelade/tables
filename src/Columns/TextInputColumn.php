<?php

declare(strict_types=1);

namespace Accelade\Tables\Columns;

use Closure;

/**
 * Text input column for inline text editing.
 */
class TextInputColumn extends Column
{
    protected string $type = 'text';

    protected ?string $inputPlaceholder = null;

    protected ?int $maxLength = null;

    protected ?int $minLength = null;

    protected bool $disabled = false;

    protected bool $readonly = false;

    protected ?Closure $updateUsing = null;

    protected ?array $rules = null;

    protected ?string $inputMode = null;

    protected ?string $step = null;

    protected ?string $min = null;

    protected ?string $max = null;

    /**
     * Set the input type.
     */
    public function type(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get the input type.
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Set as email input.
     */
    public function email(): static
    {
        $this->type = 'email';
        $this->inputMode = 'email';

        return $this;
    }

    /**
     * Set as numeric input.
     */
    public function numeric(): static
    {
        $this->type = 'number';
        $this->inputMode = 'numeric';

        return $this;
    }

    /**
     * Set as tel input.
     */
    public function tel(): static
    {
        $this->type = 'tel';
        $this->inputMode = 'tel';

        return $this;
    }

    /**
     * Set as url input type.
     */
    public function urlType(): static
    {
        $this->type = 'url';
        $this->inputMode = 'url';

        return $this;
    }

    /**
     * Set the input placeholder.
     */
    public function inputPlaceholder(?string $placeholder): static
    {
        $this->inputPlaceholder = $placeholder;

        return $this;
    }

    /**
     * Get the input placeholder.
     */
    public function getInputPlaceholder(): ?string
    {
        return $this->inputPlaceholder;
    }

    /**
     * Set the max length.
     */
    public function maxLength(?int $length): static
    {
        $this->maxLength = $length;

        return $this;
    }

    /**
     * Get the max length.
     */
    public function getMaxLength(): ?int
    {
        return $this->maxLength;
    }

    /**
     * Set the min length.
     */
    public function minLength(?int $length): static
    {
        $this->minLength = $length;

        return $this;
    }

    /**
     * Get the min length.
     */
    public function getMinLength(): ?int
    {
        return $this->minLength;
    }

    /**
     * Disable the input.
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
     * Make the input readonly.
     */
    public function readonly(bool $condition = true): static
    {
        $this->readonly = $condition;

        return $this;
    }

    /**
     * Check if readonly.
     */
    public function isReadonly(): bool
    {
        return $this->readonly;
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
     * Set validation rules.
     */
    public function rules(array $rules): static
    {
        $this->rules = $rules;

        return $this;
    }

    /**
     * Get validation rules.
     */
    public function getRules(): ?array
    {
        return $this->rules;
    }

    /**
     * Set the input mode.
     */
    public function inputMode(?string $mode): static
    {
        $this->inputMode = $mode;

        return $this;
    }

    /**
     * Get the input mode.
     */
    public function getInputMode(): ?string
    {
        return $this->inputMode;
    }

    /**
     * Set the step for numeric inputs.
     */
    public function step(?string $step): static
    {
        $this->step = $step;

        return $this;
    }

    /**
     * Get the step.
     */
    public function getStep(): ?string
    {
        return $this->step;
    }

    /**
     * Set the min value for numeric inputs.
     */
    public function min(?string $min): static
    {
        $this->min = $min;

        return $this;
    }

    /**
     * Get the min value.
     */
    public function getMin(): ?string
    {
        return $this->min;
    }

    /**
     * Set the max value for numeric inputs.
     */
    public function max(?string $max): static
    {
        $this->max = $max;

        return $this;
    }

    /**
     * Get the max value.
     */
    public function getMax(): ?string
    {
        return $this->max;
    }

    /**
     * Get the view name.
     */
    public function getView(): string
    {
        return 'tables::columns.text-input';
    }
}
