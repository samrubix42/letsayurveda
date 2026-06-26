<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'user_id',
        'product_varient_id',
        'quantity',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function variant()
    {
        return $this->belongsTo(ProductVarient::class, 'product_varient_id');
    }

    public static function mergeSessionCartWithUser($userId)
    {
        $sessionCart = session()->get('cart', []);
        if (empty($sessionCart)) {
            return;
        }

        foreach ($sessionCart as $variantId => $qty) {
            $cartItem = self::where('user_id', $userId)
                ->where('product_varient_id', $variantId)
                ->first();

            $variant = ProductVarient::with('inventory')->find($variantId);
            if (!$variant) {
                continue;
            }
            $maxStock = $variant->inventory ? $variant->inventory->quantity : 100;

            if ($cartItem) {
                $newQty = min($cartItem->quantity + $qty, $maxStock);
                $cartItem->update(['quantity' => $newQty]);
            } else {
                $qty = min($qty, $maxStock);
                if ($qty > 0) {
                    self::create([
                        'user_id' => $userId,
                        'product_varient_id' => $variantId,
                        'quantity' => $qty,
                    ]);
                }
            }
        }

        // Clear the session cart after successful merging
        session()->forget('cart');
    }
}
