<?php

use App\Http\Controllers\FreeQuestionController;

Route::prefix('free')->group(function () {
    Route::post('', [FreeQuestionController::class, 'create'])->name('Вопросы|Создать вопрос со свободным ответом');
    Route::put('{question}', [FreeQuestionController::class, 'update'])->name('Вопросы|Обновить вопрос со свободным ответом')->whereNumber('question');
    Route::delete('{question}', [FreeQuestionController::class, 'delete'])->name('Вопросы|Удалить вопрос вопрос со свободным ответом')->whereNumber('question');
    Route::patch('{question}/hide', [FreeQuestionController::class, 'hide'])->name('Вопросы|Скрыть вопрос со свободным ответом')->whereNumber('question');
    Route::patch('{question}/visible', [FreeQuestionController::class, 'visible'])->name('Вопросы|Сделать видимым вопрос со свободным ответом')->whereNumber('question');
    Route::get('{question}', [FreeQuestionController::class, 'get'])->name('Вопросы|Получить информацию о вопросе со свободным ответом')->whereNumber('question');
});
