<?php

use App\Models\College;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\AuthController;
use App\Http\Controllers\Site\BookController;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Site\TermController;
use App\Http\Controllers\Site\AboutController;
use App\Http\Controllers\Site\CollegeController;
use App\Http\Controllers\Site\ContactController;
use App\Http\Controllers\Site\UsedBookController;
use App\Http\Controllers\Site\UniversityController;
use App\Http\Controllers\Site\NotificationController;

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



Route::middleware(['authenticated'])->group(function () {
    Route::post('logout', [AuthController::class, 'logout'])->name('site.logout');

    Route::post('add-to-cart', [CartController::class, 'store'])->name('carts.store');
    Route::get('notifications', [NotificationController::class, 'index'])->name('site.notifications.index');
});

Route::get('/', [HomeController::class, 'index'])->name('site.home');
Route::get('about-us', [AboutController::class, 'index'])->name('site.aboutus.index');
Route::get('books', [BookController::class, 'index'])->name('site.books.index');
Route::get("used-books", [UsedBookController::class, 'index'])->name('site.usedbooks.index');
Route::get('offers', [BookController::class, 'offers'])->name('site.books.offers');
Route::get('universities', [UniversityController::class, 'index'])->name('site.universites.index');
Route::get('universities/{id}/colleges/', [UniversityController::class,'show'])->name('site.universites.show');
Route::get("colleges/{id}/books", [CollegeController::class, 'show'])->name('site.colleges.show');



// contact
Route::get('contact-us', [ContactController::class, 'index'])->name('site.contacts.index');
Route::post('contact-us-stote', [ContactController::class, 'store'])->name('site.contacts.store');

Route::get('term-and-conditions', [TermController::class, 'index'])->name('site.terms.index');

