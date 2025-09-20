<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Post\CommentController;
use App\Http\Controllers\Post\LikeController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', [HomeController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::prefix('post')->group(function () {
        Route::post('/', [PostController::class, 'create'])->name('post.create');
        Route::post('/{post}/like', [LikeController::class, 'toggle'])->name('post.like');

        Route::post('/{post}/comment', [CommentController::class, 'store'])->name('post.comment');
        Route::get('/{post}/comments', [CommentController::class, 'get'])->name('post.comments.get');

        Route::delete('/{post}', [PostController::class, 'destroy'])->name('post.destroy');
    });
});

require __DIR__ . '/auth.php';
