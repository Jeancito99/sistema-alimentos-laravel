<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PredictionController;

Route::get('/', function () {
    return view('prediccion');
});

Route::get('/prediccion', [PredictionController::class, 'showForm'])->name('prediccion');
Route::post('/prediccion', [PredictionController::class, 'process'])->name('post_prediccion');

Route::get('/dashboard', [PredictionController::class, 'dashboard'])->name('dashboard');