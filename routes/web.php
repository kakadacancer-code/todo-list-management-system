<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\AuthController;


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
Route::resource('tasks', TaskController::class); 

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginStore'])->name('login.store');

Route::get('/register', [AuthController::class, 'signup'])->name('register');
Route::post('/register', [AuthController::class, 'signupStore'])->name('register.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');