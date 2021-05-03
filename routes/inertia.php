<?php

use Illuminate\Support\Facades\Route;
use ScadaUnity\Money\Http\Controllers\Inertia\MoneyController;
use ScadaUnity\Money\Http\Controllers\Inertia\AccountController;
use ScadaUnity\Money\Money;

Route::group(['middleware' => config('money.middleware', ['web'])], function () {

    Route::group(['middleware' => ['auth', 'verified']], function () {
        // Dashboard
        Route::get('/money', [MoneyController::class, 'show'])->name('money');
        Route::get('/money/category', [MoneyController::class, 'category'])->name('money.category');

        // Resource Accounts
        Route::get('/money/account', [AccountController::class, 'index'])->name('money.account');
        Route::post('/money/account/store', [AccountController::class, 'store'])->name('money.account.store');
        Route::delete('/money/account/{account}', [AccountController::class, 'destroy'])->name('money.account.destroy');
    });
});
