<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\HomeController;

// Route::get('/', fn () => view('welcome'));

Route::get('/greetings', function () {
    return view('welcome');
});


Route::get('/', [HomeController::class, 'index']);

Route::resource('jobs', JobController::class);
