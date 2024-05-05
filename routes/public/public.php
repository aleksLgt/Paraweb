<?php

use App\Http\Controllers\SurveyController;

Route::get('{survey}/questions', [SurveyController::class, 'getPublicQuestions'])->name('Опрос|Список всех вопросов опроса c вариантами ответов')->whereNumber('survey');
Route::post('{survey}/answers', [SurveyController::class, 'answerQuestions'])->name('Опрос|Ответить на вопросы опроса')->whereNumber('survey');
