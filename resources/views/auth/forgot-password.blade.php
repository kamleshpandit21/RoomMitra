@extends('layouts.app')
@section('title')
    Forgot Password
@endsection

@push('styles')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <style>
        section.vh-50 {
            min-height: 90vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .card {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-header h4 {
            margin: 0;
        }
    </style>

    <style>
        :root {
            --main-color: #6366f1;
        }

        .auth-section {
            min-height: 100vh;
            background: linear-gradient(to right, #eef2ff, #ffffff);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 15px;
        }

        .auth-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
        }

        .auth-card .card-header {
            border-radius: 20px 20px 0 0;
            padding: 20px;
            background-color: var(--main-color);
            color: #fff;
        }

        .auth-card .card-body {
            padding: 30px;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-custom {
            background-color: var(--main-color);
            color: #fff;
            border-radius: 10px;
        }

        .btn-custom:hover {
            background-color: #4f46e5;
            color: #fff;
        }

        .text-small {
            font-size: 0.9rem;
        }

        .form-label i {
            margin-right: 8px;
        }
    </style>
@endpush

@section('content')
    <section class="auth-section">
        <div class="container">
            <div class="row justify-content-center">

                <!-- Forgot Password -->
                <div class="col-md-5" id="forgotSection">
                    <div class="card auth-card">
                        <div class="card-header text-center">
                            <h4><i class="fas fa-unlock-alt"></i> Forgot Password</h4>
                        </div>
                        <div class="card-body">
                            <form id="forgotPasswordForm">

                                <!-- Email -->
                                <div class="form-floating mb-3">
                                    <input type="email" class="form-control" id="email" name="email"
                                        placeholder="name@example.com" required>
                                    <label for="email"><i class="fas fa-envelope me-2"></i>Email Address</label>
                                    <div class="invalid-feedback">
                                        @error('email')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-custom w-100" id="sendOtpBtn">Send OTP</button>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- OTP Verification -->
                <div class="col-md-5 " id="otpSection" style="display: none">
                    <div class="card auth-card mt-4">
                        <div class="card-header text-center" style="background-color: #facc15; color: #000;">
                            <h4><i class="fas fa-key"></i> Verify OTP</h4>
                        </div>
                        <div class="card-body">
                            <form id="verifyOtpForm">
                                <input type="hidden" id="emailor">
                                <div class="mb-3">
                                    <label class="form-label"><i class="fas fa-shield-alt"></i> Enter 6-digit OTP</label>
                                    <input type="text" class="form-control" id="otp" maxlength="6"
                                        placeholder="OTP" required>
                                </div>
                                <button type="submit" class="btn btn-warning w-100 text-white" id="verifyOtpBtn">Verify
                                    OTP</button>
                                <div class="text-center mt-3 text-small">
                                    Didn’t receive OTP?
                                    <button type="button" class="btn btn-link p-0 m-0 align-baseline"
                                        id="resendOtpBtn">Resend OTP</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <!-- Reset Password -->
                <div class="col-md-5" id="resetSection" style="display: none">
                    <div class="card auth-card mt-4">
                        <div class="card-header text-center" style="background-color: #10b981;">
                            <h4><i class="fas fa-sync-alt"></i> Reset Password</h4>
                        </div>
                        <div class="card-body">
                            <form id="resetPasswordForm">
                                <input type="hidden">
                                <div class="mb-3">
                                    <label class="form-label"><i class="fas fa-lock"></i> New Password</label>
                                    <input type="password" class="form-control" id="newPassword" placeholder="New password"
                                        minlength="8" required>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label"><i class="fas fa-lock"></i> Confirm Password</label>
                                    <input type="password" class="form-control" id="confirmPassword"
                                        placeholder="Confirm password" required>
                                </div>
                                <button type="submit" class="btn btn-success w-100" id="resetPasswordBtn">Reset
                                    Password</button>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        /**
         * =========================================
         * Post Data (Async Handler Function)
         * =========================================
         */
        async function postData(url = '', data = {}) {
            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify(data)
                });

                const result = await response.json();
                if (!response.ok) {
                    throw new Error(result.message || 'Something went wrong!');
                }
                return result;
            } catch (error) {
                throw new Error(error.message || 'Unexpected error occurred');
            }
        }

        // 1. Handle Forgot Password
        document.getElementById('forgotPasswordForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const email = document.getElementById('email').value;
            const btn = this.querySelector('button[type="submit"]');
            toggleButtonLoading(btn, true, 'Send OTP');

            try {
                const response = await postData('{{ route('password.email') }}', {
                    email
                });
                Swal.fire('Success', response.message, 'success');
                document.getElementById('emailor').value = email;
                document.querySelector('#resetPasswordForm input[type="hidden"]').value = email;
                showSection('otpSection');
            } catch (err) {
                Swal.fire('Error', err.message, 'error');
            } finally {
                toggleButtonLoading(btn, false, 'Send OTP');
            }
        });

        document.getElementById('resendOtpBtn').addEventListener('click', async function() {
            const email = document.getElementById('emailor').value;
            const btn = this;
            toggleButtonLoading(btn, true, 'Resending...');

            try {
                const response = await postData('{{ route('password.email') }}', {
                    email
                });
                Swal.fire('Sent', response.message, 'success');
                startResendOtpCountdown();
            } catch (err) {
                Swal.fire('Error', err.message, 'error');
            } finally {
                toggleButtonLoading(btn, false, 'Resend OTP');
            }
        });

        // 2. Handle OTP Verification
        document.getElementById('verifyOtpForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const otp = document.getElementById('otp').value;
            const email = document.getElementById('emailor').value;



            try {
                const response = await postData('{{ route('otp.verify') }}', {
                    email,
                    otp
                });

                Swal.fire('Verified', response.message, 'success');

                // Show Reset Password section
                showSection('resetSection');

            } catch (err) {
                Swal.fire('Error', err.message, 'error');
            }
        });

        // 3. Handle Password Reset
        document.getElementById('resetPasswordForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const newPassword = document.getElementById('newPassword').value;
            const confirmPassword = document.getElementById('confirmPassword').value;
            const email = this.querySelector('input[type="hidden"]').value;

            if (newPassword !== confirmPassword) {
                Swal.fire('Error', "Passwords do not match!", 'warning');
                return;
            }

            try {
                const response = await postData('{{ route('password.update') }}', {
                    email,
                    password: newPassword,
                    password_confirmation: confirmPassword
                });

                Swal.fire({
                    icon: 'success',
                    title: 'Password Reset Successful',
                    text: response.message,
                    confirmButtonText: 'Login Now'
                }).then(() => {
                    window.location.href = "{{ route('login.form') }}";
                });

            } catch (err) {
                Swal.fire('Error', err.message, 'error');
            }
        });

        function showSection(idToShow) {
            ['forgotSection', 'otpSection', 'resetSection'].forEach(id => {
                document.getElementById(id).style.display = (id === idToShow) ? 'block' : 'none';
            });
        }

        function toggleButtonLoading(button, isLoading, originalText = 'Submit') {
            if (isLoading) {
                button.disabled = true;
                button.innerHTML =
                    `<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span> Processing...`;
            } else {
                button.disabled = false;
                button.innerHTML = originalText;
            }
        }

        let resendTimer;
        let countdown = 60;

        function startResendOtpCountdown() {
            const resendBtn = document.getElementById('resendOtpBtn');
            resendBtn.disabled = true;
            resendBtn.textContent = `Resend OTP in ${countdown}s`;

            resendTimer = setInterval(() => {
                countdown--;
                if (countdown <= 0) {
                    clearInterval(resendTimer);
                    resendBtn.disabled = false;
                    resendBtn.textContent = 'Resend OTP';
                    countdown = 60;
                } else {
                    resendBtn.textContent = `Resend OTP in ${countdown}s`;
                }
            }, 1000);
        }
    </script>
@endpush
