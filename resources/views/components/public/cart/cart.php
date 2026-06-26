<?php

use Livewire\Component;
use Livewire\Attributes\On;
use App\Models\ProductVarient;

new class extends Component
{
    public $cartItems = [];
    public $subtotal = 0;

    public function mount()
    {
        $this->loadCart();
    }

    #[On('cart-updated')]
    public function loadCart()
    {
        $cart = session()->get('cart', []);
        $this->cartItems = [];
        $this->subtotal = 0;

        if (!empty($cart)) {
            $variants = ProductVarient::with(['product.primaryImage', 'inventory'])
                ->whereIn('id', array_keys($cart))
                ->get();

            foreach ($variants as $variant) {
                $qty = $cart[$variant->id];
                $price = $variant->sale_price ?? $variant->price;
                $itemSubtotal = $price * $qty;
                
                $image = $variant->product->primaryImage ? $variant->product->primaryImage->image_path : null;
                $imageSrc = ($image && file_exists(public_path($image))) ? '/' . $image : 'https://images.unsplash.com/photo-1608571423902-eed4a5ad8108?auto=format&fit=crop&q=80&w=600';

                $this->cartItems[] = [
                    'variant_id' => $variant->id,
                    'product_id' => $variant->product_id,
                    'name' => $variant->product->name,
                    'variant_name' => $variant->name,
                    'image' => $imageSrc,
                    'price' => $price,
                    'quantity' => $qty,
                    'subtotal' => $itemSubtotal,
                    'stock' => $variant->inventory ? $variant->inventory->quantity : 100,
                ];

                $this->subtotal += $itemSubtotal;
            }
        }
    }

    #[On('add-to-cart')]
    public function addToCart($productId, $variantId = null, $qty = 1)
    {
        $product = \App\Models\Product::with(['variants'])->find($productId);
        if (!$product) return;

        if (!$variantId) {
            $defaultVariant = $product->defaultVariant ?? $product->variants->first();
            $variantId = $defaultVariant?->id;
        }

        if (!$variantId) return;

        $variant = ProductVarient::with('inventory')->find($variantId);
        if (!$variant) return;

        $cart = session()->get('cart', []);
        
        $maxStock = $variant->inventory ? $variant->inventory->quantity : 100;
        $currentQty = $cart[$variantId] ?? 0;
        $newQty = $currentQty + $qty;
        
        if ($newQty > $maxStock) {
            $newQty = $maxStock;
        }
        
        $cart[$variantId] = $newQty;
        session()->put('cart', $cart);
        
        $this->loadCart();
        $this->dispatch('cart-updated');
    }

    public function updateQuantity($variantId, $qty)
    {
        $cart = session()->get('cart', []);
        
        if (isset($cart[$variantId])) {
            $variant = ProductVarient::with('inventory')->find($variantId);
            if ($variant) {
                $maxStock = $variant->inventory ? $variant->inventory->quantity : 100;
                $qty = max(1, min($qty, $maxStock));
                $cart[$variantId] = $qty;
                session()->put('cart', $cart);
                
                $this->loadCart();
                $this->dispatch('cart-updated');
            }
        }
    }

    public function removeItem($variantId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$variantId])) {
            unset($cart[$variantId]);
            session()->put('cart', $cart);
            
            $this->loadCart();
            $this->dispatch('cart-updated');
        }
    }
};
