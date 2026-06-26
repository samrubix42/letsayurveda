<div class="py-12 bg-background min-h-screen">
    <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop mt-8">
        
        <!-- Page Title Header -->
        <div class="border-b border-outline-variant/20 pb-6 mb-10 flex flex-col md:flex-row md:items-baseline md:justify-between gap-2">
            <div>
                <span class="font-label-caps text-xs text-secondary font-bold tracking-widest uppercase">YOUR RITUALS</span>
                <h1 class="font-headline-md text-3xl sm:text-4xl text-primary font-bold mt-1">Shopping Bag</h1>
            </div>
            <span class="text-sm text-on-surface-variant font-medium">
                {{ count($cartItems) }} {{ count($cartItems) === 1 ? 'item' : 'items' }} in your bag
            </span>
        </div>

        @if(empty($cartItems))
            <!-- Empty State Layout -->
            <div class="max-w-md mx-auto text-center py-20 px-6 bg-surface border border-outline-variant/10 rounded-3xl shadow-sm flex flex-col items-center justify-center space-y-6 animate-fade-in-up">
                <div class="w-24 h-24 rounded-full bg-secondary/10 flex items-center justify-center text-secondary">
                    <span class="material-symbols-outlined text-5xl">shopping_basket</span>
                </div>
                <div class="space-y-2">
                    <h2 class="font-headline-sm text-xl text-primary font-bold">Your Bag is Empty</h2>
                    <p class="text-sm text-on-surface-variant max-w-xs leading-relaxed mx-auto">You haven't added any Ayurvedic formulations to your cart yet. Begin your wellness journey by exploring our boutique.</p>
                </div>
                <a href="{{ route('products') }}" wire:navigate class="inline-block bg-primary hover:bg-secondary text-white px-8 py-3.5 rounded-full font-label-caps text-xs tracking-widest transition-all hover:shadow-md active:scale-95 font-bold">
                    EXPLORE BOTANICALS
                </a>
            </div>
        @else
            <!-- Active Shopping Cart Page Grid -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 items-start">
                
                <!-- Left Column: Products List -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-surface border border-outline-variant/10 rounded-3xl p-6 md:p-8 shadow-sm space-y-6">
                        @foreach($cartItems as $item)
                            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 pb-6 border-b border-outline-variant/10 last:border-b-0 last:pb-0" wire:key="cart-page-item-{{ $item['variant_id'] }}">
                                
                                <!-- Product details section -->
                                <div class="flex gap-5 flex-grow">
                                    <div class="w-24 h-28 bg-surface-container rounded-2xl overflow-hidden shrink-0 border border-outline-variant/10">
                                        <img class="w-full h-full object-cover" src="{{ $item['image'] }}" alt="{{ $item['name'] }}"/>
                                    </div>
                                    <div class="flex flex-col justify-between py-1">
                                        <div>
                                            <h3 class="font-headline-sm text-base md:text-lg text-primary font-bold leading-tight">{{ $item['name'] }}</h3>
                                            @if($item['variant_name'] !== 'Default Variant')
                                                <p class="text-xs text-on-surface-variant font-medium mt-1.5 bg-surface-container/50 px-2.5 py-1 rounded-md inline-block">{{ $item['variant_name'] }}</p>
                                            @endif
                                        </div>
                                        <div class="flex items-baseline gap-2 mt-2">
                                            <span class="text-sm font-bold text-secondary">₹{{ number_format($item['price'], 0) }}</span>
                                            <span class="text-[10px] text-on-surface-variant font-medium">unit price</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Controls & Item total price -->
                                <div class="flex items-center justify-between sm:justify-end gap-6 w-full sm:w-auto border-t sm:border-t-0 pt-4 sm:pt-0">
                                    
                                    <!-- Qty increment/decrement -->
                                    <div class="flex items-center border border-outline-variant/40 rounded-full bg-surface-container-low px-2 py-1 select-none">
                                        <button 
                                            wire:click="updateQuantity({{ $item['variant_id'] }}, {{ $item['quantity'] - 1 }})" 
                                            class="w-8 h-8 rounded-full flex items-center justify-center hover:bg-surface-container-high transition-colors text-primary cursor-pointer font-bold active:scale-90"
                                            type="button"
                                        >
                                            <span class="material-symbols-outlined text-xs">remove</span>
                                        </button>
                                        <span class="w-10 text-center text-sm font-bold text-primary">{{ $item['quantity'] }}</span>
                                        <button 
                                            wire:click="updateQuantity({{ $item['variant_id'] }}, {{ $item['quantity'] + 1 }})" 
                                            @if($item['quantity'] >= $item['stock']) disabled @endif
                                            class="w-8 h-8 rounded-full flex items-center justify-center hover:bg-surface-container-high transition-colors text-primary cursor-pointer font-bold active:scale-90 disabled:opacity-30 disabled:cursor-not-allowed"
                                            type="button"
                                        >
                                            <span class="material-symbols-outlined text-xs">add</span>
                                        </button>
                                    </div>

                                    <!-- Price / Remove -->
                                    <div class="text-right flex items-center gap-4">
                                        <div class="w-24">
                                            <span class="block text-sm text-on-surface-variant font-medium text-[10px] uppercase tracking-wider">TOTAL</span>
                                            <span class="font-bold text-primary text-base">₹{{ number_format($item['subtotal'], 0) }}</span>
                                        </div>
                                        <button 
                                            wire:click="removeItem({{ $item['variant_id'] }})" 
                                            class="text-on-surface-variant/60 hover:text-rose-600 cursor-pointer flex items-center justify-center p-2 rounded-full hover:bg-surface-container-high/50 transition-colors"
                                            title="Delete item"
                                        >
                                            <span class="material-symbols-outlined text-lg">delete</span>
                                        </button>
                                    </div>
                                    
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Right Column: Order Summary & Coupon -->
                <div class="space-y-6">
                    <div class="bg-surface border border-outline-variant/15 rounded-3xl p-6 md:p-8 shadow-sm space-y-6">
                        <h2 class="font-headline-sm text-lg text-primary font-bold border-b border-outline-variant/10 pb-4">Order Summary</h2>
                        
                        <!-- Cost details -->
                        <div class="space-y-4 text-sm font-medium">
                            <div class="flex justify-between text-on-surface-variant">
                                <span>Bag Subtotal</span>
                                <span>₹{{ number_format($subtotal, 0) }}</span>
                            </div>
                            
                            @if($appliedCoupon)
                                <div class="flex justify-between items-center text-emerald-800 bg-emerald-50 px-3 py-2 rounded-xl border border-emerald-100">
                                    <div class="flex items-center gap-1.5">
                                        <span class="material-symbols-outlined text-base">local_offer</span>
                                        <span class="font-bold">{{ $appliedCoupon['code'] }}</span>
                                        <span class="text-xs">
                                            ({{ $appliedCoupon['type'] === 'percentage' ? round($appliedCoupon['value']).'%' : '₹'.number_format($appliedCoupon['value']) }} OFF)
                                        </span>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <span class="font-bold">-₹{{ number_format($discountAmount, 0) }}</span>
                                        <button wire:click="removeCoupon" class="text-emerald-700 hover:text-rose-600 cursor-pointer flex items-center">
                                            <span class="material-symbols-outlined text-base">cancel</span>
                                        </button>
                                    </div>
                                </div>
                            @endif

                            <div class="flex justify-between text-on-surface-variant">
                                <span>Delivery</span>
                                <span class="text-emerald-700 font-bold">FREE</span>
                            </div>
                        </div>

                        <!-- Coupon entry field -->
                        <div class="pt-4 border-t border-outline-variant/10 space-y-2">
                            <label for="coupon-input" class="block text-xs font-label-caps text-primary font-bold tracking-wider">APPLY COUPON CODE</label>
                            <form wire:submit.prevent="applyCoupon" class="flex gap-2">
                                <input 
                                    id="coupon-input"
                                    type="text" 
                                    wire:model="couponCode"
                                    placeholder="Enter Code (e.g. AYUR10)" 
                                    class="flex-grow px-4 py-2.5 bg-surface-container-low border border-outline-variant/50 rounded-xl text-sm outline-none focus:border-primary uppercase placeholder:normal-case font-semibold"
                                    @if($appliedCoupon) disabled @endif
                                />
                                <button 
                                    type="submit" 
                                    class="bg-primary hover:bg-secondary text-white px-5 py-2.5 rounded-xl font-label-caps text-xs tracking-wider font-bold transition-all disabled:opacity-40 disabled:cursor-not-allowed cursor-pointer"
                                    @if($appliedCoupon) disabled @endif
                                >
                                    APPLY
                                </button>
                            </form>
                            @error('couponCode')
                                <span class="text-xs text-rose-600 font-medium block mt-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Grand Total -->
                        <div class="pt-6 border-t border-outline-variant/10 flex justify-between items-baseline">
                            <span class="text-base text-primary font-bold">Grand Total</span>
                            <span class="font-headline-md text-2xl text-secondary font-bold">₹{{ number_format($grandTotal, 0) }}</span>
                        </div>

                        <!-- Checkout CTA -->
                        <button class="w-full bg-secondary hover:bg-secondary/90 text-white py-4 rounded-full font-label-caps tracking-widest text-xs font-bold transition-all hover:shadow-md active:scale-[0.98] cursor-pointer">
                            PROCEED TO CHECKOUT
                        </button>
                    </div>

                    <!-- Secure trust badges -->
                    <div class="bg-surface-container-low border border-outline-variant/10 rounded-2xl p-5 flex items-center justify-around gap-4 text-center text-on-surface-variant">
                        <div class="flex flex-col items-center gap-1.5">
                            <span class="material-symbols-outlined text-2xl text-primary">verified_user</span>
                            <span class="text-[9px] font-label-caps font-bold tracking-wider leading-tight">SECURE<br>CHECKOUT</span>
                        </div>
                        <div class="w-px h-8 bg-outline-variant/30"></div>
                        <div class="flex flex-col items-center gap-1.5">
                            <span class="material-symbols-outlined text-2xl text-primary">eco</span>
                            <span class="text-[9px] font-label-caps font-bold tracking-wider leading-tight">100% ORGANIC<br>FORMULAS</span>
                        </div>
                        <div class="w-px h-8 bg-outline-variant/30"></div>
                        <div class="flex flex-col items-center gap-1.5">
                            <span class="material-symbols-outlined text-2xl text-primary">local_shipping</span>
                            <span class="text-[9px] font-label-caps font-bold tracking-wider leading-tight">FAST FREE<br>DELIVERY</span>
                        </div>
                    </div>

                </div>

            </div>
        @endif
        
    </div>
</div>