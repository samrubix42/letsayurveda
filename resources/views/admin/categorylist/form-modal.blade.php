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
                    {{ $categoryId ? 'Edit Product Category' : 'Create Product Category' }}
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Configure details for your product category.</p>
            </div>
            <button @click="modalOpen = false" class="text-slate-400 hover:text-slate-700 active:scale-95 transition-transform" type="button">
                <span class="material-symbols-outlined text-xl">close</span>
            </button>
        </div>

        <form wire:submit.prevent="save" class="p-6 space-y-5">
            
            <!-- Category Name -->
            <div class="space-y-2">
                <label class="block text-xs font-label-caps text-slate-500 uppercase font-bold tracking-wider">Category Name</label>
                <input wire:model.live="name" 
                       type="text" 
                       class="w-full bg-slate-50 border border-slate-200 focus:border-emerald-500 focus:bg-white rounded-lg px-4 py-3 outline-none text-sm transition-all focus:ring-1 focus:ring-emerald-500/20" 
                       placeholder="e.g. Herbal Supplements"/>
                @error('name') 
                    <span class="text-xs text-rose-500 font-semibold block mt-1">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Parent Category Dropdown -->
            <div class="space-y-2">
                <label class="block text-xs font-label-caps text-slate-500 uppercase font-bold tracking-wider">Parent Category</label>
                <select wire:model="parent_id" 
                        class="w-full bg-slate-50 border border-slate-200 focus:border-emerald-500 focus:bg-white rounded-lg px-4 py-3 outline-none text-sm transition-all focus:ring-1 focus:ring-emerald-500/20">
                    <option value="">None (Main Category)</option>
                    @foreach($parentCategories as $parent)
                        <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                    @endforeach
                </select>
                @error('parent_id') 
                    <span class="text-xs text-rose-500 font-semibold block mt-1">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Slug -->
            <div class="space-y-2">
                <label class="block text-xs font-label-caps text-slate-500 uppercase font-bold tracking-wider">Slug</label>
                <input wire:model="slug" 
                       type="text" 
                       class="w-full bg-slate-50 border border-slate-200 focus:border-emerald-500 focus:bg-white rounded-lg px-4 py-3 outline-none text-sm transition-all focus:ring-1 focus:ring-emerald-500/20 font-mono text-xs text-slate-600" 
                       placeholder="e.g. herbal-supplements"/>
                @error('slug') 
                    <span class="text-xs text-rose-500 font-semibold block mt-1">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Image File Upload -->
            <div class="space-y-2">
                <label class="block text-xs font-label-caps text-slate-500 uppercase font-bold tracking-wider">Category Image</label>
                
                <div class="flex items-center gap-4">
                    <!-- File Input -->
                    <label class="flex items-center gap-2 bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs tracking-wider px-4 py-3 rounded-lg border border-slate-200 cursor-pointer active:scale-95 transition-all">
                        <span class="material-symbols-outlined text-sm">cloud_upload</span>
                        <span>CHOOSE IMAGE</span>
                        <input type="file" wire:model="image" class="hidden" accept="image/*"/>
                    </label>

                    <!-- Preview Thumbnail -->
                    @if ($image)
                        <div class="h-14 w-14 rounded-lg overflow-hidden bg-slate-50 border border-slate-200 relative group">
                            <img src="{{ $image->temporaryUrl() }}" class="h-full w-full object-cover">
                        </div>
                    @elseif ($existingImage)
                        <div class="h-14 w-14 rounded-lg overflow-hidden bg-slate-50 border border-slate-200 relative group">
                            <img src="{{ asset('storage/' . $existingImage) }}" class="h-full w-full object-cover">
                        </div>
                    @endif
                </div>

                @error('image') 
                    <span class="text-xs text-rose-500 font-semibold block mt-1">{{ $message }}</span> 
                @enderror
            </div>

            <!-- Status Checkbox -->
            <div class="flex items-center gap-3 py-2">
                <input wire:model="is_active" 
                       id="modal-is-active" 
                       type="checkbox" 
                       class="h-4.5 w-4.5 text-emerald-600 border-slate-300 rounded focus:ring-emerald-500 focus:ring-offset-0 transition-all cursor-pointer"/>
                <label for="modal-is-active" class="text-sm font-semibold text-slate-700 cursor-pointer select-none">
                    Mark category as Active
                </label>
                @error('is_active') 
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
