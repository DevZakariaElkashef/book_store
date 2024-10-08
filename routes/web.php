<?php

use App\Http\Controllers\Site\FavouriteController;
use App\Http\Controllers\Site\ReviewController;
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
use App\Http\Controllers\Site\CouponController;
use App\Http\Controllers\Site\UsedBookController;
use App\Http\Controllers\Site\UniversityController;
use App\Http\Controllers\Site\NotificationController;
use App\Http\Controllers\Site\OrderController;
use App\Http\Controllers\Site\ProfileController;

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

Route::post('change-lang', [ProfileController::class, 'lang'])->name('site.lang.update');
Route::get('calc-shipping', [CartController::class, 'calcShipping']);


Route::middleware('lang')->group(function () {

    Route::get('login', [AuthController::class, 'loginPage'])->name('site.login_page');
    Route::get('register', [AuthController::class, 'registerPage'])->name('site.register_page');
    Route::post('login-store', [AuthController::class, 'login'])->name('site.login');
    Route::post('register-store', [AuthController::class, 'register'])->name('site.register');
    Route::get('forget-password', [AuthController::class, 'forgetPassword'])->name('site.forget_password');
    Route::post('send-code', [AuthController::class, 'sendCode'])->name('site.send_code');
    Route::get('check-code', [AuthController::class, 'checkCode'])->name('site.check_code.index');
    Route::post('confirm-code', [AuthController::class, 'confirmCode'])->name('site.check_code.store');
    Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('site.password.reset');


    Route::middleware(['authenticated'])->group(function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('site.logout');

        Route::get("profile", [ProfileController::class, 'index'])->name('site.profile.index');
        Route::get("profile-settings", [ProfileController::class, 'settings'])->name('site.settings.index');
        Route::get("edit-password", [ProfileController::class, 'editPassword'])->name('site.password.edit');
        Route::post("update-password", [ProfileController::class, 'updatePassword'])->name('site.password.update');
        Route::get("my-orders", [ProfileController::class, 'orders'])->name('site.orders.index');
        Route::get("my-orders/{id}", [ProfileController::class, 'showOrder'])->name('site.orders.show');
        Route::post("profile-update", [ProfileController::class, 'update'])->name('site.profile.update');

        Route::get('cart', [CartController::class, 'index'])->name('carts.index');
        Route::post('add-to-cart', [CartController::class, 'store'])->name('carts.store');
        Route::post('remove-from-cart/{id}', [CartController::class, 'destroy'])->name('carts.destroy');
        Route::get('notifications', [NotificationController::class, 'index'])->name('site.notifications.index');


        Route::post('check-coupon', [CouponController::class, 'check'])->name('coupons.check');
        Route::get('checkout', [OrderController::class, 'index'])->name('orders.checkout');
        Route::post('pay-order', [OrderController::class, 'store'])->name('site.orders.store');
        Route::get("order-callback", [OrderController::class, 'callback'])->name('orders.callback');
        Route::get("success-order", [OrderController::class, 'success'])->name('orders.success');
        Route::get("error-order", [OrderController::class, 'error'])->name('orders.error');
        Route::post('cancle-orders', [OrderController::class, 'cancle'])->name('orders.cancle');



        Route::get("favourites", [FavouriteController::class, 'index'])->name('site.favourite.index');
        Route::get("add-to-favourite", [FavouriteController::class, 'toggle'])->name('site.favourite.toggle');

        Route::post('reivew-book', [ReviewController::class, 'store'])->name('site.books.review');
    });

    Route::get('/', [HomeController::class, 'index'])->name('site.home');
    Route::get('about-us', [AboutController::class, 'index'])->name('site.aboutus.index');
    Route::get('books', [BookController::class, 'index'])->name('site.books.index');
    Route::get('books/{id}', [BookController::class, 'show'])->name('site.books.show');
    Route::get("used-books", [UsedBookController::class, 'index'])->name('site.usedbooks.index');
    Route::get('offers', [BookController::class, 'offers'])->name('site.books.offers');
    Route::get('universities', [UniversityController::class, 'index'])->name('site.universites.index');
    Route::get('universities/{id}/colleges/', [UniversityController::class, 'show'])->name('site.universites.show');
    Route::get("colleges/{id}/books", [CollegeController::class, 'show'])->name('site.colleges.show');



    // contact
    Route::get('contact-us', [ContactController::class, 'index'])->name('site.contacts.index');
    Route::post('contact-us-stote', [ContactController::class, 'store'])->name('site.contacts.store');

    Route::get('term-and-conditions', [TermController::class, 'index'])->name('site.terms.index');
});
