<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('login', [AuthController::class, 'login'])->name('Авторизация|Вход');
Route::post('logout', [AuthController::class, 'logout'])->name('Авторизация|Выход');
Route::post('refresh', [AuthController::class, 'refresh'])->name('Авторизация|Обновить токен');
Route::post('me', [AuthController::class, 'me'])->name('Авторизация|Информация о пользователе');
