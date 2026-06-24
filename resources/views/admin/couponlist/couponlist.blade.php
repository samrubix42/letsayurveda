<div class="space-y-6 animate-fade-in-up">
    
    <!-- Header Title & Action -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="font-headline-sm text-3xl font-bold text-slate-800 tracking-tight">Discount Coupons</h1>
            <p class="text-sm text-slate-500 mt-1">Configure and manage promotion codes and discount campaigns.</p>
        </div>
        <button type="button" @click="$dispatch('open-modal'); $wire.openCreateModal()" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs tracking-wider px-5 py-3 rounded-full hover:shadow-md active:scale-95 transition-all cursor-pointer">
            <span class="material-symbols-outlined text-sm">add</span>
            <span>ADD COUPON</span>
        </button>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
        <!-- Total Coupons -->
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center">
                <span class="material-symbols-outlined text-2xl">confirmation_number</span>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Total Coupons</p>
                <h3 class="text-2xl font-bold text-slate-800 mt-0.5">{{ $totalCount }}</h3>
            </div>
        </div>

        <!-- Active Coupons -->
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center">
                <span class="material-symbols-outlined text-2xl">check_circle</span>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Active Coupons</p>
                <h3 class="text-2xl font-bold text-slate-800 mt-0.5">{{ $activeCount }}</h3>
            </div>
        </div>

        <!-- Total Redeemed -->
        <div class="bg-white border border-slate-200 rounded-2xl p-5 shadow-sm flex items-center gap-4">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center">
                <span class="material-symbols-outlined text-2xl">shopping_cart_checkout</span>
            </div>
            <div>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-wider">Total Redeemed</p>
                <h3 class="text-2xl font-bold text-slate-800 mt-0.5">{{ $totalUsedCount }}</h3>
            </div>
        </div>
    </div>

    <!-- Filter & Table Card -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        
        <!-- Filter Header -->
        <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-2 w-full max-w-sm px-3.5 py-2.5 bg-white border border-slate-200 rounded-lg text-slate-400 focus-within:border-emerald-500 focus-within:ring-1 focus-within:ring-emerald-500/20 transition-all">
                <span class="material-symbols-outlined text-sm">search</span>
                <input wire:model.live="search" class="bg-transparent border-none text-xs outline-none text-slate-700 placeholder:text-slate-400 w-full focus:ring-0" placeholder="Filter coupons by code..." type="text"/>
            </div>
            <div class="text-xs text-slate-400 font-semibold">
                SHOWING {{ $coupons->count() }} OF {{ $coupons->total() }} RECORDS
            </div>
        </div>

        <!-- Responsive Table Container -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-400 font-label-caps text-[10px] tracking-widest border-b border-slate-100">
                        <th class="py-4 px-6 font-bold">Code</th>
                        <th class="py-4 px-6 font-bold">Discount</th>
                        <th class="py-4 px-6 font-bold text-right">Min Spend</th>
                        <th class="py-4 px-6 font-bold text-center">Redemptions</th>
                        <th class="py-4 px-6 font-bold text-center">Expiry</th>
                        <th class="py-4 px-6 font-bold text-center">Status</th>
                        <th class="py-4 px-6 font-bold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($coupons as $coupon)
                        <tr wire:key="coupon-{{ $coupon->id }}" class="hover:bg-slate-50/40 transition-colors">
                            
                            <!-- Coupon Code (Ticket style) -->
                            <td class="py-4 px-6">
                                <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-lg bg-emerald-50/70 border border-emerald-250/20 text-emerald-800 font-mono font-bold tracking-wider text-xs">
                                    <span class="material-symbols-outlined text-xs">local_activity</span>
                                    <span>{{ $coupon->code }}</span>
                                </div>
                            </td>

                            <!-- Discount amount/percentage -->
                            <td class="py-4 px-6 font-bold text-slate-800">
                                @if($coupon->type === 'percentage')
                                    {{ number_format($coupon->value, 0) }}% Off
                                @else
                                    ₹{{ number_format($coupon->value, 2) }} Off
                                @endif
                            </td>

                            <!-- Min Spend -->
                            <td class="py-4 px-6 text-right font-medium text-slate-600">
                                @if($coupon->min_spend > 0)
                                    ₹{{ number_format($coupon->min_spend, 2) }}
                                @else
                                    <span class="text-slate-400 italic">None</span>
                                @endif
                            </td>

                            <!-- Redemption count -->
                            <td class="py-4 px-6 text-center font-medium">
                                <div class="flex flex-col items-center">
                                    <span class="text-slate-800 font-semibold">{{ $coupon->used_count }} used</span>
                                    <span class="text-[10px] text-slate-400 mt-0.5">
                                        Limit: {{ $coupon->limit_per_coupon ?: 'Unlimited' }}
                                    </span>
                                </div>
                            </td>

                            <!-- Expiry date -->
                            <td class="py-4 px-6 text-center text-slate-500 font-medium text-xs">
                                @if($coupon->expiry_date)
                                    <span @class([
                                        'text-rose-600 font-bold' => $coupon->expiry_date->isPast(),
                                        'text-slate-600' => !$coupon->expiry_date->isPast()
                                    ])>
                                        {{ $coupon->expiry_date->format('d M Y, h:i A') }}
                                    </span>
                                @else
                                    <span class="text-slate-400 italic">Never Expires</span>
                                @endif
                            </td>

                            <!-- Status Toggle Badge -->
                            <td class="py-4 px-6 text-center">
                                <button wire:click="toggleStatus({{ $coupon->id }})" class="cursor-pointer active:scale-95 transition-transform inline-flex">
                                    @if($coupon->is_active)
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                            Active
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-slate-100 text-slate-600 border border-slate-200">
                                            <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                            Inactive
                                        </span>
                                    @endif
                                </button>
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <button type="button" @click="$dispatch('open-modal'); $wire.openEditModal({{ $coupon->id }})" class="text-slate-500 hover:text-emerald-600 p-1.5 rounded hover:bg-slate-100 transition-all cursor-pointer" title="Edit Coupon">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </button>
                                    <button type="button" @click="$dispatch('open-delete-modal'); $wire.confirmDelete({{ $coupon->id }})" 
                                            class="text-slate-500 hover:text-rose-600 p-1.5 rounded hover:bg-slate-100 transition-all cursor-pointer" 
                                            title="Delete Coupon">
                                        <span class="material-symbols-outlined text-lg">delete</span>
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="py-12 px-6 text-center text-slate-400">
                                <span class="material-symbols-outlined text-4xl block mb-2 opacity-50">search_off</span>
                                <span class="text-sm font-medium">No coupons found.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer Pagination -->
        @if($coupons->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/20">
                {{ $coupons->links() }}
            </div>
        @endif

    </div>

    <!-- Include Form and Delete Confirmation Modals -->
    @include('admin.couponlist.form-modal')
    @include('admin.couponlist.delete-modal')

</div>
