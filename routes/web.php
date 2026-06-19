<?php

use App\Http\Controllers\TrackController;
use App\Http\Controllers\AdminController;

// Public tracking portal routes
Route::get('/', [TrackController::class, 'index'])->name('home');
Route::post('/track', [TrackController::class, 'search'])->name('track.search')->middleware('throttle:10,1');

// Auth redirect (handles default auth middleware redirect)
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

// Admin panel routes
Route::prefix('admin')->group(function () {
    // Redirect /admin to login page
    Route::get('/', function () {
        return redirect()->route('admin.login');
    });

    // Guest access (Login, Register, Forgot/Reset Password)
    Route::get('/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
    Route::get('/register', [AdminController::class, 'showRegisterForm'])->name('admin.register');
    Route::get('/forgot-password', [AdminController::class, 'showForgotPasswordForm'])->name('admin.forgot-password');
    Route::get('/reset-password/{token}', [AdminController::class, 'showResetPasswordForm'])->name('admin.reset-password');

    // Rate-limited POST routes (5 attempts per minute)
    Route::middleware(['throttle:5,1'])->group(function () {
        Route::post('/login', [AdminController::class, 'login'])->name('admin.login.submit');
        Route::post('/register', [AdminController::class, 'register'])->name('admin.register.submit');
        Route::post('/forgot-password', [AdminController::class, 'sendResetLink'])->name('admin.forgot-password.submit');
        Route::post('/reset-password', [AdminController::class, 'resetPassword'])->name('admin.reset-password.submit');
    });

    // Authenticated access
    Route::middleware(['auth'])->group(function () {
        Route::post('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        
        // Orders management
        Route::post('/orders', [AdminController::class, 'storeOrder'])->name('admin.orders.store');
        Route::get('/orders/{id}', [AdminController::class, 'showOrder'])->name('admin.orders.show');
        Route::delete('/orders/{id}', [AdminController::class, 'deleteOrder'])->name('admin.orders.delete');
        
        // Order timeline & status management
        Route::patch('/orders/{id}/status', [AdminController::class, 'updateStatus'])->name('admin.orders.updateStatus');
        Route::post('/orders/{id}/timeline', [AdminController::class, 'addTimeline'])->name('admin.orders.addTimeline');
        Route::delete('/timeline/{id}', [AdminController::class, 'deleteTimeline'])->name('admin.orders.deleteTimeline');
    });
});
