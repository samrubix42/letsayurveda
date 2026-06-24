<div class="bg-background min-h-screen py-10">
    <div class="max-w-[1440px] mx-auto px-margin-mobile md:px-margin-desktop">
        
        <!-- Header Banner Section -->
        <div class="text-center max-w-3xl mx-auto mb-16 animate-fade-in-up">
            <span class="font-label-caps text-xs text-secondary font-bold tracking-widest uppercase mb-3 block">THE AYURVEDA CHRONICLES</span>
            <h1 class="font-display-lg text-4xl md:text-5xl lg:text-6xl text-primary font-bold leading-tight mb-4">
                Timeless Wisdom for Modern Balanced Living
            </h1>
            <p class="font-body-lg text-base md:text-lg text-on-surface-variant leading-relaxed">
                Explore holistic self-care, herbal bio-actives, wellness journals, and organic dietary guides compiled by our certified Ayurvedic doctors.
            </p>
        </div>

        <!-- Search and Filter Bar -->
        <div class="flex flex-col md:flex-row gap-6 justify-between items-center mb-12 border-b border-outline-variant/30 pb-8">
            <!-- Categories Pills -->
            <div class="flex gap-2 overflow-x-auto w-full md:w-auto no-scrollbar pb-2 md:pb-0 scroll-smooth">
                <button 
                    wire:click="selectCategory(null)" 
                    class="px-5 py-2.5 rounded-full font-label-caps text-xs tracking-wider font-bold transition-all duration-300 whitespace-nowrap cursor-pointer active:scale-95 {{ is_null($selectedCategory) ? 'bg-primary text-white shadow-md' : 'bg-surface-container hover:bg-surface-container-high text-on-surface-variant' }}"
                >
                    ALL ARTICLES
                </button>
                @foreach($categories as $category)
                    <button 
                        wire:click="selectCategory('{{ $category->slug }}')" 
                        class="px-5 py-2.5 rounded-full font-label-caps text-xs tracking-wider font-bold transition-all duration-300 whitespace-nowrap cursor-pointer active:scale-95 {{ $selectedCategory === $category->slug ? 'bg-primary text-white shadow-md' : 'bg-surface-container hover:bg-surface-container-high text-on-surface-variant' }}"
                    >
                        {{ strtoupper($category->name) }}
                    </button>
                @endforeach
            </div>

            <!-- Search Field -->
            <div class="relative w-full md:w-80">
                <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant text-xl">search</span>
                <input 
                    wire:model.live.debounce.300ms="search" 
                    type="text" 
                    placeholder="Search articles..." 
                    class="w-full pl-12 pr-4 py-3 bg-surface border border-outline-variant/50 focus:border-primary rounded-full font-body-md text-sm text-on-surface outline-none transition-all placeholder:text-on-surface-variant/60"
                />
            </div>
        </div>

        <!-- Active Filters Alert -->
        @if($search || $selectedCategory)
            <div class="mb-8 flex items-center justify-between bg-surface-container-low px-6 py-3 rounded-2xl border border-outline-variant/20">
                <div class="flex items-center gap-2 text-sm text-on-surface-variant font-body-md">
                    <span>Showing results for:</span>
                    @if($selectedCategory)
                        <span class="bg-secondary/15 text-secondary font-bold px-3 py-1 rounded-full text-xs">
                            Category: {{ ucwords(str_replace('-', ' ', $selectedCategory)) }}
                        </span>
                    @endif
                    @if($search)
                        <span class="bg-primary/10 text-primary font-bold px-3 py-1 rounded-full text-xs">
                            Search: "{{ $search }}"
                        </span>
                    @endif
                </div>
                <button 
                    wire:click="$set('selectedCategory', null); $set('search', '')" 
                    class="text-xs font-label-caps tracking-widest text-secondary hover:text-primary transition-colors font-bold cursor-pointer"
                >
                    CLEAR ALL
                </button>
            </div>
        @endif

        <!-- Featured Post Section (Only shown if page = 1 and no search query active, or just if featuredPost exists) -->
        @if($featuredPost && !$search && !$selectedCategory && $blogs->currentPage() === 1)
            <div class="mb-16">
                <div class="grid grid-cols-1 lg:grid-cols-12 bg-surface-container rounded-3xl overflow-hidden shadow-sm border border-outline-variant/20 hover:shadow-md transition-shadow duration-500">
                    <!-- Featured Image -->
                    <div class="lg:col-span-7 relative h-72 sm:h-96 lg:h-auto overflow-hidden group">
                        <img 
                            src="{{ $featuredPost->banner_image ?? 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&q=80&w=1200' }}" 
                            alt="{{ $featuredPost->title }}" 
                            class="absolute inset-0 w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-700 ease-out"
                        />
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent"></div>
                        <div class="absolute top-6 left-6 bg-secondary text-white font-label-caps text-[10px] tracking-widest font-bold px-4 py-1.5 rounded-full shadow-md">
                            FEATURED READING
                        </div>
                    </div>
                    
                    <!-- Featured Details -->
                    <div class="lg:col-span-5 flex flex-col justify-between p-8 sm:p-12 lg:p-16">
                        <div class="space-y-4">
                            <span class="font-label-caps text-xs text-secondary font-bold tracking-widest uppercase">
                                {{ $featuredPost->category->name ?? 'Ayurveda' }}
                            </span>
                            <h2 class="font-display-lg text-2xl sm:text-3xl text-primary font-bold leading-tight hover:text-secondary transition-colors duration-300">
                                <a href="{{ route('blogs.view', $featuredPost->slug) }}">{{ $featuredPost->title }}</a>
                            </h2>
                            <p class="font-body-md text-sm sm:text-base text-on-surface-variant leading-relaxed">
                                {{ Str::limit(strip_tags($featuredPost->content), 180) }}
                            </p>
                        </div>

                        <div class="mt-8 pt-8 border-t border-outline-variant/30 flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-primary-container text-white font-bold flex items-center justify-center text-sm shadow-inner">
                                    {{ substr($featuredPost->user->name ?? 'A', 0, 1) }}
                                </div>
                                <div class="flex flex-col text-left">
                                    <span class="text-xs font-bold text-primary">{{ $featuredPost->user->name ?? 'Ayurvedic Specialist' }}</span>
                                    <span class="text-[10px] text-on-surface-variant font-medium">
                                        {{ $featuredPost->published_at ? $featuredPost->published_at->format('M d, Y') : $featuredPost->created_at->format('M d, Y') }}
                                    </span>
                                </div>
                            </div>
                            <a 
                                href="{{ route('blogs.view', $featuredPost->slug) }}" 
                                class="inline-flex items-center gap-2 bg-primary hover:bg-primary-container text-white px-5 py-3 rounded-full font-label-caps tracking-widest text-[10px] transition-all hover:translate-x-1 duration-300 shadow-sm"
                            >
                                READ ARTICLE
                                <span class="material-symbols-outlined text-sm">arrow_forward</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Blog Cards Grid -->
        @if($blogs->isEmpty())
            <div class="text-center py-20 bg-surface-container rounded-3xl border border-outline-variant/20 max-w-xl mx-auto">
                <span class="material-symbols-outlined text-5xl text-outline mb-4">search_off</span>
                <h3 class="font-headline-sm text-xl text-primary font-bold">No articles found</h3>
                <p class="font-body-md text-sm text-on-surface-variant mt-2 max-w-sm mx-auto">
                    We couldn't find any articles matching your filters. Try clearing your search query or choosing another category.
                </p>
                <button 
                    wire:click="$set('selectedCategory', null); $set('search', '')" 
                    class="mt-6 bg-primary hover:bg-primary-container text-white px-6 py-3 rounded-full font-label-caps tracking-widest text-xs font-bold transition-all active:scale-95 cursor-pointer"
                >
                    RESET ALL FILTERS
                </button>
            </div>
        @else
            <div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($blogs as $blog)
                        <div class="bg-surface rounded-2xl overflow-hidden shadow-sm border border-outline-variant/20 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                            <!-- Card Image -->
                            <a href="{{ route('blogs.view', $blog->slug) }}" class="relative aspect-[16/10] overflow-hidden block">
                                <img 
                                    src="{{ $blog->banner_image ?? 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&q=80&w=800' }}" 
                                    alt="{{ $blog->title }}" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                />
                                <div class="absolute top-4 left-4 bg-surface-container-low/95 backdrop-blur-sm text-secondary px-3.5 py-1 rounded-full text-[10px] font-label-caps font-bold shadow-sm">
                                    {{ $blog->category->name ?? 'Wellness' }}
                                </div>
                            </a>
                            
                            <!-- Card Details -->
                            <div class="p-6 flex flex-col flex-grow">
                                <div class="flex items-center gap-2 text-on-surface-variant text-[11px] font-medium mb-3">
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">calendar_today</span>
                                        {{ $blog->published_at ? $blog->published_at->format('M d, Y') : $blog->created_at->format('M d, Y') }}
                                    </span>
                                    <span>•</span>
                                    <span class="flex items-center gap-1">
                                        <span class="material-symbols-outlined text-xs">schedule</span>
                                        {{ max(1, ceil(str_word_count(strip_tags($blog->content)) / 200)) }} min read
                                    </span>
                                </div>

                                <h3 class="font-headline-sm text-lg text-primary font-bold mb-3 group-hover:text-secondary transition-colors">
                                    <a href="{{ route('blogs.view', $blog->slug) }}">{{ $blog->title }}</a>
                                </h3>

                                <p class="text-sm text-on-surface-variant leading-relaxed mb-6 flex-grow">
                                    {{ Str::limit(strip_tags($blog->content), 110) }}
                                </p>

                                <div class="mt-auto pt-4 border-t border-outline-variant/30 flex items-center justify-between">
                                    <span class="text-xs font-bold text-primary flex items-center gap-2">
                                        <span class="w-6 h-6 rounded-full bg-primary-container text-white font-bold flex items-center justify-center text-[10px] shadow-inner">
                                            {{ substr($blog->user->name ?? 'A', 0, 1) }}
                                        </span>
                                        {{ $blog->user->name ?? 'AyurDoctor' }}
                                    </span>
                                    <a 
                                        href="{{ route('blogs.view', $blog->slug) }}" 
                                        class="inline-flex items-center gap-1.5 text-secondary font-label-caps tracking-widest text-[10px] font-bold group-hover:text-primary transition-colors"
                                    >
                                        READ ARTICLE
                                        <span class="material-symbols-outlined text-xs group-hover:translate-x-0.5 transition-transform">arrow_forward</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination Links -->
                <div class="mt-16 flex justify-center">
                    {{ $blogs->links() }}
                </div>
            </div>
        @endif

        <!-- Newsletter Subscription Box -->
        <div class="mt-24 bg-primary-container text-white rounded-3xl p-8 md:p-16 shadow-lg relative overflow-hidden text-center max-w-4xl mx-auto">
            <div class="absolute -right-24 -bottom-24 w-80 h-80 rounded-full border border-white/10 opacity-30"></div>
            <div class="absolute -left-24 -top-24 w-80 h-80 rounded-full border border-white/10 opacity-30"></div>
            
            <div class="relative z-10 max-w-xl mx-auto">
                <span class="material-symbols-outlined text-4xl text-secondary mb-4 animate-float">mail</span>
                <h3 class="font-display-lg text-2xl md:text-3xl text-white font-bold mb-4">Subscribe to Ayurveda Insights</h3>
                <p class="font-body-md text-sm text-white/80 mb-8 leading-relaxed">
                    Receive weekly handpicked wellness articles, organic diet plans, dosha balancing guidance, and exclusive early access to botanical skincare formulations.
                </p>
                <form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto" onsubmit="event.preventDefault(); alert('Thank you for subscribing!');">
                    <input 
                        type="email" 
                        required 
                        placeholder="Enter your email address" 
                        class="flex-grow bg-white/10 border border-white/20 focus:border-white focus:bg-white/20 rounded-full px-5 py-3.5 text-sm text-white outline-none placeholder:text-white/60 transition-all"
                    />
                    <button 
                        type="submit" 
                        class="bg-secondary hover:bg-secondary/90 text-white font-label-caps text-xs tracking-widest px-8 py-3.5 rounded-full font-bold shadow-md hover:shadow-lg transition-all active:scale-95 whitespace-nowrap cursor-pointer"
                    >
                        SUBSCRIBE
                    </button>
                </form>
                <p class="text-[10px] text-white/50 mt-4 italic">No spam. Unsubscribe anytime.</p>
            </div>
        </div>

    </div>
</div>