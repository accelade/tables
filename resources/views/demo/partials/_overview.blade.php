{{-- Grids Overview Demo - E-commerce Style User Grid with Sidebar Filters --}}
@props(['prefix' => 'a'])

@php
    use App\Models\User;

    $showAttr = match($prefix) {
        'v' => 'v-show',
        'data-state' => 'data-state-show',
        's' => 's-show',
        'ng' => 'ng-show',
        default => 'a-show',
    };

    $textAttr = match($prefix) {
        'v' => 'v-text',
        'data-state' => 'data-state-text',
        's' => 's-text',
        'ng' => 'ng-text',
        default => 'a-text',
    };

    // Fetch users from the database
    $users = User::query()
        ->orderBy('created_at', 'desc')
        ->limit(12)
        ->get()
        ->map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'avatar' => 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random&size=200',
                'verified' => $user->email_verified_at !== null,
                'created_at' => $user->created_at->format('M d, Y'),
                'created_at_diff' => $user->created_at->diffForHumans(),
                'initial' => strtoupper(substr($user->name, 0, 1)),
                'role' => match(true) {
                    str_contains(strtolower($user->email), 'admin') => 'Admin',
                    str_contains(strtolower($user->email), 'manager') => 'Manager',
                    $user->id <= 10 => 'Staff',
                    default => 'Member',
                },
            ];
        })
        ->toArray();

    $roles = ['Admin', 'Manager', 'Staff', 'Member'];

    // Role badge colors
    $roleColors = [
        'Admin' => 'bg-rose-100 text-rose-700 dark:bg-rose-500/20 dark:text-rose-400',
        'Manager' => 'bg-amber-100 text-amber-700 dark:bg-amber-500/20 dark:text-amber-400',
        'Staff' => 'bg-sky-100 text-sky-700 dark:bg-sky-500/20 dark:text-sky-400',
        'Member' => 'bg-gray-100 text-gray-700 dark:bg-gray-500/20 dark:text-gray-400',
    ];
@endphp

