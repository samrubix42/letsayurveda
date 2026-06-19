<div class="space-y-6 animate-fade-in-up">
    
    <!-- Top Breadcrumb & Header -->
    <div class="flex flex-col gap-2">
        <a href="/admin/blog" class="inline-flex items-center gap-1.5 text-xs font-semibold text-slate-500 hover:text-emerald-700 transition-colors uppercase tracking-wider cursor-pointer" wire:navigate>
            <span class="material-symbols-outlined text-base">arrow_back</span>
            <span>Back to Blogs</span>
        </a>
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mt-2">
            <div>
                <h1 class="font-headline-sm text-3xl font-bold text-slate-800 tracking-tight">Edit Blog</h1>
                <p class="text-sm text-slate-500 mt-1">Update wellness article details, scheduling, and metadata.</p>
            </div>
        </div>
    </div>

    <!-- Edit Form -->
    <form wire:submit.prevent="save" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Side: Main Editor Details (2 Columns on Large Screens) -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 space-y-6">
                
                <!-- Blog Title -->
                <div>
                    <label for="title" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Blog Title</label>
                    <input id="title" wire:model.live.debounce.300ms="title" type="text" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 transition-all outline-none" placeholder="Enter a descriptive title..."/>
                    @error('title') <span class="text-rose-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>

                <!-- Slug & Category Row -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Slug -->
                    <div>
                        <label for="slug" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Slug (URL Path)</label>
                        <input id="slug" wire:model.live="slug" type="text" class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl text-sm text-slate-700 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 transition-all outline-none font-mono" placeholder="auto-generated-slug-path"/>
                        @error('slug') <span class="text-rose-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>

                    <!-- Category Select -->
                    <div>
                        <label for="category_id" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Category</label>
                        <select id="category_id" wire:model.live="category_id" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 transition-all outline-none cursor-pointer">
                            <option value="">Select Category (Optional)</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-rose-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                    </div>
                </div>

                <!-- Content Area (TinyMCE) -->
                <div>
                    <label class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Blog Content</label>
                    <div wire:ignore class="rounded-xl border border-slate-200 overflow-hidden" x-data="{
                        value: @entangle('content'),
                        initTinyMCE() {
                            tinymce.init({
                                target: this.$refs.editor,
                                height: 500,
                                menubar: false,
                                plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                                toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
                                setup: (editor) => {
                                    editor.on('change', () => {
                                        this.value = editor.getContent();
                                    });
                                    editor.on('init', () => {
                                        editor.setContent(this.value || '');
                                    });
                                    this.$watch('value', (newValue) => {
                                        if (newValue !== editor.getContent()) {
                                            editor.setContent(newValue || '');
                                        }
                                    });
                                }
                            });
                        }
                    }" x-init="initTinyMCE()">
                        <textarea x-ref="editor"></textarea>
                    </div>
                    @error('content') <span class="text-rose-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>

            </div>
        </div>

        <!-- Right Side: Sidebar Controls (1 Column) -->
        <div class="space-y-6">
            
            <!-- Publish Actions Card -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 space-y-5">
                <h3 class="text-sm font-bold text-slate-800 border-b border-slate-100 pb-3 uppercase tracking-wider">Publish Controls</h3>
                
                <!-- Status Toggle -->
                <div class="flex items-center justify-between">
                    <div>
                        <span class="block text-xs font-bold text-slate-700 uppercase tracking-wider">Active Status</span>
                        <span class="text-xs text-slate-400">Controls visibility on the website</span>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer select-none">
                        <input type="checkbox" wire:model.live="is_active" class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-slate-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-emerald-600"></div>
                    </label>
                </div>

                <!-- Published At Date-time -->
                <div>
                    <label for="published_at" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Publish Date & Time</label>
                    <input id="published_at" wire:model.live="published_at" type="datetime-local" class="w-full px-4 py-3 bg-white border border-slate-200 rounded-xl text-sm text-slate-800 outline-none focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 transition-all cursor-pointer"/>
                    <span class="text-[10px] text-slate-400 mt-1 block leading-normal">Leave blank to keep as an unpublished Draft, or select a future time to schedule.</span>
                    @error('published_at') <span class="text-rose-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>

                <!-- Form Action Buttons -->
                <div class="pt-3 flex flex-col gap-2.5">
                    <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs tracking-wider py-3.5 rounded-full hover:shadow-md active:scale-95 transition-all cursor-pointer flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-sm">save</span>
                        <span>SAVE CHANGES</span>
                    </button>
                    <a href="/admin/blog" class="w-full bg-slate-100 hover:bg-slate-200 text-slate-700 font-semibold text-xs tracking-wider py-3.5 rounded-full active:scale-95 transition-all cursor-pointer flex items-center justify-center" wire:navigate>
                        CANCEL
                    </a>
                </div>
            </div>

            <!-- Banner Image Uploader Card -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 space-y-4">
                <h3 class="text-sm font-bold text-slate-800 border-b border-slate-100 pb-3 uppercase tracking-wider">Banner Image</h3>
                
                <div class="space-y-3">
                    <div class="relative w-full h-44 rounded-xl border-2 border-dashed border-slate-200 hover:border-emerald-500 transition-colors bg-slate-50/50 flex flex-col items-center justify-center overflow-hidden group">
                        
                        @if ($banner_image)
                            <img src="{{ $banner_image->temporaryUrl() }}" class="w-full h-full object-cover">
                            <!-- Overlay to remove or change -->
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="text-white text-xs font-semibold bg-slate-900/60 px-3 py-1.5 rounded-full">Change Image</span>
                            </div>
                        @elseif ($existing_banner)
                            <img src="{{ asset('storage/' . $existing_banner) }}" class="w-full h-full object-cover">
                            <!-- Overlay to remove or change -->
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="text-white text-xs font-semibold bg-slate-900/60 px-3 py-1.5 rounded-full">Change Image</span>
                            </div>
                        @else
                            <div class="text-center p-4">
                                <span class="material-symbols-outlined text-slate-400 text-3xl">add_photo_alternate</span>
                                <p class="text-xs text-slate-500 font-semibold mt-1">Upload Banner Image</p>
                                <p class="text-[10px] text-slate-400 mt-0.5">PNG, JPG up to 2MB</p>
                            </div>
                        @endif

                        <!-- Input File Field overlaying full block -->
                        <input type="file" wire:model="banner_image" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full" accept="image/*"/>
                    </div>

                    <!-- File Uploading State Indicator -->
                    <div wire:loading wire:target="banner_image" class="flex items-center gap-2 text-xs text-emerald-600 font-medium">
                        <span class="animate-spin inline-block h-3.5 w-3.5 border-2 border-emerald-600 border-t-transparent rounded-full"></span>
                        Uploading image...
                    </div>

                    @error('banner_image') <span class="text-rose-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- SEO Metadata Card -->
            <div class="bg-white border border-slate-200 rounded-2xl shadow-sm p-6 space-y-4">
                <h3 class="text-sm font-bold text-slate-800 border-b border-slate-100 pb-3 uppercase tracking-wider font-semibold">SEO Optimization</h3>
                
                <!-- Meta Title -->
                <div>
                    <label for="meta_title" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Meta Title</label>
                    <input id="meta_title" wire:model.live="meta_title" type="text" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-xs text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 transition-all outline-none" placeholder="Enter SEO Meta Title..."/>
                    @error('meta_title') <span class="text-rose-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>

                <!-- Meta Description -->
                <div>
                    <label for="meta_description" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Meta Description</label>
                    <textarea id="meta_description" wire:model.live="meta_description" rows="3" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-xs text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 transition-all outline-none resize-none" placeholder="Enter brief search snippet description..."></textarea>
                    @error('meta_description') <span class="text-rose-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>

                <!-- Meta Keywords -->
                <div>
                    <label for="meta_keywords" class="block text-xs font-semibold uppercase tracking-wider text-slate-500 mb-2">Meta Keywords</label>
                    <input id="meta_keywords" wire:model.live="meta_keywords" type="text" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl text-xs text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/10 transition-all outline-none" placeholder="comma, separated, terms"/>
                    @error('meta_keywords') <span class="text-rose-500 text-xs mt-1 block font-medium">{{ $message }}</span> @enderror
                </div>
            </div>

        </div>

    </form>

</div>