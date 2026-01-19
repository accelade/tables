<?php

declare(strict_types=1);

namespace Accelade\Grids\Http\Controllers;

use Accelade\Grids\Grid;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class GridsDemoController
{
    /**
     * Sample product data for demo.
     */
    protected function getProducts(): Collection
    {
        return collect([
            (object) [
                'id' => 1,
                'name' => 'MacBook Pro 16"',
                'description' => 'Apple M3 Pro chip, 18GB RAM, 512GB SSD. The most powerful MacBook ever.',
                'price' => 2499.00,
                'category' => 'Electronics',
                'brand' => 'Apple',
                'stock' => 15,
                'rating' => 4.9,
                'is_featured' => true,
                'is_new' => true,
                'image' => 'https://picsum.photos/seed/macbook/400/300',
            ],
            (object) [
                'id' => 2,
                'name' => 'Sony WH-1000XM5',
                'description' => 'Industry-leading noise cancellation with exceptional sound quality.',
                'price' => 399.00,
                'category' => 'Electronics',
                'brand' => 'Sony',
                'stock' => 42,
                'rating' => 4.8,
                'is_featured' => true,
                'is_new' => false,
                'image' => 'https://picsum.photos/seed/sony/400/300',
            ],
            (object) [
                'id' => 3,
                'name' => 'Ergonomic Office Chair',
                'description' => 'Premium mesh back with lumbar support. Perfect for long work sessions.',
                'price' => 549.00,
                'category' => 'Furniture',
                'brand' => 'Herman Miller',
                'stock' => 8,
                'rating' => 4.7,
                'is_featured' => false,
                'is_new' => true,
                'image' => 'https://picsum.photos/seed/chair/400/300',
            ],
            (object) [
                'id' => 4,
                'name' => 'Kindle Paperwhite',
                'description' => '6.8" display with adjustable warm light. Waterproof design.',
                'price' => 139.00,
                'category' => 'Electronics',
                'brand' => 'Amazon',
                'stock' => 120,
                'rating' => 4.6,
                'is_featured' => false,
                'is_new' => false,
                'image' => 'https://picsum.photos/seed/kindle/400/300',
            ],
            (object) [
                'id' => 5,
                'name' => 'Standing Desk Pro',
                'description' => 'Electric height-adjustable desk with memory presets. 60" x 30" surface.',
                'price' => 699.00,
                'category' => 'Furniture',
                'brand' => 'Uplift',
                'stock' => 23,
                'rating' => 4.5,
                'is_featured' => true,
                'is_new' => false,
                'image' => 'https://picsum.photos/seed/desk/400/300',
            ],
            (object) [
                'id' => 6,
                'name' => 'AirPods Pro 2',
                'description' => 'Active Noise Cancellation with Adaptive Transparency. USB-C charging.',
                'price' => 249.00,
                'category' => 'Electronics',
                'brand' => 'Apple',
                'stock' => 85,
                'rating' => 4.8,
                'is_featured' => true,
                'is_new' => true,
                'image' => 'https://picsum.photos/seed/airpods/400/300',
            ],
            (object) [
                'id' => 7,
                'name' => 'Minimalist Desk Lamp',
                'description' => 'LED desk lamp with 5 brightness levels and 3 color temperatures.',
                'price' => 89.00,
                'category' => 'Home',
                'brand' => 'BenQ',
                'stock' => 67,
                'rating' => 4.4,
                'is_featured' => false,
                'is_new' => false,
                'image' => 'https://picsum.photos/seed/lamp/400/300',
            ],
            (object) [
                'id' => 8,
                'name' => 'Mechanical Keyboard',
                'description' => 'Cherry MX Brown switches with RGB backlighting. Compact 75% layout.',
                'price' => 179.00,
                'category' => 'Electronics',
                'brand' => 'Keychron',
                'stock' => 34,
                'rating' => 4.7,
                'is_featured' => false,
                'is_new' => true,
                'image' => 'https://picsum.photos/seed/keyboard/400/300',
            ],
            (object) [
                'id' => 9,
                'name' => 'Ultra-wide Monitor',
                'description' => '34" curved display, 3440x1440 resolution, 144Hz refresh rate.',
                'price' => 899.00,
                'category' => 'Electronics',
                'brand' => 'LG',
                'stock' => 12,
                'rating' => 4.6,
                'is_featured' => true,
                'is_new' => false,
                'image' => 'https://picsum.photos/seed/monitor/400/300',
            ],
            (object) [
                'id' => 10,
                'name' => 'Bamboo Desk Organizer',
                'description' => 'Eco-friendly desktop organizer with phone stand and pen holder.',
                'price' => 45.00,
                'category' => 'Home',
                'brand' => 'Grovemade',
                'stock' => 200,
                'rating' => 4.3,
                'is_featured' => false,
                'is_new' => false,
                'image' => 'https://picsum.photos/seed/organizer/400/300',
            ],
            (object) [
                'id' => 11,
                'name' => 'Wireless Charging Pad',
                'description' => '15W fast wireless charger compatible with MagSafe devices.',
                'price' => 49.00,
                'category' => 'Electronics',
                'brand' => 'Belkin',
                'stock' => 150,
                'rating' => 4.2,
                'is_featured' => false,
                'is_new' => true,
                'image' => 'https://picsum.photos/seed/charger/400/300',
            ],
            (object) [
                'id' => 12,
                'name' => 'Leather Desk Mat',
                'description' => 'Premium full-grain leather desk pad. 36" x 17" coverage.',
                'price' => 129.00,
                'category' => 'Home',
                'brand' => 'Grovemade',
                'stock' => 45,
                'rating' => 4.8,
                'is_featured' => true,
                'is_new' => false,
                'image' => 'https://picsum.photos/seed/deskmat/400/300',
            ],
        ]);
    }

    /**
     * Show the comprehensive grid demo.
     */
    public function index(Request $request)
    {
        $products = $this->getProducts();

        // Apply search
        if ($search = $request->get('search')) {
            $products = $products->filter(function ($product) use ($search) {
                return str_contains(strtolower($product->name), strtolower($search)) ||
                       str_contains(strtolower($product->description), strtolower($search));
            });
        }

        // Apply filters
        if ($category = $request->get('category')) {
            $products = $products->where('category', $category);
        }

        if ($brand = $request->get('brand')) {
            $products = $products->where('brand', $brand);
        }

        if ($request->has('is_featured') && $request->get('is_featured') !== '') {
            $products = $products->where('is_featured', (bool) $request->get('is_featured'));
        }

        if ($request->has('is_new') && $request->get('is_new') !== '') {
            $products = $products->where('is_new', (bool) $request->get('is_new'));
        }

        if ($minPrice = $request->get('min_price')) {
            $products = $products->where('price', '>=', (float) $minPrice);
        }

        if ($maxPrice = $request->get('max_price')) {
            $products = $products->where('price', '<=', (float) $maxPrice);
        }

        // Apply sorting
        $sort = $request->get('sort', 'name');
        $direction = $request->get('direction', 'asc');

        $products = $direction === 'desc'
            ? $products->sortByDesc($sort)
            : $products->sortBy($sort);

        // Get unique categories and brands for filters
        $categories = $this->getProducts()->pluck('category')->unique()->sort()->values();
        $brands = $this->getProducts()->pluck('brand')->unique()->sort()->values();

        return view('grids::demo.index', [
            'products' => $products->values(),
            'categories' => $categories,
            'brands' => $brands,
            'search' => $search,
            'selectedCategory' => $category,
            'selectedBrand' => $brand,
            'isFeatured' => $request->get('is_featured'),
            'isNew' => $request->get('is_new'),
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'currentSort' => $sort,
            'currentDirection' => $direction,
            'layout' => $request->get('layout', 'grid'),
            'columns' => (int) $request->get('columns', 3),
        ]);
    }
}
