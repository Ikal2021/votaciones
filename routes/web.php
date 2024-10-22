<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Livewire\CreateNewCandidate;

// Route::view('/', 'welcome');

//Creada por percy para para redirigir directamente al dashboard(login)
Route::redirect('/', 'dashboard');

//Dashboard o pagina principal
Route::get('dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])
->name('dashboard');

//Ruta para formulario de creacion de nuevo candidato
Route::get('/nuevoCandidato', CreateNewCandidate::class)->name('nuevoCandidato');

// Route::view('dashboard', 'dashboard')
//     ->middleware(['auth', 'verified'])
//     ->name('dashboard');

Route::view('profile', 'profile')->middleware(['auth'])->name('profile');

require __DIR__.'/auth.php';
