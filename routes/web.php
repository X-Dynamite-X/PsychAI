<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\VideoController;

Route::get('/', [HomeController::class, 'index'])->name("home");

Route::get('/test', function () {
    return view('test');
})->name("test");

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::view('category', 'category')
    ->name('category');

Route::view('article', 'article')
    ->name('article');
Route::resource('video', VideoController::class);
require __DIR__ . '/auth.php';
require __DIR__.'/chatAi.php';
require __DIR__.'/admin.php';