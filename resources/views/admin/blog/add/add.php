<?php

use Livewire\Component;
use App\Models\Blog;
use App\Models\BlogCategory;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

new class extends Component
{
    use WithFileUploads;

    // Form inputs
    public $title = '';
    public $slug = '';
    public $content = '';
    public $banner_image;
    public $category_id = '';
    public $is_active = true;
    public $published_at = '';
    
    // SEO Inputs
    public $meta_title = '';
    public $meta_description = '';
    public $meta_keywords = '';

    // Auto-generate slug on updating title
    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    // Save Form (Create Blog)
    public function save()
    {
        $rules = [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug',
            'content' => 'required|string',
            'banner_image' => 'nullable|image|max:2048', // 2MB Max
            'category_id' => 'nullable|exists:blog_categories,id',
            'is_active' => 'boolean',
            'published_at' => 'nullable',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
        ];

        $this->validate($rules);

        $bannerPath = null;
        if ($this->banner_image) {
            $bannerPath = $this->banner_image->store('blogs', 'public');
        }

        Blog::create([
            'user_id' => auth()->id(),
            'category_id' => $this->category_id ?: null,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'banner_image' => $bannerPath,
            'meta_title' => $this->meta_title ?: null,
            'meta_description' => $this->meta_description ?: null,
            'meta_keywords' => $this->meta_keywords ?: null,
            'published_at' => $this->published_at ?: null,
            'is_active' => $this->is_active,
        ]);

        session()->flash('message', 'Blog created successfully!');

        return $this->redirect('/admin/blog', navigate: true);
    }

    public function render()
    {
        $categories = BlogCategory::where('status', true)->orderBy('name', 'asc')->get();

        return view('admin.blog.add.add', [
            'categories' => $categories,
        ])->layout('layouts.admin');
    }
};