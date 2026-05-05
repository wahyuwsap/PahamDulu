<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;

use App\Models\Module;
use App\Models\ModuleVideo;
use App\Models\UserModuleProgress;
use App\Models\UserVideoProgress;
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
    public $quizSubmitted = false;
    public $finalScore = 0;
    public $wrongQuestions = [];
    public $quizStartedAt = null;
    public $timeTaken = 0;

    public function mount($id)
    {
        $this->modules = Module::orderBy('order')->get();
        $this->activeModule = Module::with(['videos', 'quizzes'])->findOrFail($id);

        if ($this->activeModule->videos->isNotEmpty()) {
            $this->activeVideo = $this->activeModule->videos->first();
        }

        // Load progress from database
        if (auth()->check()) {
            $this->watchedVideos = UserVideoProgress::where('user_id', auth()->id())
                ->whereIn('video_id', $this->activeModule->videos->pluck('id'))
                ->pluck('video_id')
                ->toArray();

            $progress = UserModuleProgress::where('user_id', auth()->id())
                ->where('module_id', $this->activeModule->id)
                ->first();

            if ($progress && $progress->is_completed) {
                $this->finalScore = $progress->score;
                $this->quizSubmitted = true;
                $this->timeTaken = $progress->time_taken ?? 0;
                if (!empty($progress->answers)) {
                    $this->userAnswers = $progress->answers;
                }
            }
        }
    }

    #[Computed]
    public function paginatedQuizzes()
    {
        if ($this->activeModule->quizzes->isEmpty())
            return collect();
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
        if (!$this->activeModule)
            return false;
        return count(array_unique($this->watchedVideos)) >= $this->activeModule->videos->count();
    }

    public function unlockQuiz()
    {
        if (!in_array($this->activeVideo->id, $this->watchedVideos)) {
            $this->watchedVideos[] = $this->activeVideo->id;

            if (auth()->check()) {
                UserVideoProgress::updateOrCreate([
                    'user_id' => auth()->id(),
                    'video_id' => $this->activeVideo->id
                ]);
            }
        }
    }

    public function selectAnswer($quizId, $answer)
    {
        // Don't allow changing answers after quiz is submitted
        if ($this->quizSubmitted)
            return;

        // Start timer on first answer
        if ($this->quizStartedAt === null) {
            $this->quizStartedAt = now()->timestamp;
        }

        $this->userAnswers[$quizId] = $answer;
    }

    public function submitQuiz()
    {
        // Don't allow re-submitting
        if ($this->quizSubmitted)
            return;

        $correctAnswers = 0;
        $activeModule = Module::with('quizzes')->findOrFail($this->activeModule->id);
        $totalQuizzes = $activeModule->quizzes->count();
        $this->wrongQuestions = [];

        if ($totalQuizzes === 0)
            return;

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
        $this->quizSubmitted = true;

        // Calculate time taken
        if ($this->quizStartedAt) {
            $this->timeTaken = now()->timestamp - $this->quizStartedAt;
        }

        // Save to database
        if (auth()->check()) {
            UserModuleProgress::updateOrCreate(
                ['user_id' => auth()->id(), 'module_id' => $activeModule->id],
                [
                    'is_unlocked' => true,
                    'is_completed' => true,
                    'score' => $this->finalScore,
                    'answers' => $this->userAnswers,
                    'time_taken' => $this->timeTaken,
                ]
            );
        }

        $this->dispatch('swal:score', score: $this->finalScore, wrongQuestions: $this->wrongQuestions, timeTaken: $this->timeTaken);
    }

    public function resetQuiz()
    {
        $this->userAnswers = [];
        $this->currentPage = 1;
        $this->wrongQuestions = [];
        $this->quizSubmitted = false;
        $this->finalScore = 0;
        $this->quizStartedAt = null;
        $this->timeTaken = 0;

        // Reset progress in database but keep the record (score is preserved via history)
        if (auth()->check()) {
            UserModuleProgress::where('user_id', auth()->id())
                ->where('module_id', $this->activeModule->id)
                ->update([
                    'is_completed' => false,
                    'answers' => null,
                ]);
        }
    }

    public function render()
    {
        return view('livewire.module-viewer');
    }
}
