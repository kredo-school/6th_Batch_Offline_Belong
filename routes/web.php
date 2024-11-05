<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FooterController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SuccessController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\RuleController;
<<<<<<< HEAD
use App\Http\Controllers\ProfileController;
=======

use App\Http\Controllers\ReviewController;


use App\Http\Controllers\ProfileController;

>>>>>>> 4592502906e58c552f08f8713e7f765112325b25
use App\Http\Controllers\ReviewController;


Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::get('/payment', [PaymentController::class, 'show'])->name('payment.show');
    Route::post('/payment', [PaymentController::class, 'store'])->name('payment.store'); // POST route

    Route::get('/rules', [RuleController::class, 'rules'])->name('rules.page');
    Route::get('/success', [SuccessController::class, 'index'])->name('success.page'); // Success page route

    // Posts routes
    Route::prefix('posts')->group(function () {
        Route::get('/create', [PostController::class, 'create'])->name('posts.create'); // Create a new post
        Route::post('/', [PostController::class, 'store'])->name('posts.store'); // Store a new post
        Route::get('/{post}', [PostController::class, 'show'])->name('posts.show'); // Show a single post
        Route::get('/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');
        Route::put('/{post}', [PostController::class, 'update'])->name('posts.update');
        Route::get('/schedule', [PostController::class, 'index'])->name('posts.schedule'); // Schedule posts

        Route::get('/category/play', [PostController::class, 'play'])->name('category.play');
        Route::get('/category/watch-and-learn', [PostController::class, 'watchAndLearn'])->name('category.watch-and-learn');
        Route::get('/category/eat', [PostController::class, 'eat'])->name('category.eat');
        Route::get('/category/others', [PostController::class, 'others'])->name('category.others');

<<<<<<< HEAD
        Route::delete('/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
=======
        Route::delete('/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

>>>>>>> 2f26ca9e579c8532ac8f9ceb558ff369a5cd2378
    });

    // Comment routes
    Route::group(['prefix' => 'comment', 'as' => 'comment.'], function () {
        Route::post('/{post_id}/store', [CommentController::class, 'store'])->name('store');
        Route::delete('/{id}', [CommentController::class, 'destroy'])->name('destroy');
    });

    // Bookings routes
    Route::prefix('bookings')->group(function () {
<<<<<<< HEAD
        Route::get('/{post}', [BookController::class, 'show'])->name('bookings.show'); // Show booking page
        Route::post('/{post}', [BookController::class, 'store'])->name('bookings.store'); // Store booking
        Route::delete('/{post}', [BookController::class, 'destroy'])->name('bookings.destroy'); // Cancel booking
=======
        Route::get('/{post}', [BookController::class, 'show'])->name('bookings.show'); // 予約ページの表示
        Route::post('/bookings/{post}', [BookController::class, 'store'])->name('bookings.store');
        Route::get('/posts/booked', [BookController::class, 'index'])->name('posts.booked');

>>>>>>> 2f26ca9e579c8532ac8f9ceb558ff369a5cd2378
    });

    // Footer routes
    Route::group(['prefix' => 'footer', 'as' => 'footer.'], function() {
        Route::get('/faq', [FooterController::class, 'index'])->name('faq');
        Route::get('/about', [FooterController::class, 'about'])->name('about');
    });
<<<<<<< HEAD

    // Profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

    // Reviews routes
    Route::get('/posts/{post}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
    Route::post('/posts/{post}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
    Route::get('/posts/{post}/reviews', [ReviewController::class, 'index'])->name('reviews.index');
});
=======
});


    Route::middleware(['auth'])->group(function () {
        Route::get('/posts/{post}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
        Route::post('/posts/{post}/reviews', [ReviewController::class, 'store'])->name('reviews.store');
        Route::get('/posts/{post}/reviews', [ReviewController::class, 'index'])->name('reviews.index');

    });
























>>>>>>> 4592502906e58c552f08f8713e7f765112325b25
