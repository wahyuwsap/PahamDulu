<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Module;
use App\Models\UserModuleProgress;
use Illuminate\Support\Facades\DB;

#[Layout('components.layouts.dashboard')]
class Dashboard extends Component
{
    public function render()
    {
        $userId = auth()->id();
        $totalModules = Module::count();

        // Get user's completed module progress
        $userProgress = UserModuleProgress::where('user_id', $userId)
            ->where('is_completed', true)
            ->get();

        $completedCount = $userProgress->count();
        $totalScore = $completedCount > 0 ? (int) round($userProgress->avg('score')) : 0;

        // Calculate ranking: average score per user, rank current user
        $ranking = '-';
        if ($completedCount > 0) {
            $allUserScores = UserModuleProgress::where('is_completed', true)
                ->select('user_id', DB::raw('ROUND(AVG(score)) as avg_score'))
                ->groupBy('user_id')
                ->orderByDesc('avg_score')
                ->pluck('avg_score', 'user_id');

            $rank = 1;
            foreach ($allUserScores as $uid => $avgScore) {
                if ($uid == $userId) {
                    $ranking = '#' . $rank;
                    break;
                }
                $rank++;
            }
        }

        // Get fastest quiz time
        $fastestTime = null;
        if ($completedCount > 0) {
            $fastestTime = $userProgress->whereNotNull('time_taken')->where('time_taken', '>', 0)->min('time_taken');
        }

        // Chart data: scores over the last 14 days
        $chartLabels = [];
        $chartData = [];
        $startDate = now()->subDays(13)->startOfDay();

        for ($i = 0; $i < 14; $i++) {
            $date = $startDate->copy()->addDays($i);
            $chartLabels[] = $date->format('d M');

            $dayScore = UserModuleProgress::where('user_id', $userId)
                ->where('is_completed', true)
                ->whereDate('updated_at', $date->toDateString())
                ->avg('score');

            $chartData[] = $dayScore !== null ? round($dayScore) : null;
        }

        return view('livewire.dashboard', [
            'totalScore' => $totalScore,
            'completedCount' => $completedCount,
            'totalModules' => $totalModules,
            'ranking' => $ranking,
            'fastestTime' => $fastestTime,
            'chartLabels' => $chartLabels,
            'chartData' => $chartData,
        ]);
    }
}
