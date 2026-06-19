<?php

use Livewire\Component;
use App\Models\Blog;
use App\Models\BlogCategory;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

new class extends Component
{
    use WithFileUploads;

    // Blog identifier
    public $blogId;

    // Form inputs
    public $title = '';
    public $slug = '';
    public $content = '';
    public $banner_image;
    public $existing_banner = null;
    public $category_id = '';
    public $is_active = true;
    public $published_at = '';
    
    // SEO Inputs
    public $meta_title = '';
    public $meta_description = '';
    public $meta_keywords = '';

    public function mount($id)
    {
        $blog = Blog::findOrFail($id);
        $this->blogId = $blog->id;
        $this->title = $blog->title;
        $this->slug = $blog->slug;
        $this->content = $blog->content;
        $this->existing_banner = $blog->banner_image;
        $this->category_id = $blog->category_id ?? '';
        $this->is_active = (bool) $blog->is_active;
        $this->published_at = $blog->published_at ? $blog->published_at->format('Y-m-d\TH:i') : '';
        
        $this->meta_title = $blog->meta_title ?? '';
        $this->meta_description = $blog->meta_description ?? '';
        $this->meta_keywords = $blog->meta_keywords ?? '';
    }

    // Auto-generate slug on updating title
    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    // Save Form (Update Blog)
    public function save()
    {
        $rules = [
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $this->blogId,
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

        $blog = Blog::findOrFail($this->blogId);
        $bannerPath = $blog->banner_image;

        if ($this->banner_image) {
            // Delete old banner if it exists
            if ($blog->banner_image) {
                Storage::disk('public')->delete($blog->banner_image);
            }
            $bannerPath = $this->banner_image->store('blogs', 'public');
        }

        $blog->update([
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

        session()->flash('message', 'Blog updated successfully!');

        return $this->redirect('/admin/blog', navigate: true);
    }

    public function render()
    {
        $categories = BlogCategory::where('status', true)->orderBy('name', 'asc')->get();

        return view('admin.blog.update.update', [
            'categories' => $categories,
        ])->layout('layouts.admin');
    }
};