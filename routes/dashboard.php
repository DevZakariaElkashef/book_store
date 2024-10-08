<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\BankController;
use App\Http\Controllers\Dashboard\BookController;
use App\Http\Controllers\Dashboard\CityController;
use App\Http\Controllers\Dashboard\HomeController;
use App\Http\Controllers\Dashboard\PageController;
use App\Http\Controllers\Dashboard\RoleController;
use App\Http\Controllers\Dashboard\UserController;
use App\Http\Controllers\Dashboard\OrderController;
use App\Http\Controllers\Dashboard\CouponController;
use App\Http\Controllers\Dashboard\ReviewController;
use App\Http\Controllers\Dashboard\SliderController;
use App\Http\Controllers\Dashboard\AboutusController;
use App\Http\Controllers\Dashboard\CollegeController;
use App\Http\Controllers\Dashboard\ContactController;
use App\Http\Controllers\Dashboard\SettingController;
use App\Http\Controllers\Dashboard\SubjectController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\Dashboard\ShippingController;
use App\Http\Controllers\Dashboard\UniversityController;
use App\Http\Controllers\Dashboard\ContactTypeController;
use App\Http\Controllers\Dashboard\HeaderImageController;
use App\Http\Controllers\Dashboard\ImageController;
use App\Http\Controllers\Dashboard\NotificationController;
use App\Http\Controllers\Dashboard\ProfileController;

Route::middleware('lang')->group(function () {


    Route::get('/', function() {
        return to_route('dashboard.home');
    });

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

        Route::get('profile', [ProfileController::class, 'index'])->name('dashboard.profile');
        Route::put('update-profile', [ProfileController::class, 'update'])->name('dashboard.profile.update');

        // home
        Route::get('home', [HomeController::class, 'index'])->name('dashboard.home');


        // rules
        Route::resource('roles', RoleController::class);

        // employees
        Route::get('/employees/pagination', [EmployeeController::class, 'pagination'])->name('employees.pagination');
        Route::get('employees-search', [EmployeeController::class, 'search'])->name('employees.search');
        Route::get('employees-export', [EmployeeController::class, 'export'])->name('employees.export');
        Route::delete('employees-delete', [EmployeeController::class, 'delete'])->name('employees.delete');
        Route::resource('employees', EmployeeController::class);





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



        // subjects
        Route::get('/subjects/pagination', [SubjectController::class, 'pagination'])->name('subjects.pagination');
        Route::get('subjects-search', [SubjectController::class, 'search'])->name('subjects.search');
        Route::get('subjects-export', [SubjectController::class, 'export'])->name('subjects.export');
        Route::resource('subjects', SubjectController::class);
        Route::delete('subjects-delete', [SubjectController::class, 'delete'])->name('subjects.delete');
        Route::get('subject-by-college-id', [SubjectController::class, 'getSubjectsByCollegeId'])->name('subjects.getSubjects');



        // books
        Route::get('get-book-price', [BookController::class, 'getPrice'])->name('books.price');
        Route::get('/books/pagination', [BookController::class, 'pagination'])->name('books.pagination');
        Route::get('books-search', [BookController::class, 'search'])->name('books.search');
        Route::get('books-export', [BookController::class, 'export'])->name('books.export');
        Route::delete('books-delete', [BookController::class, 'delete'])->name('books.delete');
        Route::resource('books', BookController::class);




        Route::resource('images', ImageController::class);



        // coupons
        Route::get('/coupons/pagination', [CouponController::class, 'pagination'])->name('coupons.pagination');
        Route::get('coupons-search', [CouponController::class, 'search'])->name('coupons.search');
        Route::get('coupons-export', [CouponController::class, 'export'])->name('coupons.export');
        Route::delete('coupons-delete', [CouponController::class, 'delete'])->name('coupons.delete');
        Route::resource('coupons', CouponController::class);



        // banks
        Route::get('/banks/pagination', [BankController::class, 'pagination'])->name('banks.pagination');
        Route::get('banks-search', [BankController::class, 'search'])->name('banks.search');
        Route::get('banks-export', [BankController::class, 'export'])->name('banks.export');
        Route::delete('banks-delete', [BankController::class, 'delete'])->name('banks.delete');
        Route::resource('banks', BankController::class);



        // cities
        Route::get('/cities/pagination', [CityController::class, 'pagination'])->name('cities.pagination');
        Route::get('cities-search', [CityController::class, 'search'])->name('cities.search');
        Route::get('cities-export', [CityController::class, 'export'])->name('cities.export');
        Route::delete('cities-delete', [CityController::class, 'delete'])->name('cities.delete');
        Route::resource('cities', CityController::class);



        // reviews
        Route::get('/reviews/pagination', [ReviewController::class, 'pagination'])->name('reviews.pagination');
        Route::get('reviews-search', [ReviewController::class, 'search'])->name('reviews.search');
        Route::get('reviews-export', [ReviewController::class, 'export'])->name('reviews.export');
        Route::delete('reviews-delete', [ReviewController::class, 'delete'])->name('reviews.delete');
        Route::resource('reviews', ReviewController::class);



        // orders
        Route::get('/orders/pagination', [OrderController::class, 'pagination'])->name('orders.pagination');
        Route::get('orders-search', [OrderController::class, 'search'])->name('orders.search');
        Route::get('orders-export', [OrderController::class, 'export'])->name('orders.export');
        Route::delete('orders-delete', [OrderController::class, 'delete'])->name('orders.delete');
        Route::resource('orders', OrderController::class);



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



        // aboutus
        Route::get('/aboutus/pagination', [AboutusController::class, 'pagination'])->name('aboutus.pagination');
        Route::get('aboutus-search', [AboutusController::class, 'search'])->name('aboutus.search');
        Route::get('aboutus-export', [AboutusController::class, 'export'])->name('aboutus.export');
        Route::delete('aboutus-delete', [AboutusController::class, 'delete'])->name('aboutus.delete');
        Route::resource('aboutus', AboutusController::class);


        // sliders
        Route::delete('sliders-delete', [SliderController::class, 'delete'])->name('sliders.delete');
        Route::resource('sliders', SliderController::class);


        // settings
        Route::resource('pages', PageController::class);


        // settings
        Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
        Route::Post('settings-udpate', [SettingController::class, 'update'])->name('settings.update');

        // settings
        Route::get('shippings', [ShippingController::class, 'index'])->name('shippings.index');
        Route::Post('shippings-udpate', [ShippingController::class, 'update'])->name('shippings.update');


        // notifications
        Route::get('notifications-search', [NotificationController::class, 'search'])->name('notifications.search');
        Route::delete('notifications-delete', [NotificationController::class, 'delete'])->name('notifications.delete');
        Route::resource('notifications', NotificationController::class);
    });
});
