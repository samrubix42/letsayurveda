<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Blog;
use App\Models\BlogCategory;

new class extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategory = null;

    protected $queryString = [
        'search' => ['except' => ''],
        'selectedCategory' => ['except' => null],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function selectCategory($slug)
    {
        $this->selectedCategory = $slug;
        $this->resetPage();
    }

    public function render()
    {
        $query = Blog::with(['category', 'user'])
            ->where('is_active', true)
            ->orderBy('published_at', 'desc');

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%' . $this->search . '%')
                  ->orWhere('content', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->selectedCategory) {
            $query->whereHas('category', function ($q) {
                $q->where('slug', $this->selectedCategory);
            });
        }

        // Get the featured post (latest post overall, ignoring current filters if we want a fixed hero, 
        // or just the first item matching the search query). 
        // Let's get the overall latest active post as featured, or the first post of the current query.
        // Getting the overall latest post as featured is highly elegant!
        $featuredPost = Blog::with(['category', 'user'])
            ->where('is_active', true)
            ->orderBy('published_at', 'desc')
            ->first();

        $blogs = $query->paginate(6);
        $categories = BlogCategory::where('status', true)->get();

        return view('pages.blogs.blogs', [
            'blogs' => $blogs,
            'categories' => $categories,
            'featuredPost' => $featuredPost,
        ]);
    }
};