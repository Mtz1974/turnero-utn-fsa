<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\KioscoTurnos;
use App\Livewire\PantallaTV;
use App\Livewire\PuestoPanel;
use App\Livewire\AdminTurnos;
use App\Http\Controllers\ProfileController;

// Home público
Route::view('/', 'welcome')->name('home');

// Dashboard de Breeze (necesario si usás el layout app con navbar)
Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])->name('dashboard');

// Páginas públicas
Route::get('/kiosco',   KioscoTurnos::class)->name('kiosco');
Route::get('/pantalla', PantallaTV::class)->name('pantalla');

// Protegidas (login + rol)
Route::middleware(['auth','role:agente,admin'])->get('/puesto', PuestoPanel::class)->name('puesto');
Route::middleware(['auth','role:admin'])->get('/admin/turnos', AdminTurnos::class)->name('admin.turnos');

// Perfil (Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile',  [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile',[ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Auth routes (Breeze)
require __DIR__.'/auth.php';
