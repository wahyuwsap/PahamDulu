<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

#[Layout('components.layouts.dashboard')]
class ChangePassword extends Component
{
    public $current_password;
    public $password;
    public $password_confirmation;

    public function updatePassword()
    {
        $this->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::defaults()],
        ]);

        Auth::user()->update([
            'password' => Hash::make($this->password),
        ]);

        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect()->route('login')->with('message', 'Kata sandi berhasil diubah! Silakan masuk kembali dengan kata sandi baru Anda.');
    }

    public function render()
    {
        return view('livewire.profile.change-password');
    }
}
