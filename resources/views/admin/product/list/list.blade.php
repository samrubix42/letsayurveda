<div class="space-y-6 animate-fade-in-up">

    <!-- Header Title & Action -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="font-headline-sm text-3xl font-bold text-slate-800 tracking-tight">Products</h1>
            <p class="text-sm text-slate-500 mt-1">Manage and classify your wellness sanctuary ecommerce product catalog.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" wire:navigate class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs tracking-wider px-5 py-3 rounded-full hover:shadow-md active:scale-95 transition-all cursor-pointer">
            <span class="material-symbols-outlined text-sm">add</span>
            <span>ADD PRODUCT</span>
        </a>
    </div>

    <!-- Filters Bar -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        
        <!-- Filter Header -->
        <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row gap-4 items-center justify-between">
            <div class="flex flex-wrap items-center gap-3 w-full sm:w-auto">
                {{-- Search --}}
                <div class="flex items-center gap-2 px-3 py-2 bg-white border border-slate-200 rounded-lg text-slate-400 focus-within:border-emerald-500 focus-within:ring-1 focus-within:ring-emerald-500/20 transition-all w-full sm:w-64">
                    <span class="material-symbols-outlined text-sm">search</span>
                    <input wire:model.live.debounce.300ms="search" class="bg-transparent border-none text-xs outline-none text-slate-700 placeholder:text-slate-400 w-full focus:ring-0" placeholder="Search products..." type="text"/>
                </div>

                {{-- Status Filter --}}
                <select wire:model.live="statusFilter" class="bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs text-slate-700 outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/20 transition-all">
                    <option value="">All Statuses</option>
                    <option value="active">Active</option>
                    <option value="draft">Draft</option>
                    <option value="inactive">Inactive</option>
                </select>

                {{-- Category Filter --}}
                <select wire:model.live="categoryFilter" class="bg-white border border-slate-200 rounded-lg px-3 py-2 text-xs text-slate-700 outline-none focus:border-emerald-500 focus:ring-1 focus:ring-emerald-500/20 transition-all">
                    <option value="">All Categories</option>
                    @foreach($this->categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="text-xs text-slate-400 font-semibold uppercase tracking-wider">
                Showing {{ $products->count() }} of {{ $products->total() }} records
            </div>
        </div>

        <!-- Desktop Table Container -->
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-400 font-label-caps text-[10px] tracking-widest border-b border-slate-100">
                        <th class="py-4 px-6 font-bold">Product</th>
                        <th class="py-4 px-6 font-bold">Category</th>
                        <th class="py-4 px-6 font-bold">Price</th>
                        <th class="py-4 px-6 font-bold">Stock</th>
                        <th class="py-4 px-6 font-bold">Type</th>
                        <th class="py-4 px-6 font-bold text-center">Status</th>
                        <th class="py-4 px-6 font-bold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($products as $product)
                        <tr wire:key="product-{{ $product->id }}" class="hover:bg-slate-50/40 transition-colors">
                            
                            <!-- Product (Image + Name + SKU) -->
                            <td class="py-4 px-6">
                                <div class="flex items-center gap-3">
                                    <div class="h-10 w-10 rounded-lg overflow-hidden bg-slate-100 border border-slate-200 flex items-center justify-center">
                                        @if($product->primaryImage)
                                            <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                                        @else
                                            <span class="material-symbols-outlined text-slate-300 text-lg">image</span>
                                        @endif
                                    </div>
                                    <div>
                                        <span class="font-bold text-slate-800 block line-clamp-1">{{ $product->name }}</span>
                                        @if($product->defaultVariant)
                                            <span class="text-xs text-slate-400 font-mono mt-0.5 block">{{ $product->defaultVariant->sku }}</span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Category -->
                            <td class="py-4 px-6">
                                @if($product->category)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-slate-100 text-slate-700 border border-slate-200">
                                        {{ $product->category->name }}
                                    </span>
                                @else
                                    <span class="text-xs text-slate-400 font-semibold italic">—</span>
                                @endif
                            </td>

                            <!-- Price -->
                            <td class="py-4 px-6">
                                @if($product->defaultVariant)
                                    <span class="font-bold text-slate-800">₹{{ number_format($product->defaultVariant->price, 2) }}</span>
                                    @if($product->defaultVariant->sale_price)
                                        <span class="text-xs text-emerald-600 block mt-0.5">
                                            ₹{{ number_format($product->defaultVariant->sale_price, 2) }}
                                        </span>
                                    @endif
                                @elseif($product->has_variants && $product->variants->count() > 0)
                                    @php
                                        $minPrice = $product->variants->min('price');
                                        $maxPrice = $product->variants->max('price');
                                    @endphp
                                    <span class="font-bold text-slate-800">
                                        ₹{{ number_format($minPrice, 2) }}
                                        @if($minPrice != $maxPrice)
                                            – ₹{{ number_format($maxPrice, 2) }}
                                        @endif
                                    </span>
                                @else
                                    <span class="text-xs text-slate-300">—</span>
                                @endif
                            </td>

                            <!-- Stock -->
                            <td class="py-4 px-6">
                                @php
                                    $totalStock = $product->variants->sum(fn($v) => $v->inventory->quantity ?? 0);
                                    $lowAlert = $product->defaultVariant->inventory->low_stock_threshold ?? 5;
                                @endphp
                                <div class="flex items-center gap-1.5">
                                    @if($totalStock <= 0)
                                        <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                                        <span class="text-xs font-semibold text-rose-600">Out of Stock</span>
                                    @elseif($totalStock <= $lowAlert)
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                        <span class="text-xs font-semibold text-amber-600">{{ $totalStock }} left</span>
                                    @else
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        <span class="text-xs font-semibold text-slate-600">{{ $totalStock }}</span>
                                    @endif
                                </div>
                            </td>

                            <!-- Type -->
                            <td class="py-4 px-6">
                                @if($product->has_variants)
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-purple-50 text-purple-700 border border-purple-100">
                                        {{ $product->variants->count() }} variants
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1 px-2.5 py-0.5 rounded-full text-xs font-semibold bg-sky-50 text-sky-700 border border-sky-100">
                                        Simple
                                    </span>
                                @endif
                            </td>

                            <!-- Status -->
                            <td class="py-4 px-6 text-center">
                                @if($product->status === 'active')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                        Active
                                    </span>
                                @elseif($product->status === 'draft')
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-amber-50 text-amber-700 border border-amber-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                        Draft
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                                        <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                        Inactive
                                    </span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" wire:navigate class="text-slate-500 hover:text-emerald-600 p-1.5 rounded hover:bg-slate-100 transition-all cursor-pointer" title="Edit Product">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </a>
                                    <button wire:click="toggleStatus({{ $product->id }})" class="text-slate-500 hover:text-emerald-600 p-1.5 rounded hover:bg-slate-100 transition-all cursor-pointer" title="Toggle Status">
                                        <span class="material-symbols-outlined text-lg">toggle_on</span>
                                    </button>
                                    <button type="button" @click="$dispatch('open-delete-modal'); $wire.confirmDelete({{ $product->id }})" class="text-slate-500 hover:text-rose-600 p-1.5 rounded hover:bg-slate-100 transition-all cursor-pointer" title="Delete Product">
                                        <span class="material-symbols-outlined text-lg">delete</span>
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 px-6 text-center text-slate-400">
                                <span class="material-symbols-outlined text-4xl block mb-2 opacity-50">search_off</span>
                                <span class="text-sm font-medium">No products found.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Mobile Cards List -->
        <div class="block md:hidden divide-y divide-slate-100">
            @forelse($products as $product)
                <div wire:key="mobile-product-{{ $product->id }}" class="p-4 space-y-3">
                    <div class="flex items-start gap-3">
                        <div class="h-12 w-12 rounded-lg overflow-hidden bg-slate-100 border border-slate-200 flex items-center justify-center shrink-0">
                            @if($product->primaryImage)
                                <img src="{{ asset('storage/' . $product->primaryImage->image_path) }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
                            @else
                                <span class="material-symbols-outlined text-slate-300 text-lg">image</span>
                            @endif
                        </div>
                        <div class="flex-1 min-w-0">
                            <span class="font-bold text-slate-800 block truncate">{{ $product->name }}</span>
                            @if($product->category)
                                <span class="text-xs text-slate-500 block mt-0.5">{{ $product->category->name }}</span>
                            @endif
                            <div class="mt-1">
                                @if($product->defaultVariant)
                                    <span class="text-sm font-bold text-slate-800">₹{{ number_format($product->defaultVariant->price, 2) }}</span>
                                @elseif($product->has_variants && $product->variants->count() > 0)
                                    @php
                                        $min = $product->variants->min('price');
                                        $max = $product->variants->max('price');
                                    @endphp
                                    <span class="text-sm font-bold text-slate-800">
                                        ₹{{ number_format($min, 2) }}@if($min != $max) – ₹{{ number_format($max, 2) }}@endif
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between gap-2 pt-2 border-t border-slate-50">
                        <div class="flex flex-wrap items-center gap-2">
                            @if($product->status === 'active')
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-emerald-50 text-emerald-700 border border-emerald-100">Active</span>
                            @elseif($product->status === 'draft')
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-amber-50 text-amber-700 border border-amber-100">Draft</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-slate-100 text-slate-600 border border-slate-200">Inactive</span>
                            @endif

                            @if($product->has_variants)
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-purple-50 text-purple-700 border border-purple-100">{{ $product->variants->count() }} vars</span>
                            @else
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-semibold bg-sky-50 text-sky-700 border border-sky-100">Simple</span>
                            @endif
                        </div>

                        <div class="flex items-center gap-1.5">
                            <a href="{{ route('admin.products.edit', $product->id) }}" wire:navigate class="text-slate-500 hover:text-emerald-600 p-1 rounded hover:bg-slate-100 cursor-pointer">
                                <span class="material-symbols-outlined text-lg">edit</span>
                            </a>
                            <button wire:click="toggleStatus({{ $product->id }})" class="text-slate-500 hover:text-emerald-600 p-1 rounded hover:bg-slate-100 cursor-pointer">
                                <span class="material-symbols-outlined text-lg">toggle_on</span>
                            </button>
                            <button type="button" @click="$dispatch('open-delete-modal'); $wire.confirmDelete({{ $product->id }})" class="text-slate-500 hover:text-rose-600 p-1 rounded hover:bg-slate-100 cursor-pointer">
                                <span class="material-symbols-outlined text-lg">delete</span>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="p-8 text-center text-slate-400">
                    <span class="material-symbols-outlined text-4xl block mb-2 opacity-50">search_off</span>
                    <span class="text-sm font-medium">No products found.</span>
                </div>
            @endforelse
        </div>

        <!-- Table Footer Pagination -->
        @if($products->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/20">
                {{ $products->links() }}
            </div>
        @endif

    </div>

    {{-- Delete Confirmation Modal --}}
    <div x-data="{ deleteOpen: false }"
        x-on:open-delete-modal.window="deleteOpen = true"
        x-on:close-delete-modal.window="deleteOpen = false"
        x-cloak>
        <template x-teleport="body">
            <div x-show="deleteOpen" class="fixed inset-0 z-[99] flex items-center justify-center px-4" x-transition>
                <!-- Backdrop -->
                <div @click="deleteOpen=false" class="absolute inset-0 bg-slate-900/40 backdrop-blur-[1px]"></div>
                
                <!-- Modal Box -->
                <div x-show="deleteOpen" x-transition x-trap.inert.noscroll="deleteOpen"
                    class="relative w-full max-w-sm rounded-2xl bg-white p-6 shadow-xl border border-slate-100">

                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-rose-50 flex items-center justify-center text-rose-600">
                            <span class="material-symbols-outlined">delete</span>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900">Delete Product</h3>
                    </div>

                    <p class="mb-6 text-sm text-slate-500">
                        Are you sure you want to delete this product? All variants, images, and related data will be permanently removed.
                    </p>

                    <div class="flex justify-end gap-3">
                        <button @click="deleteOpen=false"
                            class="rounded-full border border-slate-200 hover:bg-slate-50 px-5 py-2.5 text-xs font-semibold text-slate-600 transition-all cursor-pointer">
                            Cancel
                        </button>
                        <button wire:click="delete"
                            class="inline-flex items-center gap-1 bg-rose-600 hover:bg-rose-700 text-white font-semibold text-xs px-5 py-2.5 rounded-full hover:shadow-md active:scale-95 transition-all cursor-pointer">
                            <span class="material-symbols-outlined text-sm">delete</span>
                            <span>Delete</span>
                        </button>
                    </div>
                </div>
            </div>
        </template>
    </div>

</div>