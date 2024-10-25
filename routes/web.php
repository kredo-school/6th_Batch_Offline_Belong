<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// トップページのルート


Route::prefix('posts')->group(function () {
    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/', [PostController::class, 'store'])->name('posts.store');
    // 追加のルートがあればここに追加...
});

