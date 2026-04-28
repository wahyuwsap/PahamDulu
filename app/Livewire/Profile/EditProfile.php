<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

#[Layout('components.layouts.dashboard')]
class EditProfile extends Component
{
    public $name;
    public $email;
    public $username;
    public $asal_instansi;
    public $negara;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->username = $user->username;
        $this->asal_instansi = $user->asal_instansi;
        $this->negara = $user->negara;
    }

    public function save()
    {
        $user = Auth::user();
        
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'asal_instansi' => ['nullable', 'string', 'max:255'],
            'negara' => ['nullable', 'string', 'max:255'],
        ]);

        $user->update($validated);

        session()->flash('message', 'Profil berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.profile.edit-profile');
    }
}
