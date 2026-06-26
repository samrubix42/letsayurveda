<?php

use Livewire\Component;
use App\Models\Product;
use App\Models\ProductVarient;

new class extends Component
{
    public $product;
    public $selectedVariantId;
    public $quantity = 1;
    public $activeImage;
    public $relatedProducts;

    public function mount($slug)
    {
        $this->product = Product::with([
            'category',
            'images',
            'variants.variantAttributes.attribute',
            'variants.variantAttributes.value',
            'variants.inventory'
        ])
        ->where('slug', $slug)
        ->where('status', 'active')
        ->firstOrFail();

        // Get default variant
        $defaultVariant = $this->product->defaultVariant ?? $this->product->variants->first();
        $this->selectedVariantId = $defaultVariant?->id;

        // Set active image
        $primaryImg = $this->product->primaryImage ?? $this->product->images->first();
        $this->activeImage = $primaryImg ? '/' . $primaryImg->image_path : null;

        // Fetch related products in the same category
        $this->relatedProducts = Product::with(['category', 'primaryImage', 'defaultVariant.inventory'])
            ->where('status', 'active')
            ->where('category_id', $this->product->category_id)
            ->where('id', '!=', $this->product->id)
            ->take(4)
            ->get();

        // If fewer than 4 related products, pull others
        if ($this->relatedProducts->count() < 4) {
            $existingIds = $this->relatedProducts->pluck('id')->push($this->product->id)->toArray();
            $filler = Product::with(['category', 'primaryImage', 'defaultVariant.inventory'])
                ->where('status', 'active')
                ->whereNotIn('id', $existingIds)
                ->take(4 - $this->relatedProducts->count())
                ->get();
            $this->relatedProducts = $this->relatedProducts->merge($filler);
        }
    }

    public function selectVariant($variantId)
    {
        $this->selectedVariantId = $variantId;
        $this->quantity = 1; // Reset quantity when variant changes
    }

    public function changeImage($imagePath)
    {
        $this->activeImage = $imagePath;
    }

    public function incrementQuantity()
    {
        $variant = $this->getSelectedVariant();
        $maxStock = $variant && $variant->inventory ? $variant->inventory->quantity : 100;
        
        if ($this->quantity < $maxStock) {
            $this->quantity++;
        }
    }

    public function decrementQuantity()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }

    public function getSelectedVariant()
    {
        return $this->product->variants->firstWhere('id', $this->selectedVariantId);
    }

    public function addToCart()
    {
        $variant = $this->getSelectedVariant();
        if (!$variant) {
            return;
        }

        $cart = session()->get('cart', []);
        
        $maxStock = $variant->inventory ? $variant->inventory->quantity : 100;
        $currentQty = $cart[$variant->id] ?? 0;
        $newQty = $currentQty + $this->quantity;
        
        if ($newQty > $maxStock) {
            $newQty = $maxStock;
        }
        
        if ($newQty <= 0) {
            unset($cart[$variant->id]);
        } else {
            $cart[$variant->id] = $newQty;
        }
        
        session()->put('cart', $cart);
        
        $this->dispatch('cart-updated');
    }

    public function render()
    {
        return view('pages.product.product-view.product-view')
            ->layout('layouts::app', [
                'title' => $this->product->name . ' | LetsAyurveda',
                'description' => $this->product->short_description,
            ]);
    }
};