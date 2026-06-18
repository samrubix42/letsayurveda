<div class="space-y-6 animate-fade-in-up">
    
    <!-- Header Title & Action -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="font-headline-sm text-3xl font-bold text-slate-800 tracking-tight">Blog Categories</h1>
            <p class="text-sm text-slate-500 mt-1">Manage and classify your wellness sanctuary journals.</p>
        </div>
        <button type="button" @click="$dispatch('open-modal'); $wire.openCreateModal()" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs tracking-wider px-5 py-3 rounded-full hover:shadow-md active:scale-95 transition-all cursor-pointer">
            <span class="material-symbols-outlined text-sm">add</span>
            <span>ADD CATEGORY</span>
        </button>
    </div>


    <!-- Filter & Table Card -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        
        <!-- Filter Header -->
        <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-2 w-full max-w-sm px-3.5 py-2.5 bg-white border border-slate-200 rounded-lg text-slate-400 focus-within:border-emerald-500 focus-within:ring-1 focus-within:ring-emerald-500/20 transition-all">
                <span class="material-symbols-outlined text-sm">search</span>
                <input wire:model.live="search" class="bg-transparent border-none text-xs outline-none text-slate-700 placeholder:text-slate-400 w-full focus:ring-0" placeholder="Filter categories by name..." type="text"/>
            </div>
            <div class="text-xs text-slate-400 font-semibold">
                SHOWING {{ $categories->count() }} OF {{ $categories->total() }} RECORDS
            </div>
        </div>

        <!-- Responsive Table Container -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-400 font-label-caps text-[10px] tracking-widest border-b border-slate-100">
                        <th class="py-4 px-6 font-bold">Category</th>
                        <th class="py-4 px-6 font-bold">Slug</th>
                        <th class="py-4 px-6 font-bold text-center">Status</th>
                        <th class="py-4 px-6 font-bold text-center">Created At</th>
                        <th class="py-4 px-6 font-bold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($categories as $category)
                        <tr wire:key="category-{{ $category->id }}" class="hover:bg-slate-50/40 transition-colors">
                            
                            <!-- Category Name -->
                            <td class="py-4 px-6">
                                <span class="font-bold text-slate-800">{{ $category->name }}</span>
                            </td>

                            <!-- Slug -->
                            <td class="py-4 px-6 text-slate-500 font-mono text-xs">{{ $category->slug }}</td>

                            <!-- Status Toggle Badge -->
                            <td class="py-4 px-6 text-center">
                                <button wire:click="toggleStatus({{ $category->id }})" class="cursor-pointer active:scale-95 transition-transform inline-flex">
                                    @if($category->status)
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

                            <!-- Created At -->
                            <td class="py-4 px-6 text-center text-slate-400 font-medium text-xs">
                                {{ $category->created_at ? $category->created_at->format('d M Y') : 'N/A' }}
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <button type="button" @click="$dispatch('open-modal'); $wire.openEditModal({{ $category->id }})" class="text-slate-500 hover:text-emerald-600 p-1.5 rounded hover:bg-slate-100 transition-all cursor-pointer" title="Edit Category">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </button>
                                    <button type="button" @click="$dispatch('open-delete-modal'); $wire.confirmDelete({{ $category->id }})" 
                                            class="text-slate-500 hover:text-rose-600 p-1.5 rounded hover:bg-slate-100 transition-all cursor-pointer" 
                                            title="Delete Category">
                                        <span class="material-symbols-outlined text-lg">delete</span>
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-12 px-6 text-center text-slate-400">
                                <span class="material-symbols-outlined text-4xl block mb-2 opacity-50">search_off</span>
                                <span class="text-sm font-medium">No blog categories found.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer Pagination -->
        @if($categories->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/20">
                {{ $categories->links() }}
            </div>
        @endif

    </div>

    <!-- Include Form and Delete Confirmation Modals -->
    @include('admin.blog.categorylist.form-modal')
    @include('admin.blog.categorylist.delete-modal')

</div>