<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.app')]
class Register extends Component
{
    public $name = '';
    public $username = '';
    public $password = '';
    public $password_confirmation = '';
    public $asal_instansi = '';

    public function register()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'asal_instansi' => 'required|string|max:255',
        ], [
            'name.required' => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'asal_instansi.required' => 'Asal instansi wajib diisi.',
        ]);

        $user = User::create([
            'name' => $this->name,
            'username' => $this->username,
            'password' => Hash::make($this->password),
            'asal_instansi' => $this->asal_instansi,
            'negara' => 'Indonesia',
        ]);

        Auth::login($user);

        if ($user->role === 'admin') {
            return redirect()->intended(route('admin.dashboard'));
        }
        return redirect()->intended(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
