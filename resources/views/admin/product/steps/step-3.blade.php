<div class="space-y-8"
     x-data="{
        showDeleteModal: false,
        itemToDelete: null,
        typeToDelete: null,
        variantIndex: null,
        confirmDelete() {
            if(this.typeToDelete === 'existing') {
                $wire.removeExistingImage(this.itemToDelete);
            } else if(this.typeToDelete === 'new') {
                $wire.removeVariantImage(this.variantIndex, this.itemToDelete);
            }
            this.showDeleteModal = false;
        }
     }">

    {{-- Attribute Selector --}}
    <div>
        <h3 class="text-sm font-semibold text-slate-700 flex items-center gap-2 mb-4">
            <span class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <span class="material-symbols-outlined text-sm">palette</span>
            </span>
            <span>Select Attributes</span>
        </h3>
        <p class="text-xs text-slate-400 mb-5">Click on attribute values to create variant combinations</p>

        <div class="space-y-5">
            @foreach($this->productAttributes as $attribute)
            <div class="bg-slate-50/85 rounded-xl p-5 border border-slate-100">
                <h4 class="text-sm font-bold text-slate-700 mb-3">{{ $attribute->name }}</h4>
                <div class="flex flex-wrap gap-2">
                    @foreach($attribute->values as $value)
                    @php $selected = $this->isValueSelected($attribute->id, $value->id); @endphp
                    <button type="button"
                        wire:click="toggleAttributeValue({{ $attribute->id }}, {{ $value->id }})"
                        @class([ 'px-4 py-2 rounded-full text-xs font-semibold tracking-wider transition-all duration-200 border cursor-pointer' , 
                        'bg-emerald-600 text-white border-emerald-500 shadow-sm scale-105'=> $selected,
                        'bg-white text-slate-600 border-slate-200 hover:border-emerald-300 hover:text-emerald-600 hover:bg-emerald-50' => !$selected,
                        ])>
                        @if($selected)
                        <span class="material-symbols-outlined text-xs mr-1 align-middle">check</span>
                        @endif
                        <span>{{ $value->value }}</span>
                    </button>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- Generated Variants --}}
    @if(count($variants) > 0)
    <div>
        <div class="flex items-center justify-between mb-4">
            <h3 class="text-sm font-semibold text-slate-700 flex items-center gap-2">
                <span class="w-6 h-6 rounded-lg bg-emerald-50 text-emerald-600 flex items-center justify-center">
                    <span class="material-symbols-outlined text-sm">layers</span>
                </span>
                <span>Generated Variants</span>
                <span class="ml-2 px-2.5 py-0.5 rounded-full bg-emerald-550/15 text-emerald-700 text-[10px] font-bold uppercase tracking-wider">
                    {{ count($variants) }}
                </span>
            </h3>
        </div>

        @error('variants')
        <p class="mb-3 text-xs text-rose-600 flex items-center gap-1"><span class="material-symbols-outlined text-xs">error</span> {{ $message }}</p>
        @enderror

        <div class="space-y-3">
            @foreach($variants as $index => $variant)
            <div class="bg-white border border-slate-200 rounded-xl p-5 hover:shadow-md transition-shadow duration-200"
                wire:key="variant-{{ $index }}">

                {{-- Variant Header --}}
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-gradient-to-br from-emerald-500 to-emerald-600 text-white flex items-center justify-center text-xs font-bold select-none">
                            {{ $index + 1 }}
                        </span>
                        <span class="text-sm font-bold text-slate-800">{{ $variant['name'] }}</span>
                    </div>
                    <button type="button" wire:click="removeVariant({{ $index }})"
                        class="w-7 h-7 rounded-lg bg-rose-50 text-rose-400 hover:bg-rose-100 hover:text-rose-600 flex items-center justify-center transition-colors cursor-pointer">
                        <span class="material-symbols-outlined text-base">delete</span>
                    </button>
                </div>

                {{-- Variant Fields --}}
                <div class="space-y-4">
                    <div class="grid grid-cols-2 md:grid-cols-5 gap-3">
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1">SKU</label>
                            <input type="text" wire:model="variants.{{ $index }}.sku"
                                class="w-full rounded-lg border border-slate-200 bg-slate-50/50 px-3 py-2 text-sm
                                               focus:bg-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-550/15 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1">
                                Price <span class="text-rose-400">*</span>
                            </label>
                            <input type="number" step="0.01" wire:model="variants.{{ $index }}.price"
                                placeholder="0.00"
                                class="w-full rounded-lg border border-slate-200 bg-slate-50/50 px-3 py-2 text-sm
                                               focus:bg-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-550/15 focus:outline-none">
                            @error("variants.{$index}.price")
                            <p class="mt-0.5 text-[10px] text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1">Sale Price</label>
                            <input type="number" step="0.01" wire:model="variants.{{ $index }}.sale_price"
                                placeholder="0.00"
                                class="w-full rounded-lg border border-slate-200 bg-slate-50/50 px-3 py-2 text-sm
                                               focus:bg-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-550/15 focus:outline-none">
                        </div>
                        <div>
                            <label class="block text-xs font-semibold text-slate-500 mb-1">Cost Price</label>
                            <input type="number" step="0.01" wire:model="variants.{{ $index }}.cost_price"
                                placeholder="0.00"
                                class="w-full rounded-lg border border-slate-200 bg-slate-50/50 px-3 py-2 text-sm
                                               focus:bg-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-550/15 focus:outline-none">
                        </div>
                        <div>
                            <div class="flex items-center justify-between mb-1">
                                <label class="block text-xs font-semibold text-slate-500">
                                    Stock <span class="text-rose-400">*</span>
                                </label>
                                @php
                                $vStock = (int)($variant['stock'] ?? 0);
                                $vLow = (int)($variant['low_stock_alert'] ?? 5);
                                $vStatus = 'In Stock';
                                $vColor = 'text-emerald-500';
                                if ($vStock <= 0) {
                                    $vStatus='Out' ;
                                    $vColor='text-rose-500' ;
                                } elseif ($vStock <=$vLow) {
                                    $vStatus='Low' ;
                                    $vColor='text-amber-500' ;
                                }
                                @endphp
                                <span class="text-[9px] font-bold uppercase {{ $vColor }}">{{ $vStatus }}</span>
                            </div>
                            <input type="number" wire:model="variants.{{ $index }}.stock"
                                placeholder="0"
                                class="w-full rounded-lg border border-slate-200 bg-slate-50/50 px-3 py-2 text-sm
                                               focus:bg-white focus:border-emerald-500 focus:ring-2 focus:ring-emerald-550/15 focus:outline-none">
                            @error("variants.{$index}.stock")
                            <p class="mt-0.5 text-[10px] text-rose-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    {{-- Variant Media & Status --}}
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pt-3 border-t border-slate-100">
                        <div class="flex items-center gap-4">
                            {{-- Multi-Image Upload & Gallery --}}
                            <div class="flex flex-col gap-2">
                                <div class="flex flex-wrap gap-2">
                                    {{-- Existing Images (from DB) --}}
                                    @if(isset($existingVariantImages[$variant['id'] ?? null]))
                                    @foreach($existingVariantImages[$variant['id']] as $vImg)
                                    <div class="relative w-12 h-12 rounded-lg border border-slate-200 overflow-hidden bg-slate-50 group">
                                        <img src="{{ asset('storage/' . $vImg['image_path']) }}" class="w-full h-full object-cover">
                                        <button type="button"
                                            @click="showDeleteModal = true; itemToDelete = {{ $vImg['id'] }}; typeToDelete = 'existing'; variantIndex = {{ $index }}"
                                            class="absolute inset-0 bg-rose-600/80 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 cursor-pointer">
                                            <span class="material-symbols-outlined text-base">delete</span>
                                        </button>
                                    </div>
                                    @endforeach
                                    @endif

                                    {{-- New Upload Previews --}}
                                    @if(isset($variantImages[$index]) && is_array($variantImages[$index]))
                                    @foreach($variantImages[$index] as $uKey => $uImg)
                                    <div class="relative w-12 h-12 rounded-lg border border-emerald-200 overflow-hidden bg-emerald-50 group">
                                        <img src="{{ $uImg->temporaryUrl() }}" class="w-full h-full object-cover">
                                        <button type="button"
                                            @click="showDeleteModal = true; itemToDelete = {{ $uKey }}; typeToDelete = 'new'; variantIndex = {{ $index }}"
                                            class="absolute inset-0 bg-rose-600/80 text-white flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-200 cursor-pointer">
                                            <span class="material-symbols-outlined text-base">delete</span>
                                        </button>
                                    </div>
                                    @endforeach
                                    @endif

                                    {{-- Add Button --}}
                                    <div class="relative w-12 h-12 rounded-lg border-2 border-dashed border-slate-200 flex items-center justify-center hover:border-emerald-400 hover:bg-emerald-50/50 transition-all cursor-pointer group">
                                        <span class="material-symbols-outlined text-slate-400 group-hover:text-emerald-500">add_photo_alternate</span>
                                        <input type="file" wire:model="variantImages.{{ $index }}" multiple class="absolute inset-0 opacity-0 cursor-pointer text-[0]">
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 select-none">
                                    <span class="text-[9px] font-bold text-slate-400 uppercase tracking-wider">Variant Gallery</span>
                                    <div wire:loading wire:target="variantImages.{{ $index }}">
                                        <span class="material-symbols-outlined animate-spin text-emerald-600 text-xs">sync</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Status Toggle --}}
                        <div class="flex items-center gap-2">
                            <span class="text-xs font-semibold text-slate-500">Active</span>
                            <button type="button"
                                wire:click="$set('variants.{{ $index }}.status', {{ !($variant['status'] ?? true) ? 'true' : 'false' }})"
                                @class([ 'relative inline-flex h-5 w-9 items-center rounded-full transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-emerald-550/20 cursor-pointer' , 
                                'bg-emerald-600'=> $variant['status'] ?? true,
                                'bg-slate-200' => !($variant['status'] ?? true),
                                ])>
                                <span @class([ 'inline-block h-3 w-3 transform rounded-full bg-white transition duration-200 ease-in-out' , 'translate-x-5'=> $variant['status'] ?? true,
                                    'translate-x-1' => !($variant['status'] ?? true),
                                    ])></span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    {{-- Empty State --}}
    <div class="text-center py-12 bg-slate-50/80 rounded-xl border-2 border-dashed border-slate-200">
        <div class="w-14 h-14 rounded-2xl bg-slate-100 flex items-center justify-center mx-auto mb-4">
            <span class="material-symbols-outlined text-slate-400 text-2xl">apps</span>
        </div>
        <h4 class="text-sm font-bold text-slate-600">No Variants Yet</h4>
        <p class="text-xs text-slate-400 mt-1">Select attribute values above to auto-generate variant combinations</p>
    </div>
    @endif

    {{-- Variant Image Delete Confirmation Modal --}}
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

            <h3 class="text-lg font-bold text-slate-800 text-center mb-2">Delete Variant Image?</h3>
            <p class="text-sm text-slate-500 text-center mb-6">Are you sure you want to remove this image from the variant gallery? This action can be permanent for existing images.</p>

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
</div>
