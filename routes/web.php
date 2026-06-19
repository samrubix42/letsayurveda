<?php

use Illuminate\Support\Facades\Route;

// Public Routes
Route::livewire('/', 'pages::home');
Route::livewire('/login','auth::login')->name('login');

// Admin Portal Routes (View-based Multi-File Components)
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::redirect('/', '/admin/dashboard');
    Route::livewire('/dashboard', 'admin::dashboard')->name('admin.dashboard');
    Route::livewire('/blog', 'admin::blog.list')->name('admin.blogs');
    Route::livewire('/blog/add', 'admin::blog.add')->name('admin.blogs.create');
    Route::livewire('/blog/edit/{id}', 'admin::blog.update')->name('admin.blogs.edit');
    Route::livewire('/blog/categories', 'admin::blog.categorylist')->name('admin.categories');
    
    // Logout Action Route
    Route::post('/logout', function () {
        Illuminate\Support\Facades\Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect()->route('login');
    })->name('logout');
});
