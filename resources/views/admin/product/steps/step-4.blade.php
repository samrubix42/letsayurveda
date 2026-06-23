<div class="space-y-6"
    x-data="{
        dragging: false,
        showDeleteModal: false,
        showPrimaryModal: false,
        itemToDelete: null,
        typeToDelete: null,
        itemToPrimary: null,
        confirmDelete() {
            if(this.typeToDelete === 'existing') {
                $wire.removeExistingImage(this.itemToDelete);
            } else {
                $wire.removeImage(this.itemToDelete);
            }
            this.showDeleteModal = false;
        },
        confirmPrimary() {
            $wire.setPrimaryImage(this.itemToPrimary);
            this.showPrimaryModal = false;
        }
    }">

    {{-- Upload Zone --}}
    <div x-on:dragover.prevent="dragging = true"
         x-on:dragleave.prevent="dragging = false"
         x-on:drop.prevent="dragging = false"
         :class="dragging ? 'border-emerald-400 bg-emerald-50/50 scale-[1.01]' : 'border-slate-200 bg-slate-50/30 hover:border-emerald-300 hover:bg-emerald-50/30'"
         class="relative border-2 border-dashed rounded-2xl p-10 text-center transition-all duration-300 cursor-pointer group">

        <input type="file" wire:model="productImages" multiple accept="image/*"
            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" id="media-upload">

        <div class="flex flex-col items-center">
            <div :class="dragging ? 'bg-emerald-200 text-emerald-700 scale-110' : 'bg-slate-100 text-slate-400 group-hover:bg-emerald-100 group-hover:text-emerald-500'"
                 class="w-16 h-16 rounded-2xl flex items-center justify-center mb-4 transition-all duration-300">
                <span class="material-symbols-outlined text-3xl">add_photo_alternate</span>
            </div>

            <h4 class="text-sm font-semibold text-slate-700 mb-1">
                <span x-show="!dragging">Drop images here or click to browse</span>
                <span x-show="dragging" class="text-emerald-600">Release to upload</span>
            </h4>
            <p class="text-xs text-slate-400 font-medium">PNG, JPG, WEBP up to 2MB each</p>
        </div>

        {{-- Loading Indicator --}}
        <div wire:loading wire:target="productImages" class="absolute inset-0 bg-white/80 rounded-2xl flex items-center justify-center backdrop-blur-[1px]">
            <div class="flex flex-col items-center gap-2">
                <span class="material-symbols-outlined animate-spin text-2xl text-emerald-600">sync</span>
                <span class="text-sm font-semibold text-emerald-600">Uploading...</span>
            </div>
        </div>
    </div>

    @error('productImages.*')
        <p class="text-xs text-rose-600 flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span> {{ $message }}</p>
    @enderror

    {{-- Existing Images Previews --}}
    @if(isset($existingImages) && count($existingImages) > 0)
        <div>
            <div class="flex items-center justify-between mb-3">
                <h4 class="text-sm font-semibold text-slate-700">
                    Existing Images
                    <span class="ml-1 text-xs font-normal text-slate-400">({{ count($existingImages) }} files)</span>
                </h4>
            </div>

            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3">
                @foreach($existingImages as $index => $img)
                    <div class="group relative rounded-xl overflow-hidden shadow-sm border border-slate-200 aspect-square bg-slate-100"
                         wire:key="existing-img-{{ $img['id'] }}">

                        <img src="{{ asset('storage/' . $img['image_path']) }}"
                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                             alt="Existing image">

                        {{-- Primary Badge --}}
                        @if($img['is_primary'])
                            <span class="absolute top-1.5 left-1.5 px-2 py-0.5 rounded-md bg-emerald-600 text-white text-[10px] font-bold uppercase tracking-wider shadow">
                                Primary
                            </span>
                        @endif

                        {{-- Remove Button --}}
                        <button type="button" 
                            @click="showDeleteModal = true; itemToDelete = {{ $img['id'] }}; typeToDelete = 'existing'"
                            class="absolute top-1.5 right-1.5 z-10 w-7 h-7 rounded-lg bg-white/90 text-slate-600 flex items-center justify-center
                                   opacity-0 group-hover:opacity-100 transition-all duration-200 hover:bg-rose-600 hover:text-white shadow-sm border border-slate-100 cursor-pointer">
                            <span class="material-symbols-outlined text-base">close</span>
                        </button>

                        {{-- Set Primary Button --}}
                        @if(!$img['is_primary'])
                            <button type="button" 
                                @click="showPrimaryModal = true; itemToPrimary = {{ $img['id'] }}"
                                class="absolute bottom-1.5 right-1.5 z-10 w-7 h-7 rounded-lg bg-white/90 text-emerald-600 flex items-center justify-center
                                       opacity-0 group-hover:opacity-100 transition-all duration-200 hover:bg-emerald-600 hover:text-white shadow-sm border border-slate-100 cursor-pointer">
                                <span class="material-symbols-outlined text-base">star</span>
                            </button>
                        @endif
 
                        {{-- Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none"></div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- New Upload Previews --}}
    @if($productImages && count($productImages) > 0)
        <div>
            <div class="flex items-center justify-between mb-3">
                <h4 class="text-sm font-semibold text-slate-700">
                    New Uploads
                    <span class="ml-1 text-xs font-normal text-slate-400">({{ count($productImages) }} files)</span>
                </h4>
                @if(!isset($existingImages) || count($existingImages) === 0)
                    <span class="text-xs text-slate-400">First image = Primary</span>
                @endif
            </div>

            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-6 gap-3">
                @foreach($productImages as $index => $image)
                    <div class="group relative rounded-xl overflow-hidden shadow-sm border border-slate-200 aspect-square bg-slate-100"
                         wire:key="img-preview-{{ $index }}">

                        <img src="{{ $image->temporaryUrl() }}"
                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
                             alt="Product image {{ $index + 1 }}">

                        {{-- Primary Badge --}}
                        @if($index === 0)
                            <span class="absolute top-1.5 left-1.5 px-2 py-0.5 rounded-md bg-emerald-600 text-white text-[10px] font-bold uppercase tracking-wider shadow">
                                Primary
                            </span>
                        @endif

                        {{-- Remove Button --}}
                        <button type="button" 
                            @click="showDeleteModal = true; itemToDelete = {{ $index }}; typeToDelete = 'new'"
                            class="absolute top-1.5 right-1.5 z-10 w-7 h-7 rounded-lg bg-white/90 text-slate-600 flex items-center justify-center
                                   opacity-0 group-hover:opacity-100 transition-all duration-200 hover:bg-rose-600 hover:text-white shadow-sm border border-slate-100 cursor-pointer">
                            <span class="material-symbols-outlined text-base">close</span>
                        </button>
 
                        {{-- Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-200 pointer-events-none"></div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Delete Confirmation Modal --}}
    <div x-show="showDeleteModal" 
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-[1px]"
         x-cloak
         x-transition>
        
        <div @click.away="showDeleteModal = false" 
             class="bg-white rounded-2xl shadow-2xl max-w-sm w-full p-6 transform transition-all border border-slate-100"
             x-transition>
            
            <div class="w-16 h-16 rounded-full bg-rose-50 text-rose-500 flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-3xl">delete</span>
            </div>
            
            <h3 class="text-lg font-bold text-slate-800 text-center mb-2">Delete Image?</h3>
            <p class="text-sm text-slate-500 text-center mb-6">This action cannot be undone. The image will be permanently removed from storage.</p>
            
            <div class="flex gap-3">
                <button type="button" @click="showDeleteModal = false"
                    class="flex-1 px-4 py-2.5 rounded-full border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition-colors cursor-pointer">
                    Cancel
                </button>
                <button type="button" @click="confirmDelete()"
                    class="flex-1 px-4 py-2.5 rounded-full bg-rose-600 text-white text-xs font-semibold hover:bg-rose-700 transition-all cursor-pointer">
                    Yes, Delete
                </button>
            </div>
        </div>
    </div>

    {{-- Primary Confirmation Modal --}}
    <div x-show="showPrimaryModal" 
         class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-slate-900/60 backdrop-blur-[1px]"
         x-cloak
         x-transition>
        
        <div @click.away="showPrimaryModal = false" 
             class="bg-white rounded-2xl shadow-2xl max-w-sm w-full p-6 transform transition-all border border-slate-100"
             x-transition>
            
            <div class="w-16 h-16 rounded-full bg-emerald-50 text-emerald-500 flex items-center justify-center mx-auto mb-4">
                <span class="material-symbols-outlined text-3xl">star</span>
            </div>
            
            <h3 class="text-lg font-bold text-slate-800 text-center mb-2">Set as Primary?</h3>
            <p class="text-sm text-slate-500 text-center mb-6">This image will be used as the main cover for the product. Previous primary image will be changed to regular.</p>
            
            <div class="flex gap-3">
                <button type="button" @click="showPrimaryModal = false"
                    class="flex-1 px-4 py-2.5 rounded-full border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-50 transition-colors cursor-pointer">
                    Cancel
                </button>
                <button type="button" @click="confirmPrimary()"
                    class="flex-1 px-4 py-2.5 rounded-full bg-emerald-600 text-white text-xs font-semibold hover:bg-emerald-700 transition-all cursor-pointer">
                    Set Primary
                </button>
            </div>
        </div>
    </div>
</div>
