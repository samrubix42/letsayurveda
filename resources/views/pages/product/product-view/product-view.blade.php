<div class="bg-background min-h-screen py-10 animate-fade-in-up">
    <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop">
        
        <!-- Breadcrumbs Navigation -->
        <nav class="flex items-center gap-2 text-xs font-label-caps text-on-surface-variant/70 mb-10 pb-4 border-b border-outline-variant/10">
            <a href="/" class="hover:text-primary transition-colors">HOME</a>
            <span>/</span>
            <a href="{{ route('products') }}" class="hover:text-primary transition-colors">SHOP</a>
            <span>/</span>
            @if($product->category)
                <a href="{{ route('products') }}?categorySlug={{ $product->category->slug }}" class="hover:text-primary transition-colors uppercase">
                    {{ $product->category->name }}
                </a>
                <span>/</span>
            @endif
            <span class="text-primary font-bold uppercase truncate max-w-[200px] sm:max-w-none">{{ $product->name }}</span>
        </nav>

        <!-- Main Product Section -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-16 items-start mb-20">
            
            <!-- Left Column: Media Gallery -->
            <div class="lg:col-span-6 space-y-6">
                <!-- Large Active Image -->
                <div class="aspect-square bg-surface-container-low rounded-3xl overflow-hidden border border-outline-variant/20 shadow-sm relative group">
                    <!-- Badges Overlay -->
                    <div class="absolute top-4 left-4 z-10 flex flex-col gap-2">
                        @if($product->is_featured)
                            <span class="bg-primary/95 text-white text-[9px] font-label-caps font-bold px-3 py-1 rounded-full tracking-widest shadow-sm">
                                RECOMMENDED
                            </span>
                        @endif
                        @php
                            $variant = $this->getSelectedVariant();
                            $stock = $variant && $variant->inventory ? $variant->inventory->quantity : 0;
                            $price = $variant ? $variant->price : 0;
                            $salePrice = $variant ? $variant->sale_price : null;
                        @endphp
                        @if($salePrice)
                            <span class="bg-secondary/95 text-white text-[9px] font-label-caps font-bold px-3 py-1 rounded-full tracking-widest shadow-sm">
                                SPECIAL OFFER
                            </span>
                        @endif
                        @if($stock <= 0)
                            <span class="bg-surface-container-high/90 text-on-surface-variant text-[9px] font-label-caps font-bold px-3 py-1 rounded-full tracking-widest shadow-sm">
                                OUT OF STOCK
                            </span>
                        @endif
                    </div>

                    @if($activeImage)
                        <img 
                            src="{{ $activeImage }}" 
                            alt="{{ $product->name }}" 
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-[1.02]"
                            onerror="this.src='https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?auto=format&fit=crop&q=80&w=800';"
                        />
                    @else
                        <div class="w-full h-full flex items-center justify-center text-outline-variant">
                            <span class="material-symbols-outlined text-8xl">spa</span>
                        </div>
                    @endif
                </div>

                <!-- Thumbnails Gallery -->
                @if($product->images->count() > 0)
                    <div class="flex gap-4 overflow-x-auto no-scrollbar py-2">
                        @foreach($product->images as $img)
                            @php $imgPath = '/' . $img->image_path; @endphp
                            <button 
                                wire:click="changeImage('{{ $imgPath }}')"
                                class="w-20 h-20 bg-surface-container-low rounded-2xl overflow-hidden shrink-0 border-2 transition-all cursor-pointer {{ $activeImage === $imgPath ? 'border-secondary shadow-sm scale-95' : 'border-outline-variant/30 hover:border-primary' }}"
                            >
                                <img 
                                    src="{{ $imgPath }}" 
                                    alt="{{ $product->name }} Thumbnail" 
                                    class="w-full h-full object-cover"
                                    onerror="this.src='https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?auto=format&fit=crop&q=80&w=150';"
                                />
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Right Column: Product Information -->
            <div class="lg:col-span-6 space-y-6">
                <!-- Category and Availability -->
                <div class="flex items-center justify-between">
                    <span class="font-label-caps text-xs text-secondary font-bold tracking-widest uppercase">
                        {{ $product->category ? $product->category->name : 'Ayurvedic Formulations' }}
                    </span>
                    @if($stock > 0)
                        <span class="inline-flex items-center gap-1 text-xs text-emerald-700 font-bold bg-emerald-50 px-3 py-1 rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500"></span>
                            IN STOCK ({{ $stock }} items)
                        </span>
                    @else
                        <span class="inline-flex items-center gap-1 text-xs text-red-700 font-bold bg-red-50 px-3 py-1 rounded-full">
                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                            OUT OF STOCK
                        </span>
                    @endif
                </div>

                <!-- Product Name -->
                <h1 class="font-display-lg text-3xl sm:text-4xl lg:text-5xl text-primary font-bold leading-tight">
                    {{ $product->name }}
                </h1>

                <!-- Rating Stars -->
                <div class="flex items-center gap-2">
                    <div class="flex items-center text-secondary">
                        <span class="material-symbols-outlined text-sm fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm fill-icon">star</span>
                        <span class="material-symbols-outlined text-sm fill-icon">star</span>
                    </div>
                    <span class="text-xs text-on-surface-variant font-medium">(48 customer reviews)</span>
                </div>

                <!-- Price Section -->
                <div class="flex items-baseline gap-3 py-2">
                    @if($salePrice)
                        <span class="font-headline-sm text-3xl text-secondary font-bold">₹{{ number_format($salePrice, 0) }}</span>
                        <span class="text-sm text-on-surface-variant/60 line-through">₹{{ number_format($price, 0) }}</span>
                        <span class="text-xs text-emerald-700 bg-emerald-50 font-bold px-2 py-0.5 rounded">
                            SAVE {{ round((($price - $salePrice) / $price) * 100) }}%
                        </span>
                    @else
                        <span class="font-headline-sm text-3xl text-secondary font-bold">₹{{ number_format($price, 0) }}</span>
                    @endif
                </div>

                <!-- Short Description -->
                <p class="font-body-md text-base text-on-surface-variant leading-relaxed">
                    {{ $product->short_description }}
                </p>

                <!-- Variant Selectors -->
                @if($product->variants->count() > 1 || ($product->variants->first() && $product->variants->first()->name !== 'Default Variant'))
                    <div class="space-y-3 pt-4 border-t border-outline-variant/20">
                        <span class="font-label-caps text-xs text-primary font-bold tracking-wider block">AVAILABLE OPTIONS:</span>
                        <div class="flex flex-wrap gap-3">
                            @foreach($product->variants as $var)
                                @php
                                    $attrValName = $var->name;
                                    $displayName = str_replace('Size: ', '', $attrValName);
                                    if ($displayName === 'Default Variant') {
                                        $displayName = 'Standard Pack';
                                    }
                                @endphp
                                <button 
                                    wire:click="selectVariant({{ $var->id }})"
                                    class="px-5 py-3 rounded-2xl border text-sm font-semibold tracking-wider transition-all active:scale-95 cursor-pointer flex flex-col items-center justify-center gap-0.5 {{ $selectedVariantId === $var->id ? 'border-primary bg-primary-fixed text-primary shadow-sm' : 'border-outline-variant/40 bg-surface hover:border-primary text-on-surface-variant' }}"
                                >
                                    <span>{{ $displayName }}</span>
                                    <span class="text-[10px] opacity-75 font-body-md">₹{{ number_format($var->sale_price ?? $var->price, 0) }}</span>
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- SKU & Weight info -->
                @if($variant)
                    <div class="flex gap-6 py-2.5 text-xs text-on-surface-variant/80 font-medium">
                        @if($variant->sku)
                            <span>SKU: <strong class="text-primary">{{ $variant->sku }}</strong></span>
                        @endif
                        @if($variant->weight)
                            <span>WEIGHT: <strong class="text-primary">{{ $variant->weight }} {{ $product->category && in_array($product->category->slug, ['skincare', 'haircare', 'wellness-oils']) ? 'ml' : 'g' }}</strong></span>
                        @endif
                    </div>
                @endif

                <!-- Quantity & Add to Cart -->
                <div class="flex flex-col sm:flex-row gap-4 items-center pt-6 border-t border-outline-variant/20">
                    <!-- Quantity Input -->
                    <div class="flex items-center border border-outline-variant/40 rounded-full bg-surface-container-low px-2 py-1 select-none w-full sm:w-auto justify-between sm:justify-start">
                        <button 
                            wire:click="decrementQuantity" 
                            class="w-10 h-10 rounded-full flex items-center justify-center hover:bg-surface-container transition-colors active:scale-90 text-primary cursor-pointer font-bold"
                        >
                            <span class="material-symbols-outlined text-sm">remove</span>
                        </button>
                        <span class="w-12 text-center text-sm font-bold text-primary">{{ $quantity }}</span>
                        <button 
                            wire:click="incrementQuantity" 
                            class="w-10 h-10 rounded-full flex items-center justify-center hover:bg-surface-container transition-colors active:scale-90 text-primary cursor-pointer font-bold"
                        >
                            <span class="material-symbols-outlined text-sm">add</span>
                        </button>
                    </div>

                    <!-- Add To Cart Button -->
                    <button 
                        @click="cartOpen = true"
                        @if(!$selectedVariantId || $stock <= 0) disabled @endif
                        class="flex-1 w-full bg-primary hover:bg-secondary text-white py-4 rounded-full font-label-caps tracking-widest text-xs font-bold transition-all active:scale-95 shadow-md flex items-center justify-center gap-3 cursor-pointer disabled:bg-surface-container disabled:text-on-surface-variant/40 disabled:cursor-not-allowed"
                    >
                        <span class="material-symbols-outlined text-lg">shopping_cart</span>
                        ADD TO RITUAL
                    </button>
                </div>

                <!-- Info Tabs Accordion -->
                <div class="border-t border-outline-variant/20 mt-10 pt-8" x-data="{ activeTab: 'desc' }">
                    <div class="flex border-b border-outline-variant/20 pb-3 gap-6 font-label-caps text-xs tracking-wider">
                        <button 
                            @click="activeTab = 'desc'" 
                            class="pb-3 border-b-2 transition-all cursor-pointer font-bold"
                            :class="activeTab === 'desc' ? 'border-secondary text-secondary' : 'border-transparent text-on-surface-variant hover:text-primary'"
                        >
                            DESCRIPTION
                        </button>
                        <button 
                            @click="activeTab = 'usage'" 
                            class="pb-3 border-b-2 transition-all cursor-pointer font-bold"
                            :class="activeTab === 'usage' ? 'border-secondary text-secondary' : 'border-transparent text-on-surface-variant hover:text-primary'"
                        >
                            HOW TO USE
                        </button>
                        <button 
                            @click="activeTab = 'ingredients'" 
                            class="pb-3 border-b-2 transition-all cursor-pointer font-bold"
                            :class="activeTab === 'ingredients' ? 'border-secondary text-secondary' : 'border-transparent text-on-surface-variant hover:text-primary'"
                        >
                            INGREDIENTS
                        </button>
                    </div>
                    
                    <div class="py-6 font-body-md text-sm text-on-surface-variant leading-relaxed">
                        <div x-show="activeTab === 'desc'" class="space-y-4 animate-fade-in-up">
                            <p>{{ $product->description }}</p>
                        </div>
                        <div x-show="activeTab === 'usage'" class="space-y-4 animate-fade-in-up" x-cloak>
                            <p>For optimum results and authentic Ayurvedic efficacy:</p>
                            <ul class="list-disc pl-5 space-y-2">
                                <li>Apply or consume daily as part of your morning or night wellness ritual.</li>
                                <li>Best used after thorough cleansing or with warm water as advised.</li>
                                <li>Keep in a cool, dry sanctuary away from direct sunlight.</li>
                            </ul>
                        </div>
                        <div x-show="activeTab === 'ingredients'" class="space-y-4" x-cloak>
                            <p>Crafted with 100% organic wild-harvested botanicals and bio-actives:</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 pt-2">
                                <div class="flex items-center gap-3 bg-surface-container-low p-3.5 rounded-xl border border-outline-variant/10">
                                    <span class="material-symbols-outlined text-secondary text-xl">psychology</span>
                                    <div>
                                        <span class="block font-bold text-primary text-xs">Botanical Adaptogens</span>
                                        <span class="text-[10px] text-on-surface-variant/80">Restores mental and physical vitality</span>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3 bg-surface-container-low p-3.5 rounded-xl border border-outline-variant/10">
                                    <span class="material-symbols-outlined text-secondary text-xl">spa</span>
                                    <div>
                                        <span class="block font-bold text-primary text-xs">Bio-potencies</span>
                                        <span class="text-[10px] text-on-surface-variant/80">Dual scientific chemical validation</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Related Products Section -->
        @if($relatedProducts->count() > 0)
            <div class="border-t border-outline-variant/20 pt-16 mt-10">
                <div class="flex flex-col sm:flex-row justify-between items-baseline mb-10 gap-2">
                    <div>
                        <span class="font-label-caps text-xs text-secondary font-bold tracking-widest uppercase mb-1 block">THE AYURVEDIC ROUTINE</span>
                        <h2 class="font-display-lg text-2xl sm:text-3xl text-primary font-bold">Complete Your Daily Ritual</h2>
                    </div>
                    <a href="{{ route('products') }}" class="font-label-caps text-xs text-secondary hover:text-primary tracking-wider font-bold transition-colors">
                        VIEW ALL PRODUCTS
                    </a>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    @foreach($relatedProducts as $rel)
                        @php
                            $relDefVar = $rel->defaultVariant;
                            $relPrice = $relDefVar ? $relDefVar->price : 0;
                            $relSalePrice = $relDefVar ? $relDefVar->sale_price : null;
                            $relStock = $relDefVar && $relDefVar->inventory ? $relDefVar->inventory->quantity : 0;
                            
                            $relImg = $rel->primaryImage ? $rel->primaryImage->image_path : null;
                            $relImgSrc = ($relImg && file_exists(public_path($relImg))) ? '/' . $relImg : 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?auto=format&fit=crop&q=80&w=400';
                        @endphp
                        <div class="bg-surface rounded-3xl overflow-hidden shadow-sm border border-outline-variant/10 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col group relative">
                            
                            <!-- Badges Overlay -->
                            <div class="absolute top-4 left-4 z-10 flex flex-col gap-2">
                                @if($rel->is_featured)
                                    <span class="bg-primary/95 text-white text-[9px] font-label-caps font-bold px-3 py-1 rounded-full shadow-sm tracking-widest">
                                        RECOMMENDED
                                    </span>
                                @endif
                                @if($relSalePrice)
                                    <span class="bg-secondary/95 text-white text-[9px] font-label-caps font-bold px-3 py-1 rounded-full shadow-sm tracking-widest">
                                        SPECIAL
                                    </span>
                                @endif
                                @if($relStock <= 0)
                                    <span class="bg-surface-container-high/90 text-on-surface-variant text-[9px] font-label-caps font-bold px-3 py-1 rounded-full shadow-sm tracking-widest">
                                        OUT
                                    </span>
                                @endif
                            </div>

                            <!-- Image Container -->
                            <a href="/products/{{ $rel->slug }}" class="relative aspect-[4/5] overflow-hidden bg-surface-container-low block">
                                <img 
                                    class="w-full h-full object-cover group-hover:scale-[1.03] transition-transform duration-500" 
                                    src="{{ $relImgSrc }}" 
                                    alt="{{ $rel->name }}"
                                    onerror="this.src='https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?auto=format&fit=crop&q=80&w=400';"
                                />
                                <div class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                                    <span class="bg-white/90 backdrop-blur-sm text-primary text-[10px] font-label-caps tracking-widest px-4 py-2 rounded-full shadow-md font-bold">
                                        VIEW DETAILS
                                    </span>
                                </div>
                            </a>

                            <!-- Info -->
                            <div class="p-5 flex flex-col flex-grow">
                                <span class="font-label-caps text-[9px] tracking-wider text-secondary font-bold mb-1.5 block uppercase">
                                    {{ $rel->category ? $rel->category->name : 'Wellness' }}
                                </span>
                                <h4 class="font-display-lg text-base text-primary font-bold mb-2 group-hover:text-secondary transition-colors line-clamp-1">
                                    <a href="/products/{{ $rel->slug }}">{{ $rel->name }}</a>
                                </h4>
                                <p class="text-xs text-on-surface-variant leading-relaxed mb-4 line-clamp-2">
                                    {{ $rel->short_description }}
                                </p>
                                <div class="flex items-center justify-between mt-auto">
                                    <div class="flex items-baseline gap-2">
                                        @if($relSalePrice)
                                            <span class="font-headline-sm text-base text-secondary font-bold">₹{{ number_format($relSalePrice, 0) }}</span>
                                            <span class="text-[10px] text-on-surface-variant/60 line-through">₹{{ number_format($relPrice, 0) }}</span>
                                        @else
                                            <span class="font-headline-sm text-base text-secondary font-bold">₹{{ number_format($relPrice, 0) }}</span>
                                        @endif
                                    </div>
                                    <button 
                                        @click="cartOpen = true"
                                        @if($relStock <= 0) disabled @endif
                                        class="p-2.5 rounded-full bg-primary hover:bg-secondary text-white transition-all duration-300 active:scale-90 flex items-center justify-center cursor-pointer disabled:bg-surface-container disabled:text-on-surface-variant/40 disabled:cursor-not-allowed"
                                    >
                                        <span class="material-symbols-outlined text-xs">add_shopping_cart</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>