<div class="space-y-6">
    {{-- Introduction --}}
    <div class="prose dark:prose-invert max-w-none">
        <p class="text-gray-600 dark:text-gray-400">
            The Grids package provides a powerful way to display data in card-based layouts. This demo shows a
            <strong class="text-gray-900 dark:text-white">user management grid</strong> with sidebar filters,
            similar to e-commerce product pages. The data is loaded from the
            <strong class="text-gray-900 dark:text-white">User model</strong> ({{ count($users) }} users shown).
        </p>
    </div>

    {{-- Main Layout: Sidebar + Grid --}}
    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10 overflow-hidden">
        {{-- Header --}}
        <div class="px-6 py-4 border-b border-gray-200 dark:border-white/10">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-primary-50 dark:bg-primary-500/10">
                        <svg class="w-5 h-5 text-primary-600 dark:text-primary-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
                        </svg>
                    </div>
                    <div>
                        <h3 class="text-base font-semibold text-gray-950 dark:text-white">User Management Grid</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ count($users) }} users from database</p>
                    </div>
                </div>
            </div>
        </div>

        <x-accelade::toggle :data="['sidebarOpen' => true]">
            <div class="flex">
                {{-- Sidebar Filters --}}
                <div
                    {{ $showAttr }}="sidebarOpen"
                    class="w-64 flex-shrink-0 border-r border-gray-200 dark:border-white/10 bg-gray-50 dark:bg-white/5"
                >
                    <div class="p-4 space-y-6">
                        {{-- Sidebar Header --}}
                        <div class="flex items-center justify-between">
                            <h4 class="text-sm font-semibold text-gray-900 dark:text-white">Filters</h4>
                            <span class="text-xs text-gray-500 dark:text-gray-400">Demo Only</span>
                        </div>

                        {{-- Search Filter (Visual Only) --}}
                        <div class="space-y-2">
                            <label class="text-xs font-medium text-gray-700 dark:text-gray-300">Search</label>
                            <div class="relative">
                                <div class="pointer-events-none absolute inset-y-0 start-0 flex items-center ps-3">
                                    <svg class="h-4 w-4 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input
                                    type="search"
                                    placeholder="Search users..."
                                    class="block w-full rounded-lg border-0 py-2 ps-9 pe-3 text-sm text-gray-900 dark:text-white bg-white dark:bg-white/5 ring-1 ring-inset ring-gray-300 dark:ring-white/10 placeholder:text-gray-400 focus:ring-2 focus:ring-primary-500"
                                >
                            </div>
                        </div>

                        {{-- Role Filter (Visual Only) --}}
                        <div class="space-y-2">
                            <label class="text-xs font-medium text-gray-700 dark:text-gray-300">Role</label>
                            <div class="space-y-1.5">
                                <label class="flex items-center gap-2 cursor-pointer p-1.5 rounded hover:bg-white dark:hover:bg-white/5">
                                    <input type="radio" name="role" value="" checked class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500">
                                    <span class="text-sm text-gray-700 dark:text-gray-300">All Roles</span>
                                </label>
                                @foreach($roles as $r)
                                <label class="flex items-center gap-2 cursor-pointer p-1.5 rounded hover:bg-white dark:hover:bg-white/5">
                                    <input type="radio" name="role" value="{{ $r }}" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500">
                                    <span class="text-sm text-gray-700 dark:text-gray-300">{{ $r }}</span>
                                    <span class="ml-auto px-1.5 py-0.5 text-xs rounded {{ $roleColors[$r] }}">
                                        {{ collect($users)->where('role', $r)->count() }}
                                    </span>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Verified Filter (Visual Only) --}}
                        <div class="space-y-2">
                            <label class="text-xs font-medium text-gray-700 dark:text-gray-300">Email Status</label>
                            <div class="space-y-1.5">
                                <label class="flex items-center gap-2 cursor-pointer p-1.5 rounded hover:bg-white dark:hover:bg-white/5">
                                    <input type="radio" name="verified" value="" checked class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500">
                                    <span class="text-sm text-gray-700 dark:text-gray-300">All</span>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer p-1.5 rounded hover:bg-white dark:hover:bg-white/5">
                                    <input type="radio" name="verified" value="verified" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500">
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Verified</span>
                                    <svg class="ml-auto h-4 w-4 text-emerald-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.403 12.652a3 3 0 0 0 0-5.304 3 3 0 0 0-3.75-3.751 3 3 0 0 0-5.305 0 3 3 0 0 0-3.751 3.75 3 3 0 0 0 0 5.305 3 3 0 0 0 3.75 3.751 3 3 0 0 0 5.305 0 3 3 0 0 0 3.751-3.75Zm-2.546-4.46a.75.75 0 0 0-1.214-.883l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                                    </svg>
                                </label>
                                <label class="flex items-center gap-2 cursor-pointer p-1.5 rounded hover:bg-white dark:hover:bg-white/5">
                                    <input type="radio" name="verified" value="unverified" class="h-4 w-4 border-gray-300 text-primary-600 focus:ring-primary-500">
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Unverified</span>
                                    <svg class="ml-auto h-4 w-4 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z" clip-rule="evenodd" />
                                    </svg>
                                </label>
                            </div>
                        </div>

                        {{-- Sort Filter (Visual Only) --}}
                        <div class="space-y-2">
                            <label class="text-xs font-medium text-gray-700 dark:text-gray-300">Sort By</label>
                            <select class="w-full rounded-lg border-0 py-2 pl-3 pr-8 text-sm text-gray-900 dark:text-white bg-white dark:bg-white/5 ring-1 ring-inset ring-gray-300 dark:ring-white/10 focus:ring-2 focus:ring-primary-500">
                                <option value="newest">Newest First</option>
                                <option value="oldest">Oldest First</option>
                                <option value="name_asc">Name A-Z</option>
                                <option value="name_desc">Name Z-A</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Main Content --}}
                <div class="flex-1 min-w-0">
                    {{-- Toolbar --}}
                    <div class="px-4 py-3 border-b border-gray-200 dark:border-white/10 bg-gray-50/50 dark:bg-white/2.5">
                        <div class="flex items-center justify-between gap-4">
                            {{-- Toggle Sidebar --}}
                            <button
                                type="button"
                                @click.prevent="toggle('sidebarOpen')"
                                class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 bg-white dark:bg-white/5 ring-1 ring-inset ring-gray-300 dark:ring-white/10 hover:bg-gray-50 dark:hover:bg-white/10"
                            >
                                <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z" clip-rule="evenodd" />
                                </svg>
                                <span {{ $showAttr }}="sidebarOpen">Hide Filters</span>
                                <span {{ $showAttr }}="!sidebarOpen">Show Filters</span>
                            </button>

                            <div class="flex items-center gap-3">
                                {{-- Layout Info --}}
                                <span class="text-xs text-gray-500 dark:text-gray-400">3-column grid</span>
                            </div>
                        </div>
                    </div>

                    {{-- User Cards - Static Grid --}}
                    <div class="p-4">
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            @foreach($users as $user)
                            <div class="group relative flex flex-col overflow-hidden rounded-xl bg-white dark:bg-gray-800 ring-1 ring-gray-200 dark:ring-white/10 hover:ring-primary-500 transition-all duration-200 hover:shadow-md">
                                {{-- Card Header with Avatar --}}
                                <div class="p-4 text-center border-b border-gray-100 dark:border-white/5">
                                    <img
                                        src="{{ $user['avatar'] }}"
                                        alt="{{ $user['name'] }}"
                                        class="mx-auto h-16 w-16 rounded-full object-cover ring-2 ring-white dark:ring-gray-700 shadow-sm"
                                    >
                                    <h4 class="mt-3 text-sm font-semibold text-gray-900 dark:text-white truncate">
                                        {{ $user['name'] }}
                                    </h4>
                                    <p class="text-xs text-gray-500 dark:text-gray-400 truncate">
                                        {{ $user['email'] }}
                                    </p>
                                </div>

                                {{-- Card Body --}}
                                <div class="p-4 flex-1 space-y-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">Role</span>
                                        <span class="px-2 py-0.5 text-xs font-medium rounded-full {{ $roleColors[$user['role']] }}">
                                            {{ $user['role'] }}
                                        </span>
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">Status</span>
                                        @if($user['verified'])
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-emerald-100 text-emerald-700 dark:bg-emerald-500/20 dark:text-emerald-400">
                                            <svg class="h-3 w-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M16.403 12.652a3 3 0 0 0 0-5.304 3 3 0 0 0-3.75-3.751 3 3 0 0 0-5.305 0 3 3 0 0 0-3.751 3.75 3 3 0 0 0 0 5.305 3 3 0 0 0 3.75 3.751 3 3 0 0 0 5.305 0 3 3 0 0 0 3.751-3.75Zm-2.546-4.46a.75.75 0 0 0-1.214-.883l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z" clip-rule="evenodd" />
                                            </svg>
                                            Verified
                                        </span>
                                        @else
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-medium rounded-full bg-gray-100 text-gray-600 dark:bg-gray-500/20 dark:text-gray-400">
                                            Unverified
                                        </span>
                                        @endif
                                    </div>
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">Joined</span>
                                        <span class="text-xs font-medium text-gray-700 dark:text-gray-300">{{ $user['created_at_diff'] }}</span>
                                    </div>
                                </div>

                                {{-- Card Actions --}}
                                <div class="p-3 border-t border-gray-100 dark:border-white/5 bg-gray-50 dark:bg-white/2.5">
                                    <div class="flex items-center justify-center gap-2">
                                        <button type="button" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg text-gray-700 dark:text-gray-300 bg-white dark:bg-white/5 ring-1 ring-inset ring-gray-300 dark:ring-white/10 hover:bg-gray-50 dark:hover:bg-white/10 transition-colors">
                                            <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12.5a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5Z" />
                                                <path fill-rule="evenodd" d="M.664 10.59a1.651 1.651 0 0 1 0-1.186A10.004 10.004 0 0 1 10 3c4.257 0 7.893 2.66 9.336 6.41.147.381.146.804 0 1.186A10.004 10.004 0 0 1 10 17c-4.257 0-7.893-2.66-9.336-6.41ZM14 10a4 4 0 1 1-8 0 4 4 0 0 1 8 0Z" clip-rule="evenodd" />
                                            </svg>
                                            View
                                        </button>
                                        <button type="button" class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium rounded-lg text-primary-700 dark:text-primary-400 bg-primary-50 dark:bg-primary-500/10 hover:bg-primary-100 dark:hover:bg-primary-500/20 transition-colors">
                                            <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                                <path d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                                                <path d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                                            </svg>
                                            Edit
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </x-accelade::toggle>
    </div>

    {{-- Features Grid --}}
    <div class="bg-white dark:bg-gray-900 rounded-xl shadow-sm ring-1 ring-gray-950/5 dark:ring-white/10 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200 dark:border-white/10">
            <h4 class="text-base font-semibold text-gray-950 dark:text-white">Grid Package Features</h4>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div class="flex items-start gap-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-primary-50 dark:bg-primary-500/10">
                        <svg class="h-5 w-5 text-primary-600 dark:text-primary-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.25 2A2.25 2.25 0 002 4.25v2.5A2.25 2.25 0 004.25 9h2.5A2.25 2.25 0 009 6.75v-2.5A2.25 2.25 0 006.75 2h-2.5zm0 9A2.25 2.25 0 002 13.25v2.5A2.25 2.25 0 004.25 18h2.5A2.25 2.25 0 009 15.75v-2.5A2.25 2.25 0 006.75 11h-2.5zm9-9A2.25 2.25 0 0011 4.25v2.5A2.25 2.25 0 0013.25 9h2.5A2.25 2.25 0 0018 6.75v-2.5A2.25 2.25 0 0015.75 2h-2.5zm0 9A2.25 2.25 0 0011 13.25v2.5A2.25 2.25 0 0013.25 18h2.5A2.25 2.25 0 0018 15.75v-2.5A2.25 2.25 0 0015.75 11h-2.5z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">Responsive Grid</p>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Configurable columns per breakpoint</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-emerald-50 dark:bg-emerald-500/10">
                        <svg class="h-5 w-5 text-emerald-600 dark:text-emerald-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M2.628 1.601C5.028 1.206 7.49 1 10 1s4.973.206 7.372.601a.75.75 0 01.628.74v2.288a2.25 2.25 0 01-.659 1.59l-4.682 4.683a2.25 2.25 0 00-.659 1.59v3.037c0 .684-.31 1.33-.844 1.757l-1.937 1.55A.75.75 0 018 18.25v-5.757a2.25 2.25 0 00-.659-1.591L2.659 6.22A2.25 2.25 0 012 4.629V2.34a.75.75 0 01.628-.74z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">Sidebar Filters</p>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Collapsible filter panel like e-commerce</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-sky-50 dark:bg-sky-500/10">
                        <svg class="h-5 w-5 text-sky-600 dark:text-sky-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M4.5 2A1.5 1.5 0 0 0 3 3.5v13A1.5 1.5 0 0 0 4.5 18h11a1.5 1.5 0 0 0 1.5-1.5V7.621a1.5 1.5 0 0 0-.44-1.06l-4.12-4.122A1.5 1.5 0 0 0 11.378 2H4.5Zm2.25 8.5a.75.75 0 0 0 0 1.5h6.5a.75.75 0 0 0 0-1.5h-6.5Zm0 3a.75.75 0 0 0 0 1.5h6.5a.75.75 0 0 0 0-1.5h-6.5Z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">Real Database</p>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Uses User model with Eloquent queries</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-amber-50 dark:bg-amber-500/10">
                        <svg class="h-5 w-5 text-amber-600 dark:text-amber-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">Client-side Search</p>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Instant filtering with Accelade reactivity</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-rose-50 dark:bg-rose-500/10">
                        <svg class="h-5 w-5 text-rose-600 dark:text-rose-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M1 2.75A.75.75 0 011.75 2h16.5a.75.75 0 010 1.5H1.75A.75.75 0 011 2.75zm0 5A.75.75 0 011.75 7h16.5a.75.75 0 010 1.5H1.75A.75.75 0 011 7.75zM1.75 12a.75.75 0 000 1.5h10.5a.75.75 0 000-1.5H1.75z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">Layout Modes</p>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Grid and List views with toggle</p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-gray-100 dark:bg-gray-500/10">
                        <svg class="h-5 w-5 text-gray-600 dark:text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M1 4a1 1 0 011-1h16a1 1 0 011 1v8a1 1 0 01-1 1H2a1 1 0 01-1-1V4zm12 4a3 3 0 11-6 0 3 3 0 016 0zM4 9a1 1 0 100-2 1 1 0 000 2zm13-1a1 1 0 11-2 0 1 1 0 012 0z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-900 dark:text-white">Card Components</p>
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Customizable card templates with actions</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Code Example --}}
    <x-accelade::code-block language="php" filename="GridController.php">@verbatim
