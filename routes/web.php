<?php

 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
 

Route::get('/test', function () {
    return view('test');
})->name("test");
Route::get('/', [HomeController::class, 'index'])->name("home");
require __DIR__ . '/auth.php';
require __DIR__.'/chatAi.php';
require __DIR__.'/admin.php';
require __DIR__."/specialist.php";
require __DIR__.'/doctor.php';