<?php

use Livewire\Component;
use App\Models\BlogCategory;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

new class extends Component
{
    use WithPagination;
    use WithFileUploads;

    // Search query
    public $search = '';

    // Form inputs
    public $categoryId = null;
    public $name = '';
    public $slug = '';
    public $image = '';
    public $imageFile = null;
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
        $this->image = '';
        $this->imageFile = null;
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
        $this->image = $category->image;
        $this->imageFile = null;
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

        if ($this->imageFile) {
            $rules['imageFile'] = 'image|max:1024';
        }

        $this->validate($rules);

        $imagePath = $this->image;
        if ($this->imageFile) {
            $imagePath = '/storage/' . $this->imageFile->store('blog-categories', 'public');
        }

        if ($this->isEditMode) {
            $category = BlogCategory::findOrFail($this->categoryId);
            $category->update([
                'name' => $this->name,
                'slug' => $this->slug,
                'image' => $imagePath,
                'status' => $this->status,
            ]);
            session()->flash('message', 'Category updated successfully.');
        } else {
            BlogCategory::create([
                'name' => $this->name,
                'slug' => $this->slug,
                'image' => $imagePath,
                'status' => $this->status,
            ]);
            session()->flash('message', 'Category created successfully.');
        }

        $this->imageFile = null;
        $this->dispatch('close-modal');
    }

    // Inline Status Toggle Action
    public function toggleStatus($id)
    {
        $category = BlogCategory::findOrFail($id);
        $category->status = !$category->status;
        $category->save();

        session()->flash('message', 'Category status updated successfully.');
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

            session()->flash('message', 'Category deleted successfully.');
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