<div class="h-full flex flex-col bg-surface shadow-2xl">
    <div class="flex-1 py-6 overflow-y-auto px-margin-mobile">
        <div class="flex items-start justify-between">
            <h2 class="font-headline-sm text-headline-sm text-primary font-bold">Your Cart</h2>
            <button @click="cartOpen = false" class="text-on-surface-variant cursor-pointer active:scale-95 flex items-center justify-center" type="button">
                <span class="material-symbols-outlined" data-icon="close">close</span>
            </button>
        </div>
        
        @if(empty($cartItems))
            <!-- Empty Cart State -->
            <div class="flex flex-col items-center justify-center py-20 text-center space-y-6">
                <div class="w-20 h-20 rounded-full bg-secondary/10 flex items-center justify-center text-secondary">
                    <span class="material-symbols-outlined text-4xl">shopping_basket</span>
                </div>
                <div class="space-y-2">
                    <h3 class="font-headline-sm text-lg text-primary font-bold">Your cart is empty</h3>
                    <p class="text-xs text-on-surface-variant max-w-[240px] leading-relaxed">Explore our botanical formulations and begin your wellness ritual.</p>
                </div>
                <a href="{{ route('products') }}" @click="cartOpen = false" class="inline-block bg-primary hover:bg-secondary text-white px-8 py-3 rounded-full font-label-caps text-[10px] tracking-widest transition-all hover:shadow-md active:scale-95 font-bold">
                    SHOP ALL PRODUCTS
                </a>
            </div>
        @else
            <!-- Cart Items List -->
            <div class="mt-12 space-y-6">
                @foreach($cartItems as $item)
                    <div class="flex gap-4 border-b border-outline-variant/10 pb-6" wire:key="cart-item-{{ $item['variant_id'] }}">
                        <!-- Image -->
                        <div class="w-20 h-24 bg-surface-container rounded-lg overflow-hidden shrink-0 border border-outline-variant/10">
                            <img class="w-full h-full object-cover" src="{{ $item['image'] }}" alt="{{ $item['name'] }}"/>
                        </div>
                        
                        <!-- Content -->
                        <div class="flex flex-col justify-between py-1 flex-grow">
                            <div>
                                <div class="flex justify-between items-start gap-2">
                                    <h3 class="font-bold text-primary text-sm leading-tight line-clamp-2">{{ $item['name'] }}</h3>
                                    <button 
                                        wire:click="removeItem({{ $item['variant_id'] }})" 
                                        class="text-on-surface-variant/60 hover:text-rose-600 cursor-pointer flex items-center justify-center p-1 rounded-full hover:bg-surface-container-high/50 transition-colors"
                                        title="Remove item"
                                    >
                                        <span class="material-symbols-outlined text-base">delete</span>
                                    </button>
                                </div>
                                @if($item['variant_name'] !== 'Default Variant')
                                    <p class="text-xs text-on-surface-variant font-medium mt-1">{{ $item['variant_name'] }}</p>
                                @endif
                            </div>
                            
                            <div class="flex items-center justify-between mt-4">
                                <!-- Qty controls -->
                                <div class="flex items-center border border-outline-variant/40 rounded-full bg-surface-container-low px-1.5 py-0.5 select-none scale-90 origin-left">
                                    <button 
                                        wire:click="updateQuantity({{ $item['variant_id'] }}, {{ $item['quantity'] - 1 }})" 
                                        class="w-7 h-7 rounded-full flex items-center justify-center hover:bg-surface-container-high/70 transition-colors text-primary cursor-pointer font-bold active:scale-95"
                                        type="button"
                                    >
                                        <span class="material-symbols-outlined text-xs">remove</span>
                                    </button>
                                    <span class="w-8 text-center text-xs font-bold text-primary">{{ $item['quantity'] }}</span>
                                    <button 
                                        wire:click="updateQuantity({{ $item['variant_id'] }}, {{ $item['quantity'] + 1 }})" 
                                        @if($item['quantity'] >= $item['stock']) disabled @endif
                                        class="w-7 h-7 rounded-full flex items-center justify-center hover:bg-surface-container-high/70 transition-colors text-primary cursor-pointer font-bold active:scale-95 disabled:opacity-30 disabled:cursor-not-allowed"
                                        type="button"
                                    >
                                        <span class="material-symbols-outlined text-xs">add</span>
                                    </button>
                                </div>
                                
                                <p class="font-bold text-secondary text-sm">₹{{ number_format($item['subtotal'], 0) }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    
    @if(!empty($cartItems))
        <!-- Subtotal / Action Footer -->
        <div class="border-t border-outline-variant p-6 space-y-4 bg-surface-container-low">
            <div class="flex justify-between font-headline-sm text-headline-sm">
                <span class="text-primary font-bold">Subtotal</span>
                <span class="text-secondary font-bold">₹{{ number_format($subtotal, 0) }}</span>
            </div>
            <p class="text-xs text-on-surface-variant italic leading-relaxed">Shipping and taxes calculated at checkout.</p>
            
            <div class="flex flex-col gap-3">
                <a href="{{ route('cart') }}" @click="cartOpen = false" wire:navigate class="block w-full text-center bg-primary text-white py-3.5 rounded-full font-label-caps tracking-widest text-xs font-bold hover:bg-secondary active:scale-[0.98] transition-all hover:shadow-md cursor-pointer">
                    VIEW SHOPPING CART
                </a>
                <button class="w-full border border-outline text-primary py-3.5 rounded-full font-label-caps tracking-widest text-xs font-bold hover:bg-surface-container active:scale-[0.98] transition-all cursor-pointer">
                    PROCEED TO CHECKOUT
                </button>
            </div>
        </div>
    @endif
</div>
