<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Clientes;
use App\Livewire\Pedidos;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return \Illuminate\Support\Facades\Auth::check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/clientes', Clientes::class)
    ->middleware('auth')
    ->name('clientes');

Route::get('/pedidos', Pedidos::class)
    ->middleware('auth')
    ->name('pedidos');

require __DIR__.'/auth.php';
