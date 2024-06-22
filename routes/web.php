<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\AuthController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\ContactController;

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



Route::get('login', [AuthController::class, 'loginPage'])->name('site.login_page');
Route::get('register', [AuthController::class, 'registerPage'])->name('site.register_page');
Route::post('login-store', [AuthController::class, 'login'])->name('site.login');
Route::post('register-store', [AuthController::class, 'register'])->name('site.register');



Route::middleware(['auth'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('site.logout');
});

Route::get('/', [HomeController::class, 'index'])->name('site.home');



// contact
Route::post('contact-us', [ContactController::class, 'index'])->name('site.contacts.index');
Route::post('contact-us-stote', [ContactController::class, 'store'])->name('site.contacts.store');
