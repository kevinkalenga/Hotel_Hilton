<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\Admin\AdminSlideController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminProfileController;


/* ----------------------Front--------------------------*/ 

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');



/* ---------------------- Admin ---------------------- */

// Dashboard
Route::get('/admin/home', [AdminHomeController::class, 'index'])
    ->name('admin_home')
    ->middleware('admin:admin');

// Login
Route::get('/admin/login', [AdminLoginController::class, 'index'])->name('admin_login');
Route::post('/admin/login-submit', [AdminLoginController::class, 'login_submit'])->name('admin_login_submit');

// Logout
Route::get('/admin/logout', [AdminLoginController::class, 'logout'])->name('admin_logout');

// Forget password
Route::get('/admin/forget-password', [AdminLoginController::class, 'forget_password'])->name('admin_forget_password');
Route::post('/admin/forget-password-submit', [AdminLoginController::class, 'forget_password_submit'])->name('admin_forget_password_submit');

// Edit profile (GET + POST) ✅ middleware admin appliqué sur les deux
Route::middleware('admin:admin')->group(function () {
    Route::get('/admin/edit-profile', [AdminProfileController::class, 'index'])->name('admin_profile');
    Route::post('/admin/edit-profile-submit', [AdminProfileController::class, 'profile_submit'])->name('admin_profile_submit');
});

// Slide
Route::get('/admin/slide/view', [AdminSlideController::class, 'index'])->name('admin_slide_view')->middleware('admin:admin');
Route::get('/admin/slide/add', [AdminSlideController::class, 'add'])->name('admin_slide_add')->middleware('admin:admin');
Route::post('/admin/slide/store', [AdminSlideController::class, 'store'])->name('admin_slide_store')->middleware('admin:admin');
