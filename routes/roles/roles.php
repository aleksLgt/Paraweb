<?php

use App\Http\Controllers\RoleController;

Route::get('', [RoleController::class, 'getAll'])->name('Роли|Список всех ролей');
Route::post('{role}/permissions', [RoleController::class, 'addPermissions'])->name('Роли|Выдать роли права на действия')->whereNumber('role');
