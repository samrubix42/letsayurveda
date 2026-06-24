<div class="space-y-6 animate-fade-in-up">
    
    <!-- Header Title & Action -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="font-headline-sm text-3xl font-bold text-slate-800 tracking-tight">Inventory Management</h1>
            <p class="text-sm text-slate-500 mt-1">Monitor, adjust, and audit stock levels for all product variants.</p>
        </div>
    </div>

    <!-- Filter & Table Card -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        
        <!-- Filter Header -->
        <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex flex-wrap items-center gap-4 w-full sm:w-auto">
                <div class="flex items-center gap-2 w-full max-w-sm px-3.5 py-2.5 bg-white border border-slate-200 rounded-lg text-slate-400 focus-within:border-emerald-500 focus-within:ring-1 focus-within:ring-emerald-500/20 transition-all">
                    <span class="material-symbols-outlined text-sm">search</span>
                    <input wire:model.live="search" class="bg-transparent border-none text-xs outline-none text-slate-700 placeholder:text-slate-400 w-full focus:ring-0" placeholder="Search by SKU or product name..." type="text"/>
                </div>
                
                <label class="flex items-center gap-2 text-xs font-semibold text-slate-700 cursor-pointer select-none">
                    <input wire:model.live="lowStockOnly" type="checkbox" class="h-4 w-4 text-emerald-600 border-slate-300 rounded focus:ring-emerald-500 focus:ring-offset-0 transition-all cursor-pointer"/>
                    <span>Low Stock Alert Only</span>
                </label>
            </div>
            
            <div class="text-xs text-slate-400 font-semibold">
                SHOWING {{ $variants->count() }} OF {{ $variants->total() }} RECORDS
            </div>
        </div>

        <!-- Responsive Table Container -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-400 font-label-caps text-[10px] tracking-widest border-b border-slate-100">
                        <th class="py-4 px-6 font-bold">Product / Variant</th>
                        <th class="py-4 px-6 font-bold">SKU</th>
                        <th class="py-4 px-6 font-bold text-center">Status</th>
                        <th class="py-4 px-6 font-bold text-right">In Stock</th>
                        <th class="py-4 px-6 font-bold text-right">Reserved</th>
                        <th class="py-4 px-6 font-bold text-center">Tracking</th>
                        <th class="py-4 px-6 font-bold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($variants as $variant)
                        @php
                            $qty = $variant->inventory->quantity ?? 0;
                            $threshold = $variant->inventory->low_stock_threshold ?? 5;
                            $tracking = $variant->inventory->track_inventory ?? true;
                            
                            $status = 'In Stock';
                            $statusClass = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                            $dotClass = 'bg-emerald-500';
                            
                            if (!$tracking) {
                                $status = 'Not Tracked';
                                $statusClass = 'bg-slate-50 text-slate-500 border-slate-200';
                                $dotClass = 'bg-slate-400';
                            } elseif ($qty <= 0) {
                                $status = 'Out of Stock';
                                $statusClass = 'bg-rose-50 text-rose-700 border-rose-200';
                                $dotClass = 'bg-rose-500';
                            } elseif ($qty <= $threshold) {
                                $status = 'Low Stock';
                                $statusClass = 'bg-amber-50 text-amber-700 border-amber-200';
                                $dotClass = 'bg-amber-500';
                            }
                        @endphp
                        <tr wire:key="variant-{{ $variant->id }}" class="hover:bg-slate-50/40 transition-colors">
                            
                            <!-- Product Name & Variant Name -->
                            <td class="py-4 px-6">
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-800">{{ $variant->product->name }}</span>
                                    @if($variant->name !== 'Default Variant')
                                        <span class="text-xs text-slate-400 font-semibold mt-0.5">{{ $variant->name }}</span>
                                    @else
                                        <span class="text-[10px] text-slate-300 font-semibold italic mt-0.5">Base Product</span>
                                    @endif
                                </div>
                            </td>

                            <!-- SKU -->
                            <td class="py-4 px-6 text-slate-500 font-mono text-xs">{{ $variant->sku }}</td>

                            <!-- Stock Status Badge -->
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold {{ $statusClass }} border">
                                    <span class="h-1.5 w-1.5 rounded-full {{ $dotClass }}"></span>
                                    {{ $status }}
                                </span>
                            </td>

                            <!-- In Stock Qty -->
                            <td class="py-4 px-6 text-right font-semibold text-slate-800">
                                {{ $qty }}
                            </td>

                            <!-- Reserved Qty -->
                            <td class="py-4 px-6 text-right font-medium text-slate-400">
                                {{ $variant->inventory->reserved_quantity ?? 0 }}
                            </td>

                            <!-- Track Inventory -->
                            <td class="py-4 px-6 text-center">
                                @if($tracking)
                                    <span class="text-emerald-600 font-bold text-xs">Yes</span>
                                @else
                                    <span class="text-slate-400 font-semibold text-xs">No</span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <button type="button" @click="$dispatch('open-modal'); $wire.openEditModal({{ $variant->id }})" class="text-slate-500 hover:text-emerald-600 p-1.5 rounded hover:bg-slate-100 transition-all cursor-pointer" title="Adjust Stock">
                                        <span class="material-symbols-outlined text-lg">edit_note</span>
                                    </button>
                                    <button type="button" @click="$dispatch('open-logs-modal'); $wire.openLogsModal({{ $variant->id }})" class="text-slate-500 hover:text-indigo-600 p-1.5 rounded hover:bg-slate-100 transition-all cursor-pointer" title="View Audit Logs">
                                        <span class="material-symbols-outlined text-lg">history</span>
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 px-6 text-center text-slate-400">
                                <span class="material-symbols-outlined text-4xl block mb-2 opacity-50">search_off</span>
                                <span class="text-sm font-medium">No stock records found.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer Pagination -->
        @if($variants->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/20">
                {{ $variants->links() }}
            </div>
        @endif

    </div>

    <!-- Modals -->
    @include('admin.inventorylist.form-modal')
    @include('admin.inventorylist.logs-modal')

</div>
