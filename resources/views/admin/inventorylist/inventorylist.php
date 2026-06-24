<?php

use Livewire\Component;
use App\Models\ProductVarient;
use App\Models\Inventory;
use App\Models\InventoryLog;
use Livewire\WithPagination;
use Livewire\Attributes\Layout;

new #[Layout('layouts::admin')] class extends Component
{
    use WithPagination;

    // Search & Filter
    public $search = '';
    public bool $lowStockOnly = false;

    // Form inputs for Stock Adjustment
    public ?int $variantId = null;
    public string $variantName = '';
    public string $sku = '';
    public $quantity = 0;
    public $lowStockThreshold = 5;
    public bool $trackInventory = true;
    public string $adjustmentNote = '';

    // Logs view
    public ?int $viewLogsVariantId = null;
    public string $viewLogsVariantName = '';
    public $logsList = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'lowStockOnly' => ['except' => false],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingLowStockOnly()
    {
        $this->resetPage();
    }

    // Open Edit Stock Modal
    public function openEditModal($variantId)
    {
        $this->resetErrorBag();
        $this->variantId = $variantId;
        $this->adjustmentNote = '';

        $variant = ProductVarient::with('product', 'inventory', 'variantAttributes.attribute', 'variantAttributes.value')->findOrFail($variantId);
        $this->variantName = $variant->product->name . ($variant->name !== 'Default Variant' ? ' (' . $variant->name . ')' : '');
        $this->sku = $variant->sku;

        // Ensure inventory record exists
        $inventory = $variant->inventory;
        if (!$inventory) {
            $inventory = $variant->inventory()->create([
                'quantity' => 0,
                'reserved_quantity' => 0,
                'low_stock_threshold' => 5,
                'track_inventory' => true,
            ]);
        }

        $this->quantity = $inventory->quantity;
        $this->lowStockThreshold = $inventory->low_stock_threshold;
        $this->trackInventory = (bool) $inventory->track_inventory;

        $this->dispatch('open-modal');
    }

    // Save Stock Adjustments
    public function save()
    {
        $this->validate([
            'quantity' => 'required|integer|min:0',
            'lowStockThreshold' => 'required|integer|min:0',
            'trackInventory' => 'required|boolean',
            'adjustmentNote' => 'nullable|string|max:255',
        ]);

        $variant = ProductVarient::with('inventory')->findOrFail($this->variantId);
        $inventory = $variant->inventory;

        $beforeQty = $inventory->quantity;
        $afterQty = (int) $this->quantity;
        $qtyDiff = $afterQty - $beforeQty;

        $inventory->update([
            'quantity' => $afterQty,
            'low_stock_threshold' => $this->lowStockThreshold,
            'track_inventory' => $this->trackInventory,
        ]);

        // Create log entry if quantity changed
        if ($qtyDiff !== 0) {
            $type = 'adjustment';
            if ($qtyDiff > 0) {
                $type = 'stock_in';
            } elseif ($qtyDiff < 0) {
                $type = 'stock_out';
            }

            InventoryLog::create([
                'inventory_id' => $inventory->id,
                'type' => $type,
                'quantity' => abs($qtyDiff),
                'before_quantity' => $beforeQty,
                'after_quantity' => $afterQty,
                'note' => $this->adjustmentNote ?: 'Manual admin stock adjustment',
            ]);
        }

        $this->dispatch('toast-show', [
            'message' => 'Inventory updated successfully!',
            'type' => 'success',
            'position' => 'top-right',
        ]);

        $this->dispatch('close-modal');
    }

    // Open Logs Viewer Modal
    public function openLogsModal($variantId)
    {
        $this->viewLogsVariantId = $variantId;
        $variant = ProductVarient::with('product', 'inventory')->findOrFail($variantId);
        $this->viewLogsVariantName = $variant->product->name . ($variant->name !== 'Default Variant' ? ' (' . $variant->name . ')' : '');

        $inventory = $variant->inventory;
        if ($inventory) {
            $this->logsList = InventoryLog::where('inventory_id', $inventory->id)
                ->orderBy('id', 'desc')
                ->get();
        } else {
            $this->logsList = [];
        }

        $this->dispatch('open-logs-modal');
    }

    public function render()
    {
        $query = ProductVarient::with(['product', 'inventory', 'variantAttributes.attribute', 'variantAttributes.value']);

        // Search filter
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('sku', 'like', '%' . $this->search . '%')
                  ->orWhereHas('product', function ($pq) {
                      $pq->where('name', 'like', '%' . $pq->search = $this->search . '%');
                  });
            });
        }

        // Low stock filter
        if ($this->lowStockOnly) {
            $query->whereHas('inventory', function ($iq) {
                $iq->whereColumn('quantity', '<=', 'low_stock_threshold')
                   ->where('track_inventory', true);
            });
        }

        $variants = $query->orderBy('id', 'desc')->paginate(10);

        // Ensure inventory relation exists for all paginated items
        foreach ($variants->items() as $variant) {
            if (!$variant->inventory) {
                $variant->inventory()->create([
                    'quantity' => 0,
                    'reserved_quantity' => 0,
                    'low_stock_threshold' => 5,
                    'track_inventory' => true,
                ]);
                $variant->load('inventory');
            }
        }

        return view('admin.inventorylist.inventorylist', [
            'variants' => $variants,
        ]);
    }
};
