<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

#[Layout('components.layouts.dashboard')]
class EditProfile extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $username;
    public $asal_instansi;
    public $negara;
    public $avatar;
    public $current_avatar_path;

    public function mount()
    {
        $user = Auth::user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->username = $user->username;
        $this->asal_instansi = $user->asal_instansi;
        $this->negara = $user->negara;
        $this->current_avatar_path = $user->avatar_path;
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
            'avatar' => ['nullable', 'image', 'max:2048'], // Max 2MB
        ]);

        if ($this->avatar) {
            // Delete old avatar if exists
            if ($user->avatar_path) {
                Storage::disk('public')->delete($user->avatar_path);
            }
            
            $path = $this->avatar->store('avatars', 'public');
            $validated['avatar_path'] = $path;
        }

        unset($validated['avatar']);
        $user->update($validated);
        $this->current_avatar_path = $user->avatar_path;
        $this->avatar = null;

        session()->flash('message', 'Profil berhasil diperbarui!');
    }

    public function render()
    {
        return view('livewire.profile.edit-profile');
    }
}
