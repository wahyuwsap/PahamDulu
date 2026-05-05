<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class ManageUsers extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->id !== auth()->id()) {
            $user->delete();
            session()->flash('message', 'Pengguna berhasil dihapus.');
        } else {
            session()->flash('error', 'Tidak dapat menghapus akun sendiri.');
        }
    }

    public function toggleRole($id)
    {
        $user = User::findOrFail($id);
        if ($user->id !== auth()->id()) {
            $user->role = $user->role === 'admin' ? 'student' : 'admin';
            $user->save();
            session()->flash('message', 'Role pengguna berhasil diubah.');
        } else {
            session()->flash('error', 'Tidak dapat mengubah role akun sendiri.');
        }
    }

    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')
            ->orWhere('email', 'like', '%' . $this->search . '%')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('livewire.admin.manage-users', [
            'users' => $users,
        ])->layout('components.layouts.dashboard');
    }
}
