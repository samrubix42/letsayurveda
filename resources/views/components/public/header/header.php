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
        $cart = session()->get('cart', []);
        $this->cartCount = array_sum($cart);
    }
};