<?php

use App\Http\Controllers\ConversionController;
use App\Http\Controllers\ConversionPopularController;
use Illuminate\Support\Facades\Route;

Route::prefix('conversions')
    ->name('conversions.')
    ->controller(ConversionController::class)
    ->group(function () {
        Route::get('', 'index')->name('index');
        Route::post('', 'store')->name('store');
        Route::get('popular', ConversionPopularController::class)->name('popular');
        Route::get('{conversion}', 'show')->name('show');
    });
