<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Module;
use Illuminate\Support\Facades\DB;

class ManageModules extends Component
{
    use WithPagination;

    public $search = '';

    public $isModalOpen = false;
    public $isEditMode = false;
    public $moduleId;
    public $title, $subtitle, $order, $description, $content;
    
    public $videos = [];
    public $quizzes = [];

    protected function rules()
    {
        return [
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'order' => 'required|integer',
            'description' => 'nullable|string',
            'content' => 'nullable|string',
            
            'videos.*.title' => 'required|string|max:255',
            'videos.*.youtube_id' => 'required|string|max:255',
            'videos.*.order' => 'required|integer',
            
            'quizzes.*.question' => 'required|string',
            'quizzes.*.option_a' => 'required|string',
            'quizzes.*.option_b' => 'required|string',
            'quizzes.*.option_c' => 'required|string',
            'quizzes.*.option_d' => 'required|string',
            'quizzes.*.correct_answer' => 'required|in:a,b,c,d',
        ];
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function addVideo()
    {
        $this->videos[] = [
            'title' => '',
            'youtube_id' => '',
            'order' => count($this->videos) + 1
        ];
    }

    public function removeVideo($index)
    {
        unset($this->videos[$index]);
        $this->videos = array_values($this->videos);
    }

    public function addQuiz()
    {
        $this->quizzes[] = [
            'question' => '',
            'option_a' => '',
            'option_b' => '',
            'option_c' => '',
            'option_d' => '',
            'correct_answer' => 'a'
        ];
    }

    public function removeQuiz($index)
    {
        unset($this->quizzes[$index]);
        $this->quizzes = array_values($this->quizzes);
    }

    public function openModal()
    {
        $this->reset(['title', 'subtitle', 'order', 'description', 'content', 'moduleId']);
        $this->videos = [];
        $this->quizzes = [];
        
        // Add 1 default empty video and quiz to guide user
        $this->addVideo();
        $this->addQuiz();

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
        $module = Module::with(['videos', 'quizzes'])->findOrFail($id);
        $this->moduleId = $module->id;
        $this->title = $module->title;
        $this->subtitle = $module->subtitle;
        $this->order = $module->order;
        $this->description = $module->description;
        $this->content = $module->content;
        
        $this->videos = $module->videos->toArray();
        $this->quizzes = $module->quizzes->toArray();
        
        $this->isEditMode = true;
        $this->isModalOpen = true;
    }

    public function saveModule()
    {
        $this->validate();

        DB::transaction(function () {
            if ($this->isEditMode) {
                $module = Module::findOrFail($this->moduleId);
                $module->update([
                    'title' => $this->title,
                    'subtitle' => $this->subtitle,
                    'order' => $this->order,
                    'description' => $this->description,
                    'content' => $this->content,
                ]);

                // Sync videos
                $module->videos()->delete();
                $module->videos()->createMany($this->videos);

                // Sync quizzes
                $module->quizzes()->delete();
                $module->quizzes()->createMany($this->quizzes);

                session()->flash('message', 'Modul beserta video dan kuis berhasil diperbarui.');
            } else {
                $module = Module::create([
                    'title' => $this->title,
                    'subtitle' => $this->subtitle,
                    'order' => $this->order,
                    'description' => $this->description,
                    'content' => $this->content,
                ]);

                $module->videos()->createMany($this->videos);
                $module->quizzes()->createMany($this->quizzes);

                session()->flash('message', 'Modul baru beserta video dan kuis berhasil ditambahkan.');
            }
        });

        $this->closeModal();
    }

    public function deleteModule($id)
    {
        $module = Module::findOrFail($id);
        $module->delete(); // Cascades on DB level for relations
        session()->flash('message', 'Modul berhasil dihapus.');
    }

    public function render()
    {
        $modules = Module::with(['videos', 'quizzes'])
            ->where('title', 'like', '%' . $this->search . '%')
            ->orderBy('order', 'asc')
            ->paginate(10);

        return view('livewire.admin.manage-modules', [
            'modules' => $modules,
        ])->layout('components.layouts.dashboard');
    }
}
