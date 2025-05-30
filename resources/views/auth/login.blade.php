@extends('layouts.app')

@section('title', 'Login')

@push('styles')
    <link rel="stylesheet" href="{{asset('css/landing-page.css')}}">
@endpush

@section('content')

<section class="login-section vh-100 d-flex align-items-center" style="padding: 160px 0 80px 0;">
     
    <div class="container">
        <div class="container">
            <h1 class="display-5 fw-bold  heading">Login Now</h1>

        </div>
        <div class="row justify-content-center">
            <div class="col-lg-10 shadow rounded-4 overflow-hidden bg-white">
                <div class="row">
                    <!-- Left Side Image & Tagline -->
                    <div
                        class="col-md-6 d-none d-md-flex align-items-center justify-content-center bg-success text-white p-4">
                        <div class="text-center">
                            <img src="/assets/logo.png" alt="Logo" class="mb-4" style="width: 80px;">
                            <h2 class="fw-bold">Welcome Back!</h2>
                            <p class="lead">Secure student housing starts here.</p>
                        </div>
                    </div>

                    <!-- Right Side Login Form -->
                    <div class="col-md-6 p-5">
                        <h4 class="fw-bold text-success mb-4 text-center">🔐 Login to Your Account</h4>
                        <h6 class="fw-bold text-success mb-4">
                            {{ session('success') }} {{ session('error') }} @if (isset($email))
                                {{ $email }}
                                
                            @endif
                        </h6>
                        <form method="POST" action="{{ route('login') }}" novalidate id="login-form">
                            @csrf

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

                            <!-- Remember Me & Forgot Password -->
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="remember" name="remember">
                                    <label class="form-check-label" for="remember">Remember Me</label>
                                </div>
                                <a href="" class="text-success">Forgot Password?</a>
                            </div>

                            <!-- Role Toggle (Optional) -->
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Login as:</label>
                                <select class="form-select" name="role" required>
                                    <option value="user">User</option>
                                    <option value="room_owner">Owner</option>
                                </select>
                            </div>

                            <!-- Submit Button -->
                            <button type="submit" class="btn btn-success w-100 py-2">Login</button>

                            <div class="text-center mt-4">
                                <small class="text-muted">Don't have an account? <a href="{{ route('register.form') }}"
                                        class="text-success">Register Now</a></small>
                            </div>

                            <!-- Social Login Placeholder -->
                            <div class="text-center mt-4">
                                <small class="text-muted">Or Register with</small>
                                <div class="mt-2">
                                      <!-- Login as Student with Google -->
                                      <a href="{{ route('social.login', ['provider' => 'google', 'role' => 'user']) }}"
                                        class="btn btn-outline-dark btn-sm me-2" id="google-login-user">
                                        <i class="fab fa-google me-1"></i> Student Google Login
                                    </a>

                                    <!-- Login as Room Owner with Google -->
                                    <a href="{{ route('social.login', ['provider' => 'google', 'role' => 'room_owner']) }}"
                                        class="btn btn-outline-dark btn-sm" id="google-login-owner">
                                        <i class="fab fa-google me-1"></i> Room Owner Google Login
                                    </a>
                                </div>
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