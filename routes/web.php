<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\LoanDetailsController::class, 'index'])->middleware('auth');
Route::post('/process-data', [App\Http\Controllers\EMIController::class, 'process'])->name('process.data')->middleware('auth');
