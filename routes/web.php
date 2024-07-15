<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\PostsController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/p/create', [PostsController::class, 'create']);
Route::post('/p', [PostsController::class, 'store']);


Route::get('/profile/{user}', [ProfilesController::class, 'index'])->name('profile.show');