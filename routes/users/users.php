<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('', [UserController::class, 'getAll'])->name('Пользователи|Список всех пользователей');
Route::get('survey-admins', [UserController::class, 'getSurveyAdmins'])->name('Пользователи|Список всех администраторов опросов');
Route::get('survey-operators', [UserController::class, 'getSurveyOperators'])->name('Пользователи|Список всех операторов опросов');
Route::post('', [UserController::class, 'create'])->name('Пользователи|Создать пользователя');
Route::put('{user}', [UserController::class, 'update'])->name('Пользователи|Обновить информацию о пользователе')->whereNumber('user');
