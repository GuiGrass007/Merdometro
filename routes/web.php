<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MerdaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [MerdaController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/registrar', [MerdaController::class, 'create'])->middleware('auth')->name('merdas.create');
Route::post('/merdas', [MerdaController::class, 'store'])->middleware('auth')->name('merdas.store');
Route::get('/feed', [MerdaController::class, 'feed'])->middleware('auth')->name('merdas.feed');
Route::post('/merdas/{merda}/votar', [MerdaController::class, 'votar'])->middleware('auth')->name('merdas.votar');
Route::get('/meu-historico', [MerdaController::class, 'historico'])->middleware(['auth', 'verified'])->name('meu-historico');
Route::post('/merdas/{merda}/comentar', [MerdaController::class, 'comentar'])->middleware('auth')->name('merdas.comentar');
Route::get('/ranking', [MerdaController::class, 'ranking'])->middleware(['auth', 'verified'])->name('ranking');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
