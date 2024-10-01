<?php

use App\Http\Controllers\Admin\Dashboard\IndexController as DashboardIndexController;
use App\Http\Controllers\Admin\Task\ConfirmDeleteController as TaskConfirmDeleteController;
use App\Http\Controllers\Admin\Task\CreateController as TaskCreateController;
use App\Http\Controllers\Admin\Task\DestroyController as TaskDestroyController;
use App\Http\Controllers\Admin\Task\EditController as TaskEditController;
use App\Http\Controllers\Admin\Task\IndexController as TaskIndexController;
use App\Http\Controllers\Admin\Task\StoreController as TaskStoreController;
use App\Http\Controllers\Admin\Task\UpdateController as TaskUpdateController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', function () {
    return redirect()->route('admin_panel::dashboard');
});

Route::as('admin_panel::')->prefix('admin-panel')->middleware('auth')->group(function () {
    Route::get('/', DashboardIndexController::class)->name('dashboard');

    Route::as('tasks::')->prefix('tasks')->group(function () {
        Route::get('/', TaskIndexController::class)->name('index');
        Route::get('/create', TaskCreateController::class)->name('create');
        Route::post('/store', TaskStoreController::class)->name('store');
        Route::get('/{task}/edit', TaskEditController::class)->name('edit');
        Route::patch('/{task}', TaskUpdateController::class)->name('update');
        Route::get('/{task}/confirm_delete', TaskConfirmDeleteController::class)->name('confirm_delete');
        Route::delete('/{task}', TaskDestroyController::class)->name('destroy');
    });
});
