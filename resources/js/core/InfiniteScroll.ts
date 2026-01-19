/**
 * InfiniteScroll handles automatic loading of more items when scrolling.
 */
export class InfiniteScroll {
    private container: HTMLElement;
    private loadMoreUrl: string;
    private threshold: number;
    private loading: boolean = false;
    private hasMore: boolean = true;
    private page: number = 1;
    private observer: IntersectionObserver | null = null;
    private sentinel: HTMLElement | null = null;
    private onLoad: ((items: HTMLElement[]) => void) | null = null;
    private onError: ((error: Error) => void) | null = null;

    constructor(container: HTMLElement, options: {
        loadMoreUrl: string;
        threshold?: number;
        onLoad?: (items: HTMLElement[]) => void;
        onError?: (error: Error) => void;
    }) {
        this.container = container;
        this.loadMoreUrl = options.loadMoreUrl;
        this.threshold = options.threshold ?? 200;
        this.onLoad = options.onLoad ?? null;
        this.onError = options.onError ?? null;

        this.init();
    }

    /**
     * Initialize infinite scroll
     */
    private init(): void {
        this.createSentinel();
        this.setupObserver();
    }

    /**
     * Create sentinel element for intersection observer
     */
    private createSentinel(): void {
        this.sentinel = document.createElement('div');
        this.sentinel.className = 'accelade-grid-sentinel';
        this.sentinel.style.height = '1px';
        this.sentinel.style.width = '100%';
        this.sentinel.setAttribute('aria-hidden', 'true');

        this.container.appendChild(this.sentinel);
    }

    /**
     * Setup intersection observer
     */
    private setupObserver(): void {
        this.observer = new IntersectionObserver(
            (entries) => {
                const entry = entries[0];
                if (entry.isIntersecting && !this.loading && this.hasMore) {
                    this.loadMore();
                }
            },
            {
                root: null,
                rootMargin: `${this.threshold}px`,
                threshold: 0,
            }
        );

        if (this.sentinel) {
            this.observer.observe(this.sentinel);
        }
    }

    /**
     * Load more items
     */
    async loadMore(): Promise<void> {
        if (this.loading || !this.hasMore) return;

        this.loading = true;
        this.page++;

        try {
            const url = new URL(this.loadMoreUrl, window.location.origin);
            url.searchParams.set('page', this.page.toString());

            // Preserve existing query parameters
            const currentUrl = new URL(window.location.href);
            currentUrl.searchParams.forEach((value, key) => {
                if (key !== 'page') {
                    url.searchParams.set(key, value);
                }
            });

            const response = await fetch(url.toString(), {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'text/html',
                },
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const html = await response.text();

            // Parse the HTML and extract items
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const items = Array.from(doc.querySelectorAll('.accelade-grid-item')) as HTMLElement[];

            if (items.length === 0) {
                this.hasMore = false;
                this.hideSentinel();
            } else {
                // Insert items before sentinel
                items.forEach((item) => {
                    if (this.sentinel) {
                        this.container.insertBefore(item.cloneNode(true), this.sentinel);
                    }
                });

                // Callback
                if (this.onLoad) {
                    this.onLoad(items);
                }

                // Dispatch event
                this.container.dispatchEvent(new CustomEvent('items:loaded', {
                    detail: { items, page: this.page },
                }));
            }
        } catch (error) {
            this.page--;
            console.error('Failed to load more items:', error);

            if (this.onError && error instanceof Error) {
                this.onError(error);
            }

            // Dispatch error event
            this.container.dispatchEvent(new CustomEvent('items:error', {
                detail: { error, page: this.page },
            }));
        } finally {
            this.loading = false;
        }
    }

    /**
     * Hide sentinel when no more items
     */
    private hideSentinel(): void {
        if (this.sentinel) {
            this.sentinel.style.display = 'none';
        }
    }

    /**
     * Show sentinel
     */
    private showSentinel(): void {
        if (this.sentinel) {
            this.sentinel.style.display = '';
        }
    }

    /**
     * Reset state (e.g., after filter change)
     */
    reset(): void {
        this.page = 1;
        this.hasMore = true;
        this.loading = false;
        this.showSentinel();
    }

    /**
     * Update load more URL
     */
    setLoadMoreUrl(url: string): void {
        this.loadMoreUrl = url;
    }

    /**
     * Check if currently loading
     */
    isLoading(): boolean {
        return this.loading;
    }

    /**
     * Check if more items are available
     */
    hasMoreItems(): boolean {
        return this.hasMore;
    }

    /**
     * Get current page
     */
    getPage(): number {
        return this.page;
    }

    /**
     * Destroy infinite scroll
     */
    destroy(): void {
        if (this.observer) {
            this.observer.disconnect();
            this.observer = null;
        }

        if (this.sentinel) {
            this.sentinel.remove();
            this.sentinel = null;
        }
    }
}
