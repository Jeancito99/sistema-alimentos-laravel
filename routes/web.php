<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PredictionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/prediccion', [PredictionController::class, 'showForm']);
Route::post('/prediccion', [PredictionController::class, 'process'])->name('prediccion.process');