<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Transactions;
use App\Http\Controllers\Statistics;

Route::prefix('transactions')->controller(Transactions::class)->group(function () {
    Route::post('/', 'create');
    Route::delete('/{id}', 'delete');
});

Route::get('statistics', [Statistics::class, 'getAll']);
