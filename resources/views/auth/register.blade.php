@extends('layouts.app')

@section('title', 'Login')

@push('styles')
@endpush

@section('content')
    <section class="login-section mt-2 d-flex align-items-center mb-3">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10 shadow rounded-2 overflow-hidden bg-white">
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
                            <h4 class="fw-bold text-success mb-4 text-center">📝 Register with StudentStay</h4>
                            <form method="POST" action="{{ route('common.register') }}" novalidate id="register-form">
                                @csrf

                                {{-- Full Name --}}
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                        id="name" name="full_name" placeholder="name@example.com">
                                    <label for="name"><i class="fas fa-user me-2"></i>Full Name</label>
                                    @error('full_name')
                                        <span class="invalid-feedback" role="alert"></span>
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                                <!-- Email -->
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="name@example.com" required>
                                    <label for="email"><i class="fas fa-envelope me-2"></i>Email address</label>
                                </div>
                                
                                {{-- Phone --}}
                                <div class="form-floating mb-3">
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                        id="phone" name="phone" placeholder="name@example.com">
                                    <label for="phone"><i class="fas fa-user me-2"></i>Phone</label>
                                    @error('phone')
                                        <span class="invalid-feedback" role="alert"></span>
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </div>
                                {{-- Password --}}
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Password" required>
                                    <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert"></span>
                                        <strong>{{ $message }}</strong>
                                    @enderror
                                </div>


                                <!-- Password -->
                                <div class="form-floating mb-3">
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
                                        placeholder="Confirm Password" required>
                                    <label for="password_confirmation"><i class="fas fa-lock me-2"></i>Password</label>
                                </div>

                                <!-- Role Toggle (Optional) -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Who are you?</label>
                                    <select class="form-select" name="role" required>
                                        <option value="user">User</option>
                                        <option value="room_owner">Owner</option>
                                    </select>
                                </div>

                                <!-- Submit Button -->
                                <button type="submit" class="btn btn-success w-100 py-2">Register</button>

                                <div class="text-center mt-4">
                                <small class="text-muted">Already have an account? <a href="{{ route('common.login.form') }}"
                                        class="text-success">Login Now</a></small> 
                                </div>

                                <!-- Social Login Placeholder -->
                                <div class="text-center mt-4">
                                    <small class="text-muted">Or Register with</small>
                                    <div class="mt-2">
                                          <!-- Login as Student with Google -->
                                          <a href="{{ route('common.social.login', ['provider' => 'google', 'role' => 'user']) }}"
                                            class="btn btn-outline-dark btn-sm me-2" id="google-login-user">
                                            <i class="fab fa-google me-1"></i> Student Google Login
                                        </a>

                                        <!-- Login as Room Owner with Google -->
                                        <a href="{{ route('common.social.login', ['provider' => 'google', 'role' => 'room_owner']) }}"
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
    <Script>
      document.addEventListener('DOMContentLoaded', function () {

    // AJAX Login Submission
    const loginForm = document.getElementById('login-form');

    loginForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(loginForm);

        fetch("{{ route('common.login') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Redirect to dashboard or show success
                window.location.href = data.redirect_to || '/dashboard';
            } else {
                // Show error messages
                alert(data.message || "Invalid login credentials.");
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert("Something went wrong. Please try again.");
        });
    });
});
    </Script>
@endpush
