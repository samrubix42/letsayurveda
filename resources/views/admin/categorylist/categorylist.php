<?php

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;

new #[Layout('layouts::admin')] class extends Component
{
    use WithPagination, WithFileUploads;

    // Search query
    public $search = '';

    // Form inputs
    public $categoryId = null;
    public $name = '';
    public $parent_id = '';
    public $slug = '';
    public $image; // Uploaded file
    public $existingImage = null; // Existing image path
    public $is_active = true;

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
        $this->parent_id = '';
        $this->slug = '';
        $this->image = null;
        $this->existingImage = null;
        $this->is_active = true;
        $this->isEditMode = false;

        $this->dispatch('open-modal');
    }

    // Modal Trigger: Edit Mode
    public function openEditModal($id)
    {
        $this->resetErrorBag();
        $this->categoryId = $id;
        $this->isEditMode = true;

        $category = Category::findOrFail($id);
        $this->name = $category->name;
        $this->parent_id = $category->parent_id ?? '';
        $this->slug = $category->slug;
        $this->existingImage = $category->image;
        $this->image = null;
        $this->is_active = (bool) $category->is_active;

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
            'slug' => 'required|string|max:255|unique:categories,slug,' . ($this->categoryId ?? 'NULL'),
            'parent_id' => 'nullable|exists:categories,id',
            'image' => 'nullable|image|max:2048', // 2MB max
            'is_active' => 'boolean',
        ];

        // Ensure parent_id is not the same as categoryId
        if ($this->categoryId && $this->parent_id == $this->categoryId) {
            $this->addError('parent_id', 'A category cannot be its own parent.');
            return;
        }

        $this->validate($rules);

        $imagePath = $this->existingImage;
        if ($this->image) {
            $imagePath = $this->image->store('categories', 'public');
        }

        if ($this->isEditMode) {
            $category = Category::findOrFail($this->categoryId);
            $category->update([
                'name' => $this->name,
                'parent_id' => $this->parent_id ?: null,
                'slug' => $this->slug,
                'image' => $imagePath,
                'is_active' => $this->is_active,
            ]);
        } else {
            Category::create([
                'name' => $this->name,
                'parent_id' => $this->parent_id ?: null,
                'slug' => $this->slug,
                'image' => $imagePath,
                'is_active' => $this->is_active,
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
        $category = Category::findOrFail($id);
        $category->is_active = !$category->is_active;
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
            $category = Category::findOrFail($this->deleteId);
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
        $categories = Category::with('parent')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        // Get all potential parent categories (exclude current category to avoid circular references)
        $parentCategories = Category::orderBy('name', 'asc')
            ->when($this->categoryId, function ($query) {
                $query->where('id', '!=', $this->categoryId);
            })
            ->get();

        return view('admin.categorylist.categorylist', [
            'categories' => $categories,
            'parentCategories' => $parentCategories,
        ]);
    }
};