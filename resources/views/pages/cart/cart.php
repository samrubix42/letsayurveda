<?php

use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Layout;
use App\Models\ProductVarient;
use App\Models\CartItem;
use App\Models\Coupon;

new #[Layout('layouts::app', ['title' => 'Your Shopping Bag | LetsAyurveda'])] class extends Component
{
    public $cartItems = [];
    public $subtotal = 0;
    
    // Coupon system
    public $couponCode = '';
    public $appliedCoupon = null;
    public $discountAmount = 0;
    public $grandTotal = 0;

    public function mount()
    {
        $this->loadCart();
    }

    #[On('cart-updated')]
    public function loadCart()
    {
        $this->cartItems = [];
        $this->subtotal = 0;

        if (auth()->check()) {
            // Load from database
            $dbItems = CartItem::with(['variant.product.primaryImage', 'variant.inventory'])
                ->where('user_id', auth()->id())
                ->get();

            foreach ($dbItems as $item) {
                $variant = $item->variant;
                if (!$variant) continue;

                $qty = $item->quantity;
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
        } else {
            // Load from session
            $cart = session()->get('cart', []);
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

        // Validate applied coupon validity under new subtotal
        if ($this->appliedCoupon) {
            $couponModel = Coupon::find($this->appliedCoupon['id']);
            if ($couponModel && $couponModel->min_spend && $this->subtotal < $couponModel->min_spend) {
                $this->appliedCoupon = null;
                $this->discountAmount = 0;
                $this->dispatch('toast-show', [
                    'message' => 'Coupon Removed',
                    'description' => 'Subtotal fell below the minimum spend requirement for the applied coupon.',
                    'type' => 'warning',
                    'position' => 'top-right',
                ]);
            }
        }

        $this->calculateTotals();
    }

    public function updateQuantity($variantId, $qty)
    {
        $variant = ProductVarient::with('inventory')->find($variantId);
        if (!$variant) return;

        $maxStock = $variant->inventory ? $variant->inventory->quantity : 100;
        $qty = max(1, min($qty, $maxStock));

        if (auth()->check()) {
            CartItem::where('user_id', auth()->id())
                ->where('product_varient_id', $variantId)
                ->update(['quantity' => $qty]);
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$variantId])) {
                $cart[$variantId] = $qty;
                session()->put('cart', $cart);
            }
        }
        
        $this->loadCart();
        $this->dispatch('cart-updated');
    }

    public function removeItem($variantId)
    {
        if (auth()->check()) {
            CartItem::where('user_id', auth()->id())
                ->where('product_varient_id', $variantId)
                ->delete();
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$variantId])) {
                unset($cart[$variantId]);
                session()->put('cart', $cart);
            }
        }
        
        $this->loadCart();
        $this->dispatch('cart-updated');
    }

    public function applyCoupon()
    {
        $this->validate([
            'couponCode' => 'required|string',
        ]);

        $coupon = Coupon::where('code', $this->couponCode)
            ->where('is_active', true)
            ->first();

        if (!$coupon) {
            $this->addError('couponCode', 'Invalid or inactive coupon code.');
            return;
        }

        $now = now();
        if ($coupon->start_date && $now->lt($coupon->start_date)) {
            $this->addError('couponCode', 'This coupon is not active yet.');
            return;
        }
        if ($coupon->expiry_date && $now->gt($coupon->expiry_date)) {
            $this->addError('couponCode', 'This coupon has expired.');
            return;
        }

        if ($coupon->min_spend && $this->subtotal < $coupon->min_spend) {
            $this->addError('couponCode', 'Minimum spend of ₹' . number_format($coupon->min_spend) . ' is required.');
            return;
        }

        if ($coupon->limit_per_coupon && $coupon->used_count >= $coupon->limit_per_coupon) {
            $this->addError('couponCode', 'This coupon usage limit has been reached.');
            return;
        }

        $this->appliedCoupon = [
            'id' => $coupon->id,
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
        ];

        $this->couponCode = ''; // Clear input
        $this->loadCart();

        $this->dispatch('toast-show', [
            'message' => 'Coupon Applied',
            'description' => 'Discount applied successfully!',
            'type' => 'success',
            'position' => 'top-right',
        ]);
    }

    public function removeCoupon()
    {
        $this->appliedCoupon = null;
        $this->discountAmount = 0;
        $this->loadCart();

        $this->dispatch('toast-show', [
            'message' => 'Coupon Removed',
            'description' => 'Coupon has been cleared.',
            'type' => 'info',
            'position' => 'top-right',
        ]);
    }

    public function calculateTotals()
    {
        $this->discountAmount = 0;

        if ($this->appliedCoupon) {
            if ($this->appliedCoupon['type'] === 'percentage') {
                $this->discountAmount = $this->subtotal * ($this->appliedCoupon['value'] / 100);
            } else {
                $this->discountAmount = $this->appliedCoupon['value'];
            }
            
            $this->discountAmount = min($this->discountAmount, $this->subtotal);
        }

        $this->grandTotal = max(0, $this->subtotal - $this->discountAmount);
    }

    public function render()
    {
        return view('pages.cart.cart');
    }
};