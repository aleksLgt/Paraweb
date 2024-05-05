<?php

use App\Http\Controllers\ChoiceQuestionController;

Route::prefix('choice')->group(function () {
    Route::post('', [ChoiceQuestionController::class, 'create'])->name('Вопросы|Создать вопрос с выбором ответа');
    Route::put('{question}', [ChoiceQuestionController::class, 'update'])->name('Вопросы|Обновить вопрос с выбором ответа')->whereNumber('question');
    Route::delete('{question}', [ChoiceQuestionController::class, 'delete'])->name('Вопросы|Удалить вопрос с выбором ответа')->whereNumber('question');
    Route::patch('{question}/hide', [ChoiceQuestionController::class, 'hide'])->name('Вопросы|Скрыть вопрос с выбором ответа')->whereNumber('question');
    Route::patch('{question}/visible', [ChoiceQuestionController::class, 'visible'])->name('Вопросы|Сделать видимым вопрос с выбором ответа')->whereNumber('question');
    Route::get('{question}/unselected-answers', [ChoiceQuestionController::class, 'getUnselectedAnswersOfQuestion'])->name('Вопросы|Получить список ответов на вопрос с выбором ответа, которые никто не выбрал')->whereNumber('question');
    Route::delete('{question}/answer/{answer}', [ChoiceQuestionController::class, 'deleteQuestionAnswer'])->name('Вопросы|Удалить ответ на вопрос с выбором ответа, который никто не выбрал')->whereNumber('question')->whereNumber('answer');
    Route::get('{question}', [ChoiceQuestionController::class, 'get'])->name('Вопросы|Получить информацию о вопросе с выбором ответа')->whereNumber('question');
});
