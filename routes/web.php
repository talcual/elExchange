<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/monitor', [App\Http\Controllers\MonitorController::class, 'index'])->name('monitor');
Route::post('/create_monitor', [App\Http\Controllers\MonitorController::class, 'create'])->name('create_monitor');
Route::get('/delete/{id}', [App\Http\Controllers\MonitorController::class, 'delete'])->name('delete_monitor');