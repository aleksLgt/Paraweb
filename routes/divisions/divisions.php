<?php

use App\Http\Controllers\DivisionController;

Route::post('', [DivisionController::class, 'create'])->name('Дисциплина|Добавить подразделение');
Route::get('', [DivisionController::class, 'getAll'])->name('Подразделение|Получить список всех подразделений');
