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
                    Adjust Stock Levels
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Manage quantities, threshold levels, and audit trail logs.</p>
            </div>
            <button @click="modalOpen = false" class="text-slate-400 hover:text-slate-700 active:scale-95 transition-transform" type="button">
                <span class="material-symbols-outlined text-xl">close</span>
            </button>
        </div>

        <form wire:submit.prevent="save" class="p-6 space-y-5">
            
            <!-- Read-only Info -->
            <div class="bg-slate-50 border border-slate-200/60 p-4 rounded-xl space-y-1">
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Product Variant</div>
                <div class="text-sm font-bold text-slate-800">{{ $variantName }}</div>
                <div class="text-xs font-mono text-slate-500 mt-1">SKU: {{ $sku }}</div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <!-- Quantity In Stock -->
                <div class="space-y-2">
                    <label class="block text-xs font-label-caps text-slate-500 uppercase font-bold tracking-wider">Quantity In Stock</label>
                    <input wire:model="quantity" 
                           type="number" 
                           class="w-full bg-slate-50 border border-slate-200 focus:border-emerald-500 focus:bg-white rounded-lg px-4 py-3 outline-none text-sm transition-all focus:ring-1 focus:ring-emerald-500/20" 
                           placeholder="e.g. 50"/>
                    @error('quantity') 
                        <span class="text-xs text-rose-500 font-semibold block mt-1">{{ $message }}</span> 
                    @enderror
                </div>

                <!-- Low Stock Threshold -->
                <div class="space-y-2">
                    <label class="block text-xs font-label-caps text-slate-500 uppercase font-bold tracking-wider">Low Stock Threshold</label>
                    <input wire:model="lowStockThreshold" 
                           type="number" 
                           class="w-full bg-slate-50 border border-slate-200 focus:border-emerald-500 focus:bg-white rounded-lg px-4 py-3 outline-none text-sm transition-all focus:ring-1 focus:ring-emerald-500/20" 
                           placeholder="e.g. 5"/>
                    @error('lowStockThreshold') 
                        <span class="text-xs text-rose-500 font-semibold block mt-1">{{ $message }}</span> 
                    @enderror
                </div>
            </div>

            <!-- Track Inventory Toggle -->
            <div class="flex items-center gap-3 py-1">
                <input wire:model="trackInventory" 
                       id="modal-track-inventory" 
                       type="checkbox" 
                       class="h-4.5 w-4.5 text-emerald-600 border-slate-300 rounded focus:ring-emerald-500 focus:ring-offset-0 transition-all cursor-pointer"/>
                <label for="modal-track-inventory" class="text-sm font-semibold text-slate-700 cursor-pointer select-none">
                    Track Inventory for this Variant
                </label>
                @error('trackInventory') 
                    <span class="text-xs text-rose-500 font-semibold block mt-1">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Adjustment Note (Mandatory for log auditing) -->
            <div class="space-y-2">
                <label class="block text-xs font-label-caps text-slate-500 uppercase font-bold tracking-wider">Audit Log Reason/Note</label>
                <textarea wire:model="adjustmentNote" 
                          rows="3"
                          class="w-full bg-slate-50 border border-slate-200 focus:border-emerald-500 focus:bg-white rounded-lg px-4 py-3 outline-none text-sm transition-all focus:ring-1 focus:ring-emerald-500/20" 
                          placeholder="e.g. Received new shipment of 50 units, or Correcting stock count after manual recount."></textarea>
                @error('adjustmentNote') 
                    <span class="text-xs text-rose-500 font-semibold block mt-1">{{ $message }}</span> 
                @enderror
            </div>

            <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-5">
                <button type="button" @click="modalOpen = false" class="text-sm font-semibold text-slate-500 hover:text-slate-800 px-5 py-3 rounded-full hover:bg-slate-50 transition-colors cursor-pointer">
                    Cancel
                </button>
                <button type="submit" wire:loading.attr="disabled" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs tracking-wider px-6 py-3 rounded-full hover:shadow-md active:scale-95 transition-all cursor-pointer disabled:opacity-60">
                    <span wire:loading.remove wire:target="save">
                        SAVE ADJUSTMENT
                    </span>
                    <span wire:loading wire:target="save">SAVING...</span>
                </button>
            </div>
        </form>

    </div>
</div>
