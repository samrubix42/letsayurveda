<div class="space-y-6 animate-fade-in-up">
    @if (session()->has('message'))
        <div x-data x-init="window.toast('{{ session('message') }}', { type: 'success', position: 'top-right' })"></div>
    @endif
    
    <!-- Header Title & Action -->
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
        <div>
            <h1 class="font-headline-sm text-3xl font-bold text-slate-800 tracking-tight">Blogs</h1>
            <p class="text-sm text-slate-500 mt-1">Manage and publish wellness articles and ayurvedic wisdom.</p>
        </div>
        <a href="/admin/blog/add" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs tracking-wider px-5 py-3 rounded-full hover:shadow-md active:scale-95 transition-all cursor-pointer">
            <span class="material-symbols-outlined text-sm">add</span>
            <span>WRITE NEW BLOG</span>
        </a>
    </div>

    <!-- Filter & Table Card -->
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">
        
        <!-- Filter Header -->
        <div class="p-6 border-b border-slate-100 bg-slate-50/50 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div class="flex items-center gap-2 w-full max-w-sm px-3.5 py-2.5 bg-white border border-slate-200 rounded-lg text-slate-400 focus-within:border-emerald-500 focus-within:ring-1 focus-within:ring-emerald-500/20 transition-all">
                <span class="material-symbols-outlined text-sm">search</span>
                <input wire:model.live="search" class="bg-transparent border-none text-xs outline-none text-slate-700 placeholder:text-slate-400 w-full focus:ring-0" placeholder="Search blogs by title or slug..." type="text"/>
            </div>
            <div class="text-xs text-slate-400 font-semibold">
                SHOWING {{ $blogs->count() }} OF {{ $blogs->total() }} RECORDS
            </div>
        </div>

        <!-- Responsive Table Container -->
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-400 font-label-caps text-[10px] tracking-widest border-b border-slate-100">
                        <th class="py-4 px-6 font-bold">Banner</th>
                        <th class="py-4 px-6 font-bold">Title</th>
                        <th class="py-4 px-6 font-bold">Category</th>
                        <th class="py-4 px-6 font-bold text-center">Status</th>
                        <th class="py-4 px-6 font-bold text-center">Publish Date</th>
                        <th class="py-4 px-6 font-bold text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100 text-sm">
                    @forelse($blogs as $blog)
                        <tr wire:key="blog-{{ $blog->id }}" class="hover:bg-slate-50/40 transition-colors">
                            
                            <!-- Banner Image Preview -->
                            <td class="py-4 px-6">
                                <div class="h-12 w-20 rounded-lg overflow-hidden bg-slate-100 border border-slate-200/60 flex items-center justify-center">
                                    @if($blog->banner_image)
                                        <img src="{{ asset('storage/' . $blog->banner_image) }}" alt="{{ $blog->title }}" class="h-full w-full object-cover">
                                    @else
                                        <span class="material-symbols-outlined text-slate-300 text-xl">image</span>
                                    @endif
                                </div>
                            </td>

                            <!-- Title & Slug -->
                            <td class="py-4 px-6 max-w-xs md:max-w-md">
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-800 line-clamp-1" title="{{ $blog->title }}">{{ $blog->title }}</span>
                                    <span class="text-slate-400 font-mono text-[11px] mt-0.5 line-clamp-1" title="{{ $blog->slug }}">{{ $blog->slug }}</span>
                                </div>
                            </td>

                            <!-- Category Badge -->
                            <td class="py-4 px-6">
                                @if($blog->category)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-50 text-emerald-800 border border-emerald-100">
                                        {{ $blog->category->name }}
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-slate-150 text-slate-500 border border-slate-200">
                                        Uncategorized
                                    </span>
                                @endif
                            </td>

                            <!-- Status Toggle Badge -->
                            <td class="py-4 px-6 text-center">
                                <button wire:click="toggleStatus({{ $blog->id }})" class="cursor-pointer active:scale-95 transition-transform inline-flex">
                                    @if($blog->is_active)
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

                            <!-- Publish Date -->
                            <td class="py-4 px-6 text-center text-slate-500 font-medium text-xs">
                                @if($blog->published_at)
                                    @if($blog->published_at->isFuture())
                                        <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded bg-amber-50 text-amber-700 border border-amber-200 font-semibold" title="Scheduled to publish">
                                            <span class="material-symbols-outlined text-xs">schedule</span>
                                            {{ $blog->published_at->format('d M Y H:i') }}
                                        </span>
                                    @else
                                        <span>{{ $blog->published_at->format('d M Y H:i') }}</span>
                                    @endif
                                @else
                                    <span class="text-slate-400 font-semibold italic">Draft</span>
                                @endif
                            </td>

                            <!-- Actions -->
                            <td class="py-4 px-6 text-right">
                                <div class="flex items-center justify-end gap-3">
                                    <a href="/admin/blog/edit/{{ $blog->id }}" class="text-slate-500 hover:text-emerald-600 p-1.5 rounded hover:bg-slate-100 transition-all cursor-pointer" title="Edit Blog">
                                        <span class="material-symbols-outlined text-lg">edit</span>
                                    </a>
                                    <button type="button" @click="$dispatch('open-delete-modal'); $wire.confirmDelete({{ $blog->id }})" 
                                            class="text-slate-500 hover:text-rose-600 p-1.5 rounded hover:bg-slate-100 transition-all cursor-pointer" 
                                            title="Delete Blog">
                                        <span class="material-symbols-outlined text-lg">delete</span>
                                    </button>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-12 px-6 text-center text-slate-400">
                                <span class="material-symbols-outlined text-4xl block mb-2 opacity-50">search_off</span>
                                <span class="text-sm font-medium">No blogs found.</span>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Table Footer Pagination -->
        @if($blogs->hasPages())
            <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/20">
                {{ $blogs->links() }}
            </div>
        @endif

    </div>

    <!-- Include Delete Confirmation Modal -->
    @include('admin.blog.list.delete-modal')

</div>