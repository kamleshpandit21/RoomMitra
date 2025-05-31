<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Common\{
    AboutController,
    AuthController,
    HomeController,
    SearchController,
    CommonFaqController,
    CommonTestimonialController,
    CommonContactMessageController,
    CommonOtpController,
    CommonRoomController,
    ComplaintController,
    ForgotPasswordController,
    SocialAuthController
};
use App\Http\Controllers\Admin\{
    AboutUsController,
    AdminController,
    UserManagementController,
    OwnerManagementController,
    RoomVerificationController,
    ComplaintManagementController,
    AdminFaqController,
    AdminLoginController,
    AdminPaymentController,
    BookingManagementController,
    TestimonialController,
    ContactMessageController,
    ContactUsController,
    TermConditionController
};

use App\Http\Controllers\Owner\{
    RoomController,
    RoomImageController,
    FurnitureItemController,
    AmenityController,
    BookingRequestController,
    OwnerProfileController,
    ComplaintResponseController,
    OwnerController
};

use App\Http\Controllers\User\{
    UserController,
    BookingController,
    ReviewController,
    PaymentController,
    ProfileController,
    UserOtpController
};



// Auth Routes (login, registration, logout)
Route::controller(AuthController::class)->group(function () {
    Route::get('login', 'showLoginForm')->name('login.form');
    Route::post('login', 'login')->name('login');
    Route::get('register', 'showRegistrationForm')->name('register.form');
    Route::post('register', 'register')->name('register');
    Route::get('logout', 'logout')->name('logout');
});

/**
 * =============================================================
 * Password Reset Routes
 * =============================================================
 */

Route::controller(ForgotPasswordController::class)->group(function () {

    // Password Reset Request

    Route::get('/forgot-password', 'showForgotForm')->name('password.request');
    Route::post('/forgot-password', 'sendOtp')->name('password.email');

    // Password Reset Verification
    Route::post('/verify-otp', 'verifyOtp')->name('otp.verify');

    // Password Reset & Update

    Route::post('/reset-password', 'resetPassword')->name('password.update');
});




Route::controller(SocialAuthController::class)->group(function () {
    Route::get('/auth/{provider}', 'redirectToProvider')->name('social.login'); // role added here
    Route::get('/auth/{provider}/callback', 'handleProviderCallback');
});

// Public Routes

// Home Page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Search functionality
Route::get('search', [SearchController::class, 'search'])->name('search');

// FAQ
Route::get('faqs', [CommonFaqController::class, 'index'])->name('faqs');

//Rooms
Route::get('rooms-list', [CommonRoomController::class, 'index'])->name('rooms');
Route::get('room/{id}', [CommonRoomController::class, 'show'])
    ->name('room.show')
    ->middleware(['user']);
// Contact Us
Route::get('contact', [CommonContactMessageController::class, 'index'])->name('contact.form');
Route::post('contact', [CommonContactMessageController::class, 'store'])->name('contact.store');

// About Us
Route::get('about', [AboutController::class, 'index'])->name('about');

// Complaint
Route::get('complaint', [ComplaintController::class, 'index'])->name('complaint.form');
Route::post('complaint', [ComplaintController::class, 'store'])->name('complaint.store');


/**
 * =============================================================
 * Admin Routes
 * =============================================================
 */

Route::controller(AdminLoginController::class)->prefix('admin')->as('admin.')->group(function () {
    Route::get('login', 'showLoginForm')->name('login.form');
    Route::post('login', 'login')->name('login');
    Route::get('logout', 'logout')->name('logout');
});


Route::prefix('admin')->middleware(['admin'])->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Users Management
    Route::resource('users', UserManagementController::class);
    Route::controller(UserManagementController::class)->group(function () {
        Route::patch('/users/{id}/verify', 'verify')->name('users.verify');
        Route::patch('/users/{id}/block', 'block')->name('users.block');
        Route::patch('/users/{id}/unblock', 'unblock')->name('users.unblock');

    });


    // Room Management
    Route::resource('rooms', RoomVerificationController::class);
    Route::patch('/rooms/{id}/approve', [RoomVerificationController::class, 'approve'])->name('rooms.approve');

    //Payments
    Route::resource('payments', AdminPaymentController::class);

    // Bookings
    Route::resource('bookings', BookingManagementController::class);

    // Complaints
    Route::resource('complaints', ComplaintManagementController::class);
    Route::post('complaints/{id}/resolve', [ComplaintManagementController::class, 'resolve'])->name('complaints.resolve');


    // FAQs
    Route::resource('faqs', AdminFaqController::class);

    // Testimonials
    Route::resource('testimonials', TestimonialController::class);

    // Contact Messages
    Route::resource('contact-messages', ContactMessageController::class);

    //About Us
    Route::resource('about-us', AboutUsController::class);

    // Contact Us
    Route::resource('contact-us', ContactUsController::class);

    // Terms and Conditions
    Route::resource('terms-conditions', TermConditionController::class);

});


Route::prefix('owner')->middleware('owner')->name('owner.')->group(function () {
    Route::get('/', [OwnerController::class, 'index'])->name('dashboard');
    // Room Management
    Route::resource('rooms', RoomController::class);
    Route::resource('room-images', RoomImageController::class);
    Route::resource('furniture-items', FurnitureItemController::class);
    Route::resource('amenities', AmenityController::class);

    // Booking Requests
    Route::resource('bookings', BookingRequestController::class);

    // Profile Management
    Route::resource('profile', OwnerProfileController::class);
    Route::get('profile-edit', [OwnerProfileController::class, 'editProfile'])->name('profile.edit');

    Route::put('change-password', [OwnerProfileController::class, 'updatePassword'])->name('profile.update-password');

    // Complaint Responses
    Route::resource('complaints', ComplaintResponseController::class);
});



Route::prefix('user')->name('user.')->middleware('user')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('dashboard');
    // User Profile
    Route::resource('profile', ProfileController::class);
    Route::get('profile-edit', [ProfileController::class, 'editProfile'])->name('profile.edit');

    // change password
    Route::put('change-password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    // Booking Management
    Route::resource('bookings', BookingController::class);
    Route::get('/booking/{room}/checkout', [BookingController::class, 'checkout'])->name('booking.checkout');
    Route::post('/booking/{room}/pay', [BookingController::class, 'pay'])->name('booking.pay');
    Route::get('/booking/success', [BookingController::class, 'success'])->name('booking.success');
    Route::get('/booking/fail', [BookingController::class, 'fail'])->name('booking.fail');

    // Reviews
    Route::resource('reviews', ReviewController::class);

    // Payments
    Route::resource('payments', PaymentController::class);

    // Complaints
    Route::resource('complaints', ComplaintController::class);

    // OTP Management
    Route::post('otp', [UserOtpController::class, 'sendOtp'])->name('otp.send');
});
