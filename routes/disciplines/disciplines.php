<?php

use App\Http\Controllers\DisciplineController;

Route::post('', [DisciplineController::class, 'create'])->name('Дисциплина|Добавить дисциплину');
Route::get('', [DisciplineController::class, 'getAll'])->name('Дисциплина|Получить список всех дисциплин');
Route::delete('{discipline}/detach', [DisciplineController::class, 'detach'])->name('Дисциплина|Открепить подразделение от дисциплины')->whereNumber('detach');
Route::delete('{discipline}/detach-all', [DisciplineController::class, 'detachAll'])->name('Дисциплина|Открепить все подразделения от дисциплины')->whereNumber('detach');
Route::post('{discipline}/attach', [DisciplineController::class, 'attach'])->name('Дисциплина|Прикрепить подразделение к дисциплины')->whereNumber('attach');
