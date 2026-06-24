<div class="bg-background min-h-screen py-12">
    <div class="max-w-[960px] mx-auto px-margin-mobile md:px-margin-desktop">
        
        <!-- Back Navigation -->
        <div class="mb-10">
            <a 
                href="{{ route('blogs') }}" 
                class="inline-flex items-center gap-2 text-secondary hover:text-primary font-label-caps tracking-widest text-xs font-bold transition-all duration-300 group"
            >
                <span class="material-symbols-outlined text-sm group-hover:-translate-x-1 transition-transform">arrow_back</span>
                BACK TO CHRONICLES
            </a>
        </div>

        <!-- Article Header -->
        <article class="space-y-6">
            <div class="flex items-center gap-3">
                <span class="bg-secondary/15 text-secondary px-4 py-1.5 rounded-full text-[10px] font-label-caps font-bold uppercase shadow-sm">
                    {{ $blog->category->name ?? 'Wellness' }}
                </span>
                <span class="text-on-surface-variant/40 text-sm">•</span>
                <span class="text-xs text-on-surface-variant font-medium flex items-center gap-1">
                    <span class="material-symbols-outlined text-xs">schedule</span>
                    {{ max(1, ceil(str_word_count(strip_tags($blog->content)) / 200)) }} min read
                </span>
            </div>

            <h1 class="font-display-lg text-3xl sm:text-4xl lg:text-5xl text-primary font-bold leading-tight">
                {{ $blog->title }}
            </h1>

            <!-- Author & Date Details -->
            <div class="flex items-center gap-4 pt-4 border-b border-outline-variant/30 pb-6">
                <div class="w-12 h-12 rounded-full bg-primary-container text-white font-bold flex items-center justify-center text-lg shadow-inner">
                    {{ substr($blog->user->name ?? 'A', 0, 1) }}
                </div>
                <div class="flex flex-col text-left">
                    <span class="text-sm font-bold text-primary">{{ $blog->user->name ?? 'Ayurvedic Consultant' }}</span>
                    <span class="text-xs text-on-surface-variant font-medium flex items-center gap-1 mt-0.5">
                        <span class="material-symbols-outlined text-[10px]">calendar_today</span>
                        Published on {{ $blog->published_at ? $blog->published_at->format('F d, Y') : $blog->created_at->format('F d, Y') }}
                    </span>
                </div>
            </div>

            <!-- Banner Image -->
            <div class="my-8 aspect-[21/9] w-full rounded-3xl overflow-hidden shadow-sm border border-outline-variant/20 bg-surface-container">
                <img 
                    src="{{ $blog->banner_image ?? 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&q=80&w=1200' }}" 
                    alt="{{ $blog->title }}" 
                    class="w-full h-full object-cover"
                />
            </div>

            <!-- Article Content (Sleek custom typography styling) -->
            <div class="blog-rich-content text-on-surface-variant font-body-md text-base sm:text-lg leading-relaxed space-y-6 pt-4">
                {!! $blog->content !!}
            </div>

            <!-- Author Profile Card -->
            <div class="mt-16 bg-surface-container rounded-3xl p-8 border border-outline-variant/20 flex flex-col sm:flex-row gap-6 items-center sm:items-start text-center sm:text-left">
                <div class="w-20 h-20 rounded-full bg-primary-container text-white font-bold flex items-center justify-center text-3xl shrink-0 shadow-md">
                    {{ substr($blog->user->name ?? 'A', 0, 1) }}
                </div>
                <div class="space-y-3">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-2">
                        <h4 class="font-display-lg text-xl text-primary font-bold">{{ $blog->user->name ?? 'Ayurvedic Expert' }}</h4>
                        <span class="inline-block bg-primary/10 text-primary font-label-caps text-[9px] tracking-widest px-3 py-1 rounded-full font-bold">
                            CONTRIBUTING AUTHOR
                        </span>
                    </div>
                    <p class="text-sm text-on-surface-variant leading-relaxed">
                        Dedicated to sharing classical Ayurvedic practices adapted for contemporary lifestyles. Through clinical experience and diagnostic expertise, they write guides focused on restoring natural homeostasis and unlocking skin and hair vitality.
                    </p>
                </div>
            </div>

        </article>

        <!-- Divider -->
        <hr class="my-16 border-outline-variant/30" />

        <!-- Related Posts Section -->
        @if($relatedBlogs->isNotEmpty())
            <div class="space-y-8">
                <h3 class="font-display-lg text-2xl text-primary font-bold text-center sm:text-left">
                    Continue Your Wellness Journey
                </h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-8">
                    @foreach($relatedBlogs as $rBlog)
                        <div class="bg-surface rounded-2xl overflow-hidden border border-outline-variant/20 hover:shadow-md hover:-translate-y-1 transition-all duration-300 flex flex-col group">
                            <!-- Image -->
                            <a href="{{ route('blogs.view', $rBlog->slug) }}" class="relative aspect-[16/10] overflow-hidden block">
                                <img 
                                    src="{{ $rBlog->banner_image ?? 'https://images.unsplash.com/photo-1540555700478-4be289fbecef?auto=format&fit=crop&q=80&w=600' }}" 
                                    alt="{{ $rBlog->title }}" 
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                />
                            </a>
                            
                            <!-- Body -->
                            <div class="p-5 flex flex-col flex-grow">
                                <span class="font-label-caps text-[9px] tracking-widest text-secondary font-bold mb-2 uppercase block">
                                    {{ $rBlog->category->name ?? 'Wellness' }}
                                </span>
                                
                                <h4 class="font-headline-sm text-base text-primary font-bold mb-3 line-clamp-2 group-hover:text-secondary transition-colors">
                                    <a href="{{ route('blogs.view', $rBlog->slug) }}">{{ $rBlog->title }}</a>
                                </h4>
                                
                                <div class="mt-auto pt-3 border-t border-outline-variant/10 flex items-center justify-between text-[10px] text-on-surface-variant font-medium">
                                    <span>{{ $rBlog->published_at ? $rBlog->published_at->format('M d, Y') : $rBlog->created_at->format('M d, Y') }}</span>
                                    <a href="{{ route('blogs.view', $rBlog->slug) }}" class="text-secondary font-bold hover:text-primary transition-colors flex items-center gap-1 uppercase tracking-wider">
                                        READ
                                        <span class="material-symbols-outlined text-[10px]">arrow_forward</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>

