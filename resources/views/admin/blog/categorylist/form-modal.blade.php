<div x-data="{ modalOpen: false }"
     x-on:open-modal.window="modalOpen = true"
     x-on:close-modal.window="modalOpen = false"
     x-cloak>
    <template x-teleport="body">
        <div x-show="modalOpen" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            
            <!-- Backdrop Click Closes -->
            <div @click="modalOpen = false" 
                 class="absolute inset-0 bg-black/40 backdrop-blur-sm"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-end="opacity-100"
                 x-transition:enter-start="opacity-0"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-end="opacity-0"
                 x-transition:leave-start="opacity-100"></div>

            <!-- Modal Dialog Container -->
            <div class="relative bg-white w-full max-w-lg rounded-2xl shadow-2xl overflow-hidden z-10 border border-slate-200"
                 x-show="modalOpen"
                 x-transition:enter="ease-out duration-300 transform"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:leave="ease-in duration-200 transform"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-trap.inert.noscroll="modalOpen">
                
                <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
                    <div>
                        <h3 class="text-lg font-bold text-slate-800">
                            {{ $categoryId ? 'Edit Category' : 'Create Category' }}
                        </h3>
                        <p class="text-xs text-slate-500 mt-0.5">Fill in category details and save.</p>
                    </div>
                    <button @click="modalOpen = false" class="text-slate-400 hover:text-slate-700 active:scale-95 transition-transform" type="button">
                        <span class="material-symbols-outlined text-xl">close</span>
                    </button>
                </div>

                <form wire:submit.prevent="save" class="p-6 space-y-6">
                    <!-- Name -->
                    <div class="space-y-2">
                        <label class="block text-xs font-label-caps text-slate-500 uppercase font-bold tracking-wider">Category Name</label>
                        <input wire:model.live="name" 
                               type="text" 
                               class="w-full bg-slate-50 border border-slate-200 focus:border-emerald-500 focus:bg-white rounded-lg px-4 py-3 outline-none text-sm transition-all focus:ring-1 focus:ring-emerald-500/20" 
                               placeholder="e.g. Daily Rituals"/>
                        @error('name') 
                            <span class="text-xs text-rose-500 font-semibold block mt-1">{{ $message }}</span> 
                        @enderror
                    </div>

                    <!-- Slug -->
                    <div class="space-y-2">
                        <label class="block text-xs font-label-caps text-slate-500 uppercase font-bold tracking-wider">Slug</label>
                        <input wire:model="slug" 
                               type="text" 
                               class="w-full bg-slate-50 border border-slate-200 focus:border-emerald-500 focus:bg-white rounded-lg px-4 py-3 outline-none text-sm transition-all focus:ring-1 focus:ring-emerald-500/20 font-mono text-xs text-slate-600" 
                               placeholder="e.g. daily-rituals"/>
                        @error('slug') 
                            <span class="text-xs text-rose-500 font-semibold block mt-1">{{ $message }}</span> 
                        @enderror
                    </div>


                    <!-- Status Checkbox -->
                    <div class="flex items-center gap-3 py-2">
                        <input wire:model="status" 
                               id="modal-status" 
                               type="checkbox" 
                               class="h-4.5 w-4.5 text-emerald-600 border-slate-300 rounded focus:ring-emerald-500 focus:ring-offset-0 transition-all cursor-pointer"/>
                        <label for="modal-status" class="text-sm font-semibold text-slate-700 cursor-pointer select-none">
                            Mark category as Active
                        </label>
                        @error('status') 
                            <span class="text-xs text-rose-500 font-semibold block mt-1">{{ $message }}</span> 
                        @enderror
                    </div>

                    <div class="flex items-center justify-end gap-3 border-t border-slate-100 pt-5">
                        <button type="button" @click="modalOpen = false" class="text-sm font-semibold text-slate-500 hover:text-slate-800 px-5 py-3 rounded-full hover:bg-slate-50 transition-colors cursor-pointer">
                            Cancel
                        </button>
                        <button type="submit" wire:loading.attr="disabled" class="bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs tracking-wider px-6 py-3 rounded-full hover:shadow-md active:scale-95 transition-all cursor-pointer disabled:opacity-60">
                            <span wire:loading.remove wire:target="save">
                                {{ $categoryId ? 'UPDATE CATEGORY' : 'CREATE CATEGORY' }}
                            </span>
                            <span wire:loading wire:target="save">SAVING...</span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </template>
</div>
