<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfilesController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [ProfilesController::class, 'index'])->name('home');
