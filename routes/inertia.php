<?php

use Illuminate\Support\Facades\Route;
use ScadaUnity\Money\Http\Controllers\Inertia\MoneyController;
use ScadaUnity\Money\Http\Controllers\Inertia\AccountController;
use ScadaUnity\Money\Http\Controllers\Inertia\CategoryController;
use ScadaUnity\Money\Http\Controllers\Inertia\TransactionsController;
use ScadaUnity\Money\Money;

Route::group(['middleware' => config('money.middleware', ['web'])], function () {

    Route::group(['middleware' => ['auth', 'verified']], function () {
        // Dashboard
        Route::get('/money', [MoneyController::class, 'show'])->name('money');
        //Route::get('/money/category', [MoneyController::class, 'category'])->name('money.category');

        // Resource Accounts
        Route::get('/money/account', [AccountController::class, 'index'])->name('money.account');
        Route::post('/money/account/store', [AccountController::class, 'store'])->name('money.account.store');
        Route::put('/money/account/{account}', [AccountController::class, 'update'])->name('money.account.update');
        Route::delete('/money/account/{account}', [AccountController::class, 'destroy'])->name('money.account.destroy');
        // Resource Category
        Route::get('/money/category', [CategoryController::class, 'index'])->name('money.category');
        Route::post('/money/category/store', [CategoryController::class, 'store'])->name('money.category.store');
        Route::put('/money/category/{category}', [CategoryController::class, 'update'])->name('money.category.update');
        Route::delete('/money/category/{category}', [CategoryController::class, 'destroy'])->name('money.category.destroy');
        // Resource Transactions
        Route::get('/money/transactions', [TransactionsController::class, 'index'])->name('money.transactions');
        Route::post('/money/transactions/store', [TransactionsController::class, 'store'])->name('money.transactions.store');
        Route::put('/money/transactions/{transaction}', [TransactionsController::class, 'update'])->name('money.transactions.update');
        Route::delete('/money/transactions/{transaction}', [TransactionsController::class, 'destroy'])->name('money.transactions.destroy');
    });
});
