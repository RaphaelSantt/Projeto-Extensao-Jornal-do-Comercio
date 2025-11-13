<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Noticias_DestaquesController;
use App\Http\Controllers\AnaliseController;

Route::get('/', [AnaliseController::class, 'dashboard'])->name('dashboard');
Route::post('/gerar', [AnaliseController::class, 'gerar'])->name('gerar');
Route::get('/revisao/{id}', [AnaliseController::class, 'revisao'])->name('revisao');
Route::post('/revisao/{id}/aprovar', [AnaliseController::class, 'aprovar'])->name('aprovar');