use Accelade\Grids\Grid;
use Accelade\Grids\Cards\Card;
use Accelade\Grids\Cards\CardSection;
use Accelade\Filters\FilterPanel;
use Accelade\Filters\Components\SelectFilter;
use Accelade\Filters\Components\BooleanFilter;
use Accelade\Actions\ViewAction;
use Accelade\Actions\EditAction;

$grid = Grid::make('users')
    ->query(User::query())
    ->columns(['default' => 1, 'sm' => 2, 'lg' => 3])
    ->gap('4')
    ->searchable(['name', 'email'])
    ->sortable([
        'name' => 'Name',
        'created_at' => 'Date Joined',
    ])
    ->filters([
        SelectFilter::make('role')
            ->label('Role')
            ->options(['Admin', 'Manager', 'Staff', 'Member']),

        BooleanFilter::make('email_verified_at')
            ->label('Verified'),
    ])
    ->filterPanelLayout('sidebar')
    ->card(
        Card::make()
            ->avatar(fn ($user) => $user->avatar_url)
            ->title(fn ($user) => $user->name)
            ->description(fn ($user) => $user->email)
            ->badge(fn ($user) => $user->role, 'primary')
            ->sections([
                CardSection::make()
                    ->label('Status')
                    ->value(fn ($user) => $user->email_verified_at ? 'Verified' : 'Unverified'),
                CardSection::make()
                    ->label('Joined')
                    ->value(fn ($user) => $user->created_at->diffForHumans()),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
            ])
    )
    ->emptyStateHeading('No users found')
    ->emptyStateDescription('Try adjusting your filters.')
    ->fromRequest();

// In your Blade view
{!! $grid !!}
@endverbatim</x-accelade::code-block>
</div>
