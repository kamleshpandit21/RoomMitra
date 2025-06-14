<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>RoomMitra | @yield('title', 'Home')</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    @stack('styles')
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">

</head>
@php
    if (Auth::check()):
        $user = Auth::user();
        $profile = $user->ownerProfile;
    endif;
@endphp


<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('owner.dashboard') }}" class="nav-link">Dashboard</a>
                </li>

                <li class="nav-item d-none d-sm-inline-block">
                    <a href="{{ route('owner.complaints.index') }}" class="nav-link">Support</a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('owner.profile.index') }}">
                        Profile
                    </a>
                </li>
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="far fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">5</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <span class="dropdown-item dropdown-header">5 Notifications</span>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-envelope mr-2"></i> 2 new bookings
                            <span class="float-right text-muted text-sm">3 mins</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-users mr-2"></i> 3 check-ins today
                            <span class="float-right text-muted text-sm">12 hours</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i> 1 new review
                            <span class="float-right text-muted text-sm">2 days</span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.html" class="brand-link">
                <img src="https://placehold.co/600x400" alt="Property Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">RoomMitra</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">


                        <img src="{{ asset($profile->avatar) ?? asset('adminlte/dist/img/user2-160x160.jpg') }}"
                            alt="Owner Image" class="img-circle elevation-2" alt="Owner Image">
                    </div>
                    <div class="info">

                        <a href="{{ route('owner.profile.index') }}" class="d-block">{{ $user->full_name ?? '' }}</a>
                        <small class="d-block text-muted">Room Owner</small>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Dashboard -->
                        <li class="nav-item">
                            <a href="{{ route('owner.dashboard') }}" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>

                        <!-- Room Management -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-bed"></i>
                                <p>
                                    Room Management
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('owner.rooms.create') }}" class="nav-link">
                                        <i class="fas fa-plus-circle nav-icon"></i>
                                        <p>Add New Room</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('owner.rooms.index') }}" class="nav-link">
                                        <i class="fas fa-list nav-icon"></i>
                                        <p>View All Rooms</p>
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <!-- Bookings -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-calendar-alt"></i>
                                <p>
                                    Bookings
                                    <i class="fas fa-angle-left right"></i>
                                    <span class="badge badge-info right">3</span>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="current-bookings.html" class="nav-link">
                                        <i class="fas fa-clock nav-icon"></i>
                                        <p>Current Bookings</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="booking-history.html" class="nav-link">
                                        <i class="fas fa-history nav-icon"></i>
                                        <p>Booking History</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Payments -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-wallet"></i>
                                <p>
                                    Payments
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="payment-records.html" class="nav-link">
                                        <i class="fas fa-coins nav-icon"></i>
                                        <p>Payment Records</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="revenue-reports.html" class="nav-link">
                                        <i class="fas fa-chart-line nav-icon"></i>
                                        <p>Revenue Reports</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Complaints -->
                        <li class="nav-item">
                            <a href="complaints.html" class="nav-link">
                                <i class="nav-icon fas fa-exclamation-triangle"></i>
                                <p>
                                    Complaints
                                    <span class="badge badge-danger right">2</span>
                                </p>
                            </a>
                        </li>


                        <!-- Profile -->
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user-cog"></i>
                                <p>
                                    Profile Settings
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('owner.profile.index') }}" class="nav-link">
                                        <i class="fas fa-user nav-icon"></i>
                                        <p>View Profile</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('owner.profile.edit') }}" class="nav-link">
                                        <i class="fas fa-user-edit nav-icon"></i>
                                        <p>Edit Profile</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('owner.profile.index') }}" class="nav-link">
                                        <i class="fas fa-lock nav-icon"></i>
                                        <p>Change Password</p>
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <!-- Logout -->
                        <li class="nav-item">
                            <a href="{{ route('logout') }}" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>Logout</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper p-3">

            @yield('content')
        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                Anything you want
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2025 <a href="{{ route('owner.dashboard') }}">RoomMitra</a>.</strong> All rights
            reserved.
        </footer>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true
        });
    </script>
    <!-- ./wrapper -->
    @stack('scripts')
    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>

</body>

</html>
