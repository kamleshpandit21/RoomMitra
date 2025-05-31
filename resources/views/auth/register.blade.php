@extends('layouts.app')

@section('title', 'Register')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .register-section {

            padding: 2rem 0;
        }

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
            <h1 class="display-5 fw-bold  heading">Register Now</h1>

        </div>

        <div class="container ">
            <div class="row justify-content-center register-section">

                <div class="row">

                    <div class="col-md-6"
                        style="background: url({{ asset('img/register.svg') }}) center center/contain no-repeat;"data-aos="fade-right"
                        data-aos-duration="1000">


                    </div>


                    <!-- Right Form Section -->
                    <div class="col-md-6 p-5 d-flex flex-column justify-content-center" data-aos="fade-left"
                        data-aos-duration="1000">
                        <h6 class="fw-bold text-success mb-4">
                            {{ session('success') }} {{ session('error') }} @if (isset($email))
                                {{ $email }}
                            @endif
                        </h6>

                        <form method="POST" action="{{ route('register') }}" id="register-form">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <!-- Full Name -->
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control @error('full_name') is-invalid @enderror"
                                            id="full_name" name="full_name" placeholder="Full Name" required>
                                        <label for="full_name"><i class="fas fa-user me-2"></i>Full Name</label>
                                        @error('full_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Email -->
                                    <div class="form-floating mb-3">
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" placeholder="Email" required>
                                        <label for="email"><i class="fas fa-envelope me-2"></i>Email address</label>
                                        @error('email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>




                            <!-- Phone -->
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                    id="phone" name="phone" placeholder="Phone" required>
                                <label for="phone"><i class="fas fa-phone me-2"></i>Phone</label>
                                @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">

                                <div class="col-md-6">
                                    <!-- Password -->
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                                            id="password" name="password" placeholder="Password" required>
                                        <label for="password"><i class="fas fa-lock me-2"></i>Password</label>
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <!-- Confirm Password -->
                                    <div class="form-floating mb-3">
                                        <input type="password" class="form-control" id="password_confirmation"
                                            name="password_confirmation" placeholder="Confirm Password" required>
                                        <label for="password_confirmation"><i class="fas fa-lock me-2"></i>Confirm
                                            Password</label>
                                    </div>
                                </div>

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
                            <button type="submit" class="btn submit-btn w-100 py-2 mb-3">Register</button>

                            <div class="text-center">
                                <small class="text-muted">Already have an account?
                                    <a href="{{ route('login.form') }}" class="text-success fw-semibold">Login Now</a>
                                </small>
                            </div>

                            <!-- OR separator -->
                            <div class="text-center my-3 text-muted">
                                <hr>
                                <span class="bg-white px-2">or register with</span>
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
                    </div> <!-- End Right -->
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <Script>
        document.addEventListener('DOMContentLoaded', function() {

            // AJAX Login Submission
            const loginForm = document.getElementById('login-form');

            loginForm.addEventListener('submit', function(e) {
                e.preventDefault();

                const formData = new FormData(loginForm);

                fetch("{{ route('login') }}", {
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
