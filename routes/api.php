<?php

use App\Http\Controllers\CreateTaskController;
use App\Http\Controllers\DeleteTaskController;
use App\Http\Controllers\TaskListController;
use App\Http\Controllers\UpdateTaskController;
use Illuminate\Support\Facades\Route;

Route::get('/tasks', TaskListController::class)->name('api.task.list');
Route::post('/tasks', CreateTaskController::class)->name('api.task.create');
Route::put('/tasks/{id}', UpdateTaskController::class)->whereNumber('id')->name('api.task.update');
Route::delete('/tasks/{id}', DeleteTaskController::class)->whereNumber('id')->name('api.task.delete');