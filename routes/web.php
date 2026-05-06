<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::get('/', function () {
    return view('welcome');
});

// Named routes FIRST
Route::get('/tasks/today',     [TaskController::class, 'today'])->name('tasks.today');
Route::get('/tasks/upcoming',  [TaskController::class, 'upcoming'])->name('tasks.upcoming');
Route::get('/tasks/completed', [TaskController::class, 'completed'])->name('tasks.completed');
Route::get('/tasks/overdue',   [TaskController::class, 'overdue'])->name('tasks.overdue');
Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle'); // ← add this

// Resource LAST
Route::resource('tasks', TaskController::class); // ← make sure this is here