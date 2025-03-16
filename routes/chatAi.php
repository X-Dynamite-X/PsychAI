<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;






 Route::get('/chat', [ChatController::class, 'index'])->name('chat');
 Route::get('/chat/{roomChat}', [ChatController::class, 'show'])->name('chat.show');
 Route::post('/chat/{roomChat}', [ChatController::class, 'store'])->name('chat.store');