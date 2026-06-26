<?php

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Product;

new #[Layout('layouts::app')] class extends Component
{
    public function render()
    {
        $products = Product::with(['category', 'primaryImage', 'defaultVariant.inventory'])
            ->where('status', 'active')
            ->take(6)
            ->get();

        return view('pages.home.home', [
            'products' => $products,
        ]);
    }
};