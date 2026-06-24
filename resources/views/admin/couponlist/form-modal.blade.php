<div x-data="{ modalOpen: false }"
     x-on:open-modal.window="modalOpen = true"
     x-on:close-modal.window="modalOpen = false"
     wire:ignore.self
     x-show="modalOpen"
     class="fixed inset-0 z-[100] flex items-center justify-center p-4"
     x-cloak>
    
    <!-- Backdrop Click Closes -->
    <div x-show="modalOpen"
         @click="modalOpen = false" 
         class="absolute inset-0 bg-black/40 backdrop-blur-sm"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"></div>

    <!-- Modal Dialog Container -->
    <div x-show="modalOpen"
         class="relative bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden z-10 border border-slate-200"
         x-transition:enter="ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 scale-95 translate-y-4"
         x-transition:enter-end="opacity-100 scale-100 translate-y-0"
         x-transition:leave="ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 scale-100 translate-y-0"
         x-transition:leave-end="opacity-0 scale-95 translate-y-4">
        
        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
            <div>
                <h3 class="text-lg font-bold text-slate-800">
                    {{ $couponId ? 'Edit Discount Coupon' : 'Create Discount Coupon' }}
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Configure details, types, value, and limitations for coupon codes.</p>
            </div>
            <button @click="modalOpen = false" class="text-slate-400 hover:text-slate-700 active:scale-95 transition-transform" type="button">
                <span class="material-symbols-outlined text-xl">close</span>
            </button>
        </div>

        <form wire:submit.prevent="save" class="p-6 space-y-4 max-h-[80vh] overflow-y-auto">
            
            <!-- Coupon Code -->
            <div class="space-y-2">
                <label class="block text-xs font-label-caps text-slate-500 uppercase font-bold tracking-wider">Coupon Code</label>
                <input wire:model="code" 
                       type="text" 
                       class="w-full bg-slate-50 border border-slate-200 focus:border-emerald-500 focus:bg-white rounded-lg px-4 py-3 outline-none text-sm transition-all focus:ring-1 focus:ring-emerald-500/20 font-mono tracking-wider" 
                       placeholder="e.g. WELCOME10, FESTIVAL25"/>
                @error('code') 
                    <span class="text-xs text-rose-500 font-semibold block mt-1">{{ $message }}</span> 
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Type -->
                <div class="space-y-2">
                    <label class="block text-xs font-label-caps text-slate-500 uppercase font-bold tracking-wider">Discount Type</label>
                    <select wire:model="type" 
                            class="w-full bg-slate-50 border border-slate-200 focus:border-emerald-500 focus:bg-white rounded-lg px-4 py-3 outline-none text-sm transition-all focus:ring-1 focus:ring-emerald-500/20">
                        <option value="percentage">Percentage (%)</option>
                        <option value="fixed">Fixed Amount (₹)</option>
                    </select>
                    @error('type') 
                        <span class="text-xs text-rose-500 font-semibold block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <!-- Value -->
                <div class="space-y-2">
                    <label class="block text-xs font-label-caps text-slate-500 uppercase font-bold tracking-wider">Discount Value</label>
                    <input wire:model="value" 
                           type="number" 
                           step="0.01"
                           class="w-full bg-slate-50 border border-slate-200 focus:border-emerald-500 focus:bg-white rounded-lg px-4 py-3 outline-none text-sm transition-all focus:ring-1 focus:ring-emerald-500/20 font-semibold" 
                           placeholder="e.g. 10 or 15.00"/>
                    @error('value') 
                        <span class="text-xs text-rose-500 font-semibold block mt-1">{{ $message }}</span> 
                    @enderror
                </div>
            </div>

            <!-- Min Spend -->
            <div class="space-y-2">
                <label class="block text-xs font-label-caps text-slate-500 uppercase font-bold tracking-wider">Minimum Spend Requirement (₹)</label>
                <input wire:model="minSpend" 
                       type="number" 
                       step="0.01"
                       class="w-full bg-slate-50 border border-slate-200 focus:border-emerald-500 focus:bg-white rounded-lg px-4 py-3 outline-none text-sm transition-all focus:ring-1 focus:ring-emerald-500/20" 
                       placeholder="e.g. 0.00 or 50.00 (leave empty for none)"/>
                @error('minSpend') 
                    <span class="text-xs text-rose-500 font-semibold block mt-1">{{ $message }}</span> 
                @enderror
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Limit per Coupon -->
                <div class="space-y-2">
                    <label class="block text-xs font-label-caps text-slate-500 uppercase font-bold tracking-wider">Usage Limit per Coupon</label>
                    <input wire:model="limitPerCoupon" 
                           type="number" 
                           class="w-full bg-slate-50 border border-slate-200 focus:border-emerald-500 focus:bg-white rounded-lg px-4 py-3 outline-none text-sm transition-all focus:ring-1 focus:ring-emerald-500/20" 
                           placeholder="e.g. 100 (empty for unlimited)"/>
                    @error('limitPerCoupon') 
                        <span class="text-xs text-rose-500 font-semibold block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <!-- Limit per User -->
                <div class="space-y-2">
                    <label class="block text-xs font-label-caps text-slate-500 uppercase font-bold tracking-wider">Usage Limit per User</label>
                    <input wire:model="limitPerUser" 
                           type="number" 
                           class="w-full bg-slate-50 border border-slate-200 focus:border-emerald-500 focus:bg-white rounded-lg px-4 py-3 outline-none text-sm transition-all focus:ring-1 focus:ring-emerald-500/20" 
                           placeholder="e.g. 1 (empty for unlimited)"/>
                    @error('limitPerUser') 
                        <span class="text-xs text-rose-500 font-semibold block mt-1">{{ $message }}</span> 
                    @enderror
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Start Date -->
                <div class="space-y-2">
                    <label class="block text-xs font-label-caps text-slate-500 uppercase font-bold tracking-wider">Start Date</label>
                    <input wire:model="startDate" 
                           type="datetime-local" 
                           class="w-full bg-slate-50 border border-slate-200 focus:border-emerald-500 focus:bg-white rounded-lg px-4 py-3 outline-none text-sm transition-all focus:ring-1 focus:ring-emerald-500/20 text-slate-600" />
                    @error('startDate') 
                        <span class="text-xs text-rose-500 font-semibold block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <!-- Expiry Date -->
                <div class="space-y-2">
                    <label class="block text-xs font-label-caps text-slate-500 uppercase font-bold tracking-wider">Expiry Date</label>
                    <input wire:model="expiryDate" 
                           type="datetime-local" 
                           class="w-full bg-slate-50 border border-slate-200 focus:border-emerald-500 focus:bg-white rounded-lg px-4 py-3 outline-none text-sm transition-all focus:ring-1 focus:ring-emerald-500/20 text-slate-600" />
                    @error('expiryDate') 
                        <span class="text-xs text-rose-500 font-semibold block mt-1">{{ $message }}</span> 
                    @enderror
                </div>
            </div>

            <!-- Status Checkbox -->
            <div class="flex items-center gap-3 py-2">
                <input wire:model="isActive" 
                       id="modal-is-active" 
                       type="checkbox" 
                       class="h-4.5 w-4.5 text-emerald-600 border-slate-300 rounded focus:ring-emerald-500 focus:ring-offset-0 transition-all cursor-pointer"/>
                <label for="modal-is-active" class="text-sm font-semibold text-slate-700 cursor-pointer select-none">
                    Mark coupon as Active
                </label>
                @error('isActive') 
                    <span class="text-xs text-rose-500 font-semibold block mt-1">{{ $message }}</span> 
                @enderror
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-5">
                <button type="button" @click="modalOpen = false" class="text-sm font-semibold text-slate-500 hover:text-slate-800 px-5 py-3 rounded-full hover:bg-slate-50 transition-colors cursor-pointer">
                    Cancel
                </button>
                <button type="submit" wire:loading.attr="disabled" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs tracking-wider px-6 py-3 rounded-full hover:shadow-md active:scale-95 transition-all cursor-pointer disabled:opacity-60">
                    <span wire:loading.remove wire:target="save">
                        {{ $couponId ? 'UPDATE COUPON' : 'CREATE COUPON' }}
                    </span>
                    <span wire:loading wire:target="save">SAVING...</span>
                </button>
            </div>
        </form>

    </div>
</div>
