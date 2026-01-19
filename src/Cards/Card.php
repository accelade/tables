<?php

declare(strict_types=1);

namespace Accelade\Grids\Cards;

use Closure;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Traits\Conditionable;

/**
 * Card component for grid items.
 */
class Card
{
    use Conditionable;

    protected ?Model $record = null;

    protected string|Closure|null $title = null;

    protected string|Closure|null $description = null;

    protected string|Closure|null $image = null;

    protected string $imagePosition = 'top';

    protected string|Closure|null $url = null;

    protected bool $openInNewTab = false;

    /**
     * @var array<CardSection>
     */
    protected array $sections = [];

    /**
     * @var array<\Accelade\Actions\Action>
     */
    protected array $actions = [];

    protected string $actionsPosition = 'footer';

    protected ?string $badge = null;

    protected ?string $badgeColor = null;

    protected bool $hoverable = true;

    protected bool $bordered = true;

    protected bool $shadow = true;

    protected array $extraAttributes = [];

    /**
     * Create a new card instance.
     */
    public static function make(): static
    {
        return new static;
    }

    /**
     * Set the record.
     */
    public function record(Model $record): static
    {
        $this->record = $record;

        return $this;
    }

    /**
     * Get the record.
     */
    public function getRecord(): ?Model
    {
        return $this->record;
    }

    /**
     * Set the title.
     */
    public function title(string|Closure $title): static
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get the title.
     */
    public function getTitle(): ?string
    {
        if ($this->title instanceof Closure) {
            return ($this->title)($this->record);
        }

        if ($this->title !== null) {
            return $this->title;
        }

        // Try to get from record
        if ($this->record !== null) {
            return $this->record->title ?? $this->record->name ?? null;
        }

        return null;
    }

    /**
     * Set the description.
     */
    public function description(string|Closure $description): static
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get the description.
     */
    public function getDescription(): ?string
    {
        if ($this->description instanceof Closure) {
            return ($this->description)($this->record);
        }

        if ($this->description !== null) {
            return $this->description;
        }

        // Try to get from record
        if ($this->record !== null) {
            return $this->record->description ?? $this->record->excerpt ?? null;
        }

        return null;
    }

    /**
     * Set the image.
     */
    public function image(string|Closure $image, string $position = 'top'): static
    {
        $this->image = $image;
        $this->imagePosition = $position;

        return $this;
    }

    /**
     * Get the image URL.
     */
    public function getImage(): ?string
    {
        if ($this->image instanceof Closure) {
            return ($this->image)($this->record);
        }

        if ($this->image !== null) {
            return $this->image;
        }

        // Try to get from record
        if ($this->record !== null) {
            return $this->record->image ?? $this->record->thumbnail ?? $this->record->avatar ?? null;
        }

        return null;
    }

    /**
     * Get the image position.
     */
    public function getImagePosition(): string
    {
        return $this->imagePosition;
    }

    /**
     * Set the URL.
     */
    public function url(string|Closure $url, bool $openInNewTab = false): static
    {
        $this->url = $url;
        $this->openInNewTab = $openInNewTab;

        return $this;
    }

    /**
     * Get the URL.
     */
    public function getUrl(): ?string
    {
        if ($this->url instanceof Closure) {
            return ($this->url)($this->record);
        }

        return $this->url;
    }

    /**
     * Check if URL should open in new tab.
     */
    public function shouldOpenInNewTab(): bool
    {
        return $this->openInNewTab;
    }

    /**
     * Set the card sections.
     *
     * @param  array<CardSection>  $sections
     */
    public function sections(array $sections): static
    {
        $this->sections = $sections;

        return $this;
    }

    /**
     * Get the sections.
     *
     * @return array<CardSection>
     */
    public function getSections(): array
    {
        return $this->sections;
    }

    /**
     * Set the actions.
     *
     * @param  array<\Accelade\Actions\Action>  $actions
     */
    public function actions(array $actions, string $position = 'footer'): static
    {
        $this->actions = $actions;
        $this->actionsPosition = $position;

        return $this;
    }

    /**
     * Get the actions.
     */
    public function getActions(): array
    {
        return $this->actions;
    }

    /**
     * Get actions position.
     */
    public function getActionsPosition(): string
    {
        return $this->actionsPosition;
    }

    /**
     * Check if card has actions.
     */
    public function hasActions(): bool
    {
        return ! empty($this->actions);
    }

    /**
     * Set a badge.
     */
    public function badge(?string $badge, ?string $color = null): static
    {
        $this->badge = $badge;
        $this->badgeColor = $color;

        return $this;
    }

    /**
     * Get the badge.
     */
    public function getBadge(): ?string
    {
        return $this->badge;
    }

    /**
     * Get the badge color.
     */
    public function getBadgeColor(): string
    {
        return $this->badgeColor ?? 'gray';
    }

    /**
     * Enable/disable hover effect.
     */
    public function hoverable(bool $condition = true): static
    {
        $this->hoverable = $condition;

        return $this;
    }

    /**
     * Check if hoverable.
     */
    public function isHoverable(): bool
    {
        return $this->hoverable;
    }

    /**
     * Enable/disable border.
     */
    public function bordered(bool $condition = true): static
    {
        $this->bordered = $condition;

        return $this;
    }

    /**
     * Check if bordered.
     */
    public function isBordered(): bool
    {
        return $this->bordered;
    }

    /**
     * Enable/disable shadow.
     */
    public function shadow(bool $condition = true): static
    {
        $this->shadow = $condition;

        return $this;
    }

    /**
     * Check if shadow.
     */
    public function hasShadow(): bool
    {
        return $this->shadow;
    }

    /**
     * Add extra HTML attributes.
     */
    public function extraAttributes(array $attributes): static
    {
        $this->extraAttributes = array_merge($this->extraAttributes, $attributes);

        return $this;
    }

    /**
     * Get extra attributes.
     */
    public function getExtraAttributes(): array
    {
        return $this->extraAttributes;
    }

    /**
     * Get the view name.
     */
    public function getView(): string
    {
        return 'accelade::card';
    }

    /**
     * Render the card.
     */
    public function render(): string
    {
        return view($this->getView(), [
            'card' => $this,
        ])->render();
    }

    /**
     * Convert to string.
     */
    public function __toString(): string
    {
        return $this->render();
    }
}
