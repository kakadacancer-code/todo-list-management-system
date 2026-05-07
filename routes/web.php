<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\EditTaskController;


Route::get('/', function () {
    return view('welcome');
});


Route::resource('tasks', TaskController::class);
Route::get('/edit-task', [EditTaskController::class, 'index'])->name('edit-task');
Route::post('/add-task', [EditTaskController::class, 'store'])->name('edit-task.store');
