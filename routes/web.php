<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilesController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\FollowerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostLikeController; // Add this line
use App\Mail\NewUserWelcomeMail;

// Authentication Routes
Auth::routes();

// Home Route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Post Routes
Route::prefix('posts')->group(function () {
    Route::get('/', [PostsController::class, 'index'])->name('posts.index');
    Route::get('/create', [PostsController::class, 'create'])->name('posts.create');
    Route::post('/', [PostsController::class, 'store'])->name('posts.store');
    Route::get('/{post}', [PostsController::class, 'show'])->name('posts.show');
    Route::get('/{post}/edit', [PostsController::class, 'edit'])->name('posts.edit');
    Route::patch('/{post}', [PostsController::class, 'update'])->name('posts.update');
    Route::delete('/{post}', [PostsController::class, 'destroy'])->name('posts.destroy');
    Route::post('/{post}/like', [PostLikeController::class, 'toggleLike'])->name('posts.like');
})->middleware('auth');

// Profile Routes
Route::prefix('profile')->group(function () {
    // Most specific routes first
    Route::get('/{user}/change-password', [ProfilesController::class, 'showChangePasswordForm'])
        ->name('profile.change-password');
    Route::patch('/{user}/change-password', [ProfilesController::class, 'updatePassword'])
        ->name('profile.update-password');
    Route::get('/{user}/edit', [ProfilesController::class, 'edit'])
        ->name('profile.edit');

    // Then more general routes
    Route::patch('/{user}', [ProfilesController::class, 'update'])
        ->name('profile.update');
    Route::get('/{user}', [ProfilesController::class, 'index'])
        ->name('profile.show');
})->middleware('auth');

// Follow/Unfollow Routes
Route::middleware('auth')->group(function () {
    Route::post('/follow/{user}', [FollowerController::class, 'follow'])->name('follow');
    Route::delete('/unfollow/{user}', [FollowerController::class, 'unfollow'])->name('unfollow');
});
