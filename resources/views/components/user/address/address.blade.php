<div class="bg-white border border-outline-variant/30 rounded-3xl p-6 md:p-8 space-y-6 shadow-sm"
     x-data="{ 
         showAddressModal: @entangle('showAddressModal'), 
         editAddressMode: @entangle('editAddressMode') 
     }">

    <!-- Alert / Messages -->
    @if (session()->has('message'))
        <div class="bg-emerald-55 bg-opacity-10 border border-emerald-250 text-emerald-800 px-4 py-3 rounded-2xl text-xs font-semibold flex items-center gap-2 animate-fade-in-up">
            <span class="material-symbols-outlined text-emerald-600 text-lg">check_circle</span>
            <span>{{ session('message') }}</span>
        </div>
    @endif

    <!-- Header with add button -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-4 border-b border-outline-variant/10">
        <div class="space-y-1">
            <h2 class="font-headline-md text-lg md:text-xl text-primary font-bold">Saved Delivery Addresses</h2>
            <p class="text-xs text-on-surface-variant">Manage your shipping and billing addresses for faster checkout.</p>
        </div>
        <button wire:click="openCreateModal" 
                class="bg-primary hover:bg-primary/95 text-white font-semibold text-xs tracking-wider px-4 py-2.5 rounded-xl transition-all cursor-pointer flex items-center gap-1.5 self-start sm:self-auto shadow-sm active:scale-98">
            <span class="material-symbols-outlined text-sm">add</span>
            <span>ADD NEW</span>
        </button>
    </div>

    <!-- Addresses Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        @foreach($addresses as $addr)
            <div class="bg-slate-50/20 border border-outline-variant/30 rounded-2xl p-6 shadow-sm flex flex-col justify-between relative hover:shadow-md transition-all">
                
                <!-- Badges -->
                <div class="absolute top-4 right-4 flex gap-1.5">
                    @if($addr['is_default'])
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[9px] font-semibold bg-emerald-55 text-emerald-800 border border-emerald-200 uppercase tracking-wider">
                            Default
                        </span>
                    @endif
                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-[9px] font-semibold bg-slate-100 text-slate-600 border border-outline-variant/30 uppercase tracking-wider">
                        {{ $addr['type'] }}
                    </span>
                </div>

                <!-- Details -->
                <div class="space-y-3 pt-2">
                    <div class="flex items-center gap-2 text-primary">
                        <span class="material-symbols-outlined text-base">person</span>
                        <span class="font-bold text-xs text-slate-800">{{ $addr['name'] }}</span>
                    </div>
                    <div class="flex items-start gap-2 text-slate-600">
                        <span class="material-symbols-outlined text-base shrink-0 mt-0.5">home_pin</span>
                        <div class="text-xs space-y-0.5 leading-relaxed">
                            <p class="font-medium text-slate-705">{{ $addr['address_line1'] }}</p>
                            @if($addr['address_line2'])
                                <p>{{ $addr['address_line2'] }}</p>
                            @endif
                            <p class="text-slate-600">{{ $addr['city'] }}, {{ $addr['state'] }} - {{ $addr['zip'] }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 text-slate-600">
                        <span class="material-symbols-outlined text-base">call</span>
                        <span class="text-xs">{{ $addr['phone'] }}</span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="border-t border-outline-variant/10 mt-6 pt-4 flex items-center justify-between">
                    <button wire:click="openEditModal({{ $addr['id'] }})" 
                            class="text-xs font-semibold text-secondary hover:text-secondary/85 flex items-center gap-1 transition-all cursor-pointer">
                        <span class="material-symbols-outlined text-sm">edit</span>
                        <span>Edit Address</span>
                    </button>
                    <button wire:click="deleteAddress({{ $addr['id'] }})" 
                            class="text-xs font-semibold text-rose-600 hover:text-rose-750 flex items-center gap-1 transition-all cursor-pointer">
                        <span class="material-symbols-outlined text-sm">delete</span>
                        <span>Delete</span>
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Empty state -->
    @if(count($addresses) === 0)
        <div class="border border-outline-variant/30 border-dashed rounded-3xl p-12 text-center space-y-4 bg-slate-50/10 animate-fade-in-up">
            <div class="h-16 w-16 bg-slate-50 border border-outline-variant/20 rounded-full flex items-center justify-center mx-auto text-slate-400">
                <span class="material-symbols-outlined text-3xl">home_pin</span>
            </div>
            <div class="space-y-1">
                <h3 class="font-bold text-slate-800 text-sm">No saved addresses</h3>
                <p class="text-xs text-on-surface-variant max-w-sm mx-auto">Please add a shipping or billing address so we can route your orders correctly.</p>
            </div>
            <button wire:click="openCreateModal" 
                    class="bg-primary hover:bg-primary/95 text-white font-semibold text-xs tracking-wider px-5 py-3 rounded-xl transition-all cursor-pointer inline-flex items-center gap-1.5 shadow-sm active:scale-98">
                <span class="material-symbols-outlined text-sm">add</span>
                <span>ADD FIRST ADDRESS</span>
            </button>
        </div>
    @endif

    <!-- ADDRESS CREATION / EDITING MODAL (Entangled with Livewire State) -->
    <div class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-sm"
         x-cloak
         x-show="showAddressModal"
         x-transition:enter="transition-opacity ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition-opacity ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        <!-- Modal Content Container -->
        <div class="bg-white rounded-3xl border border-outline-variant/30 max-w-lg w-full p-6 md:p-8 space-y-6 shadow-2xl relative"
             @click.away="showAddressModal = false"
             x-transition:enter="transition-transform ease-out duration-300"
             x-transition:enter-start="scale-95 translate-y-4"
             x-transition:enter-end="scale-100 translate-y-0"
             x-transition:leave="transition-transform ease-in duration-200"
             x-transition:leave-start="scale-100 translate-y-0"
             x-transition:leave-end="scale-95 translate-y-4">
            
            <!-- Close icon button -->
            <button @click="showAddressModal = false" class="absolute top-6 right-6 text-slate-400 hover:text-slate-650 transition-colors cursor-pointer">
                <span class="material-symbols-outlined">close</span>
            </button>

            <!-- Title -->
            <div class="space-y-1">
                <h3 class="font-headline-sm text-lg text-primary font-bold" x-text="editAddressMode ? 'Edit Saved Address' : 'Add New Address'"></h3>
                <p class="text-xs text-on-surface-variant">Enter the delivery details for your order shipment.</p>
            </div>

            <!-- Form -->
            <form wire:submit.prevent="saveAddress" class="space-y-4">
                
                <!-- Type Selection -->
                <div class="space-y-1.5">
                    <label class="block text-xs font-semibold text-slate-700">Address Type</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="border border-outline-variant/30 rounded-xl px-4 py-3 flex items-center gap-2 cursor-pointer hover:bg-slate-50/50 transition-all select-none"
                               :class="$wire.type === 'shipping' ? 'border-primary bg-primary/5 text-primary font-semibold' : 'text-slate-600'">
                            <input type="radio" value="shipping" wire:model="type" class="text-primary focus:ring-primary h-4.5 w-4.5">
                            <span class="text-xs">Shipping</span>
                        </label>
                        <label class="border border-outline-variant/30 rounded-xl px-4 py-3 flex items-center gap-2 cursor-pointer hover:bg-slate-50/50 transition-all select-none"
                               :class="$wire.type === 'billing' ? 'border-primary bg-primary/5 text-primary font-semibold' : 'text-slate-600'">
                            <input type="radio" value="billing" wire:model="type" class="text-primary focus:ring-primary h-4.5 w-4.5">
                            <span class="text-xs">Billing</span>
                        </label>
                    </div>
                    @error('type') <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Full Name & Phone -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-slate-700 font-label-caps tracking-wide">Contact Person</label>
                        <input type="text" required wire:model="name" placeholder="John Doe" 
                               class="w-full bg-slate-50/50 border border-outline-variant/30 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-primary focus:bg-white transition-all">
                        @error('name') <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-slate-700 font-label-caps tracking-wide">Phone Number</label>
                        <input type="text" required wire:model="phone" placeholder="+91 98765 43210" 
                               class="w-full bg-slate-50/50 border border-outline-variant/30 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-primary focus:bg-white transition-all">
                        @error('phone') <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Address Line 1 -->
                <div class="space-y-1">
                    <label class="block text-xs font-semibold text-slate-700 font-label-caps tracking-wide">Street Address / Flat No.</label>
                    <input type="text" required wire:model="address_line1" placeholder="108, Shanti Vihar, Lotus Lane" 
                           class="w-full bg-slate-50/50 border border-outline-variant/30 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-primary focus:bg-white transition-all">
                    @error('address_line1') <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Address Line 2 -->
                <div class="space-y-1">
                    <label class="block text-xs font-semibold text-slate-700 font-label-caps tracking-wide">Landmark / Locality (Optional)</label>
                    <input type="text" wire:model="address_line2" placeholder="Near Ayur Temple" 
                           class="w-full bg-slate-50/50 border border-outline-variant/30 rounded-xl px-4 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-primary focus:bg-white transition-all">
                    @error('address_line2') <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- City, State & Zip -->
                <div class="grid grid-cols-3 gap-4">
                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-slate-700 font-label-caps tracking-wide">City</label>
                        <input type="text" required wire:model="city" placeholder="Rishikesh" 
                               class="w-full bg-slate-50/50 border border-outline-variant/30 rounded-xl px-3 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-primary focus:bg-white transition-all">
                        @error('city') <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-slate-700 font-label-caps tracking-wide">State</label>
                        <input type="text" required wire:model="state" placeholder="Uttarakhand" 
                               class="w-full bg-slate-50/50 border border-outline-variant/30 rounded-xl px-3 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-primary focus:bg-white transition-all">
                        @error('state') <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="space-y-1">
                        <label class="block text-xs font-semibold text-slate-700 font-label-caps tracking-wide">ZIP Code</label>
                        <input type="text" required wire:model="zip" placeholder="249201" 
                               class="w-full bg-slate-50/50 border border-outline-variant/30 rounded-xl px-3 py-2.5 text-xs text-slate-800 focus:outline-none focus:border-primary focus:bg-white transition-all">
                        @error('zip') <p class="text-rose-600 text-xs font-semibold mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Default Toggles -->
                <label class="flex items-center gap-2.5 pt-2 cursor-pointer select-none">
                    <input type="checkbox" wire:model="is_default" class="rounded text-primary focus:ring-primary h-4.5 w-4.5 border-outline-variant/30">
                    <span class="text-xs text-on-surface-variant font-medium">Set as default <span x-text="$wire.type"></span> address</span>
                </label>

                <!-- Actions -->
                <div class="border-t border-outline-variant/10 pt-6 flex items-center justify-end gap-3">
                    <button type="button" @click="showAddressModal = false" 
                            class="bg-slate-100 hover:bg-slate-200 text-slate-750 font-semibold text-xs tracking-wider px-5 py-3 rounded-xl transition-all cursor-pointer">
                        CANCEL
                    </button>
                    <button type="submit" 
                            class="bg-primary hover:bg-primary/95 text-white font-semibold text-xs tracking-wider px-5 py-3 rounded-xl transition-all cursor-pointer shadow-sm">
                        SAVE ADDRESS
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>