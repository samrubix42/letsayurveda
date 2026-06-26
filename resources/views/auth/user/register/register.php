<?php

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;

new #[Layout('layouts::auth', ['title' => 'LetsAyurveda | Register'])] class extends Component
{
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';

    public function mount()
    {
        if (Auth::check()) {
            if (Auth::user()->is_admin) {
                return $this->redirect('/admin/dashboard', navigate: true);
            }
            return $this->redirect('/dashboard', navigate: true);
        }
    }

    public function register()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'is_admin' => false,
        ]);

        Auth::login($user);

        session()->flash('message', 'Registration successful! Welcome to LetsAyurveda.');

        return $this->redirect('/dashboard', navigate: true);
    }

    public function render()
    {
        return view('auth.user.register.register');
    }
};