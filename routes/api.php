<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * 
 * Api endpoints
 *  
 */


Route::post('/login', [App\Http\Controllers\Api\LoginController::class, 'login']);
Route::post('/conversion', [App\Http\Controllers\ExchangeController::class, 'conversion'])->middleware('auth:sanctum');
Route::post('/historial', [App\Http\Controllers\ExchangeController::class, 'historial'])->middleware('auth:sanctum');
Route::post('/rates', [App\Http\Controllers\ExchangeController::class, 'rates'])->middleware('auth:sanctum');