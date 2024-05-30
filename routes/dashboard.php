<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\BookController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CollegeController;
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



    // colleges
    Route::get('/colleges/pagination', [CollegeController::class, 'pagination'])->name('colleges.pagination');
    Route::get('colleges-search', [CollegeController::class, 'search'])->name('colleges.search');
    Route::get('colleges-export', [CollegeController::class, 'export'])->name('colleges.export');
    Route::resource('colleges', CollegeController::class);
    Route::get('college-by-university-id', [CollegeController::class, 'getCollegesByUniversityId'])->name('colleges.getColleges');



    // books
    Route::get('/books/pagination', [BookController::class, 'pagination'])->name('books.pagination');
    Route::get('books-search', [BookController::class, 'search'])->name('books.search');
    Route::get('books-export', [BookController::class, 'export'])->name('books.export');
    Route::resource('books', BookController::class);




    // notifications
    Route::resource('notifications', NotificationController::class)->only(['update']);



});
