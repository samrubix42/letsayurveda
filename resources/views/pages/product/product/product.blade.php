<div class="bg-background min-h-screen py-10" x-data="{ mobileFiltersOpen: false }">
    <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop">
        
        <!-- Header Banner Section -->
        <div class="text-center max-w-3xl mx-auto mb-16 animate-fade-in-up">
            <span class="font-label-caps text-xs text-secondary font-bold tracking-widest uppercase mb-3 block">THE BOUTIQUE</span>
            <h1 class="font-display-lg text-4xl md:text-5xl lg:text-6xl text-primary font-bold leading-tight mb-4">
                Authentic Ayurvedic Formulations
            </h1>
            <p class="font-body-lg text-base md:text-lg text-on-surface-variant leading-relaxed">
                Explore our range of 100% natural, scientifically-validated remedies designed to restore balance, beauty, and vitality.
            </p>
        </div>

        <!-- Top Quick Search and Category Pills -->
        <div class="flex flex-col md:flex-row gap-6 justify-between items-center mb-10 bg-surface-container/30 p-4 rounded-3xl border border-outline-variant/10">
            <!-- Search Input -->
            <div class="relative w-full md:w-96">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-xl">search</span>
                <input 
                    wire:model.live.debounce.300ms="search" 
                    type="text" 
                    placeholder="Search formulas, ingredients, SKUs..." 
                    class="w-full pl-12 pr-4 py-3 bg-surface border border-outline-variant/50 focus:border-primary rounded-full font-body-md text-sm text-on-surface outline-none transition-all placeholder:text-on-surface-variant/60"
                />
            </div>

            <!-- Categories Quick Pills -->
            <div class="flex gap-2 overflow-x-auto w-full md:w-auto no-scrollbar pb-2 md:pb-0 scroll-smooth">
                <button 
                    wire:click="selectCategory(null)" 
                    class="px-5 py-2.5 rounded-full font-label-caps text-[10px] tracking-wider font-bold transition-all duration-300 whitespace-nowrap cursor-pointer active:scale-95 {{ is_null($categorySlug) ? 'bg-primary text-white shadow-sm' : 'bg-surface hover:bg-surface-container-high text-on-surface-variant border border-outline-variant/30' }}"
                >
                    ALL PRODUCTS
                </button>
                @foreach($categories as $cat)
                    <button 
                        wire:click="selectCategory('{{ $cat->slug }}')" 
                        class="px-5 py-2.5 rounded-full font-label-caps text-[10px] tracking-wider font-bold transition-all duration-300 whitespace-nowrap cursor-pointer active:scale-95 {{ $categorySlug === $cat->slug ? 'bg-primary text-white shadow-sm' : 'bg-surface hover:bg-surface-container-high text-on-surface-variant border border-outline-variant/30' }}"
                    >
                        {{ strtoupper($cat->name) }}
                    </button>
                @endforeach
            </div>
        </div>

        <!-- Filters Bar (Mobile filter toggle, sort dropdown, results count) -->
        <div class="flex items-center justify-between border-b border-outline-variant/30 pb-6 mb-8 gap-4">
            <div class="flex items-center gap-4">
                <!-- Mobile Filters Toggle -->
                <button @click="mobileFiltersOpen = true" class="lg:hidden flex items-center gap-2 bg-surface border border-outline-variant/50 px-4 py-2.5 rounded-full font-label-caps text-xs font-bold text-on-surface-variant cursor-pointer active:scale-95">
                    <span class="material-symbols-outlined text-sm">filter_list</span>
                    FILTERS
                </button>
                
                <div class="hidden lg:block text-sm text-on-surface-variant font-body-md">
                    Showing <span class="font-bold text-primary">{{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}</span> of <span class="font-bold text-primary">{{ $products->total() }}</span> formulas
                </div>
            </div>
            
            <!-- Sort dropdown -->
            <div class="flex items-center gap-3 w-full sm:w-auto justify-end">
                <div class="relative min-w-[160px]">
                    <select wire:model.live="sortBy" class="w-full bg-surface border border-outline-variant/50 focus:border-primary rounded-full px-4 py-2.5 font-label-caps text-[10px] tracking-wider font-bold text-on-surface-variant outline-none cursor-pointer">
                        <option value="featured">FEATURED</option>
                        <option value="newest">NEW ARRIVALS</option>
                        <option value="price_asc">PRICE: LOW TO HIGH</option>
                        <option value="price_desc">PRICE: HIGH TO LOW</option>
                        <option value="name_asc">NAME: A TO Z</option>
                        <option value="name_desc">NAME: Z TO A</option>
                    </select>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-10">
            
            <!-- Left Column: Desktop Sidebar Filters -->
            <aside class="hidden lg:block lg:col-span-1 space-y-8">
                
                <!-- Category Filter list -->
                <div class="bg-surface rounded-2xl p-6 border border-outline-variant/20 shadow-sm space-y-4">
                    <h3 class="font-headline-sm text-base text-primary font-bold border-b border-outline-variant/30 pb-3">CATEGORIES</h3>
                    <div class="flex flex-col gap-2.5">
                        <button 
                            wire:click="selectCategory(null)"
                            class="flex items-center justify-between text-left text-sm font-medium transition-colors cursor-pointer {{ is_null($categorySlug) ? 'text-secondary font-bold' : 'text-on-surface-variant hover:text-primary' }}"
                        >
                            <span>All Products</span>
                            <span class="text-[10px] bg-surface-container px-2.5 py-0.5 rounded-full font-bold text-on-surface-variant">{{ \App\Models\Product::where('status', 'active')->count() }}</span>
                        </button>
                        @foreach($categories as $cat)
                            <button 
                                wire:click="selectCategory('{{ $cat->slug }}')"
                                class="flex items-center justify-between text-left text-sm font-medium transition-colors cursor-pointer {{ $categorySlug === $cat->slug ? 'text-secondary font-bold' : 'text-on-surface-variant hover:text-primary' }}"
                            >
                                <span>{{ $cat->name }}</span>
                                <span class="text-[10px] bg-surface-container px-2.5 py-0.5 rounded-full font-bold text-on-surface-variant">{{ $cat->products()->where('status', 'active')->count() }}</span>
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Price Filter -->
                <div class="bg-surface rounded-2xl p-6 border border-outline-variant/20 shadow-sm space-y-4">
                    <h3 class="font-headline-sm text-base text-primary font-bold border-b border-outline-variant/30 pb-3">PRICE RANGE</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="relative flex-1">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs text-on-surface-variant font-bold">₹</span>
                                <input 
                                    wire:model.live.debounce.500ms="minPrice" 
                                    type="number" 
                                    placeholder="Min" 
                                    class="w-full pl-7 pr-2 py-2 bg-surface-container-low border border-outline-variant/40 rounded-lg text-sm text-on-surface outline-none focus:border-primary"
                                />
                            </div>
                            <span class="text-on-surface-variant text-sm">-</span>
                            <div class="relative flex-1">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs text-on-surface-variant font-bold">₹</span>
                                <input 
                                    wire:model.live.debounce.500ms="maxPrice" 
                                    type="number" 
                                    placeholder="Max" 
                                    class="w-full pl-7 pr-2 py-2 bg-surface-container-low border border-outline-variant/40 rounded-lg text-sm text-on-surface outline-none focus:border-primary"
                                />
                            </div>
                        </div>
                        
                        @if($minPrice || $maxPrice)
                            <button 
                                wire:click="$set('minPrice', null); $set('maxPrice', null)" 
                                class="w-full py-2 bg-surface-container hover:bg-surface-container-high text-xs font-label-caps text-on-surface-variant font-bold rounded-lg transition-colors cursor-pointer"
                            >
                                CLEAR PRICE FILTER
                            </button>
                        @endif
                    </div>
                </div>

                <!-- Availability & Options -->
                <div class="bg-surface rounded-2xl p-6 border border-outline-variant/20 shadow-sm space-y-4">
                    <h3 class="font-headline-sm text-base text-primary font-bold border-b border-outline-variant/30 pb-3">AVAILABILITY</h3>
                    <label class="flex items-center gap-3 cursor-pointer text-sm font-medium text-on-surface-variant hover:text-primary transition-colors">
                        <input 
                            wire:model.live="inStockOnly" 
                            type="checkbox" 
                            class="rounded text-primary focus:ring-primary border-outline-variant/50 w-4 h-4 cursor-pointer"
                        />
                        <span>In Stock Only</span>
                    </label>
                </div>

                <!-- Reset Button -->
                @if($search || $categorySlug || $minPrice || $maxPrice || $inStockOnly || $sortBy !== 'featured')
                    <button 
                        wire:click="resetFilters" 
                        class="w-full py-3 bg-secondary hover:bg-secondary/90 text-white font-label-caps text-[10px] tracking-widest font-bold rounded-full transition-all active:scale-95 shadow-md flex items-center justify-center gap-2 cursor-pointer"
                    >
                        <span class="material-symbols-outlined text-sm">restart_alt</span>
                        RESET ALL FILTERS
                    </button>
                @endif
            </aside>

            <!-- Right Column: Products Grid -->
            <div class="lg:col-span-3 space-y-8">
                
                <!-- Active Filter Tags -->
                @if($search || $categorySlug || $minPrice || $maxPrice || $inStockOnly)
                    <div class="flex flex-wrap items-center gap-2 bg-surface-container-low px-5 py-3.5 rounded-2xl border border-outline-variant/20 animate-fade-in-up">
                        <span class="text-xs text-on-surface-variant font-body-md font-medium">Active Filters:</span>
                        @if($categorySlug)
                            <span class="inline-flex items-center gap-1 bg-secondary/10 text-secondary font-bold px-3 py-1 rounded-full text-xs">
                                {{ ucwords(str_replace('-', ' ', $categorySlug)) }}
                                <button wire:click="$set('categorySlug', null)" class="hover:text-primary cursor-pointer flex items-center"><span class="material-symbols-outlined text-[10px] leading-none">close</span></button>
                            </span>
                        @endif
                        @if($search)
                            <span class="inline-flex items-center gap-1 bg-primary/10 text-primary font-bold px-3 py-1 rounded-full text-xs">
                                "{{ $search }}"
                                <button wire:click="$set('search', '')" class="hover:text-secondary cursor-pointer flex items-center"><span class="material-symbols-outlined text-[10px] leading-none">close</span></button>
                            </span>
                        @endif
                        @if($minPrice !== null || $maxPrice !== null)
                            <span class="inline-flex items-center gap-1 bg-primary/10 text-primary font-bold px-3 py-1 rounded-full text-xs">
                                ₹{{ $minPrice ?? '0' }} - ₹{{ $maxPrice ?? $systemMaxPrice }}
                                <button wire:click="$set('minPrice', null); $set('maxPrice', null)" class="hover:text-secondary cursor-pointer flex items-center"><span class="material-symbols-outlined text-[10px] leading-none">close</span></button>
                            </span>
                        @endif
                        @if($inStockOnly)
                            <span class="inline-flex items-center gap-1 bg-primary/10 text-primary font-bold px-3 py-1 rounded-full text-xs">
                                In Stock
                                <button wire:click="$set('inStockOnly', false)" class="hover:text-secondary cursor-pointer flex items-center"><span class="material-symbols-outlined text-[10px] leading-none">close</span></button>
                            </span>
                        @endif
                        
                        <button 
                            wire:click="resetFilters" 
                            class="text-[10px] font-label-caps tracking-widest text-secondary hover:text-primary transition-colors font-bold ml-auto cursor-pointer"
                        >
                            CLEAR ALL
                        </button>
                    </div>
                @endif

                <!-- Empty State -->
                @if($products->isEmpty())
                    <div class="text-center py-24 bg-surface-container/30 rounded-3xl border border-outline-variant/20 max-w-xl mx-auto">
                        <span class="material-symbols-outlined text-6xl text-outline mb-4">spa</span>
                        <h3 class="font-headline-sm text-2xl text-primary font-bold">No Formulas Found</h3>
                        <p class="font-body-md text-sm text-on-surface-variant mt-2 max-w-sm mx-auto leading-relaxed">
                            We couldn't find any remedies matching your criteria. Try adjusting your price range, clearing your search query, or checking another category.
                        </p>
                        <button 
                            wire:click="resetFilters" 
                            class="mt-8 bg-primary hover:bg-primary-container text-white px-8 py-3.5 rounded-full font-label-caps tracking-widest text-[10px] font-bold transition-all active:scale-95 cursor-pointer shadow-md"
                        >
                            RESET FILTERS
                        </button>
                    </div>
                @else
                    <!-- Grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-8">
                        @foreach($products as $prod)
                            @php
                                $defVariant = $prod->defaultVariant;
                                $price = $defVariant ? $defVariant->price : 0;
                                $salePrice = $defVariant ? $defVariant->sale_price : null;
                                $weight = $defVariant ? $defVariant->weight : null;
                                $stock = $defVariant && $defVariant->inventory ? $defVariant->inventory->quantity : 0;
                                
                                // Determine image path
                                $image = $prod->primaryImage ? $prod->primaryImage->image_path : null;
                                $imageSrc = null;
                                if ($image) {
                                    $imageSrc = '/' . $image;
                                }
                                if (!$imageSrc) {
                                    $imageSrc = 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?auto=format&fit=crop&q=80&w=600';
                                }

                                // Get category name
                                $catName = $prod->category ? $prod->category->name : 'Wellness';
                            @endphp
                            <div class="bg-surface rounded-3xl overflow-hidden shadow-sm border border-outline-variant/10 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col group relative">
                                
                                <!-- Top Badges Overlay -->
                                <div class="absolute top-4 left-4 z-10 flex flex-col gap-2">
                                    @if($prod->is_featured)
                                        <span class="bg-primary/95 text-white text-[9px] font-label-caps font-bold px-3 py-1 rounded-full shadow-sm tracking-widest">
                                            RECOMMENDED
                                        </span>
                                    @endif
                                    @if($salePrice)
                                        <span class="bg-secondary/95 text-white text-[9px] font-label-caps font-bold px-3 py-1 rounded-full shadow-sm tracking-widest">
                                            SPECIAL OFFER
                                        </span>
                                    @endif
                                    @if($stock <= 0)
                                        <span class="bg-surface-container-high/90 text-on-surface-variant text-[9px] font-label-caps font-bold px-3 py-1 rounded-full shadow-sm tracking-widest">
                                            OUT OF STOCK
                                        </span>
                                    @endif
                                </div>

                                <!-- Product Image Container -->
                                <div 
                                    @click="selectedProduct = { 
                                        name: '{{ addslashes($prod->name) }}', 
                                        price: '₹{{ $salePrice ?? $price }}', 
                                        desc: '{{ addslashes($prod->short_description) }}', 
                                        image: '{{ $imageSrc }}' 
                                    }; quickViewOpen = true"
                                    class="relative aspect-[4/5] overflow-hidden cursor-pointer bg-surface-container-low"
                                >
                                    <img 
                                        class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500" 
                                        src="{{ $imageSrc }}" 
                                        alt="{{ $prod->name }}"
                                        onerror="this.src='https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?auto=format&fit=crop&q=80&w=600';"
                                    />
                                    <!-- Smooth overlay on hover -->
                                    <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                        <span class="bg-white/90 backdrop-blur-sm text-primary text-[10px] font-label-caps tracking-widest px-5 py-2.5 rounded-full shadow-md transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300 font-bold">
                                            QUICK VIEW
                                        </span>
                                    </div>
                                </div>

                                <!-- Product Info -->
                                <div class="p-6 flex flex-col flex-grow">
                                    <!-- Category and Weight -->
                                    <div class="flex items-center justify-between text-[11px] font-label-caps tracking-wider text-secondary font-bold mb-2">
                                        <span>{{ strtoupper($catName) }}</span>
                                        @if($weight)
                                            <span class="text-on-surface-variant/70 font-medium font-body-md">{{ $weight }} {{ $prod->category && in_array($prod->category->slug, ['skincare', 'haircare', 'wellness-oils']) ? 'ml' : 'g' }}</span>
                                        @endif
                                    </div>

                                    <!-- Name -->
                                    <h4 class="font-display-lg text-lg text-primary font-bold mb-2 line-clamp-1">
                                        <a href="{{ route('products.view', $prod->slug) }}" class="hover:text-secondary transition-colors">
                                            {{ $prod->name }}
                                        </a>
                                    </h4>

                                    <!-- Short Description -->
                                    <p class="text-sm text-on-surface-variant leading-relaxed mb-6 line-clamp-2">
                                        {{ $prod->short_description }}
                                    </p>

                                    <!-- Price & Add To Cart -->
                                    <div class="flex items-center justify-between mt-auto">
                                        <div class="flex items-baseline gap-2">
                                            @if($salePrice)
                                                <span class="font-headline-sm text-lg text-secondary font-bold">₹{{ number_format($salePrice, 0) }}</span>
                                                <span class="text-xs text-on-surface-variant/60 line-through">₹{{ number_format($price, 0) }}</span>
                                            @else
                                                <span class="font-headline-sm text-lg text-secondary font-bold">₹{{ number_format($price, 0) }}</span>
                                            @endif
                                        </div>
                                        
                                        <!-- Cart Trigger button -->
                                        <button 
                                            @click="cartOpen = true"
                                            @if($stock <= 0) disabled @endif
                                            class="p-3.5 rounded-full bg-primary hover:bg-secondary hover:shadow-md text-white transition-all duration-300 active:scale-90 flex items-center justify-center cursor-pointer disabled:bg-surface-container disabled:text-on-surface-variant/40 disabled:cursor-not-allowed"
                                        >
                                            <span class="material-symbols-outlined text-base">add_shopping_cart</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination Footer -->
                    <div class="mt-16 pt-8 border-t border-outline-variant/20">
                        {{ $products->links() }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Mobile Filters Slide-over Drawer -->
        <div aria-labelledby="mobile-filters-title" aria-modal="true" class="fixed inset-0 z-[100] lg:hidden" role="dialog" x-cloak x-show="mobileFiltersOpen">
            <!-- Backdrop -->
            <div @click="mobileFiltersOpen = false" class="absolute inset-0 bg-black/30 backdrop-blur-sm"
                 x-transition:enter="ease-in-out duration-500"
                 x-transition:enter-end="opacity-100"
                 x-transition:enter-start="opacity-0"
                 x-transition:leave="ease-in-out duration-500"
                 x-transition:leave-end="opacity-0"
                 x-transition:leave-start="opacity-100"></div>
            
            <!-- Drawer Content -->
            <div class="fixed inset-y-0 left-0 max-w-full flex">
                <div class="w-screen max-w-xs"
                     x-transition:enter="transform transition ease-in-out duration-500"
                     x-transition:enter-end="translate-x-0"
                     x-transition:enter-start="-translate-x-full"
                     x-transition:leave="transform transition ease-in-out duration-500"
                     x-transition:leave-end="-translate-x-full"
                     x-transition:leave-start="translate-x-0">
                    <div class="h-full flex flex-col bg-surface shadow-2xl">
                        
                        <!-- Header -->
                        <div class="flex items-center justify-between border-b border-outline-variant/30 pb-4 pt-6 px-6">
                            <span class="font-headline-sm text-lg text-primary font-bold">Filters</span>
                            <button @click="mobileFiltersOpen = false" class="text-on-surface-variant cursor-pointer active:scale-95" type="button">
                                <span class="material-symbols-outlined" data-icon="close">close</span>
                            </button>
                        </div>
                        
                        <!-- Body -->
                        <div class="flex-1 py-6 overflow-y-auto px-6 space-y-8">
                            <!-- Category Filter List -->
                            <div class="space-y-4">
                                <h3 class="font-label-caps text-xs text-secondary font-bold tracking-widest">CATEGORIES</h3>
                                <div class="flex flex-col gap-3">
                                    <button 
                                        wire:click="selectCategory(null); mobileFiltersOpen = false"
                                        class="text-left text-sm font-medium transition-colors cursor-pointer {{ is_null($categorySlug) ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}"
                                    >
                                        All Products
                                    </button>
                                    @foreach($categories as $cat)
                                        <button 
                                            wire:click="selectCategory('{{ $cat->slug }}'); mobileFiltersOpen = false"
                                            class="text-left text-sm font-medium transition-colors cursor-pointer {{ $categorySlug === $cat->slug ? 'text-primary font-bold' : 'text-on-surface-variant hover:text-primary' }}"
                                        >
                                            {{ $cat->name }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Price Filter -->
                            <div class="space-y-4">
                                <h3 class="font-label-caps text-xs text-secondary font-bold tracking-widest">PRICE RANGE</h3>
                                <div class="flex items-center gap-3">
                                    <div class="relative flex-1">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs text-on-surface-variant font-bold">₹</span>
                                        <input 
                                            wire:model.live.debounce.500ms="minPrice" 
                                            type="number" 
                                            placeholder="Min" 
                                            class="w-full pl-7 pr-2 py-2 bg-surface-container border border-outline-variant/40 rounded-lg text-sm text-on-surface outline-none font-body-md"
                                        />
                                    </div>
                                    <span class="text-on-surface-variant">-</span>
                                    <div class="relative flex-1">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-xs text-on-surface-variant font-bold">₹</span>
                                        <input 
                                            wire:model.live.debounce.500ms="maxPrice" 
                                            type="number" 
                                            placeholder="Max" 
                                            class="w-full pl-7 pr-2 py-2 bg-surface-container border border-outline-variant/40 rounded-lg text-sm text-on-surface outline-none font-body-md"
                                        />
                                    </div>
                                </div>
                            </div>

                            <!-- Availability -->
                            <div class="space-y-4">
                                <h3 class="font-label-caps text-xs text-secondary font-bold tracking-widest">AVAILABILITY</h3>
                                <label class="flex items-center gap-3 cursor-pointer text-sm font-medium text-on-surface-variant">
                                    <input 
                                        wire:model.live="inStockOnly" 
                                        type="checkbox" 
                                        class="rounded text-primary focus:ring-primary border-outline-variant/50 w-4 h-4 cursor-pointer"
                                    />
                                    <span>In Stock Only</span>
                                </label>
                            </div>
                        </div>
                        
                        <!-- Footer -->
                        <div class="border-t border-outline-variant/30 p-6 bg-surface-container-low">
                            <button 
                                wire:click="resetFilters(); mobileFiltersOpen = false" 
                                class="w-full py-3 bg-primary hover:bg-primary-container text-white font-label-caps text-xs tracking-widest font-bold rounded-full transition-all active:scale-95 shadow-md flex items-center justify-center gap-2 cursor-pointer"
                            >
                                RESET ALL FILTERS
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>