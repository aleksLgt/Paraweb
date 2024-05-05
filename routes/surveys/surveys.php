<?php

use App\Http\Controllers\SurveyController;
use Illuminate\Support\Facades\Route;

Route::post('', [SurveyController::class, 'create'])->name('Опрос|Создать опрос');
Route::get('', [SurveyController::class, 'getAll'])->name('Опрос|Список всех опросов');
Route::get('{survey}/questions', [SurveyController::class, 'getQuestions'])->name('Опрос|Список всех вопросов опроса')->whereNumber('survey');
Route::get('{survey}/statistics', [SurveyController::class, 'getStatisticsBySurvey'])->name('Опрос|Статистика ответов по опросу')->whereNumber('survey');
Route::get('me', [SurveyController::class, 'getMeAll'])->name('Опрос|Список всех опросов авторизованного пользователя');
Route::get('{survey}', [SurveyController::class, 'get'])->name('Опрос|Отчет по опросу')->whereNumber('survey');
Route::put('{survey}', [SurveyController::class, 'update'])->name('Опрос|Обновить информацию о запросе')->whereNumber('survey');
Route::patch('{survey}/active', [SurveyController::class, 'active'])->name('Опрос|Сделать опрос активным')->whereNumber('survey');
Route::patch('{survey}/inactive', [SurveyController::class, 'inactive'])->name('Опрос|Сделать опрос неактивным')->whereNumber('survey');
Route::patch('{survey}/hide', [SurveyController::class, 'hide'])->name('Опрос|Скрыть опрос')->whereNumber('survey');
Route::patch('{survey}/visible', [SurveyController::class, 'visible'])->name('Опрос|Отобразить опрос')->whereNumber('survey');
