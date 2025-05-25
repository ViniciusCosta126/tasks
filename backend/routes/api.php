<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\ColunaController;
use Illuminate\Support\Facades\Route;


Route::apiResource('boards', BoardController::class);
Route::apiResource('colunas', ColunaController::class);