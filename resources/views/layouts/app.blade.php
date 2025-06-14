<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />

        <title>RoomMitra | @yield('title', 'Home')</title>
        <meta name="description"
            content="RoomMitra helps students find 100% verified, affordable, and secure PGs, hostels, and rental rooms near their college. Safe booking. Owner-verified." />
        <meta name="keywords"
            content="Room booking, Student accommodation, Hostel booking, PGs, RoomMitra, Student housing India" />
        <meta name="robots" content="index, follow" />

        <!-- Open Graph (Facebook & others) -->
        <meta property="og:title" content="RoomMitra | Student Room Booking Simplified" />
        <meta property="og:description"
            content="Explore verified rooms with owner KYC, secure booking, and flexible cancellations on RoomMitra." />
        {{-- <meta property="og:type" content="website" />
        <meta property="og:url" content="https://www.roommitra.in" />
        <meta property="og:image" content="https://www.roommitra.in/assets/og-image.jpg" /> --}}

        <!-- Twitter Card -->
        {{-- <meta name="twitter:card" content="summary_large_image" />
        <meta name="twitter:title" content="RoomMitra | Simplified Student Room Booking" />
        <meta name="twitter:description" content="100% Verified Rooms, No Brokers, Just Peace of Mind." />
        <meta name="twitter:image" content="https://www.roommitra.in/assets/twitter-card.jpg" /> --}}

        <!-- Preconnect for performance -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <!-- Google Fonts: Optimized -->
        <link
            href="https://fonts.googleapis.com/css2?family=Nunito:wght@600;800&family=Quicksand:wght@300;500;700&family=Raleway:wght@400;600;800&display=swap"
            rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />

        <!-- Font Awesome (Latest) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
            integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Animate.css (Latest v4) -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />

        <!-- AOS (Animate on Scroll) -->
        <link href="{{ asset('aos/dist/aos.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href="{{ asset('css/landing-page.css') }}">


        @stack('styles')
        <style>
            html,
            body {
                width: 100%;
                height: 100%;
                background-color: #fff;
                font-family: 'raleway', sans-serif;
            }

            /* Smooth sticky effect */
            .sticky-nav {
                position: sticky;
                top: 0;
                z-index: 1030;
                transition: all 0.3s ease-in-out;
            }

            .navbar {
                padding-top: 0.5rem;
                padding-bottom: 0.5rem;
                transition: all 0.3s ease-in-out;
                background-color: rgba(0, 0, 0, 0.3);
                /* Semi-transparent dark background */
                color: #ffffff;
                /* White text */
            }

            .navbar-nav .nav-link {
                padding: 0.75rem 1rem;
                font-weight: 500;
                font-size: 1.1rem;
                color: #ffffff;
                /* White text for links */
            }

            /* Navbar links color when hovered */
            .navbar-nav .nav-link:hover,
            .navbar-nav .nav-link.active {
                color: #6366f1;
                /* Bootstrap success color */
            }

            /* Notification icon spacing */
            .navbar .fa-bell,
            .navbar .fa-heart {
                cursor: pointer;
                transition: color 0.3s;
            }

            .navbar .fa-bell:hover,
            .navbar .fa-heart:hover {
                color: #198754;
            }

            /* Profile avatar hover */
            .dropdown-toggle img {
                transition: transform 0.3s ease;
            }

            .dropdown-toggle:hover img {
                transform: scale(1.05);
            }

            /* When scrolled, navbar becomes solid */
            .navbar.scrolled {
                background-color: #ffffff !important;
                /* Solid white background */
                padding-top: 1.2rem;
                padding-bottom: 1.2rem;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                /* Add shadow when solid */
                color: #000 !important;
                /* Dark text color for solid navbar */
            }

            .navbar.scrolled .nav-link {
                color: #000 !important;
                /* Dark text for links when navbar becomes solid */
            }

            .navbar.scrolled .nav-link:hover,
            .navbar.scrolled .nav-link.active {
                color: #6366f1 !important;
            }

            /* Animation for shadow/pulse effect */
            @keyframes pulse {
                0% {
                    box-shadow: 0 0 0 0 #6366f1;
                }

                70% {
                    box-shadow: 0 0 0 10px rgba(0, 123, 255, 0);
                }

                100% {
                    box-shadow: 0 0 0 0 rgba(0, 123, 255, 0);
                }
            }

            .shadow-pulse {
                animation: pulse 1.5s infinite;
            }
        </style>

    </head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm fixed-top py-3">
        <div class="container-fluid px-lg-5 d-flex justify-content-between align-items-center">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('logo/RoomLogo.png') }}" alt="Logo" alt="" height="80">
            </a>

            <!-- Toggle Button (Mobile) -->
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
                <ul class="navbar-nav align-items-center w-100 d-flex flex-wrap justify-content-end gap-3 ">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('rooms') }}">Rooms</a>
                    </li>
                    <!-- Pages -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('wishlist.index') }}">Wishlist</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact.form') }}">Contact</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('faqs') }}">FAQ</a>
                    </li>


                    <!-- Login/Register -->
                    @if (Auth::check() && Auth::user())
                        <li class="nav-item">
                            <a href="{{ route('user.profile.index') }}" class="btn btn-success">Profile</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="btn btn-outline-success me-2">Logout</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('register.form') }}"
                                class="btn btn-lg fs-5 shadow-pulse me-2 text-white "
                                style="background: linear-gradient(135deg, #6366f1, #8b5cf6)">Get Started</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Full Width Footer -->
    <footer class="text-white" style="background-color: #1c2331">
        <!-- Social Media -->
        <section class="d-flex justify-content-between align-items-center px-5 py-4"
            style="background:linear-gradient(135deg, #6366f1, #8b5cf6)">
            <span class="fw-semibold">Get connected with us on social networks:</span>
            <div>
                <a href="#" class="text-white me-4"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="text-white me-4"><i class="fab fa-twitter"></i></a>
                <a href="#" class="text-white me-4"><i class="fab fa-instagram"></i></a>
                <a href="#" class="text-white me-4"><i class="fab fa-linkedin"></i></a>
                <a href="#" class="text-white me-4"><i class="fab fa-github"></i></a>
            </div>
        </section>

        <!-- Main Footer Content -->
        <section class="px-5 pt-5">
            <div class="row gx-5 gy-4">
                <!-- Company Info -->
                <div class="col-md-3">
                    <img src="{{ asset('logo/RoomLogo.png') }}" alt="" height="80">
                    <hr class="text-success" style="width: 60px; height: 2px" />
                    <p>
                        A one-stop platform for students to find and book verified
                        accommodations with ease and confidence.
                    </p>
                </div>

                <!-- Explore Links -->
                <div class="col-md-2">
                    <h6 class="text-uppercase fw-bold">Explore</h6>
                    <hr class="text-success" style="width: 60px; height: 2px" />
                    <p><a href="{{ route('home') }}" class="text-white text-decoration-none">Home</a></p>
                    <p>
                        <a href="{{ route('about') }}" class="text-white text-decoration-none">About Us</a>
                    </p>
                    <p><a href="" class="text-white text-decoration-none">Rooms</a></p>

                </div>

                <!-- Useful Links -->
                <div class="col-md-3">
                    <h6 class="text-uppercase fw-bold">Useful Links</h6>
                    <hr class="text-success" style="width: 60px; height: 2px" />
                    {{-- <p>
                        <a href="#" class="text-white text-decoration-none">My Account</a>
                    </p>
                    <p>
                        <a href="#" class="text-white text-decoration-none">Booking History</a>
                    </p> --}}
                    <p><a href="{{ route('faqs') }}" class="text-white text-decoration-none">FAQs</a></p>
                    <p>
                        <a href="{{ route('contact.form') }}" class="text-white text-decoration-none">Contact</a>
                    </p>
                    <p>
                        <a href="{{ route('complaint.form') }}" class="text-white text-decoration-none">Complaint</a>
                    </p>
                </div>

                <!-- Contact Info -->
                <div class="col-md-4">
                    <h6 class="text-uppercase fw-bold">Contact</h6>
                    <hr class="text-success" style="width: 60px; height: 2px" />
                    <p>
                        <i class="fas fa-home me-3"></i> Lucknow, Uttar Pradesh, India
                    </p>
                    <p>
                        <i class="fas fa-envelope me-3"></i> support@roommitra.com
                    </p>
                    <p><i class="fas fa-phone me-3"></i> <span
                            style="font-family: 'Times New Roman', Times, serif;">+91 1234567890</span></p>
                </div>
            </div>
        </section>

        <!-- Copyright -->
        <div class="text-center py-3 mt-4" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2025 Copyright:
            <a class="text-white text-decoration-none fw-bold" href="#">RoomMitra.com</a>
        </div>
    </footer>

    <!-- JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <!-- AOS JS -->
    <script src="{{ asset('aos/dist/aos.js') }}"></script>

    <script>
        AOS.init(); // using default settings

        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    </script>

    @stack('scripts')

    <script>
        // Navbar scroll effect

        window.addEventListener("scroll", function() {
            const navbar = document.querySelector(".navbar");
            if (window.scrollY > 50) {
                navbar.classList.add("scrolled"); // Add solid background after scroll
            } else {
                navbar.classList.remove("scrolled"); // Remove solid background when near top
            }
        });
    </script>
</body>

</html>
