<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;

// Route::view('/', 'welcome');

//Creada por percy para para redirigir directamente al dashboard(login)
Route::redirect('/', 'dashboard');

Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])
->name('dashboard');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
