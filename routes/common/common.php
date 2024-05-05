<?php

use App\Http\Controllers\CommonController;

Route::prefix('year-intervals')->group(function () {
    Route::get('', [CommonController::class, 'getYearIntervals'])->name('Общие|Получить список годовых интервалов');
});
