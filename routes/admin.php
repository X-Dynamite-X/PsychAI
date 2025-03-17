<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', [UsersController::class, 'index'])->name('admin.users');

    Route::delete('/users/{user}', [UsersController::class, 'destroy']);

    Route::put('/users/{user}', [UsersController::class, 'update']);
});