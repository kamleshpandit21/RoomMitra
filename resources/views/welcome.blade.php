@extends('user.layout.master')
@section('title', 'Home')
@push('styles')
  <link rel="stylesheet" href="{{asset('css/landing-page.css')}}">
@endpush
@section('content')
<section id="hero-carousel" class="position-relative">
  <div
    id="roomCarousel"
    class="carousel slide carousel-fade"
    data-bs-ride="carousel"
    data-bs-interval="5000"
  >
    <div class="carousel-inner">
      <!-- Slide 1 -->
      <div class="carousel-item active">
        <img
          src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c"
          class="d-block w-100"
          alt="Room 1"
        />
        <div
          class="carousel-caption text-start animate__animated animate__fadeInLeft"
        >
          <h1
            class="display-3 fw-bold animate__animated animate__slideInDown"
          >
            Find Your Perfect PG
          </h1>
          <p class="lead animate__animated animate__fadeInUp">
            Affordable stays near your campus with verified listings.
          </p>
          <a
            href="#explore"
            class="btn btn-success btn-lg animate__animated animate__zoomIn mt-3"
            >Explore Now</a
          >
        </div>
      </div>

      <!-- Slide 2 -->
      <div class="carousel-item">
        <img
          src="https://images.unsplash.com/photo-1613490493576-7fde63acd811"
          class="d-block w-100"
          alt="Room 2"
        />
        <div
          class="carousel-caption text-center animate__animated animate__fadeInDown"
        >
          <h1 class="display-3 fw-bold animate__animated animate__zoomIn">
            Verified Rooms
          </h1>
          <p class="lead animate__animated animate__fadeInUp">
            Safe, secure & comfortable options in your city.
          </p>
          <a
            href="#features"
            class="btn btn-outline-light btn-lg animate__animated animate__fadeInUp mt-3"
            >See Features</a
          >
        </div>
      </div>

      <!-- Slide 3 -->
      <div class="carousel-item">
        <img
          src="https://images.unsplash.com/photo-1570129477492-45c003edd2be"
          class="d-block w-100"
          alt="Room 3"
        />
        <div
          class="carousel-caption text-end animate__animated animate__fadeInRight"
        >
          <h1
            class="display-3 fw-bold animate__animated animate__fadeInDown"
          >
            Book Instantly
          </h1>
          <p class="lead animate__animated animate__zoomIn">
            Reserve your favorite PG in a few clicks.
          </p>
          <a
            href="#booking"
            class="btn btn-warning btn-lg animate__animated animate__fadeInUp mt-3"
            >Book Now</a
          >
        </div>
      </div>
    </div>

    <!-- Controls -->
    <button
      class="carousel-control-prev"
      type="button"
      data-bs-target="#roomCarousel"
      data-bs-slide="prev"
    >
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button
      class="carousel-control-next"
      type="button"
      data-bs-target="#roomCarousel"
      data-bs-slide="next"
    >
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
</section>

