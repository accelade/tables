@props([
    'card' => null,
])

@php
    $styles = config('grids.styles');
    $url = $card->getUrl();
    $image = $card->getImage();
    $imagePosition = $card->getImagePosition();
    $title = $card->getTitle();
    $description = $card->getDescription();
    $badge = $card->getBadge();
    $badgeColor = $card->getBadgeColor();
    $hoverable = $card->isHoverable();
    $bordered = $card->isBordered();
    $shadow = $card->hasShadow();
    $record = $card->getRecord();
    $actions = $card->getActions();
    $actionsPosition = $card->getActionsPosition();

    $badgeColorClasses = match($badgeColor) {
        'primary', 'blue' => 'bg-blue-100 text-blue-800 dark:bg-blue-900/30 dark:text-blue-400',
        'success', 'green' => 'bg-green-100 text-green-800 dark:bg-green-900/30 dark:text-green-400',
        'warning', 'yellow' => 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900/30 dark:text-yellow-400',
        'danger', 'red' => 'bg-red-100 text-red-800 dark:bg-red-900/30 dark:text-red-400',
        default => 'bg-gray-100 text-gray-800 dark:bg-gray-700 dark:text-gray-300',
    };
@endphp

<div
    {{ $attributes->class([
        $styles['card'] ?? 'bg-white dark:bg-gray-800 rounded-lg overflow-hidden',
        $styles['card_bordered'] ?? '' => $bordered,
        $styles['card_shadow'] ?? '' => $shadow,
        $styles['card_hoverable'] ?? '' => $hoverable,
        'cursor-pointer' => $url,
    ]) }}
    @if($url && !$card->hasActions())
        onclick="window.location='{{ $url }}'"
    @endif
>
    {{-- Image (top position) --}}
    @if($image && $imagePosition === 'top')
        <div class="relative">
            @if($url)
                <a href="{{ $url }}" @if($card->shouldOpenInNewTab()) target="_blank" rel="noopener noreferrer" @endif>
                    <img src="{{ $image }}" alt="{{ $title }}" class="{{ $styles['card_image'] ?? 'aspect-video object-cover w-full' }}" loading="lazy" />
                </a>
            @else
                <img src="{{ $image }}" alt="{{ $title }}" class="{{ $styles['card_image'] ?? 'aspect-video object-cover w-full' }}" loading="lazy" />
            @endif

            {{-- Badge (overlay) --}}
            @if($badge)
                <div class="absolute top-2 right-2">
                    <span class="px-2 py-1 text-xs font-medium rounded {{ $badgeColorClasses }}">
                        {{ $badge }}
                    </span>
                </div>
            @endif
        </div>
    @endif

    {{-- Body --}}
    <div class="{{ $styles['card_body'] ?? 'p-4' }}">
        {{-- Badge (inline, if no image) --}}
        @if($badge && (!$image || $imagePosition !== 'top'))
            <div class="mb-2">
                <span class="px-2 py-1 text-xs font-medium rounded {{ $badgeColorClasses }}">
                    {{ $badge }}
                </span>
            </div>
        @endif

        {{-- Title --}}
        @if($title)
            @if($url)
                <a
                    href="{{ $url }}"
                    @if($card->shouldOpenInNewTab()) target="_blank" rel="noopener noreferrer" @endif
                    class="{{ $styles['card_title'] ?? 'text-lg font-semibold text-gray-900 dark:text-white' }} hover:underline"
                >
                    {{ $title }}
                </a>
            @else
                <h3 class="{{ $styles['card_title'] ?? 'text-lg font-semibold text-gray-900 dark:text-white' }}">
                    {{ $title }}
                </h3>
            @endif
        @endif

        {{-- Description --}}
        @if($description)
            <p class="{{ $styles['card_description'] ?? 'mt-1 text-sm text-gray-500 dark:text-gray-400' }}">
                {{ $description }}
            </p>
        @endif

        {{-- Sections --}}
        @if(!empty($card->getSections()))
            <div class="mt-4 space-y-2">
                @foreach($card->getSections() as $section)
                    @if(!$section->isHidden())
                        <div class="flex items-center gap-2 text-sm">
                            @if($section->getIcon())
                                <span class="text-gray-400">{!! $section->getIcon() !!}</span>
                            @endif
                            @if($section->getLabel($record))
                                <span class="text-gray-500 dark:text-gray-400">{{ $section->getLabel($record) }}:</span>
                            @endif
                            <span @class([
                                'text-gray-900 dark:text-white',
                                'text-' . $section->getColor() . '-600 dark:text-' . $section->getColor() . '-400' => $section->getColor(),
                            ])>
                                {{ $section->getValue($record) }}
                            </span>
                        </div>
                    @endif
                @endforeach
            </div>
        @endif

        {{-- Actions (body position) --}}
        @if($card->hasActions() && $actionsPosition === 'body')
            <div class="mt-4 flex items-center gap-2">
                @foreach($actions as $action)
                    {!! $action->record($record)->render() !!}
                @endforeach
            </div>
        @endif
    </div>

    {{-- Footer Actions --}}
    @if($card->hasActions() && $actionsPosition === 'footer')
        <div class="{{ $styles['card_footer'] ?? 'px-4 py-3 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-200 dark:border-gray-700' }}">
            <div class="flex items-center justify-end gap-2">
                @foreach($actions as $action)
                    {!! $action->record($record)->render() !!}
                @endforeach
            </div>
        </div>
    @endif
</div>
