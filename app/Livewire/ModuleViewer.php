<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout('components.layouts.dashboard')]
class ModuleViewer extends Component
{
    public $isQuizUnlocked = false;
    public $selectedAnswer = null;
    public $isCorrect = null;

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
