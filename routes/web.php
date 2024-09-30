<?php

use App\Http\Controllers\Admin\Task\CreateController as TaskCreateController;
use App\Http\Controllers\Admin\Task\DestroyController as TaskDestroyController;
use App\Http\Controllers\Admin\Task\EditController as TaskEditController;
use App\Http\Controllers\Admin\Task\IndexController as TaskIndexController;
use App\Http\Controllers\Admin\Task\StoreController as TaskStoreController;
use App\Http\Controllers\Admin\Task\UpdateController as TaskUpdateController;
use Illuminate\Support\Facades\Route;

Route::as('admin_panel::')->prefix('admin-panel')->group(function () {
    Route::as('tasks::')->group(function () {
        Route::get('/', TaskIndexController::class)->name('index');
        Route::get('/create', TaskCreateController::class)->name('create');
        Route::post('/store', TaskStoreController::class)->name('store');
        Route::get('/{task}/edit', TaskEditController::class)->name('edit');
        Route::patch('/{task}', TaskUpdateController::class)->name('update');
        Route::delete('/{task}', TaskDestroyController::class)->name('destroy');
    });
});
