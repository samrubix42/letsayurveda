<?php

use Illuminate\Support\Facades\Route;

// Public Routes
Route::livewire('/', 'pages::home');

// Admin Portal Routes (View-based Multi-File Components)
Route::prefix('admin')->group(function () {
    Route::redirect('/', '/admin/dashboard');
    Route::livewire('/dashboard', 'admin::dashboard')->name('admin.dashboard');
    Route::livewire('/blog/categories', 'admin::blog.categorylist')->name('admin.categories');
});
