<?php

use Illuminate\Support\Facades\Route;
use ScadaUnity\Money\Http\Controllers\Inertia\DashboardController;
use ScadaUnity\Money\Money;

Route::group(['middleware' => config('money.middleware', ['web'])], function () {

    Route::group(['middleware' => ['auth', 'verified']], function () {
        // User & Profile...
        Route::get('/money/dashboard', [DashboardController::class, 'show'])->name('money');


        /* API...
        if (Money::createCategory()) {
            Route::get('/user/api-tokens', [ApiTokenController::class, 'index'])->name('api-tokens.index');
            Route::post('/user/api-tokens', [ApiTokenController::class, 'store'])->name('api-tokens.store');
            Route::put('/user/api-tokens/{token}', [ApiTokenController::class, 'update'])->name('api-tokens.update');
            Route::delete('/user/api-tokens/{token}', [ApiTokenController::class, 'destroy'])->name('api-tokens.destroy');
        }
        */


    });
});
