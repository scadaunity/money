<?php

use Illuminate\Support\Facades\Route;
use ScadaUnity\Money\Http\Controllers\Livewire\MoneyController;
use ScadaUnity\Money\Money;

Route::group(['middleware' => config('money.middleware', ['web'])], function () {

    Route::group(['middleware' => ['auth', 'verified']], function () {
        // Dashboard
        Route::get('/money', [MoneyController::class, 'show'])->name('money');
    });
});
