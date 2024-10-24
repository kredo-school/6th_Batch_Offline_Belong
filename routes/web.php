<?php

use Illuminate\Support\Facades\Route;



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// トップページのルート
Route::get('/', function () {return view('welcome');});

