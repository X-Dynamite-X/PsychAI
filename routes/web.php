<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

Route::get('/', function () {
    return view('home');
})->name("home");

Route::get('/test', function () {
    return view('test');
})->name("test");

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::view('category', 'category')
    ->name('category');
Route::view('video', 'video')
    ->name('video');
Route::view('article', 'article')
    ->name('article');

require __DIR__ . '/auth.php';
require __DIR__.'/chatAi.php';
require __DIR__.'/admin.php';
