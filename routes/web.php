<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SuccessController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RuleController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Admin\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AccountController;

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

        Route::get('/category/play', [PostController::class, 'play'])->name('category.play');
        Route::get('/category/watch-and-learn', [PostController::class, 'watchAndLearn'])->name('category.watch-and-learn');
        Route::get('/category/eat', [PostController::class, 'eat'])->name('category.eat');
        Route::get('/category/others', [PostController::class, 'others'])->name('category.others');

        Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');

        Route::delete('/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

    });


     Route::group(['prefix' => 'comment', 'as' => 'comment.'], function () {
        Route::post('/{post_id}/store', [CommentController::class, 'store'])->name('store');
        Route::delete('/{id}', [CommentController::class, 'destroy'])->name('destroy');
    });

    // Bookings routes
    Route::prefix('bookings')->group(function () {
        Route::get('/{post}', [BookController::class, 'show'])->name('bookings.show'); // 予約ページの表示
        Route::post('/bookings/{post}', [BookController::class, 'store'])->name('bookings.store');
        Route::get('/posts/booked', [BookController::class, 'index'])->name('posts.booked');
        Route::get('/posts/attended', [BookController::class, 'attendedPosts'])->name('posts.attended');
        Route::delete('/posts/{id}/cancel', [BookController::class, 'destroy'])->name('posts.cancel');


    });

    // Footer routes
    Route::group(['prefix' => 'footer', 'as' => 'footer.'], function() {
        Route::get('/faq', [FooterController::class, 'index'])->name('faq');
        Route::get('/about', [FooterController::class, 'about'])->name('about');
    });

    // Profile routes
    Route::get('/profile/{id}/show', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/{id}/update', [ProfileController::class, 'update'])->name('profile.update'); // Include ID
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    // Account routes
    Route::get('/account/{id}/show', [accountController::class, 'show'])->name('account.show');
    Route::post('/account/{id}/update', [accountController::class, 'update'])->name('account.update'); // Include ID
    Route::get('/account/edit', [accountController::class, 'edit'])->name('account.edit');
});


    Route::middleware(['auth'])->group(function () {
        Route::get('/posts/{post}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
        Route::post('/posts/{post}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
        Route::get('/posts/{post}/reviews', [ReviewController::class, 'index'])->name('reviews.index');

    });

    Route::get('/search-users', [UserController::class, 'search'])->name('posts.search.user');

    // 管理者ページのルート
    Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'admin'], function () {
        // 管理者のユーザー管理
        Route::get('/users', [UsersController::class, 'index'])->name('users');
        Route::get('/users/search', [UsersController::class, 'search'])->name('users.search');

        // 管理者の投稿管理
        Route::get('/posts', [PostsController::class, 'index'])->name('posts');
});






















