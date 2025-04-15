<?php


use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Common\{
    AuthController,
    HomeController,
    SearchController,
    CommonFaqController,
    CommonTestimonialController,
    CommonContactMessageController,
    CommonOtpController
};
use App\Http\Controllers\Admin\{
    AdminController,
    UserManagementController,
    OwnerManagementController,
    RoomVerificationController,
    ComplaintManagementController,
    AdminFaqController,
    TestimonialController,
    ContactMessageController
};

use App\Http\Controllers\Owner\{
    RoomController,
    RoomImageController,
    FurnitureItemController,
    AmenityController,
    BookingRequestController,
    OwnerProfileController,
    ComplaintResponseController
};

use App\Http\Controllers\User\{
    UserController,
    BookingController,
    ReviewController,
    PaymentController,
    ComplaintController,
    ProfileController,
    UserOtpController
};


Route::name('common.')->group(function () {
    // Auth Routes (login, registration)
    Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('register', [AuthController::class, 'register']);

    // Home Page
    Route::get('/', [HomeController::class, 'index'])->name('home');

    // Search functionality
    Route::get('search', [SearchController::class, 'search'])->name('search');

    // FAQ
    Route::get('faqs', [CommonFaqController::class, 'index'])->name('faqs');

    // Testimonials
    Route::get('testimonials', [CommonTestimonialController::class, 'index'])->name('testimonials');

    // Contact Us
    Route::get('contact', [CommonContactMessageController::class, 'create'])->name('contact');
    Route::post('contact', [CommonContactMessageController::class, 'store']);
});




Route::prefix('admin')->middleware('auth:admin')->name('admin.')->group(function () {
    // Admin Dashboard
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');

    // User Management
    Route::resource('users', UserManagementController::class);

    // Owner Management
    Route::resource('owners', OwnerManagementController::class);

    // Room Management
    Route::resource('rooms', RoomVerificationController::class);

    // Complaints
    Route::resource('complaints', ComplaintManagementController::class);

    // FAQs
    Route::resource('faqs', AdminFaqController::class);

    // Testimonials
    Route::resource('testimonials', TestimonialController::class);

    // Contact Messages
    Route::resource('contact-messages', ContactMessageController::class);
});


Route::prefix('owner')->middleware('auth:owner')->name('owner.')->group(function () {
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



Route::prefix('user')->middleware('auth:user')->name('user.')->group(function () {
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
