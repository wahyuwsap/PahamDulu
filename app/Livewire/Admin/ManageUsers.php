<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;

class ManageUsers extends Component
{
    use WithPagination;

    public $search = '';

    public $userToDelete = null;
    public $userToToggle = null;

    public $isAddModalOpen = false;
    public $name, $username, $email, $password, $role = 'student', $asal_instansi;

    public function openAddModal()
    {
        $this->reset(['name', 'username', 'email', 'password', 'role', 'asal_instansi']);
        $this->isAddModalOpen = true;
    }

    public function closeAddModal()
    {
        $this->isAddModalOpen = false;
        $this->resetValidation();
    }

    public function saveUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'nullable|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,student',
            'asal_instansi' => 'required|string|max:255',
        ]);

        User::create([
            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,
            'password' => bcrypt($this->password),
            'role' => $this->role,
            'asal_instansi' => $this->asal_instansi,
            'negara' => 'Indonesia',
        ]);

        $this->closeAddModal();
        session()->flash('message', 'Pengguna baru berhasil ditambahkan.');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDeleteUser($id)
    {
        $this->userToDelete = $id;
        $this->dispatch('swal:confirm-delete-user');
    }

    public function deleteUser()
    {
        if ($this->userToDelete) {
            $user = User::findOrFail($this->userToDelete);
            if ($user->id !== auth()->id()) {
                $user->delete();
                session()->flash('message', 'Pengguna berhasil dihapus.');
            } else {
                session()->flash('error', 'Tidak dapat menghapus akun sendiri.');
            }
            $this->userToDelete = null;
        }
    }

    public function confirmToggleRole($id)
    {
        $this->userToToggle = $id;
        $this->dispatch('swal:confirm-toggle-role');
    }

    public function toggleRole()
    {
        if ($this->userToToggle) {
            $user = User::findOrFail($this->userToToggle);
            if ($user->id !== auth()->id()) {
                $user->role = $user->role === 'admin' ? 'student' : 'admin';
                $user->save();
                session()->flash('message', 'Role pengguna berhasil diubah.');
            } else {
                session()->flash('error', 'Tidak dapat mengubah role akun sendiri.');
            }
            $this->userToToggle = null;
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
