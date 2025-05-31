@extends('layouts.app')

@section('title', 'Login')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/landing-page.css') }}">
    <style>
        .form-control:focus {
            box-shadow: none;
            border-color: #6366f1;
        }

        .form-floating label {
            color: #6c757d;
        }

        .bg-success-light {
            background: #d1e7dd;
        }

        .btn-google {
            border: 1px solid #ccc;
            background-color: white;
            color: #444;
        }

        .btn-google:hover {
            background-color: #f1f1f1;
        }
    </style>
@endpush

@section('content')

    <section class="text-center py-5" style="margin: 80px 0 80px 0;">
        <div class="container">
            <h1 class="display-5 fw-bold  heading">Login Now</h1>

        </div>

        <div class="container ">
            <div class="row justify-content-center ">

                <div class="row">

                    <div class="col-md-6"
                        style="background: url({{ asset('img/register.svg') }}) center center/contain no-repeat;"data-aos="fade-right"
                        data-aos-duration="1000">


                    </div>

                    <!-- Right Side Login Form -->
                    <div class="col-md-6 p-5 d-flex flex-column justify-content-center" data-aos="fade-left"
                        data-aos-duration="1000">
                        <h6 class="fw-bold text-success mb-4">
                            {{ session('success') }} {{ session('error') }} @if (isset($email))
                                {{ $email }}
                            @endif
                        </h6>
                        <form method="POST" action="{{ route('login') }}" novalidate id="login-form">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Email -->
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control" id="email" name="email"
                                            placeholder="name@example.com" required>
                                        <label for="email"><i class="fas fa-envelope me-2"></i>Email address</label>
                                        <div class="invalid-feedback">
                                            @error('email')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Password -->
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Password" required>
                                        <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                                        <div class="invalid-feedback">
                                            @error('password')
                                                {{ $message }}
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>





                            <!-- Remember Me & Forgot Password -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Remember Me</label>
                                </div>
                                <a href="{{ route('password.request') }}">Forgot Password?</a>
                            </div>

                            <!-- Role -->
                            <div class="mb-3">
                                <label for="role" class="form-label fw-semibold">Who are you?</label>
                                <select class="form-select" name="role" required>
                                    <option value="user">Student</option>
                                    <option value="room_owner">Room Owner</option>
                                </select>
                            </div>

                            <!-- Submit -->
                            <button type="submit" class="btn submit-btn w-100 py-2 mb-3">Login</button>

                            <div class="text-center mb-3">
                                <small class="text-muted">Don't have an account? <a
                                        href="{{ route('register.form') }}">Register Now</a></small>
                            </div>


                            <!-- Social Login -->
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('social.login', ['provider' => 'google', 'role' => 'user']) }}"
                                    class="btn btn-google w-100 me-2">
                                    <i class="fab fa-google me-1"></i> Google (Student)
                                </a>

                                <a href="{{ route('social.login', ['provider' => 'google', 'role' => 'room_owner']) }}"
                                    class="btn btn-google w-100 ms-2">
                                    <i class="fab fa-google me-1"></i> Google (Owner)
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
