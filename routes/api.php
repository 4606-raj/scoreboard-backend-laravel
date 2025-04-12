<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']);

Route::middleware(['auth:sanctum'])->post('/matches', [\App\Http\Controllers\TournamentController::class, 'store']);
Route::middleware(['auth:sanctum'])->get('/matches', [\App\Http\Controllers\TournamentController::class, 'index']);
Route::middleware(['auth:sanctum'])->get('/matches/{id}', [\App\Http\Controllers\TournamentController::class, 'show']);
Route::middleware(['auth:sanctum'])->put('/matches/{id}', [\App\Http\Controllers\TournamentController::class, 'update']);