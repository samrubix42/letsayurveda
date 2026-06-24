<div x-data="{ logsOpen: false }"
     x-on:open-logs-modal.window="logsOpen = true"
     x-on:close-logs-modal.window="logsOpen = false"
     wire:ignore.self
     x-show="logsOpen"
     class="fixed inset-0 z-[100] flex justify-end"
     x-cloak>
    
    <!-- Backdrop Click Closes -->
    <div x-show="logsOpen"
         @click="logsOpen = false" 
         class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity duration-300"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"></div>

    <!-- Side Panel Container -->
    <div x-show="logsOpen"
         class="relative bg-white w-full max-w-lg h-full shadow-2xl overflow-y-auto z-10 border-l border-slate-200 flex flex-col"
         x-transition:enter="transform transition ease-in-out duration-300 sm:duration-300"
         x-transition:enter-start="translate-x-full"
         x-transition:enter-end="translate-x-0"
         x-transition:leave="transform transition ease-in-out duration-300 sm:duration-300"
         x-transition:leave-start="translate-x-0"
         x-transition:leave-end="translate-x-full">
        
        <!-- Header -->
        <div class="px-6 py-5 border-b border-slate-100 bg-slate-50/50 flex justify-between items-center">
            <div>
                <h3 class="text-lg font-bold text-slate-800">
                    Stock Audit History
                </h3>
                <p class="text-xs text-slate-500 mt-0.5">Logs showing transaction audits and stock recounts.</p>
            </div>
            <button @click="logsOpen = false" class="text-slate-400 hover:text-slate-700 active:scale-95 transition-transform" type="button">
                <span class="material-symbols-outlined text-xl">close</span>
            </button>
        </div>

        <!-- Scrollable Timeline Content -->
        <div class="flex-1 p-6 overflow-y-auto bg-slate-50/20">
            <!-- Variant Header Info -->
            <div class="mb-6 p-4 bg-white border border-slate-200 rounded-xl">
                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">Audit Target</div>
                <div class="text-sm font-bold text-slate-800 mt-0.5">{{ $viewLogsVariantName }}</div>
            </div>

            <!-- Timeline -->
            <div class="relative border-l border-slate-200 ml-4 space-y-6">
                @forelse($logsList as $log)
                    @php
                        // Log Type Styling
                        $colorClass = 'bg-slate-100 text-slate-600 border-slate-200';
                        $iconName = 'info';
                        
                        switch($log->type) {
                            case 'stock_in':
                            case 'return':
                                $colorClass = 'bg-emerald-50 text-emerald-700 border-emerald-200';
                                $iconName = 'add';
                                break;
                            case 'stock_out':
                            case 'sale':
                                $colorClass = 'bg-rose-50 text-rose-700 border-rose-200';
                                $iconName = 'remove';
                                break;
                            case 'adjustment':
                                $colorClass = 'bg-amber-50 text-amber-700 border-amber-200';
                                $iconName = 'settings_backup_restore';
                                break;
                            case 'reserved':
                                $colorClass = 'bg-indigo-50 text-indigo-700 border-indigo-200';
                                $iconName = 'bookmark_added';
                                break;
                            case 'released':
                                $colorClass = 'bg-slate-100 text-slate-700 border-slate-200';
                                $iconName = 'lock_open';
                                break;
                        }
                    @endphp
                    <div class="relative pl-6">
                        <!-- Timeline Point -->
                        <span class="absolute -left-3.5 flex items-center justify-center w-7 h-7 rounded-full border {{ $colorClass }} font-bold text-xs select-none">
                            <span class="material-symbols-outlined text-xs">{{ $iconName }}</span>
                        </span>
                        
                        <!-- Timeline Card -->
                        <div class="bg-white border border-slate-200/80 rounded-xl p-4 shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex items-center justify-between gap-2 flex-wrap">
                                <span class="text-xs font-bold text-slate-800 uppercase tracking-wider">
                                    {{ str_replace('_', ' ', $log->type) }}
                                </span>
                                <span class="text-[10px] text-slate-400 font-semibold">
                                    {{ $log->created_at ? $log->created_at->format('d M Y, h:i A') : 'N/A' }}
                                </span>
                            </div>
                            
                            <!-- Quantities detail -->
                            <div class="flex gap-4 mt-2 text-xs font-medium border-y border-slate-100 py-1.5 my-2">
                                <div>
                                    <span class="text-slate-400">Change:</span>
                                    <span class="text-slate-700 font-semibold font-mono">
                                        @if(in_array($log->type, ['stock_in', 'return'])) + @elseif(in_array($log->type, ['stock_out', 'sale'])) - @endif{{ $log->quantity }}
                                    </span>
                                </div>
                                <div>
                                    <span class="text-slate-400">Before:</span>
                                    <span class="text-slate-500 font-semibold font-mono">{{ $log->before_quantity }}</span>
                                </div>
                                <div>
                                    <span class="text-slate-400">After:</span>
                                    <span class="text-slate-800 font-bold font-mono">{{ $log->after_quantity }}</span>
                                </div>
                            </div>

                            <!-- User Notes -->
                            @if($log->note)
                                <p class="text-xs text-slate-600 bg-slate-50 p-2.5 rounded-lg border border-slate-100 italic">
                                    "{{ $log->note }}"
                                </p>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="text-center py-12 ml-[-16px]">
                        <span class="material-symbols-outlined text-slate-300 text-4xl block mb-2">history</span>
                        <span class="text-xs text-slate-400 font-medium italic">No audit logs logged yet.</span>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Footer -->
        <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/50 flex justify-end">
            <button @click="logsOpen = false" type="button" class="px-6 py-2.5 rounded-full border border-slate-200 text-xs font-semibold text-slate-600 hover:bg-slate-100 transition-colors cursor-pointer">
                Close Panel
            </button>
        </div>
    </div>
</div>
