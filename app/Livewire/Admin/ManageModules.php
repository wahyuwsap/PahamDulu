<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Module;

class ManageModules extends Component
{
    use WithPagination;

    public $search = '';

    public $isModalOpen = false;
    public $isEditMode = false;
    public $moduleId;
    public $title, $subtitle, $order, $description, $content;

    protected $rules = [
        'title' => 'required|string|max:255',
        'subtitle' => 'nullable|string|max:255',
        'order' => 'required|integer',
        'description' => 'nullable|string',
        'content' => 'nullable|string',
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function openModal()
    {
        $this->reset(['title', 'subtitle', 'order', 'description', 'content', 'moduleId']);
        $this->isEditMode = false;
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
        $this->resetValidation();
    }

    public function editModule($id)
    {
        $module = Module::findOrFail($id);
        $this->moduleId = $module->id;
        $this->title = $module->title;
        $this->subtitle = $module->subtitle;
        $this->order = $module->order;
        $this->description = $module->description;
        $this->content = $module->content;
        
        $this->isEditMode = true;
        $this->isModalOpen = true;
    }

    public function saveModule()
    {
        $this->validate();

        if ($this->isEditMode) {
            $module = Module::findOrFail($this->moduleId);
            $module->update([
                'title' => $this->title,
                'subtitle' => $this->subtitle,
                'order' => $this->order,
                'description' => $this->description,
                'content' => $this->content,
            ]);
            session()->flash('message', 'Modul berhasil diperbarui.');
        } else {
            Module::create([
                'title' => $this->title,
                'subtitle' => $this->subtitle,
                'order' => $this->order,
                'description' => $this->description,
                'content' => $this->content,
            ]);
            session()->flash('message', 'Modul berhasil ditambahkan.');
        }

        $this->closeModal();
    }

    public function deleteModule($id)
    {
        // For simplicity in this demo, let's just delete the module
        $module = Module::findOrFail($id);
        $module->delete();
        session()->flash('message', 'Modul berhasil dihapus.');
    }

    public function render()
    {
        $modules = Module::where('title', 'like', '%' . $this->search . '%')
            ->orderBy('order', 'asc')
            ->paginate(10);

        return view('livewire.admin.manage-modules', [
            'modules' => $modules,
        ])->layout('components.layouts.dashboard');
    }
}