<section id="featured-rooms" class="py-5 bg-light">
  <div class="container">
    <h2 class="text-center fw-bold mb-4" data-aos="fade-up">
      🏡 Featured Rooms
    </h2>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
      <!-- Room Card -->
      <div class="col">
        <div class="card room-card border-0 shadow-sm h-100">
          <div class="position-relative">
            <div class="ribbon"><span>5000/month</span></div>
            <img
              src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c"
              class="card-img-top"
              alt="Room Image"
            />

            <span
              class="badge bg-warning text-dark position-absolute top-0 end-0 m-2 p-2"
              >⭐ 4.0</span
            >
          </div>
          <div class="card-body">
            <h5 class="card-title mb-1">Single Room</h5>
            <p class="text-muted mb-2">
              <i class="fas fa-map-marker-alt text-danger me-1"></i>Delhi,
              India
            </p>
            <a
              href="room-detail.php?id=1"
              class="btn btn-outline-success btn-sm w-100 p-2"
              >👁️ View Details</a
            >
          </div>
        </div>
      </div>

      <!-- Repeat Room Cards -->
      <div class="col">
        <div class="card room-card border-0 shadow-sm h-100">
          <div class="position-relative">
            <img
              src="https://images.unsplash.com/photo-1613490493576-7fde63acd811"
              class="card-img-top"
              alt="Room Image"
            />
            <span
              class="badge bg-success position-absolute top-0 start-0 m-2"
              >₹3,500/mo</span
            >
            <span
              class="badge bg-warning text-dark position-absolute top-0 end-0 m-2"
              >⭐ 5.0</span
            >
          </div>
          <div class="card-body">
            <h5 class="card-title mb-1">Shared PG Room</h5>
            <p class="text-muted mb-2">
              <i class="fas fa-map-marker-alt text-danger me-1"></i>Mumbai,
              India
            </p>
            <a
              href="room-detail.php?id=2"
              class="btn btn-outline-success btn-sm w-100 p-2"
              >👁️ View Details</a
            >
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card room-card border-0 shadow-sm h-100">
          <div class="position-relative">
            <img
              src="https://images.unsplash.com/photo-1570129477492-45c003edd2be"
              class="card-img-top"
              alt="Room Image"
            />
            <span
              class="badge bg-success position-absolute top-0 start-0 m-2"
              >₹6,000/mo</span
            >
            <span
              class="badge bg-warning text-dark position-absolute top-0 end-0 m-2"
              >⭐ 4.5</span
            >
          </div>
          <div class="card-body">
            <h5 class="card-title mb-1">AC Room with Balcony</h5>
            <p class="text-muted mb-2">
              <i class="fas fa-map-marker-alt text-danger me-1"></i>Pune,
              India
            </p>
            <a
              href="room-detail.php?id=3"
              class="btn btn-outline-success btn-sm w-100 p-2"
              >👁️ View Details</a
            >
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<section class="py-5 bg-light" id="why-choose-us">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold">Why Choose Us</h2>
      <p class="text-muted">
        Find the perfect student room with trusted features
      </p>
    </div>

    <div class="row g-4">
      <!-- Card 1 -->
      <div class="col-md-6 col-lg-4">
        <div
          class="d-flex align-items-start bg-white p-4 shadow rounded h-100"
        >
          <i class="fas fa-check-circle text-success fs-2 me-3"></i>
          <div>
            <h5 class="mb-1">100% Verified Rooms</h5>
            <p class="text-muted mb-0">
              All listed rooms are personally verified for authenticity.
            </p>
          </div>
        </div>
      </div>

      <!-- Card 2 -->
      <div class="col-md-6 col-lg-4">
        <div
          class="d-flex align-items-start bg-white p-4 shadow rounded h-100"
        >
          <i class="fas fa-shield-alt text-primary fs-2 me-3"></i>
          <div>
            <h5 class="mb-1">Safe & Secure Booking</h5>
            <p class="text-muted mb-0">
              Your booking and payments are fully protected with SSL
              security.
            </p>
          </div>
        </div>
      </div>

      <!-- Card 3 -->
      <div class="col-md-6 col-lg-4">
        <div
          class="d-flex align-items-start bg-white p-4 shadow rounded h-100"
        >
          <i class="fas fa-user-graduate text-info fs-2 me-3"></i>
          <div>
            <h5 class="mb-1">Only for Students</h5>
            <p class="text-muted mb-0">
              We specialize in student accommodations only.
            </p>
          </div>
        </div>
      </div>

      <!-- Card 4 -->
      <div class="col-md-6 col-lg-4">
        <div
          class="d-flex align-items-start bg-white p-4 shadow rounded h-100"
        >
          <i class="fas fa-id-card-alt text-warning fs-2 me-3"></i>
          <div>
            <h5 class="mb-1">Owner KYC Verified</h5>
            <p class="text-muted mb-0">
              Room owners are verified with KYC before listing.
            </p>
          </div>
        </div>
      </div>

      <!-- Card 5 -->
      <div class="col-md-6 col-lg-4">
        <div
          class="d-flex align-items-start bg-white p-4 shadow rounded h-100"
        >
          <i class="fas fa-undo-alt text-danger fs-2 me-3"></i>
          <div>
            <h5 class="mb-1">Easy Refund Policy</h5>
            <p class="text-muted mb-0">
              Cancel anytime with our easy and transparent refund policy.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="py-5 bg-white" id="testimonials">
  <div class="container">
    <div class="text-center mb-5">
      <h2 class="fw-bold display-6" data-aos="fade-up">
        What Students Say
      </h2>
      <p class="text-muted" data-aos="fade-up" data-aos-delay="100">
        Real experiences from real students
      </p>
    </div>

    <div
      id="testimonialCarousel"
      class="carousel slide"
      data-bs-ride="carousel"
      data-aos="zoom-in"
    >
      <div class="carousel-inner">
        <!-- Testimonial 1 -->
        <div class="carousel-item active">
          <div class="testimonial-card mx-auto">
            <p class="fs-5">
              “Finding a room near my college was so easy. The owner was
              friendly and everything was exactly as described!”
            </p>
            <div class="testimonial-meta mt-4">
              <img
                src="https://randomuser.me/api/portraits/women/44.jpg"
                class="rounded-circle"
                height="60"
                alt="user"
              />
              <h5 class="mt-3 mb-1 fw-semibold">Aditi Sharma</h5>
              <p class="text-muted small">Delhi University</p>
              <div class="rating">⭐⭐⭐⭐⭐</div>
            </div>
          </div>
        </div>

        <!-- Testimonial 2 -->
        <div class="carousel-item">
          <div class="testimonial-card mx-auto">
            <p class="fs-5">
              “The room was clean, the verification gave me confidence.
              Highly recommend this portal to all students!”
            </p>
            <div class="testimonial-meta mt-4">
              <img
                src="https://randomuser.me/api/portraits/men/32.jpg"
                class="rounded-circle"
                height="60"
                alt="user"
              />
              <h5 class="mt-3 mb-1 fw-semibold">Rohan Verma</h5>
              <p class="text-muted small">IIT Kanpur</p>
              <div class="rating">⭐⭐⭐⭐☆</div>
            </div>
          </div>
        </div>

        <!-- Testimonial 3 -->
        <div class="carousel-item">
          <div class="testimonial-card mx-auto">
            <p class="fs-5">
              “Booking a room took less than 10 minutes. Refund policy was
              super helpful. A+ experience!”
            </p>
            <div class="testimonial-meta mt-4">
              <img
                src="https://randomuser.me/api/portraits/women/65.jpg"
                class="rounded-circle"
                height="60"
                alt="user"
              />
              <h5 class="mt-3 mb-1 fw-semibold">Megha Das</h5>
              <p class="text-muted small">Jadavpur University</p>
              <div class="rating">⭐⭐⭐⭐⭐</div>
            </div>
          </div>
        </div>
      </div>

      <!-- Controls -->
      <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#testimonialCarousel"
        data-bs-slide="prev"
      >
        <span
          class="carousel-control-prev-icon bg-dark rounded-circle"
          aria-hidden="true"
        ></span>
      </button>
      <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#testimonialCarousel"
        data-bs-slide="next"
      >
        <span
          class="carousel-control-next-icon bg-dark rounded-circle"
          aria-hidden="true"
        ></span>
      </button>
    </div>
  </div>
