<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
 use App\Http\Controllers\VideoController;

Route::get('/test', function () {
    return view('test');
})->name("test");



//  Route::get('/chat', [HomeController::class, 'chat'])->name('chat');

Route::get('/', [HomeController::class, 'index'])->name("home");
require __DIR__ . '/auth.php';
require __DIR__.'/chatAi.php';
require __DIR__.'/admin.php';
require __DIR__.'/doctor.php';


