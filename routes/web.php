<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\GreetController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'show']);

Route::get('/demo', [DemoController::class, 'index']);
Route::get('demo/{name}', [DemoController::class, 'greet']);

Route::get('/greet', GreetController::class);

Route::resource('posts', PostController::class);