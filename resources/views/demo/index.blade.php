@extends('accelade::components.layouts.demo')

@section('title', 'Grids Demo')

@section('content')
<div class="space-y-8">
    {{-- Header --}}
    <div>
        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Grids Demo</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-400">
            A comprehensive demonstration of the Accelade Grids package with filters, sorting, search, and layout options.
        </p>
    </div>

    {{-- Controls Section --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <form method="GET" action="{{ route('grids.demo') }}" class="space-y-6">
            {{-- Search & Layout Controls --}}
            <div class="flex flex-wrap items-center gap-4">
                {{-- Search --}}
                <div class="flex-1 min-w-64">
                    <label for="search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input
                            type="text"
                            name="search"
                            id="search"
                            value="{{ $search ?? '' }}"
                            placeholder="Search products..."
                            class="block w-full pl-10 pr-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                        >
                    </div>
                </div>

                {{-- Layout Switcher --}}
                <div class="flex items-center gap-2 bg-gray-100 dark:bg-gray-700 rounded-lg p-1">
                    <button
                        type="submit"
                        name="layout"
                        value="grid"
                        class="p-2 rounded {{ ($layout ?? 'grid') === 'grid' ? 'bg-white dark:bg-gray-600 shadow text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300' }}"
                        title="Grid view"
                    >
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.25 2A2.25 2.25 0 002 4.25v2.5A2.25 2.25 0 004.25 9h2.5A2.25 2.25 0 009 6.75v-2.5A2.25 2.25 0 006.75 2h-2.5zm0 9A2.25 2.25 0 002 13.25v2.5A2.25 2.25 0 004.25 18h2.5A2.25 2.25 0 009 15.75v-2.5A2.25 2.25 0 006.75 11h-2.5zm9-9A2.25 2.25 0 0011 4.25v2.5A2.25 2.25 0 0013.25 9h2.5A2.25 2.25 0 0018 6.75v-2.5A2.25 2.25 0 0015.75 2h-2.5zm0 9A2.25 2.25 0 0011 13.25v2.5A2.25 2.25 0 0013.25 18h2.5A2.25 2.25 0 0018 15.75v-2.5A2.25 2.25 0 0015.75 11h-2.5z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <button
                        type="submit"
                        name="layout"
                        value="list"
                        class="p-2 rounded {{ ($layout ?? 'grid') === 'list' ? 'bg-white dark:bg-gray-600 shadow text-blue-600 dark:text-blue-400' : 'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300' }}"
                        title="List view"
                    >
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M2 3.75A.75.75 0 012.75 3h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 3.75zm0 4.167a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75a.75.75 0 01-.75-.75zm0 4.166a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75a.75.75 0 01-.75-.75zm0 4.167a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75a.75.75 0 01-.75-.75z" clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                {{-- Column Selector (Grid only) --}}
                @if(($layout ?? 'grid') === 'grid')
                <div class="flex items-center gap-2">
                    <label class="text-sm text-gray-500 dark:text-gray-400">Columns:</label>
                    <select
                        name="columns"
                        onchange="this.form.submit()"
                        class="border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm py-1.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        @foreach([2, 3, 4, 5, 6] as $col)
                        <option value="{{ $col }}" {{ ($columns ?? 3) == $col ? 'selected' : '' }}>{{ $col }}</option>
                        @endforeach
                    </select>
                </div>
                @endif
            </div>

            {{-- Filters --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 xl:grid-cols-6 gap-4">
                {{-- Category Filter --}}
                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Category</label>
                    <select
                        name="category"
                        id="category"
                        class="block w-full border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">All Categories</option>
                        @foreach($categories as $cat)
                        <option value="{{ $cat }}" {{ ($selectedCategory ?? '') === $cat ? 'selected' : '' }}>{{ $cat }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Brand Filter --}}
                <div>
                    <label for="brand" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Brand</label>
                    <select
                        name="brand"
                        id="brand"
                        class="block w-full border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">All Brands</option>
                        @foreach($brands as $br)
                        <option value="{{ $br }}" {{ ($selectedBrand ?? '') === $br ? 'selected' : '' }}>{{ $br }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Featured Filter --}}
                <div>
                    <label for="is_featured" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Featured</label>
                    <select
                        name="is_featured"
                        id="is_featured"
                        class="block w-full border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">All</option>
                        <option value="1" {{ ($isFeatured ?? '') === '1' ? 'selected' : '' }}>Featured Only</option>
                        <option value="0" {{ ($isFeatured ?? '') === '0' ? 'selected' : '' }}>Non-Featured</option>
                    </select>
                </div>

                {{-- New Filter --}}
                <div>
                    <label for="is_new" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">New Arrivals</label>
                    <select
                        name="is_new"
                        id="is_new"
                        class="block w-full border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                        <option value="">All</option>
                        <option value="1" {{ ($isNew ?? '') === '1' ? 'selected' : '' }}>New Only</option>
                        <option value="0" {{ ($isNew ?? '') === '0' ? 'selected' : '' }}>Not New</option>
                    </select>
                </div>

                {{-- Min Price --}}
                <div>
                    <label for="min_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Min Price</label>
                    <input
                        type="number"
                        name="min_price"
                        id="min_price"
                        value="{{ $minPrice ?? '' }}"
                        placeholder="$0"
                        min="0"
                        step="0.01"
                        class="block w-full border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>

                {{-- Max Price --}}
                <div>
                    <label for="max_price" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Max Price</label>
                    <input
                        type="number"
                        name="max_price"
                        id="max_price"
                        value="{{ $maxPrice ?? '' }}"
                        placeholder="$9999"
                        min="0"
                        step="0.01"
                        class="block w-full border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm py-2 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    >
                </div>
            </div>

            {{-- Sorting & Actions --}}
            <div class="flex flex-wrap items-center justify-between gap-4 pt-4 border-t border-gray-200 dark:border-gray-700">
                <div class="flex items-center gap-4">
                    {{-- Sort By --}}
                    <div class="flex items-center gap-2">
                        <label for="sort" class="text-sm font-medium text-gray-700 dark:text-gray-300">Sort by:</label>
                        <select
                            name="sort"
                            id="sort"
                            class="border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm py-1.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="name" {{ ($currentSort ?? 'name') === 'name' ? 'selected' : '' }}>Name</option>
                            <option value="price" {{ ($currentSort ?? 'name') === 'price' ? 'selected' : '' }}>Price</option>
                            <option value="rating" {{ ($currentSort ?? 'name') === 'rating' ? 'selected' : '' }}>Rating</option>
                            <option value="stock" {{ ($currentSort ?? 'name') === 'stock' ? 'selected' : '' }}>Stock</option>
                        </select>
                    </div>

                    {{-- Direction --}}
                    <div class="flex items-center gap-2">
                        <label for="direction" class="text-sm font-medium text-gray-700 dark:text-gray-300">Order:</label>
                        <select
                            name="direction"
                            id="direction"
                            class="border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-white text-sm py-1.5 px-3 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        >
                            <option value="asc" {{ ($currentDirection ?? 'asc') === 'asc' ? 'selected' : '' }}>Ascending</option>
                            <option value="desc" {{ ($currentDirection ?? 'asc') === 'desc' ? 'selected' : '' }}>Descending</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center gap-2">
                    <button
                        type="submit"
                        class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                    >
                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z" clip-rule="evenodd" />
                        </svg>
                        Apply Filters
                    </button>
                    <a
                        href="{{ route('grids.demo') }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 text-sm font-medium rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800"
                    >
                        <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" />
                        </svg>
                        Reset
                    </a>
                </div>
            </div>

            {{-- Hidden fields to preserve layout/columns on filter submit --}}
            <input type="hidden" name="layout" value="{{ $layout ?? 'grid' }}">
            <input type="hidden" name="columns" value="{{ $columns ?? 3 }}">
        </form>
    </div>

    {{-- Results Count --}}
    <div class="flex items-center justify-between">
        <p class="text-sm text-gray-600 dark:text-gray-400">
            Showing <span class="font-semibold text-gray-900 dark:text-white">{{ $products->count() }}</span> products
        </p>
    </div>

    {{-- Products Grid/List --}}
    @if($products->isEmpty())
        {{-- Empty State --}}
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-12 text-center">
            <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5m6 4.125l2.25 2.25m0 0l2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />
            </svg>
            <h3 class="mt-4 text-lg font-medium text-gray-900 dark:text-white">No products found</h3>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">Try adjusting your search or filter criteria.</p>
            <a
                href="{{ route('grids.demo') }}"
                class="mt-6 inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium rounded-lg transition-colors"
            >
                Clear all filters
            </a>
        </div>
    @else
        @if(($layout ?? 'grid') === 'list')
            {{-- List Layout --}}
            <div class="space-y-4">
                @foreach($products as $product)
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow overflow-hidden hover:shadow-md transition-shadow">
                    <div class="flex">
                        {{-- Image --}}
                        <div class="flex-shrink-0 w-48 h-36">
                            <img
                                src="{{ $product->image }}"
                                alt="{{ $product->name }}"
                                class="w-full h-full object-cover"
                            >
                        </div>
                        {{-- Content --}}
                        <div class="flex-1 p-4 flex flex-col justify-between">
                            <div>
                                <div class="flex items-start justify-between">
                                    <div>
                                        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $product->name }}</h3>
                                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">{{ $product->brand }} &middot; {{ $product->category }}</p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        @if($product->is_new)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">New</span>
                                        @endif
                                        @if($product->is_featured)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">Featured</span>
                                        @endif
                                    </div>
                                </div>
                                <p class="mt-2 text-sm text-gray-600 dark:text-gray-300 line-clamp-2">{{ $product->description }}</p>
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <div class="flex items-center gap-6 text-sm">
                                    <span class="text-2xl font-bold text-gray-900 dark:text-white">${{ number_format($product->price, 2) }}</span>
                                    <div class="flex items-center gap-1 text-yellow-500">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                            <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                                        </svg>
                                        <span class="text-gray-600 dark:text-gray-400">{{ $product->rating }}</span>
                                    </div>
                                    <span class="text-gray-500 dark:text-gray-400">{{ $product->stock }} in stock</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <button class="px-3 py-1.5 text-sm text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300 font-medium">View</button>
                                    <button class="px-3 py-1.5 text-sm bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">Add to Cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            {{-- Grid Layout --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 {{ $columns >= 3 ? 'lg:grid-cols-3' : '' }} {{ $columns >= 4 ? 'xl:grid-cols-4' : '' }} {{ $columns >= 5 ? '2xl:grid-cols-5' : '' }} {{ $columns >= 6 ? '3xl:grid-cols-6' : '' }} gap-6">
                @foreach($products as $product)
                <div class="bg-white dark:bg-gray-800 rounded-lg overflow-hidden ring-1 ring-gray-200 dark:ring-gray-700 shadow-sm hover:shadow-lg transition-all hover:-translate-y-1 group">
                    {{-- Image Container --}}
                    <div class="relative aspect-[4/3] overflow-hidden bg-gray-100 dark:bg-gray-700">
                        <img
                            src="{{ $product->image }}"
                            alt="{{ $product->name }}"
                            class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                        >
                        {{-- Badges --}}
                        <div class="absolute top-2 left-2 flex flex-col gap-1">
                            @if($product->is_new)
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-green-500 text-white shadow">New</span>
                            @endif
                            @if($product->is_featured)
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-medium bg-yellow-500 text-white shadow">Featured</span>
                            @endif
                        </div>
                        {{-- Quick Actions --}}
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-2">
                            <button class="p-2 bg-white rounded-full text-gray-700 hover:bg-gray-100 transition-colors" title="Quick View">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10 12.5a2.5 2.5 0 100-5 2.5 2.5 0 000 5z" />
                                    <path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 010-1.186A10.004 10.004 0 0110 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0110 17c-4.257 0-7.893-2.66-9.336-6.41zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            <button class="p-2 bg-white rounded-full text-gray-700 hover:bg-gray-100 transition-colors" title="Add to Wishlist">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M9.653 16.915l-.005-.003-.019-.01a20.759 20.759 0 01-1.162-.682 22.045 22.045 0 01-2.582-1.9C4.045 12.733 2 10.352 2 7.5a4.5 4.5 0 018-2.828A4.5 4.5 0 0118 7.5c0 2.852-2.044 5.233-3.885 6.82a22.049 22.049 0 01-3.744 2.582l-.019.01-.005.003h-.002a.739.739 0 01-.69.001l-.002-.001z" />
                                </svg>
                            </button>
                            <button class="p-2 bg-blue-600 rounded-full text-white hover:bg-blue-700 transition-colors" title="Add to Cart">
                                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M1 1.75A.75.75 0 011.75 1h1.628a1.75 1.75 0 011.734 1.51L5.18 3a65.25 65.25 0 0113.36 1.412.75.75 0 01.58.875 48.645 48.645 0 01-1.618 6.2.75.75 0 01-.712.513H6a2.503 2.503 0 00-2.292 1.5H17.25a.75.75 0 010 1.5H2.76a.75.75 0 01-.748-.807 4.002 4.002 0 012.716-3.486L3.626 2.716a.25.25 0 00-.248-.216H1.75A.75.75 0 011 1.75zM6 17.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15.5 19a1.5 1.5 0 100-3 1.5 1.5 0 000 3z" />
                                </svg>
                            </button>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-4">
                        <div class="flex items-start justify-between gap-2">
                            <div class="min-w-0">
                                <p class="text-xs text-gray-500 dark:text-gray-400 uppercase tracking-wide">{{ $product->brand }}</p>
                                <h3 class="mt-1 text-base font-semibold text-gray-900 dark:text-white truncate" title="{{ $product->name }}">{{ $product->name }}</h3>
                            </div>
                            <div class="flex items-center gap-1 flex-shrink-0">
                                <svg class="w-4 h-4 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.868 2.884c-.321-.772-1.415-.772-1.736 0l-1.83 4.401-4.753.381c-.833.067-1.171 1.107-.536 1.651l3.62 3.102-1.106 4.637c-.194.813.691 1.456 1.405 1.02L10 15.591l4.069 2.485c.713.436 1.598-.207 1.404-1.02l-1.106-4.637 3.62-3.102c.635-.544.297-1.584-.536-1.65l-4.752-.382-1.831-4.401z" clip-rule="evenodd" />
                                </svg>
                                <span class="text-sm font-medium text-gray-600 dark:text-gray-400">{{ $product->rating }}</span>
                            </div>
                        </div>
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 line-clamp-2">{{ $product->description }}</p>
                    </div>

                    {{-- Footer --}}
                    <div class="px-4 py-3 bg-gray-50 dark:bg-gray-700/50 border-t border-gray-200 dark:border-gray-700">
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-lg font-bold text-gray-900 dark:text-white">${{ number_format($product->price, 2) }}</span>
                                <span class="ml-2 text-xs text-gray-500 dark:text-gray-400">{{ $product->stock }} in stock</span>
                            </div>
                            <span class="text-xs px-2 py-1 rounded bg-gray-200 dark:bg-gray-600 text-gray-600 dark:text-gray-300">{{ $product->category }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    @endif

    {{-- Usage Code Example --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Usage Example</h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-4">
            This demo showcases the Grids package capabilities. Here's how you would use it with Eloquent models:
        </p>
        <pre class="bg-gray-900 text-gray-100 p-4 rounded-lg overflow-x-auto text-sm"><code>use Accelade\Grids\Grid;
use Accelade\Grids\Cards\Card;
use Accelade\Grids\Cards\CardSection;
use Accelade\Filters\Components\SelectFilter;
use Accelade\Filters\Components\BooleanFilter;
use Accelade\Filters\Components\NumberFilter;

$grid = Grid::make('products')
    ->query(Product::query())
    ->columns(3) // or responsive: ['default' => 1, 'sm' => 2, 'lg' => 3]
    ->gap('6')
    ->searchable(['name', 'description'])
    ->sortable([
        'name' => 'Name',
        'price' => 'Price',
        'rating' => 'Rating',
        'created_at' => 'Date Added',
    ])
    ->filters([
        SelectFilter::make('category')
            ->label('Category')
            ->options(Category::pluck('name', 'id')),

        SelectFilter::make('brand')
            ->label('Brand')
            ->options(Brand::pluck('name', 'id')),

        BooleanFilter::make('is_featured')
            ->label('Featured Only'),

        NumberFilter::make('price')
            ->label('Price Range')
            ->min(0)
            ->max(10000),
    ])
    ->card(
        Card::make()
            ->title(fn ($record) => $record->name)
            ->description(fn ($record) => $record->description)
            ->image(fn ($record) => $record->image_url)
            ->badge(fn ($record) => $record->is_new ? 'New' : null, 'green')
            ->sections([
                CardSection::make()
                    ->label('Price')
                    ->value(fn ($record) => '$' . number_format($record->price, 2))
                    ->icon('heroicon-o-currency-dollar'),

                CardSection::make()
                    ->label('Rating')
                    ->value(fn ($record) => $record->rating . '/5')
                    ->icon('heroicon-o-star'),
            ])
    )
    ->emptyStateHeading('No products found')
    ->emptyStateDescription('Try adjusting your filters.')
    ->emptyStateIcon('heroicon-o-shopping-bag')
    ->fromRequest();

// In your view
{!! $grid !!}</code></pre>
    </div>

    {{-- Features List --}}
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Grid Features</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <div class="flex items-start gap-3">
                <div class="flex-shrink-0 w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-600 dark:text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M4.25 2A2.25 2.25 0 002 4.25v2.5A2.25 2.25 0 004.25 9h2.5A2.25 2.25 0 009 6.75v-2.5A2.25 2.25 0 006.75 2h-2.5zm0 9A2.25 2.25 0 002 13.25v2.5A2.25 2.25 0 004.25 18h2.5A2.25 2.25 0 009 15.75v-2.5A2.25 2.25 0 006.75 11h-2.5zm9-9A2.25 2.25 0 0011 4.25v2.5A2.25 2.25 0 0013.25 9h2.5A2.25 2.25 0 0018 6.75v-2.5A2.25 2.25 0 0015.75 2h-2.5zm0 9A2.25 2.25 0 0011 13.25v2.5A2.25 2.25 0 0013.25 18h2.5A2.25 2.25 0 0018 15.75v-2.5A2.25 2.25 0 0015.75 11h-2.5z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900 dark:text-white">Responsive Grid</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Configurable columns with breakpoint support</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <div class="flex-shrink-0 w-8 h-8 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-green-600 dark:text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900 dark:text-white">Advanced Filters</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Text, Select, Boolean, Number, Date filters</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <div class="flex-shrink-0 w-8 h-8 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-purple-600 dark:text-purple-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M2.24 6.8a.75.75 0 001.06-.04l1.95-2.1v8.59a.75.75 0 001.5 0V4.66l1.95 2.1a.75.75 0 101.1-1.02l-3.25-3.5a.75.75 0 00-1.1 0L2.2 5.74a.75.75 0 00.04 1.06zm8 6.4a.75.75 0 00-.04 1.06l3.25 3.5a.75.75 0 001.1 0l3.25-3.5a.75.75 0 10-1.1-1.02l-1.95 2.1V6.75a.75.75 0 00-1.5 0v8.59l-1.95-2.1a.75.75 0 00-1.06-.04z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900 dark:text-white">Sorting</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Multi-column sorting with direction control</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <div class="flex-shrink-0 w-8 h-8 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-yellow-600 dark:text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900 dark:text-white">Full-text Search</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Search across multiple columns</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <div class="flex-shrink-0 w-8 h-8 bg-red-100 dark:bg-red-900 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-red-600 dark:text-red-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M1 2.75A.75.75 0 011.75 2h16.5a.75.75 0 010 1.5H1.75A.75.75 0 011 2.75zm0 5A.75.75 0 011.75 7h16.5a.75.75 0 010 1.5H1.75A.75.75 0 011 7.75zM1.75 12a.75.75 0 000 1.5h10.5a.75.75 0 000-1.5H1.75z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900 dark:text-white">Layout Modes</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Grid, List, and Masonry layouts</p>
                </div>
            </div>

            <div class="flex items-start gap-3">
                <div class="flex-shrink-0 w-8 h-8 bg-indigo-100 dark:bg-indigo-900 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0zM1.75 14.5a.75.75 0 000 1.5c4.417 0 8.693.603 12.749 1.73 1.111.309 2.251-.512 2.251-1.696v-.784a.75.75 0 00-1.5 0v.784a.272.272 0 01-.35.25A49.043 49.043 0 001.75 14.5z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div>
                    <h3 class="font-medium text-gray-900 dark:text-white">Card Components</h3>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Customizable cards with sections and actions</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
