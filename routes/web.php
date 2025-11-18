<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;

Route::get('/', function () {
    return view('welcome');
});

// ROTA PÚBLICA - Qualquer um pode ver itens para receber
Route::get('/doacoes', [DonationController::class, 'publicIndex'])
    ->name('donations.public');

// Rotas protegidas (só usuários logados)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('donations.public');
    })->name('dashboard');

    Route::resource('donations', DonationController::class);
    Route::post('/donations/{id}/receber', [DonationController::class, 'receber'])
        ->name('donations.receber');
});

require __DIR__ . '/auth.php';
