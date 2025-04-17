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
@endpush

@section('content')
    <section class="vh-50">

        <!-- 1. Forgot Password Page -->
        <section class="container" id="forgotSection">
            <div class="row justify-content-center">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header text-center bg-primary text-white">
                            <h4><i class="fas fa-unlock-alt"></i> Forgot Password</h4>
                        </div>
                        <div class="card-body">
                            <form id="forgotPasswordForm">
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" id="email" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary w-100">Send OTP</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 2. OTP Verification Page -->
        <section class="container mt-4" id="otpSection" style="display: none;">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header bg-warning text-center">
                            <h4><i class="fas fa-key"></i> Verify OTP</h4>
                        </div>
                        <div class="card-body">
                            <form id="verifyOtpForm">
                                <input type="hidden" id="emailor">
                                <div class="mb-3">
                                    <label for="otp" class="form-label">Enter 6-digit OTP</label>
                                    <input type="text" id="otp" class="form-control" maxlength="6" required>
                                </div>
                                <button type="submit" class="btn btn-warning w-100">Verify OTP</button>
                                <div class="text-center mt-2">
                                    <a href="#">Resend OTP</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- 3. Reset Password Page -->
        <section class="container mt-4" id="resetSection" style="display: none;">
            <div class="row justify-content-center">
                <div class="col-md-5">
                    <div class="card">
                        <div class="card-header bg-success text-white text-center">
                            <h4><i class="fas fa-sync-alt"></i> Reset Password</h4>
                        </div>
                        <div class="card-body">
                            <form id="resetPasswordForm">
                                <input type="hidden">
                                <div class="mb-3">
                                    <label for="newPassword" class="form-label">New Password</label>
                                    <input type="password" id="newPassword" class="form-control" minlength="8" required>
                                </div>
                                <div class="mb-3">
                                    <label for="confirmPassword" class="form-label">Confirm Password</label>
                                    <input type="password" id="confirmPassword" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-success w-100">Reset Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </section>
@endsection

@push('scripts')
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function getCsrfToken() {
            return document.querySelector('meta[name="csrf-token"]').content;
        }

        async function postData(url = '', data = {}) {
            try {
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': getCsrfToken(),
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

            try {
                const response = await postData('{{ route('forgot.sendOtp') }}', {
                    email
                });

                Swal.fire('Success', response.message, 'success');

                // Pass email to next forms
                document.getElementById('emailor').value = email;
                document.querySelector('#resetPasswordForm input[type="hidden"]').value = email;

                // Show OTP section
                document.getElementById('forgotSection').style.display = 'none';
                document.getElementById('otpSection').style.display = 'block';

            } catch (err) {
                Swal.fire('Error', err.message, 'error');
            }
        });

        // 2. Handle OTP Verification
        document.getElementById('verifyOtpForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const otp = document.getElementById('otp').value;
            const email = document.getElementById('emailor').value;

            try {
                const response = await postData('{{ route('forgot.verifyOtp') }}', {
                    email,
                    otp
                });

                Swal.fire('Verified', response.message, 'success');

                document.getElementById('otpSection').style.display = 'none';
                document.getElementById('resetSection').style.display = 'block';

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
                const response = await postData('{{ route('forgot.resetPassword') }}', {
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
    </script>
@endpush
