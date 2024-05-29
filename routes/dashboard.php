<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\UniversityController;
use App\Http\Controllers\Dashboard\NotificationController;


// auth
Route::get('login', [AuthController::class, 'loginPage'])->name('dashboard.login_page');
Route::post('login', [AuthController::class, 'login'])->name('dashboard.login');

// forget password
Route::get('forget-password', [AuthController::class, 'forgetPassword'])->name('dashboard.forget_password');
Route::post('send-forget-password-mail', [AuthController::class, 'sendEmailPassword'])->name('dashboard.send_email_password');
Route::get('reset-password/{token}', [AuthController::class, 'resetPasswordPage'])->name('dashboard.reset_password_page');
Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('dashboard.reset_password');


Route::middleware('admin_auth')->group(function () {
    // logout
    Route::post('logout', [AuthController::class, 'logout'])->name('dashboard.logout');


    // home
    Route::get('home', [HomeController::class, 'index'])->name('dashboard.home');


    // rules
    Route::resource('roles', RoleController::class);

    // users
    Route::get('/users/pagination', [UserController::class, 'pagination'])->name('users.pagination');
    Route::get('users-search', [UserController::class, 'search'])->name('users.search');
    Route::get('users-export', [UserController::class, 'export'])->name('users.export');
    Route::resource('users', UserController::class);



    // universities
    Route::get('/universities/pagination', [UniversityController::class, 'pagination'])->name('universities.pagination');
    Route::get('universities-search', [UniversityController::class, 'search'])->name('universities.search');
    Route::get('universities-export', [UniversityController::class, 'export'])->name('universities.export');
    Route::resource('universities', UniversityController::class);

    // notifications
    Route::resource('notifications', NotificationController::class)->only(['update']);



});
