<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FooterController;

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    // Posts routes
    Route::prefix('posts')->group(function () {
        Route::get('/create', [PostController::class, 'create'])->name('posts.create'); // Route for creating a new post
        Route::post('/', [PostController::class, 'store'])->name('posts.store'); // Route for storing a new post
        Route::get('/{id}', [PostController::class, 'show'])->name('posts.show'); // Route for showing a single post
        Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::get('/posts/schedule', [PostController::class, 'index'])->name('posts.schedule');
        Route::delete('/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

    });

    Route::group(['prefix' => 'footer', 'as' => 'footer.'], function() {
        Route::get('/faq', [App\Http\Controllers\FooterController::class, 'index'])->name('faq');
        Route::get('/about', [App\Http\Controllers\FooterController::class, 'about'])->name('about');
    });



});


















