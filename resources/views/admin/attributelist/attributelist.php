<?php

use Livewire\Component;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;

new #[Layout('layouts::admin')] class extends Component
{
    use WithPagination;

    // Search query
    public $search = '';

    // Form inputs
    public $attributeId = null;
    public $name = '';
    public $slug = '';
    public $status = true;

    // Attribute Values Management
    public array $attributeValues = []; // Array of ['id' => null/int, 'value' => string]
    public string $newValue = '';

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
        $this->attributeId = null;
        $this->name = '';
        $this->slug = '';
        $this->status = true;
        $this->attributeValues = [];
        $this->newValue = '';
        $this->isEditMode = false;

        $this->dispatch('open-modal');
    }

    // Modal Trigger: Edit Mode
    public function openEditModal($id)
    {
        $this->resetErrorBag();
        $this->attributeId = $id;
        $this->isEditMode = true;

        $attribute = Attribute::with('values')->findOrFail($id);
        $this->name = $attribute->name;
        $this->slug = $attribute->slug;
        $this->status = (bool) $attribute->status;
        $this->newValue = '';

        // Load existing values
        $this->attributeValues = $attribute->values->map(function ($val) {
            return [
                'id' => $val->id,
                'value' => $val->value,
            ];
        })->toArray();

        $this->dispatch('open-modal');
    }

    // Slug generation reactive link
    public function updatedName($value)
    {
        if (!$this->isEditMode) {
            $this->slug = Str::slug($value);
        }
    }

    // Add Value to list
    public function addAttributeValue()
    {
        $this->newValue = trim($this->newValue);
        if (empty($this->newValue)) {
            $this->addError('newValue', 'Value cannot be empty.');
            return;
        }

        // Check if value already exists in the list
        foreach ($this->attributeValues as $val) {
            if (strtolower($val['value']) === strtolower($this->newValue)) {
                $this->addError('newValue', 'This value is already in the list.');
                return;
            }
        }

        $this->attributeValues[] = [
            'id' => null,
            'value' => $this->newValue,
        ];

        $this->newValue = '';
        $this->resetErrorBag('newValue');
    }

    // Remove Value from list
    public function removeAttributeValue($index)
    {
        if (isset($this->attributeValues[$index])) {
            array_splice($this->attributeValues, $index, 1);
        }
    }

    // Save Form (Create or Update)
    public function save()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:attributes,slug,' . ($this->attributeId ?? 'NULL'),
            'status' => 'boolean',
            'attributeValues' => 'required|array|min:1',
            'attributeValues.*.value' => 'required|string|max:255',
        ];

        $this->validate($rules, [
            'attributeValues.required' => 'At least one attribute value is required.',
            'attributeValues.*.value.required' => 'Value name is required.',
        ]);

        if ($this->isEditMode) {
            $attribute = Attribute::findOrFail($this->attributeId);
            $attribute->update([
                'name' => $this->name,
                'slug' => $this->slug,
                'status' => $this->status,
            ]);
        } else {
            $attribute = Attribute::create([
                'name' => $this->name,
                'slug' => $this->slug,
                'status' => $this->status,
            ]);
        }

        // Sync values
        $incomingIds = [];
        foreach ($this->attributeValues as $val) {
            $valSlug = Str::slug($val['value']);

            if (isset($val['id']) && $val['id']) {
                $attrVal = AttributeValue::findOrFail($val['id']);
                $attrVal->update([
                    'value' => $val['value'],
                    'slug' => $valSlug,
                ]);
                $incomingIds[] = $attrVal->id;
            } else {
                // If it already existed but was soft-deleted, restore and update it.
                $existing = AttributeValue::withTrashed()
                    ->where('attribute_id', $attribute->id)
                    ->where('slug', $valSlug)
                    ->first();

                if ($existing) {
                    $existing->restore();
                    $existing->update([
                        'value' => $val['value'],
                    ]);
                    $incomingIds[] = $existing->id;
                } else {
                    $newVal = $attribute->values()->create([
                        'value' => $val['value'],
                        'slug' => $valSlug,
                    ]);
                    $incomingIds[] = $newVal->id;
                }
            }
        }

        // Delete any values that were not in the incoming list
        $attribute->values()->whereNotIn('id', $incomingIds)->delete();

        $this->dispatch('toast-show', [
            'message' => $this->attributeId ? 'Attribute updated successfully!' : 'Attribute created successfully!',
            'type' => 'success',
            'position' => 'top-right',
        ]);

        $this->dispatch('close-modal');
    }

    // Inline Status Toggle Action
    public function toggleStatus($id)
    {
        $attribute = Attribute::findOrFail($id);
        $attribute->status = !$attribute->status;
        $attribute->save();

        $this->dispatch('toast-show', [
            'message' => 'Attribute status updated successfully!',
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
    public function deleteAttribute()
    {
        if ($this->deleteId) {
            $attribute = Attribute::findOrFail($this->deleteId);
            $attribute->values()->delete();
            $attribute->delete();
            $this->deleteId = null;

            $this->dispatch('toast-show', [
                'message' => 'Attribute deleted successfully!',
                'type' => 'success',
                'position' => 'top-right',
            ]);
        }

        $this->dispatch('close-delete-modal');
    }

    public function render()
    {
        $allAttributes = Attribute::with('values')
            ->where('name', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('admin.attributelist.attributelist', [
            'allAttributes' => $allAttributes,
        ]);
    }
};
