<?php

use Livewire\Component;
use App\Models\BlogCategory;
use Livewire\WithPagination;
use Illuminate\Support\Str;

new class extends Component
{
    use WithPagination;

    // Search query
    public $search = '';

    // Form inputs
    public $categoryId = null;
    public $name = '';
    public $slug = '';
    public $status = true;

    // Mode
    public $isEditMode = false;

    // Deletion tracking
    public $deleteId = null;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Modal Trigger: Create Mode
    public function openCreateModal()
    {
        $this->resetErrorBag();
        $this->categoryId = null;
        $this->name = '';
        $this->slug = '';
        $this->status = true;
        $this->isEditMode = false;

        $this->dispatch('open-modal');
    }

    // Modal Trigger: Edit Mode
    public function openEditModal($id)
    {
        $this->resetErrorBag();
        $this->categoryId = $id;
        $this->isEditMode = true;

        $category = BlogCategory::findOrFail($id);
        $this->name = $category->name;
        $this->slug = $category->slug;
        $this->status = (bool) $category->status;

        $this->dispatch('open-modal');
    }

    // Slug generation reactive link
    public function updatedName($value)
    {
        if (!$this->isEditMode) {
            $this->slug = Str::slug($value);
        }
    }

    // Save Form (Create or Update)
    public function save()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blog_categories,slug,' . ($this->categoryId ?? 'NULL'),
            'status' => 'boolean',
        ];

        $this->validate($rules);

        if ($this->isEditMode) {
            $category = BlogCategory::findOrFail($this->categoryId);
            $category->update([
                'name' => $this->name,
                'slug' => $this->slug,
                'status' => $this->status,
            ]);
        } else {
            BlogCategory::create([
                'name' => $this->name,
                'slug' => $this->slug,
                'status' => $this->status,
            ]);
        }

        $this->dispatch('toast-show', [
            'message' => $this->categoryId ? 'Category updated successfully!' : 'Category created successfully!',
            'type' => 'success',
            'position' => 'top-right',
        ]);

        $this->dispatch('close-modal');
    }

    // Inline Status Toggle Action
    public function toggleStatus($id)
    {
        $category = BlogCategory::findOrFail($id);
        $category->status = !$category->status;
        $category->save();

        $this->dispatch('toast-show', [
            'message' => 'Category status updated successfully!',
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
    public function deleteCategory()
    {
        if ($this->deleteId) {
            $category = BlogCategory::findOrFail($this->deleteId);
            $category->delete();
            $this->deleteId = null;

            $this->dispatch('toast-show', [
                'message' => 'Category deleted successfully!',
                'type' => 'success',
                'position' => 'top-right',
            ]);
        }

        $this->dispatch('close-delete-modal');
    }

    public function render()
    {
        $categories = BlogCategory::where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.blog.categorylist.categorylist', [
            'categories' => $categories,
        ])->layout('layouts.admin');
    }
};