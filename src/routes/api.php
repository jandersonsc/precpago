<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\StatisticsController;

Route::prefix('transactions')->controller(TransactionsController::class)->group(function () {
    Route::post('/', 'create');
    Route::delete('/', 'delete');
});

Route::get('statistics', [StatisticsController::class, 'getAll']);
