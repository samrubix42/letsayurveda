<?php

use Livewire\Component;
use App\Models\Blog;

new class extends Component
{
    public $blog;
    public $relatedBlogs;

    public function mount($slug)
    {
        $this->blog = Blog::with(['category', 'user'])
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Fetch related blogs from the same category
        $this->relatedBlogs = Blog::with(['category'])
            ->where('is_active', true)
            ->where('category_id', $this->blog->category_id)
            ->where('id', '!=', $this->blog->id)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        // If fewer than 3 related blogs exist in this category, fill with other recent blogs
        if ($this->relatedBlogs->count() < 3) {
            $existingIds = $this->relatedBlogs->pluck('id')->push($this->blog->id)->toArray();
            
            $filler = Blog::with(['category'])
                ->where('is_active', true)
                ->whereNotIn('id', $existingIds)
                ->orderBy('published_at', 'desc')
                ->take(3 - $this->relatedBlogs->count())
                ->get();

            $this->relatedBlogs = $this->relatedBlogs->merge($filler);
        }
    }

    public function render()
    {
        return view('pages.blog-view.blog-view')
            ->layout('layouts::app', [
                'title' => $this->blog->meta_title ?? $this->blog->title,
                'description' => $this->blog->meta_description,
                'keywords' => $this->blog->meta_keywords,
            ]);
    }
};