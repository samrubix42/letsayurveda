<?php

use Livewire\Component;
use App\Models\BlogCategory;
use Livewire\Attributes\Layout;

new #[Layout('layouts::admin')] class extends Component
{
    public function render()
    {
        $categoryCount = BlogCategory::count();

        return view('admin.dashboard.dashboard', [
            'categoryCount' => $categoryCount,
        ]);
    }
};