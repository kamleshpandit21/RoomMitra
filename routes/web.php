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

// password reset

Route::controller(ForgotPasswordController::class)->group(function () {
    Route::get('forgot-password', 'index')->name('forgot-password.form');
    Route::post('forgot-password', 'sendResetLinkEmail')->name('forgot-password');
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

// Testimonials
Route::get('testimonials', [CommonTestimonialController::class, 'index'])->name('testimonials');

// Contact Us
Route::get('contact', [CommonContactMessageController::class, 'index'])->name('contact.form');
Route::post('contact', [CommonContactMessageController::class, 'store'])->name('contact.store');

// About Us
Route::get('about', [AboutController::class, 'index'])->name('about');

// Complaint
Route::get('complaint', [ComplaintController::class, 'index'])->name('complaint.form');
Route::post('complaint', [ComplaintController::class, 'store'])->name('complaint.store');


Route::fallback(function () {
    return view('common.404');
});



Route::prefix('admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // Users Management
    Route::resource('users', UserManagementController::class);
    Route::patch('/users/{id}/block', [UserManagementController::class, 'block'])->name('admin.users.block');
    Route::patch('/users/{id}/unblock', [UserManagementController::class, 'unblock'])->name('admin.users.unblock');


    // Room Management
    Route::resource('rooms', RoomVerificationController::class);

    //Payments
    Route::resource('payments', AdminPaymentController::class);

    // Bookings
    Route::resource('bookings', BookingManagementController::class);

    // Complaints
    Route::resource('complaints', ComplaintManagementController::class);

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


Route::prefix('owner')->name('owner.')->group(function () {
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

    // Complaint Responses
    Route::resource('complaints', ComplaintResponseController::class);
});



Route::prefix('user')->name('user.')->group(function () {
    // User Profile
    Route::resource('profile', ProfileController::class);

    // Booking Management
    Route::resource('bookings', BookingController::class);

    // Reviews
    Route::resource('reviews', ReviewController::class);

    // Payments
    Route::resource('payments', PaymentController::class);

    // Complaints
    Route::resource('complaints', ComplaintController::class);

    // OTP Management
    Route::post('otp', [UserOtpController::class, 'sendOtp'])->name('otp.send');
});
