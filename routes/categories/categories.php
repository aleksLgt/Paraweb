<?php

use App\Http\Controllers\SurveyCategoryController;

Route::post('', [SurveyCategoryController::class, 'create'])->name('Категории опросов|Создать новую категорию опросов');
Route::get('', [SurveyCategoryController::class, 'getAll'])->name('Категории опросов|Получить все категории опросов');
