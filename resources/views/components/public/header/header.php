<?php

use Livewire\Component;
use Livewire\Attributes\On;

new class extends Component
{
    public $cartCount = 0;

    public function mount()
    {
        $this->updateCartCount();
    }

    #[On('cart-updated')]
    public function updateCartCount()
    {
        if (auth()->check()) {
            $this->cartCount = \App\Models\CartItem::where('user_id', auth()->id())->sum('quantity');
        } else {
            $cart = session()->get('cart', []);
            $this->cartCount = array_sum($cart);
        }
    }
};