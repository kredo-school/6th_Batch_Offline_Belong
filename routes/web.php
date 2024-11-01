<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SuccessController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RuleController;

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


    Route::get('/payment', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store'); // POSTルート

    Route::get('/rules', [RuleController::class, 'rules'])->name('rules.page');


    Route::get('/success', [SuccessController::class, 'index'])->name('success.page'); // 成功ページのルート



    // Posts routes
    Route::prefix('posts')->group(function () {
        Route::get('/create', [PostController::class, 'create'])->name('posts.create'); // Route for creating a new post
        Route::post('/', [PostController::class, 'store'])->name('posts.store'); // Route for storing a new post
        Route::get('/{id}', [PostController::class, 'show'])->name('posts.show'); // Route for showing a single post


        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/{post}', [PostController::class, 'update'])->name('posts.update');

        Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/posts/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::get('/posts/schedule', [PostController::class, 'index'])->name('posts.schedule');

        Route::delete('/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
    });

     // コメント関連のルート
     Route::group(['prefix' => 'comment', 'as' => 'comment.'], function () {
        Route::post('/{post_id}/store', [CommentController::class, 'store'])->name('store');
        Route::delete('/{id}', [CommentController::class, 'destroy'])->name('destroy');
    });

    // Bookings routes
    Route::prefix('bookings')->group(function () {
        Route::get('/{post}', [BookController::class, 'show'])->name('bookings.show'); // 予約ページの表示
        Route::post('/bookings/{post}', [BookController::class, 'store'])->name('bookings.store');
        Route::delete('/{post}', [BookController::class, 'destroy'])->name('bookings.destroy'); // 予約キャンセル
    });

    // Footer routes
    Route::group(['prefix' => 'footer', 'as' => 'footer.'], function() {
        Route::get('/faq', [FooterController::class, 'index'])->name('faq');
        Route::get('/about', [FooterController::class, 'about'])->name('about');
    });

});






















