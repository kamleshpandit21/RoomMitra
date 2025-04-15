<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>RoomMitra | @yield('title')</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css?family=Sansita" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" />
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <link rel="stylesheet" href="{{ asset('css/landing-page.css') }}">

    @stack('styles')
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top py-3">
        <div class="container-fluid px-lg-5 d-flex justify-content-between align-items-center">
            <!-- Logo -->
            <a class="navbar-brand fw-bold text-success d-flex align-items-center" href="index.html">
                <img src="https://img.icons8.com/color/48/room.png" alt="logo" height="30" class="me-2" />
                RoomMitra
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
                    @if (session()->get('user_role') == 'room_owner')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('owner.dashboard') }}">Dashboard</a>
                        </li>
                    @endif
                    <li class="nav-item"> {{-- {{ route('rooms.index') }} --}}
                        <a class="nav-link" href="">Rooms</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('contact') }}">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('faq') }}">FAQ</a>
                    </li>


                    <!-- Language Dropdown (Optional) -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown">
                            🌐 English
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#">हिंदी</a></li>
                            <li><a class="dropdown-item" href="#">বাংলা</a></li>
                            <li><a class="dropdown-item" href="#">मराठी</a></li>
                        </ul>
                    </li>
                    @if (session()->has('user_id') && isset($user))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button"
                                data-bs-toggle="dropdown">
                                <img src="{{ $user->userProfile && $user->userProfile->avatar
                                    ? asset($user->userProfile->avatar)
                                    : asset('storage/avatar/avatar.png') }}"
                                    alt="Avatar" class="rounded-circle me-2"
                                    style="width: 35px; height: 35px; object-fit: cover;">
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a></li>
                                <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            {{-- {{ route('login.form') }} --}}
                            <a href="" class="btn btn-outline-success me-2">Login</a>
                        </li>
                        <li class="nav-item">
                            {{-- {{ route('register.form') }} --}}
                            <a href="" class="btn btn-success">Register</a>
                        </li>
                    @endif


                </ul>
            </div>
        </div>
    </nav>
    {{-- Main Section Start --}}
    <main>

        @yield('content')

    </main>
    {{-- Main Section End --}}
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
                        <a href="{{ route('contact') }}" class="text-white text-decoration-none">Contact</a>
                    </p>
                </div>

                <!-- Useful Links -->
                <div class="col-md-3">
                    <h6 class="text-uppercase fw-bold">Useful Links</h6>
                    <hr class="text-success" style="width: 60px; height: 2px" />
                    <p>
                        <a href="#" class="text-white text-decoration-none">My Account</a>
                    </p>
                    <p>
                        <a href="#" class="text-white text-decoration-none">Booking History</a>
                    </p>
                    <p><a href="{{ route('faq') }}" class="text-white text-decoration-none">FAQs</a></p>
                    <p>

                        <a href="{{ route('complaint') }}" class="text-white text-decoration-none">Complaint</a>
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
            <a class="text-white text-decoration-none fw-bold" href="{{ route('home') }}">StudentRoomPortal.com</a>
        </div>
    </footer>

    <!-- End of .container -->

    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- Initialize AOS -->
    <script>
        AOS.init();
    </script>
    <script src="{{ asset('js/user.master.js') }}"></script>
    @stack('scripts')

</body>

</html>
