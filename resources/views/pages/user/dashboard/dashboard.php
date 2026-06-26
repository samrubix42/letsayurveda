<?php

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

new #[Layout('layouts::app')] class extends Component
{
    public function mount()
    {
        if (!Auth::check()) {
            return $this->redirect('/login', navigate: true);
        }
    }

    public function render()
    {
        return view('pages.user.dashboard.dashboard', [
            'user' => Auth::user(),
        ]);
    }
};
