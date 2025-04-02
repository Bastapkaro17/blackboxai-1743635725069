<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/', function () {
    return view('welcome');
});

// Authentication routes
Route::controller(AuthController::class)->group(function() {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::get('/register', 'showRegistrationForm')->name('register');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout')->name('logout');
    
    // Google OAuth routes
    Route::get('/auth/google', 'redirectToGoogle')->name('login.google');
    Route::get('/auth/google/callback', 'handleGoogleCallback');
});

// User routes (authenticated)
Route::middleware(['auth'])->group(function() {
    // Profile routes
    Route::controller(UserController::class)->group(function() {
        Route::get('/profile', 'show')->name('profile');
        Route::get('/profile/edit', 'edit')->name('profile.edit');
        Route::put('/profile', 'update')->name('profile.update');
    });

    // Review page routes
    Route::controller(ReviewController::class)->group(function() {
        Route::get('/review/{username}', 'show')->name('review.show');
        Route::post('/review', 'store')->name('review.store');
    });
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function() {
    Route::controller(AdminController::class)->group(function() {
        Route::get('/dashboard', 'dashboard')->name('admin.dashboard');
        Route::get('/users', 'users')->name('admin.users');
        Route::get('/reviews', 'reviews')->name('admin.reviews');
    });
});