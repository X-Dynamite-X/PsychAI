<?php

use App\Http\Controllers\SpecialistController;
use Illuminate\Support\Facades\Route;

// المسارات العامة للمختصين
Route::get('/specialists', [SpecialistController::class, 'index'])->name('Specialist.index');
Route::get('/specialists/{specialist}', [SpecialistController::class, 'show'])->name('specialists.show');

// المسارات التي تتطلب تسجيل دخول
Route::middleware(['auth'])->group(function () {
    // حجز موعد مع مختص
    Route::get('/specialists/{specialist}/book', [SpecialistController::class, 'book'])
        ->name('specialists.book');
    
    Route::post('/specialists/{specialist}/book', [SpecialistController::class, 'storeBooking'])
        ->name('specialists.storeBooking');

    // إضافة تقييم للمختص
    Route::post('/specialists/{specialist}/reviews', [SpecialistController::class, 'storeReview'])
        ->name('specialists.reviews.store');
});

// المسارات الخاصة بالمختص نفسه
Route::middleware(['auth', 'role:doctor'])->group(function () {
    // إدارة الملف الشخصي للمختص
    Route::get('/specialist/profile', [SpecialistController::class, 'editProfile'])
        ->name('specialist.profile.edit');
    
    Route::put('/specialist/profile', [SpecialistController::class, 'updateProfile'])
        ->name('specialist.profile.update');

    // إدارة المواعيد والجلسات
    Route::get('/specialist/sessions', [SpecialistController::class, 'sessions'])
        ->name('specialist.sessions');
    
    Route::get('/specialist/bookings', [SpecialistController::class, 'bookings'])
        ->name('specialist.bookings');
    
    // تحديث حالة الحجز
    Route::put('/specialist/bookings/{booking}/status', [SpecialistController::class, 'updateBookingStatus'])
        ->name('specialist.bookings.status');

    // إدارة التخصصات
    Route::post('/specialist/specialties', [SpecialistController::class, 'addSpecialty'])
        ->name('specialist.specialties.add');
    
    Route::delete('/specialist/specialties/{specialty}', [SpecialistController::class, 'removeSpecialty'])
        ->name('specialist.specialties.remove');

    // إدارة أوقات العمل
    Route::get('/specialist/schedule', [SpecialistController::class, 'schedule'])
        ->name('specialist.schedule');
    
    Route::post('/specialist/schedule', [SpecialistController::class, 'updateSchedule'])
        ->name('specialist.schedule.update');
});