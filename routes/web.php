<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;



Route::get('/', function () {
    return redirect()->route('login');  
});


// ── Auth ─────────────────────────────────────────────────

// Show Login Page
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

// Login User
Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');

// Show Register Page
Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

// Register User
Route::post('/register', [AuthController::class, 'register'])
    ->name('register.post');

// Logout User
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('profile.update');


// Named routes FIRST form sidebar
Route::get('/tasks/today',     [TaskController::class, 'today'])->name('tasks.today');
Route::get('/tasks/upcoming',  [TaskController::class, 'upcoming'])->name('tasks.upcoming');
Route::get('/tasks/completed', [TaskController::class, 'completed'])->name('tasks.completed');
Route::get('/tasks/overdue',   [TaskController::class, 'overdue'])->name('tasks.overdue');
Route::patch('/tasks/{task}/toggle', [TaskController::class, 'toggle'])->name('tasks.toggle'); // ← add this




// All lisk
Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
// show form
Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
// store new task
Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
// show new task
Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
// show form edit
Route::get('/tasks/{task}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
// for update task 
Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
// for delete task
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');





