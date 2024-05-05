<?php

use App\Http\Controllers\PointQuestionController;

Route::prefix('point')->group(function () {
    Route::post('', [PointQuestionController::class, 'create'])->name('Вопросы|Создать вопрос с оценкой в баллах');
    Route::put('{question}', [PointQuestionController::class, 'update'])->name('Вопросы|Обновить вопрос с оценкой в баллах')->whereNumber('question');
    Route::delete('{question}', [PointQuestionController::class, 'delete'])->name('Вопросы|Удалить вопрос с оценкой в баллах')->whereNumber('question');
    Route::patch('{question}/hide', [PointQuestionController::class, 'hide'])->name('Вопросы|Скрыть вопрос с оценкой в баллах')->whereNumber('question');
    Route::patch('{question}/visible', [PointQuestionController::class, 'visible'])->name('Вопросы|Сделать видимым вопрос с оценкой в баллах')->whereNumber('question');
    Route::get('{question}', [PointQuestionController::class, 'get'])->name('Вопросы|Получить информацию о вопросе с оценкой в баллах')->whereNumber('question');
});
