<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Module;
use App\Models\UserModuleProgress;

class Dashboard extends Component
{
    public function render()
    {
        $totalUsers = User::where('role', '!=', 'admin')->orWhereNull('role')->count();
        $totalModules = Module::count();
        $avgScore = UserModuleProgress::avg('score') ?? 0;

        $recentUsers = User::orderBy('created_at', 'desc')->take(5)->get();
        $recentProgress = UserModuleProgress::with(['user', 'module'])->orderBy('updated_at', 'desc')->take(5)->get();

        return view('livewire.admin.dashboard', [
            'totalUsers' => $totalUsers,
            'totalModules' => $totalModules,
            'avgScore' => round($avgScore, 2),
            'recentUsers' => $recentUsers,
            'recentProgress' => $recentProgress,
        ])->layout('components.layouts.dashboard');
    }
}
