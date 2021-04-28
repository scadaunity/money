<?php

use Illuminate\Support\Facades\Route;
use ScadaUnity\Money\Http\Controllers\Inertia\MoneyController;
use ScadaUnity\Money\Money;

Route::group(['middleware' => config('money.middleware', ['web'])], function () {

    Route::group(['middleware' => ['auth', 'verified']], function () {
        // Dashboard
        Route::get('/money', [MoneyController::class, 'show'])->name('money');
        Route::get('/money/category', [MoneyController::class, 'category'])->name('money.category');
        Route::get('/money/account', [MoneyController::class, 'account'])->name('money.account');
    });
});
