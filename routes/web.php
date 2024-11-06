<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowerController;
use App\Mail\NewUserWelcomeMail;
use App\Http\Controllers\HomeController;

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/posts', [PostsController::class,'index']);
Route::get('/p/create', [PostsController::class, 'create']);
Route::get('/p/{post}', [PostsController::class, 'show']);
Route::post('/p', [PostsController::class, 'store']);


Route::get('/profile/{user}', [ProfilesController::class, 'index'])->name('profile.show');
Route::get('/profile/{user}/edit', [ProfilesController::class, 'edit'])->name('profile.edit');
Route::patch('/profile/{user}',[ProfilesController::class, 'update'])->name('profile.update');


Route::post('/follow/{user}', [FollowerController::class, 'follow'])->name('follow');
Route::delete('/unfollow/{user}', [FollowerController::class, 'unfollow'])->name('unfollow');

