<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;

Route::apiResource('posts', PostController::class);
Route::post('post-update/{id}', [PostController::class, 'update']);
Route::get('export', [PostController::class, 'export'])->name('post.export');
Route::post('import', [PostController::class, 'import'])->name('post.import');
Route::get('import/file', [PostController::class, 'import_file']);


Route::apiResource('users', UserController::class);
Route::post('user-update/{id}', [UserController::class, 'update']);

Route::post('login', [UserController::class, 'login']);
Route::get('logout', [UserController::class, 'logout']);
