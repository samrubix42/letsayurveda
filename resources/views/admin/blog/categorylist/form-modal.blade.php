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

                    <!-- Image Upload -->
                    <div class="space-y-2">
                        <label class="block text-xs font-label-caps text-slate-500 uppercase font-bold tracking-wider">Category Image</label>
                        
                        <div class="flex items-center gap-4">
                            <!-- Preview Container -->
                            <div class="w-20 h-20 rounded-xl overflow-hidden bg-slate-100 border border-slate-200 flex items-center justify-center shrink-0">
                                @if ($imageFile)
                                    <img src="{{ $imageFile->temporaryUrl() }}" class="w-full h-full object-cover" />
                                @elseif ($image)
                                    <img src="{{ $image }}" class="w-full h-full object-cover" />
                                @else
                                    <span class="material-symbols-outlined text-slate-400 text-3xl">image</span>
                                @endif
                            </div>

                            <!-- File Input & Upload Button -->
                            <div class="flex-1">
                                <label class="relative inline-flex items-center gap-2 px-4 py-2.5 bg-slate-50 hover:bg-slate-100 border border-slate-200 rounded-xl text-xs font-semibold text-slate-700 cursor-pointer active:scale-95 transition-all">
                                    <span class="material-symbols-outlined text-sm">cloud_upload</span>
                                    <span>Choose Image File</span>
                                    <input wire:model="imageFile" type="file" class="hidden" accept="image/*" />
                                </label>
                                <p class="text-[10px] text-slate-400 mt-1.5">PNG, JPG or WEBP up to 1MB.</p>
                                
                                <div wire:loading wire:target="imageFile" class="text-xs text-emerald-600 font-semibold mt-1 flex items-center gap-1.5">
                                    <svg class="animate-spin h-3.5 w-3.5 text-emerald-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    <span>Uploading image...</span>
                                </div>
                            </div>
                        </div>

                        @error('imageFile') 
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
