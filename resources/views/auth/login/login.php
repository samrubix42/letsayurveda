<?php

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;

new #[Layout('layouts::auth')] class extends Component
{
    public $email = '';
    public $password = '';
    public $remember = false;

    public function mount()
    {
        if (Auth::check()) {
            return $this->redirect('/admin/dashboard', navigate: true);
        }
    }

    public function login()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            session()->regenerate();
            
            session()->flash('message', 'Welcome back to LetsAyurveda!');
            return $this->redirect('/admin/dashboard', navigate: true);
        }

        $this->addError('email', 'The provided credentials do not match our records.');
        
        $this->dispatch('toast-show', [
            'message' => 'Login Failed',
            'description' => 'The credentials you entered do not match our records.',
            'type' => 'danger',
            'position' => 'top-right',
        ]);
    }

    public function render()
    {
        return view('auth.login.login');
    }
};