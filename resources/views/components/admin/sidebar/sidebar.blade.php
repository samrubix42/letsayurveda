@php
    // Define navigation items dynamically
    $menus = [
        [
            'label' => 'Dashboard',
            'href' => '/admin/dashboard',
            'icon' => 'dashboard',
            'active' => request()->is('admin/dashboard'),
        ],
        [
            'label' => 'Product Categories',
            'href' => '/admin/categories',
            'icon' => 'shopping_bag',
            'active' => request()->is('admin/categories*'),
        ],
        [
            'label' => 'Products',
            'href' => '/admin/products',
            'icon' => 'grid_view',
            'active' => request()->is('admin/products*'),
        ],
        [
            'label' => 'Variant Attributes',
            'href' => '/admin/attributes',
            'icon' => 'tune',
            'active' => request()->is('admin/attributes*'),
        ],
        [
            'label' => 'Inventory Management',
            'href' => '/admin/inventory',
            'icon' => 'inventory_2',
            'active' => request()->is('admin/inventory*'),
        ],
        [
            'label' => 'Coupons',
            'href' => '/admin/coupons',
            'icon' => 'confirmation_number',
            'active' => request()->is('admin/coupons*'),
        ],
        [
            'label' => 'Blog Management',
            'icon' => 'article',
            'active' => request()->is('admin/blog*'),
            'submenu' => [
                [
                    'label' => 'All Blogs',
                    'href' => '/admin/blog',
                    'active' => request()->is('admin/blog') || (request()->is('admin/blog/*') && !request()->is('admin/blog/categories*')),
                ],
                [
                    'label' => 'Blog Categories',
                    'href' => '/admin/blog/categories',
                    'active' => request()->is('admin/blog/categories*'),
                ],
            ]
        ],
        [
            'label' => 'Settings',
            'href' => '#',
            'icon' => 'settings',
            'active' => false,
            'disabled' => true,
        ],
    ];

    // Standardized UI Classes
    $menuItemClass = "group flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium transition-all select-none cursor-pointer";
    $menuItemActive = "bg-emerald-50 text-emerald-700 font-bold";
    $menuItemInactive = "text-slate-600 hover:bg-slate-100 hover:text-slate-900";
    $menuItemDisabled = "opacity-50 cursor-not-allowed";

    $iconWrapperClass = "inline-flex h-8 w-8 items-center justify-center rounded-lg border bg-white transition-all";
    $iconWrapperActive = "border-emerald-200 text-emerald-700";
    $iconWrapperInactive = "border-slate-200 text-slate-500 group-hover:text-slate-800";

    $submenuItemClass = "flex items-center gap-3 rounded-lg pl-14 pr-3 py-2 text-xs font-medium transition-all";
    $submenuItemActive = "text-emerald-700 bg-emerald-50/50 font-semibold";
    $submenuItemInactive = "text-slate-500 hover:bg-slate-50 hover:text-slate-800";
@endphp

<div class="h-full">
    <!-- Sidebar Outer Container -->
    <aside class="fixed inset-y-0 left-0 z-50 flex flex-col w-full md:w-72 h-full border-r border-slate-200/80 bg-white shadow-xl shadow-slate-900/10 transition-transform duration-300 ease-out md:translate-x-0 md:static md:inset-auto md:h-full"
           :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full md:translate-x-0'">
        
        <!-- Gradient Accent Bar -->
        <div class="h-1 w-full bg-gradient-to-r from-emerald-500 via-emerald-600 to-teal-600"></div>
        
        <!-- Sidebar Header (Brand/Logo) -->
        <div class="flex h-20 items-center justify-between border-b border-slate-100 px-6">
            <div>
                <p class="text-xs font-semibold uppercase tracking-[0.22em] text-emerald-600">LETS AYURVEDA</p>
                <h1 class="text-lg font-semibold text-slate-900">Admin Portal</h1>
            </div>
            <button @click="sidebarOpen = false" class="inline-flex h-10 w-10 items-center justify-center rounded-xl text-slate-400 hover:text-slate-700 md:hidden active:scale-95 transition-transform" type="button" aria-label="Close sidebar">
                <span class="material-symbols-outlined text-2xl">close</span>
            </button>
        </div>

        <!-- Sidebar Navigation Links -->
        <nav class="flex-1 px-3 py-4 space-y-1.5 overflow-y-auto no-scrollbar font-medium">
            
            @foreach($menus as $menu)
                @if(isset($menu['submenu']))
                    <!-- Submenu Item (collapsible using Alpine.js) -->
                    <div x-data="{ open: @js($menu['active']) }" class="space-y-1">
                        <button @click="open = !open" 
                                type="button"
                                class="w-full text-left {{ $menuItemClass }} {{ $menu['active'] ? $menuItemActive : $menuItemInactive }}">
                            <span class="flex items-center gap-3 flex-1">
                                <span class="{{ $iconWrapperClass }} {{ $menu['active'] ? $iconWrapperActive : $iconWrapperInactive }}">
                                    <span class="material-symbols-outlined text-lg">{{ $menu['icon'] }}</span>
                                </span>
                                <span>{{ $menu['label'] }}</span>
                            </span>
                            <span class="material-symbols-outlined text-base transition-transform duration-200" 
                                  :class="open ? 'rotate-90' : ''">
                                chevron_right
                            </span>
                        </button>
                        
                        <div x-show="open" 
                             x-cloak
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 transform -translate-y-1"
                             x-transition:enter-end="opacity-100 transform translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 transform translate-y-0"
                             x-transition:leave-end="opacity-0 transform -translate-y-1"
                             class="space-y-1">
                            @foreach($menu['submenu'] as $subItem)
                                <a href="{{ $subItem['href'] }}" 
                                   class="{{ $submenuItemClass }} {{ $subItem['active'] ? $submenuItemActive : $submenuItemInactive }}">
                                    <span>{{ $subItem['label'] }}</span>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @else
                    <!-- Regular Menu Item -->
                    <a href="{{ $menu['href'] }}" 
                       class="{{ $menuItemClass }} {{ $menu['active'] ? $menuItemActive : $menuItemInactive }} {{ ($menu['disabled'] ?? false) ? $menuItemDisabled : '' }}"
                       @if($menu['disabled'] ?? false) onclick="return false;" @endif>
                        <span class="{{ $iconWrapperClass }} {{ $menu['active'] ? $iconWrapperActive : $iconWrapperInactive }}">
                            <span class="material-symbols-outlined text-lg">{{ $menu['icon'] }}</span>
                        </span>
                        <span>{{ $menu['label'] }}</span>
                    </a>
                @endif
            @endforeach

        </nav>

        <!-- Sidebar Footer -->
        <div class="p-4 bg-slate-50/50 border-t border-slate-100">
            <a href="/" class="flex items-center justify-center gap-2 px-4 py-2.5 text-xs font-semibold uppercase tracking-wider text-slate-600 hover:text-slate-900 bg-slate-100 hover:bg-slate-200 rounded-xl transition-all">
                <span class="material-symbols-outlined text-base">home</span>
                <span>Back to Live Site</span>
            </a>
        </div>
    </aside>

    <!-- Sidebar Overlay Backdrop for Mobile -->
    <div @click="sidebarOpen = false" 
         class="fixed inset-0 z-40 bg-slate-900/45 backdrop-blur-[1px] md:hidden transition-opacity duration-300"
         x-cloak
         x-show="sidebarOpen"></div>
</div>