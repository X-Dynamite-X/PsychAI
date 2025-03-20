<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{ArticleController, VideoController};
// use App\Http\Controllers\VideoController;




Route::group(['middleware' => ['auth', 'role:doctor||admin']], function () {



    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::get("/articles/{article}/edit", [ArticleController::class, 'edit'])->name('articles.edit');
    Route::post('/video', [VideoController::class, 'store'])->name('video.store');
    Route::get('/video/create', [VideoController::class, 'create'])->name('video.create');
    Route::delete('/video/{video}', [VideoController::class, 'destroy'])->name('video.destroy');
    Route::put('/video/{video}', [VideoController::class, 'update'])->name('video.update');
    Route::get("/video/{video}/edit", [VideoController::class, 'edit'])->name('video.edit');
});

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
Route::get('/articles/category/{category}', [ArticleController::class, 'category'])->name('articles.category');
Route::post('/articles/{article}/comment', [ArticleController::class, 'storeComment'])->name('articles.comment.store');

Route::get('/video', [VideoController::class, 'index'])->name('video.index');
Route::get('/video/{video}', [VideoController::class, 'show'])->name('video.show');
Route::get('/video/category/{category}', [VideoController::class, 'category'])->name('video.category');
Route::post('/video/{video}/comment', [VideoController::class, 'storeComment'])->name('video.comment.store');
