<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>RoomMitra | @yield('title', 'Home')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Sansita" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    @stack('styles')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <style>
        html,
        body {
            width: 100%;
            height: 100%;
            background-color: #fff;
            font-family: "Sansita", sans-serif;
        }

        /* Smooth sticky effect */
        .sticky-nav {
            position: sticky;
            top: 0;
            z-index: 1030;
            transition: all 0.3s ease-in-out;
        }

        /* Navbar spacing control */
        .navbar-nav .nav-link {
            padding: 0.75rem 1rem;
            font-weight: 500;
            color: #333;
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #198754;
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
    </style>

</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top py-3">
        <div class="container-fluid px-lg-5 d-flex justify-content-between align-items-center">
            <!-- Logo -->
            <a class="navbar-brand fw-bold text-success d-flex align-items-center" href="index.html">
                <img src="https://img.icons8.com/color/48/room.png" alt="logo" height="30" class="me-2" />
                StudentRoom
            </a>

            <!-- Toggle Button (Mobile) -->
            <button class="navbar-toggler ms-auto" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
                <ul class="navbar-nav align-items-center w-100 d-flex flex-wrap justify-content-end gap-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('home') }}">Home</a>
                    </li>
                    <!-- Pages -->
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('about') }}">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact.form') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('faqs') }}">FAQ</a>
                    </li>

                    <!-- Language Dropdown (Optional) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            🌐 English
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">हिंदी</a></li>
                            <li><a class="dropdown-item" href="#">বাংলা</a></li>
                            <li><a class="dropdown-item" href="#">मराठी</a></li>
                        </ul>
                    </li>

                    <!-- Login/Register -->
                    <li class="nav-item">
                        <a href="{{ route('login.form') }}" class="btn btn-outline-success me-2">Login</a>
                        <a href="{{ route('register.form') }}" class="btn btn-success">Register</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <!-- Full Width Footer -->
    <footer class="text-white" style="background-color: #1c2331">
        <!-- Social Media -->
        <section class="d-flex justify-content-between align-items-center px-5 py-4" style="background-color: #268c38">
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
                    <h6 class="text-uppercase fw-bold">Student Room Portal</h6>
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
                    <p>
                        <a href="{{ route('contact.form') }}" class="text-white text-decoration-none">Contact</a>
                    </p>
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
                        <i class="fas fa-envelope me-3"></i> support@studentroomportal.com
                    </p>
                    <p><i class="fas fa-phone me-3"></i> +91 9876543210</p>
                    <p><i class="fas fa-print me-3"></i> +91 9876543211</p>
                </div>
            </div>
        </section>

        <!-- Copyright -->
        <div class="text-center py-3 mt-4" style="background-color: rgba(0, 0, 0, 0.2)">
            © 2025 Copyright:
            <a class="text-white text-decoration-none fw-bold" href="#">StudentRoomPortal.com</a>
        </div>
    </footer>

    <!-- End of .container -->

    <!-- Add remaining sections following similar structure -->

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Initialize AOS -->
    <script>
        AOS.init();
    </script>
    @stack('scripts')

    <script>
        // Navbar scroll effect
        window.addEventListener("scroll", function() {
            if (window.scrollY > 50) {
                document.getElementById("mainNav").classList.add("nav-scroll");
            } else {
                document.getElementById("mainNav").classList.remove("nav-scroll");
            }
        });
    </script>
    <script>
        const counters = document.querySelectorAll(".counter");
        const speed = 200; // lower = faster

        const animateCounters = () => {
            counters.forEach((counter) => {
                const updateCount = () => {
                    const target = +counter.getAttribute("data-target");
                    const count = +counter.innerText;
                    const inc = Math.ceil(target / speed);

                    if (count < target) {
                        counter.innerText = count + inc;
                        setTimeout(updateCount, 30);
                    } else {
                        counter.innerText = target + "+";
                    }
                };
                updateCount();
            });
        };

        let started = false;
        window.addEventListener("scroll", () => {
            const statsSection = document.getElementById("stats");
            const sectionTop = statsSection.getBoundingClientRect().top;
            const screenHeight = window.innerHeight;

            if (!started && sectionTop < screenHeight) {
                started = true;
                animateCounters();
            }
        });
    </script>
</body>

</html>
