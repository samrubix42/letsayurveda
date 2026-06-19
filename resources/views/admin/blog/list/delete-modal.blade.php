<div x-data="{ deleteOpen: false }"
     x-on:open-delete-modal.window="deleteOpen = true"
     x-on:close-delete-modal.window="deleteOpen = false"
     x-cloak>
    <template x-teleport="body">
        <div x-show="deleteOpen" class="fixed inset-0 z-[100] flex items-center justify-center p-4">
            
            <!-- Backdrop Click Closes -->
            <div @click="deleteOpen = false" 
                 class="absolute inset-0 bg-black/40 backdrop-blur-sm"
                 x-transition:enter="ease-out duration-300"
                 x-transition:enter-end="opacity-100"
                 x-transition:enter-start="opacity-0"
                 x-transition:leave="ease-in duration-200"
                 x-transition:leave-end="opacity-0"
                 x-transition:leave-start="opacity-100"></div>

            <!-- Modal Dialog Container -->
            <div class="relative bg-white w-full max-w-md rounded-2xl shadow-2xl overflow-hidden z-10 border border-slate-200"
                 x-show="deleteOpen"
                 x-transition:enter="ease-out duration-300 transform"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                 x-transition:leave="ease-in duration-200 transform"
                 x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-trap.inert.noscroll="deleteOpen">
                
                <div class="p-6 space-y-4 text-center">
                    <!-- Warning Icon -->
                    <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-rose-50 border border-rose-100 text-rose-600">
                        <span class="material-symbols-outlined text-2xl">warning</span>
                    </div>
                    
                    <h3 class="text-lg font-bold text-slate-800">
                        Delete Blog?
                    </h3>
                    
                    <p class="text-sm text-slate-500">
                        Are you sure you want to delete this blog? This action will permanently remove it and cannot be undone.
                    </p>
                </div>

                <div class="flex items-center justify-end gap-3 border-t border-slate-100 bg-slate-50/50 px-6 py-4">
                    <button type="button" @click="deleteOpen = false" class="text-sm font-semibold text-slate-500 hover:text-slate-800 px-5 py-2.5 rounded-full hover:bg-slate-100 transition-colors cursor-pointer">
                        Cancel
                    </button>
                    <button wire:click="deleteBlog" type="button" class="bg-rose-600 hover:bg-rose-700 text-white font-semibold text-xs tracking-wider px-6 py-2.5 rounded-full hover:shadow-md active:scale-95 transition-all cursor-pointer">
                        DELETE BLOG
                    </button>
                </div>
            </div>
        </div>
    </template>
</div>
