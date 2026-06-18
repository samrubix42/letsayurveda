<?php

use Livewire\Component;
use App\Models\BlogCategory;

new class extends Component
{
    public function render()
    {
        $categoryCount = BlogCategory::count();

        return view('admin.dashboard.dashboard', [
            'categoryCount' => $categoryCount,
        ])->layout('layouts.admin');
    }
};