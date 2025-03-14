<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;






 Route::get('/chat', [ChatController::class, 'index'])->name('chat');
 Route::post('/chat', [ChatController::class, 'store'])->name('chat.store');