<!-- Inline Custom CSS for Rich Content Rendering -->
<style>
    .blog-rich-content p {
        margin-bottom: 1.5rem;
        line-height: 1.85;
        color: var(--color-on-surface-variant);
    }
    .blog-rich-content h3 {
        font-family: "Playfair Display", serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--color-primary);
        margin-top: 2rem;
        margin-bottom: 1rem;
        line-height: 1.35;
    }
    .blog-rich-content blockquote {
        border-left: 4px solid var(--color-secondary);
        padding-left: 1.5rem;
        margin: 2rem 0;
        font-family: "Playfair Display", serif;
        font-style: italic;
        font-size: 1.15rem;
        color: var(--color-secondary);
        background-color: var(--color-surface-container-low);
        padding-top: 1rem;
        padding-bottom: 1rem;
        padding-right: 1.5rem;
        border-radius: 0 0.75rem 0.75rem 0;
    }
    .blog-rich-content ul {
        list-style-type: disc;
        padding-left: 1.5rem;
        margin-bottom: 1.5rem;
        space-y: 0.5rem;
    }
    .blog-rich-content ol {
        list-style-type: decimal;
        padding-left: 1.5rem;
        margin-bottom: 1.5rem;
        space-y: 0.5rem;
    }
    .blog-rich-content li {
        margin-bottom: 0.5rem;
        line-height: 1.7;
        color: var(--color-on-surface-variant);
    }
    .blog-rich-content strong {
        color: var(--color-primary);
        font-weight: 700;
    }
</style>