</section>

<section
  class="cta-section py-5 text-white text-center"
  data-aos="fade-up"
  id="cta"
>
  <div class="container">
    <h2 class="display-5 fw-bold mb-3">🚀 Start Finding Your Room Now</h2>
    <p class="mb-4 fs-5">
      Join thousands of students & verified room owners today!
    </p>
    <div class="d-flex justify-content-center gap-3 flex-wrap">
      <a href="/register-student" class="btn btn-success btn-lg px-4">
        🧑‍🎓 Register as Student
      </a>
      <a href="/register-owner" class="btn btn-outline-light btn-lg px-4">
        🧑‍💼 List Your Room – Owner Register
      </a>
    </div>
  </div>
</section>

<section class="py-5 bg-light" id="stats">
  <div class="container text-center">
    <h2 class="mb-4 fw-bold">Our Growing Community</h2>
    <div class="row g-4">
      <div class="col-md-3 col-6">
        <div class="p-4 bg-white rounded shadow-sm">
          <h3 class="counter text-success fw-bold" data-target="1000">0</h3>
          <p class="mb-0">Rooms Listed</p>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="p-4 bg-white rounded shadow-sm">
          <h3 class="counter text-success fw-bold" data-target="500">0</h3>
          <p class="mb-0">Verified Owners</p>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="p-4 bg-white rounded shadow-sm">
          <h3 class="counter text-success fw-bold" data-target="1500">0</h3>
          <p class="mb-0">Happy Students</p>
        </div>
      </div>
      <div class="col-md-3 col-6">
        <div class="p-4 bg-white rounded shadow-sm">
          <h3 class="counter text-success fw-bold" data-target="120">0</h3>
          <p class="mb-0">Cities Covered</p>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@push('scripts')
  <link rel="stylesheet" href="{{asset('js/landing.page.js')}}">
@endpush