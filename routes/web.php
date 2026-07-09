<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PredictionController;
use League\Uri\Http;

Route::get('/', function () {
    return view('prediccion');
});

Route::get('/prediccion', [PredictionController::class, 'showForm']);
Route::post('/prediccion', [PredictionController::class, 'process'])->name('prediccion.process');

// Ruta para visualizar el Dashboard
Route::get('/dashboard', [PredictionController::class, 'dashboard'])->name('dashboard');