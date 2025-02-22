<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\GreetController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\BladeTestController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);

Route::get('/demo', [DemoController::class, 'index']);
Route::get('demo/{name}', [DemoController::class, 'greet']);

Route::get('/greet', GreetController::class);

Route::resource('posts', PostController::class);
Route::resource('tasks', TaskController::class);
Route::patch('tasks/{task}/toggle-complete', [TaskController::class, 'toggleComplete'])->name('tasks.toggle-complete');

Route::get('/bladetest', [BladeTestController::class, 'index']);