<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UsersController;


Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', [UsersController::class, 'index'])->name('admin.users');
    Route::get('/users/{user}', [UsersController::class, 'show'])->name('admin.users.show');
    Route::put('/users/{user}', [UsersController::class, 'update'])->name('admin.users.update');
    Route::delete('/users/{user}', [UsersController::class, 'destroy'])->name('admin.users.destroy');
    Route::post('/users', [UsersController::class, 'store'])->name('admin.users.store');

});
