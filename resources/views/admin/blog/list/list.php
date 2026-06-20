<?php

use Livewire\Component;
use App\Models\Blog;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;

new #[Layout('layouts::admin')] class extends Component
{
    use WithPagination;

    // Search query
    public $search = '';

    // Deletion tracking
    public $deleteId = null;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Inline Active Status Toggle Action
    public function toggleStatus($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->is_active = !$blog->is_active;
        $blog->save();

        $this->dispatch('toast-show', [
            'message' => 'Blog status updated successfully!',
            'type' => 'success',
            'position' => 'top-right',
        ]);
    }

    // Delete Confirmation modal trigger
    public function confirmDelete($id)
    {
        $this->deleteId = $id;
        $this->dispatch('open-delete-modal');
    }

    // Delete Action
    public function deleteBlog()
    {
        if ($this->deleteId) {
            $blog = Blog::findOrFail($this->deleteId);
            
            // Delete banner image if it exists in storage
            if ($blog->banner_image) {
                Storage::disk('public')->delete($blog->banner_image);
            }
            
            $blog->delete();
            $this->deleteId = null;

            $this->dispatch('toast-show', [
                'message' => 'Blog deleted successfully!',
                'type' => 'success',
                'position' => 'top-right',
            ]);
        }

        $this->dispatch('close-delete-modal');
    }

    public function render()
    {
        $blogs = Blog::with('category')
            ->where(function($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                      ->orWhere('slug', 'like', '%' . $this->search . '%');
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.blog.list.list', [
            'blogs' => $blogs,
        ]);
    }
};