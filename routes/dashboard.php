<?php

use App\Http\Controllers\Dashboard\ContactTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\BookController;
use App\Http\Controllers\Dashboard\CityController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\CouponController;
use App\Http\Controllers\Dashboard\CollegeController;
use App\Http\Controllers\Dashboard\ContactController;
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
    Route::delete('users-delete', [UserController::class, 'delete'])->name('users.delete');
    Route::resource('users', UserController::class);



    // universities
    Route::get('/universities/pagination', [UniversityController::class, 'pagination'])->name('universities.pagination');
    Route::get('universities-search', [UniversityController::class, 'search'])->name('universities.search');
    Route::get('universities-export', [UniversityController::class, 'export'])->name('universities.export');
    Route::delete('universities-delete', [UniversityController::class, 'delete'])->name('universities.delete');
    Route::resource('universities', UniversityController::class);



    // colleges
    Route::get('/colleges/pagination', [CollegeController::class, 'pagination'])->name('colleges.pagination');
    Route::get('colleges-search', [CollegeController::class, 'search'])->name('colleges.search');
    Route::get('colleges-export', [CollegeController::class, 'export'])->name('colleges.export');
    Route::resource('colleges', CollegeController::class);
    Route::delete('colleges-delete', [CollegeController::class, 'delete'])->name('colleges.delete');
    Route::get('college-by-university-id', [CollegeController::class, 'getCollegesByUniversityId'])->name('colleges.getColleges');



    // books
    Route::get('/books/pagination', [BookController::class, 'pagination'])->name('books.pagination');
    Route::get('books-search', [BookController::class, 'search'])->name('books.search');
    Route::get('books-export', [BookController::class, 'export'])->name('books.export');
    Route::delete('books-delete', [BookController::class, 'delete'])->name('books.delete');
    Route::resource('books', BookController::class);



    // coupons
    Route::get('/coupons/pagination', [CouponController::class, 'pagination'])->name('coupons.pagination');
    Route::get('coupons-search', [CouponController::class, 'search'])->name('coupons.search');
    Route::get('coupons-export', [CouponController::class, 'export'])->name('coupons.export');
    Route::delete('coupons-delete', [CouponController::class, 'delete'])->name('coupons.delete');
    Route::resource('coupons', CouponController::class);



    // cities
    Route::get('/cities/pagination', [CityController::class, 'pagination'])->name('cities.pagination');
    Route::get('cities-search', [CityController::class, 'search'])->name('cities.search');
    Route::get('cities-export', [CityController::class, 'export'])->name('cities.export');
    Route::delete('cities-delete', [CityController::class, 'delete'])->name('cities.delete');
    Route::resource('cities', CityController::class);



    // contact_types
    Route::get('/contact_types/pagination', [ContactTypeController::class, 'pagination'])->name('contact_types.pagination');
    Route::get('contact_types-search', [ContactTypeController::class, 'search'])->name('contact_types.search');
    Route::get('contact_types-export', [ContactTypeController::class, 'export'])->name('contact_types.export');
    Route::delete('contact_types-delete', [ContactTypeController::class, 'delete'])->name('contact_types.delete');
    Route::resource('contact_types', ContactTypeController::class);



    // contacts
    Route::get('/contacts/pagination', [ContactController::class, 'pagination'])->name('contacts.pagination');
    Route::get('contacts-search', [ContactController::class, 'search'])->name('contacts.search');
    Route::get('contacts-export', [ContactController::class, 'export'])->name('contacts.export');
    Route::delete('contacts-delete', [ContactController::class, 'delete'])->name('contacts.delete');
    Route::resource('contacts', ContactController::class);




    // notifications
    Route::resource('notifications', NotificationController::class)->only(['update']);



});
