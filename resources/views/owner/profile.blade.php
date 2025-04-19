@extends('layouts.owner')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user.profile.css') }}">
@endpush
@section('content')
    <div class="container py-5">
        <div class="row">

            <!-- Sidebar/Profile Summary -->
            <div class="col-md-4">
                <div class="card text-center" style="border-radius: 15px;">
                    <div class="card-body">
                        <div class="mt-3 mb-4">
                            <img src="{{ $user->userProfile && $user->userProfile->avatar
                                ? asset($user->userProfile->avatar)
                                : asset('storage/avatar/avatar.png') }}"
                                alt="Profile" class="rounded-circle img-fluid" style="width: 100px;" />


                        </div>
                        <h4 class="mb-2">{{ $user->full_name }}</h4>

                        @if ($user->is_verified)
                            <span class="badge bg-success mb-2">Verified <i class="fa fa-check-circle"></i></span>
                        @else
                            <span class="badge bg-danger mb-2">Not Verified <i class="fa fa-times-circle"></i></span>
                        @endif


                        <p class="text-muted mb-4">{{ $user->username }} <span class="mx-2">|</span> <a
                                href="#!">{{ $user->provider ?? '' }}</a></p>
                        <p class="mb-1"><i class="fa fa-envelope me-1"></i> {{ $user->email }}</p>
                        <p><i class="fa fa-phone me-1"></i> {{ $user->phone }}</p>
                        <p class="small text-muted">Role: <span class="fw-bold">{{ $user->role }}</span></p>
                        <p class="small text-muted">Member Since: <span class="fw-bold">{{ $user->created_at }}</span>

                        </p>
                        <p class="small text-muted">Last Updated: <span class="fw-bold">{{ $user->updated_at }} </span>
                        </p>

                        <div class="mb-4 pb-2">
                            <button type="button" class="btn btn-outline-primary btn-floating"><i
                                    class="fab fa-facebook-f fa-lg"></i></button>
                            <button type="button" class="btn btn-outline-primary btn-floating"><i
                                    class="fab fa-twitter fa-lg"></i></button>
                            <button type="button" class="btn btn-outline-primary btn-floating"><i
                                    class="fab fa-skype fa-lg"></i></button>
                        </div>

                        <button type="button" class="btn btn-outline-primary btn-rounded btn-lg" data-bs-toggle="modal"
                            data-bs-target="#editProfileModal" id="edit-profile">Edit Profile</button>


                        <div class="d-flex justify-content-between text-center mt-5 mb-2">
                            <div>
                                <p class="mb-2 h5">8471</p>
                                <p class="text-muted mb-0">Wallets Balance</p>
                            </div>
                            <div class="px-3">
                                <p class="mb-2 h5">8512</p>
                                <p class="text-muted mb-0">Income amounts</p>
                            </div>
                            <div>
                                <p class="mb-2 h5">4751</p>
                                <p class="text-muted mb-0">Total Transactions</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Tabs Section -->
            <div class="col-md-8 animate__animated animate__fadeInRight">
                <ul class="nav nav-tabs mb-3" id="profileTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#personal" type="button"
                            role="tab">
                            <i class="fa fa-user"></i> Personal
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#education" type="button"
                            role="tab">
                            <i class="fa fa-graduation-cap"></i> Education
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#bio" type="button" role="tab">
                            <i class="fa fa-info-circle"></i> Bio
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#password" type="button"
                            role="tab">
                            <i class="fa fa-lock"></i> Password
                        </button>
                    </li>
                </ul>

                <div class="tab-content bg-white shadow rounded-4 p-4">
                    <!-- Personal Details Tab -->
                    <div class="tab-pane fade show active" id="personal" role="tabpanel">
                        <h5 class="mb-3">Personal Details</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label>Date of Birth:</label>
                                <p class="form-control-plaintext">{{ $profile->date_of_birth ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label>Gender:</label>
                                <p class="form-control-plaintext">{{ $profile->gender ?? 'N/A' }}</p>
                            </div>

                            <div class="col-md-12">
                                <label>Address:</label>
                                <p class="form-control-plaintext">{{ $user->address ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-12">
                                <label>Aadhar Number:</label>
                                <p class="form-control-plaintext">{{ $profile->aadhar_number ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Education Tab -->
                    <div class="tab-pane fade" id="education" role="tabpanel">
                        <h5 class="mb-3">Education Info</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label>College:</label>
                                <p class="form-control-plaintext">{{ $profile->college_name ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label>Course:</label>
                                <p class="form-control-plaintext">{{ $profile->course ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label>Year:</label>
                                @if ($profile && $profile->study_year)
                                    <p class="form-control-plaintext">{{ $profile->study_year . ' Year' }}</p>
                                @else
                                    <p class="form-control-plaintext">N/A</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <label>ID Card:</label>
                                <a href="{{ $profile->id_card ?? '#' }}" class="btn btn-sm btn-outline-secondary">View /
                                    Download</a>
                            </div>
                        </div>
                    </div>

                    <!-- Bio Tab -->
                    <div class="tab-pane fade" id="bio" role="tabpanel">
                        <h5 class="mb-3">Bio & Social Links</h5>
                        <p><strong>About Me:</strong><br>{{ $profile->bio ?? 'N/A' }}</p>
                        <div class="social-links">
                            <a href="" class="me-2"><i class="fab fa-facebook fa-lg"></i></a>
                            <a href="#" class="me-2"><i class="fab fa-twitter fa-lg"></i></a>
                            <a href="#" class="me-2"><i class="fab fa-linkedin fa-lg"></i></a>
                        </div>
                    </div>

                    <!-- Password Tab -->
                    <div class="tab-pane fade" id="password" role="tabpanel">
                        <h5 class="mb-3">Change Password</h5>
                        <form method="post" action="{{ route('change.password') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label>Current Password</label>
                                <input type="password" class="form-control" name="current_password" required>
                            </div>
                            <div class="mb-3">
                                <label>New Password</label>
                                <input type="password" class="form-control" name="password">
                            </div>
                            <div class="mb-3">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation">
                            </div>
                            <button class="btn btn-primary">Update Password</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Edit Profile Modal -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-primary text-white">
                    <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Profile Picture -->
                        <div class="mb-3">
                            <label for="avatar" class="form-label">Profile Picture</label>
                            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                        </div>

                        <!-- Full Name -->
                        <div class="mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="full_name" name="full_name"
                                value="{{ $user->full_name }}" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ $user->email }}" required>
                        </div>

                        <!-- Phone -->
                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone"
                                value="{{ $user->phone }}" required>
                        </div>

                        <!-- Address -->
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ $user->address }}" required>
                        </div>

                        <!-- Bio -->
                        <div class="mb-3">
                            <label for="bio" class="form-label">Bio</label>
                            <textarea class="form-control" id="bio" name="bio" rows="4">{{ $profile->bio ?? '' }}</textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-between">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/user.profile.js') }}"></script>
    <script>
        const editButton = document.getElementById('edit-profile');
        editButton.addEventListener('click', function() {
            window.location.href = "{{ route('profile.edit') }}";
        });
    </script>
@endpush
