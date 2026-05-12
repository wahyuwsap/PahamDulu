<?php

use Illuminate\Support\Facades\Route;

use App\Livewire\Auth\Login;
use App\Livewire\Auth\Register;

Route::middleware('guest')->group(function () {
    Route::get('/', Login::class)->name('login');
    Route::get('/register', Register::class)->name('register');
});

Route::middleware('auth')->group(function () {
    Route::middleware('role:student')->group(function () {
        Route::get('/dashboard', \App\Livewire\Dashboard::class)->name('dashboard');
        Route::get('/modul/{id}', \App\Livewire\ModuleViewer::class)->name('modul.show');
    });
    
    Route::get('/profile/edit', \App\Livewire\Profile\EditProfile::class)->name('profile.edit');
    Route::get('/profile/password', \App\Livewire\Profile\ChangePassword::class)->name('profile.password');
    
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin/dashboard', \App\Livewire\Admin\Dashboard::class)->name('admin.dashboard');
        Route::get('/admin/users', \App\Livewire\Admin\ManageUsers::class)->name('admin.users');
        Route::get('/admin/modules', \App\Livewire\Admin\ManageModules::class)->name('admin.modules');
    });

    Route::post('/logout', function () {
        Illuminate\Support\Facades\Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return redirect('/');
    })->name('logout');
});
