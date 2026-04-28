<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

use App\Models\Module;
use App\Models\ModuleVideo;
use App\Models\UserModuleProgress;
use Livewire\Attributes\Computed;

#[Layout('components.layouts.dashboard')]
class ModuleViewer extends Component
{
    public $activeModule;
    public $modules;
    public $activeVideo;
    
    public $watchedVideos = [];
    
    // Quiz state
    public $userAnswers = [];
    public $currentPage = 1;
    public $perPage = 5;
    
    // Score state
    public $showScoreModal = false;
    public $finalScore = 0;
    public $wrongQuestions = [];

    public function mount($id)
    {
        $this->modules = Module::orderBy('order')->get();
        $this->activeModule = Module::with(['videos', 'quizzes'])->findOrFail($id);
        
        if ($this->activeModule->videos->isNotEmpty()) {
            $this->activeVideo = $this->activeModule->videos->first();
        }
    }

    #[Computed]
    public function paginatedQuizzes()
    {
        if ($this->activeModule->quizzes->isEmpty()) return collect();
        $chunks = $this->activeModule->quizzes->chunk($this->perPage);
        return $chunks->has($this->currentPage - 1) ? $chunks[$this->currentPage - 1] : collect();
    }

    #[Computed]
    public function totalPages()
    {
        return max(1, ceil($this->activeModule->quizzes->count() / $this->perPage));
    }

    public function nextPage()
    {
        if ($this->currentPage < $this->totalPages()) {
            $this->currentPage++;
        }
    }

    public function prevPage()
    {
        if ($this->currentPage > 1) {
            $this->currentPage--;
        }
    }

    public function changeModule($moduleId)
    {
        return redirect()->route('modul.show', ['id' => $moduleId]);
    }

    public function changeVideo($videoId)
    {
        $this->activeVideo = ModuleVideo::findOrFail($videoId);
    }

    #[Computed]
    public function isQuizUnlocked()
    {
        if (!$this->activeModule) return false;
        return count(array_unique($this->watchedVideos)) >= $this->activeModule->videos->count();
    }

    public function unlockQuiz()
    {
        if (!in_array($this->activeVideo->id, $this->watchedVideos)) {
            $this->watchedVideos[] = $this->activeVideo->id;
        }
    }

    public function selectAnswer($quizId, $answer)
    {
        $this->userAnswers[$quizId] = $answer;
    }

    public function submitQuiz()
    {
        $correctAnswers = 0;
        $activeModule = Module::with('quizzes')->findOrFail($this->activeModule->id);
        $totalQuizzes = $activeModule->quizzes->count();
        $this->wrongQuestions = [];

        if ($totalQuizzes === 0) return;

        $iteration = 1;
        foreach ($activeModule->quizzes as $quiz) {
            if (isset($this->userAnswers[$quiz->id]) && strtolower($this->userAnswers[$quiz->id]) === strtolower($quiz->correct_answer)) {
                $correctAnswers++;
            } else {
                $this->wrongQuestions[] = $iteration;
            }
            $iteration++;
        }

        $this->finalScore = (int) round(($correctAnswers / $totalQuizzes) * 100);

        // Save to database
        if (auth()->check()) {
            UserModuleProgress::updateOrCreate(
                ['user_id' => auth()->id(), 'module_id' => $activeModule->id],
                ['is_unlocked' => true, 'is_completed' => true, 'score' => $this->finalScore]
            );
        }

        $this->showScoreModal = true;
    }

    public function render()
    {
        return view('livewire.module-viewer');
    }
}
