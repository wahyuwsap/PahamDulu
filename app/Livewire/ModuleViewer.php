<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

use App\Models\Module;
use App\Models\ModuleVideo;

#[Layout('components.layouts.dashboard')]
class ModuleViewer extends Component
{
    public $activeModule;
    public $modules;
    public $activeVideo;

    public $isQuizUnlocked = false;
    public $selectedAnswer = null;
    public $isCorrect = null;

    public function mount($id)
    {
        $this->modules = Module::orderBy('order')->get();
        $this->activeModule = Module::with('videos')->findOrFail($id);
        
        if ($this->activeModule->videos->isNotEmpty()) {
            $this->activeVideo = $this->activeModule->videos->first();
        }
    }

    public function changeModule($moduleId)
    {
        return redirect()->route('modul.show', ['id' => $moduleId]);
    }

    public function changeVideo($videoId)
    {
        $this->activeVideo = ModuleVideo::findOrFail($videoId);
        $this->isQuizUnlocked = false;
    }

    public function unlockQuiz()
    {
        $this->isQuizUnlocked = true;
    }

    public function submitAnswer($answer)
    {
        $this->selectedAnswer = $answer;
        // Mock validation
        $this->isCorrect = ($answer === 'A'); 
    }

    public function render()
    {
        return view('livewire.module-viewer');
    }
}
