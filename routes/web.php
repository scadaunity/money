<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use ScadaUnity\Money\Http\Controllers\Inertia\DashboardController;

/*
Route::get('money', function(){
  return Inertia::render('Money/dashboard');
});
*/

Route::get('/money', [DashboardController::class, 'show'])->name('money.dashboard');
