<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FooterController;



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



// トップページのルート

Route::group(['prefix' => 'footer', 'as' => 'footer.'], function() {
    Route::get('/faq', [App\Http\Controllers\FooterController::class, 'index'])->name('faq');
    Route::get('/about', [App\Http\Controllers\FooterController::class, 'about'])->name('about');
});


Route::prefix('posts')->group(function () {
    Route::get('/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/', [PostController::class, 'store'])->name('posts.store');
    // 追加のルートがあればここに追加...
});






