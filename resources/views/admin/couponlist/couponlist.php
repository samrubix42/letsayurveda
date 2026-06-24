<?php

use Livewire\Component;
use App\Models\Coupon;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

new #[Layout('layouts::admin')] class extends Component
{
    use WithPagination;

    // Search query
    public $search = '';

    // Form inputs
    public ?int $couponId = null;
    public string $code = '';
    public string $type = 'percentage';
    public $value = '';
    public $minSpend = '';
    public $limitPerCoupon = '';
    public $limitPerUser = '';
    public $startDate = '';
    public $expiryDate = '';
    public bool $isActive = true;

    // Mode
    public $isEditMode = false;

    // Deletion tracking
    public ?int $deleteId = null;

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
        $this->couponId = null;
        $this->code = '';
        $this->type = 'percentage';
        $this->value = '';
        $this->minSpend = '';
        $this->limitPerCoupon = '';
        $this->limitPerUser = '';
        $this->startDate = '';
        $this->expiryDate = '';
        $this->isActive = true;
        $this->isEditMode = false;

        $this->dispatch('open-modal');
    }

    // Modal Trigger: Edit Mode
    public function openEditModal($id)
    {
        $this->resetErrorBag();
        $this->couponId = $id;
        $this->isEditMode = true;

        $coupon = Coupon::findOrFail($id);
        $this->code = $coupon->code;
        $this->type = $coupon->type;
        $this->value = $coupon->value;
        $this->minSpend = $coupon->min_spend ?? '';
        $this->limitPerCoupon = $coupon->limit_per_coupon ?? '';
        $this->limitPerUser = $coupon->limit_per_user ?? '';
        $this->startDate = $coupon->start_date ? $coupon->start_date->format('Y-m-d\TH:i') : '';
        $this->expiryDate = $coupon->expiry_date ? $coupon->expiry_date->format('Y-m-d\TH:i') : '';
        $this->isActive = (bool) $coupon->is_active;

        $this->dispatch('open-modal');
    }

    // Save Coupon (Create or Update)
    public function save()
    {
        $this->code = strtoupper(trim($this->code));

        $rules = [
            'code' => 'required|string|max:50|unique:coupons,code,' . ($this->couponId ?? 'NULL'),
            'type' => 'required|in:fixed,percentage',
            'value' => 'required|numeric|min:0',
            'minSpend' => 'nullable|numeric|min:0',
            'limitPerCoupon' => 'nullable|integer|min:1',
            'limitPerUser' => 'nullable|integer|min:1',
            'startDate' => 'nullable|date',
            'expiryDate' => 'nullable|date|after_or_equal:startDate',
            'isActive' => 'boolean',
        ];

        $this->validate($rules);

        $data = [
            'code' => $this->code,
            'type' => $this->type,
            'value' => $this->value,
            'min_spend' => $this->minSpend ?: null,
            'limit_per_coupon' => $this->limitPerCoupon ?: null,
            'limit_per_user' => $this->limitPerUser ?: null,
            'start_date' => $this->startDate ?: null,
            'expiry_date' => $this->expiryDate ?: null,
            'is_active' => $this->isActive,
        ];

        if ($this->isEditMode) {
            $coupon = Coupon::findOrFail($this->couponId);
            $coupon->update($data);
        } else {
            Coupon::create($data);
        }

        $this->dispatch('toast-show', [
            'message' => $this->couponId ? 'Coupon updated successfully!' : 'Coupon created successfully!',
            'type' => 'success',
            'position' => 'top-right',
        ]);

        $this->dispatch('close-modal');
    }

    // Inline Status Toggle Action
    public function toggleStatus($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->is_active = !$coupon->is_active;
        $coupon->save();

        $this->dispatch('toast-show', [
            'message' => 'Coupon status updated successfully!',
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
    public function deleteCoupon()
    {
        if ($this->deleteId) {
            Coupon::findOrFail($this->deleteId)->delete();
            $this->deleteId = null;

            $this->dispatch('toast-show', [
                'message' => 'Coupon deleted successfully!',
                'type' => 'success',
                'position' => 'top-right',
            ]);
        }

        $this->dispatch('close-delete-modal');
    }

    public function render()
    {
        $coupons = Coupon::where('code', 'like', '%' . $this->search . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        // Stats
        $totalCount = Coupon::count();
        $activeCount = Coupon::where('is_active', true)->count();
        $totalUsedCount = Coupon::sum('used_count');

        return view('admin.couponlist.couponlist', [
            'coupons' => $coupons,
            'totalCount' => $totalCount,
            'activeCount' => $activeCount,
            'totalUsedCount' => $totalUsedCount,
        ]);
    }
};
