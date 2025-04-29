@extends('layouts.owner')
@section('title', 'Profile')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user.profile.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
@endpush
@section('content')
    <div class="container py-5">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            @php
                $user = auth()->user();
                $profile = $user->ownerProfile;
            @endphp

            <!-- Sidebar/Profile Summary -->
            <div class="col-md-4">
                <div class="card text-center" style="border-radius: 15px;">
                    <div class="card-body">
                        <div class="mt-3 mb-4  overflow-hidden">
                           
                                <img src="{{ asset($profile->avatar) ?? asset('img/avatar/avatar.png') }}" alt="Default Avatar"
                                    class="rounded-circle img" style="width: 100px;">
                          


                        </div>
                        <h4 class="mb-2">{{ $user->full_name }}</h4>

                        @if ($user->is_verified)
                            <span class="badge bg-success mb-2">Verified <i class="fa fa-check-circle"></i></span>
                        @else
                            <span class="badge bg-danger mb-2">Not Verified <i class="fa fa-times-circle"></i></span>
                        @endif


                        <p class="text-muted mb-4"><a href="#!">{{ $user->provider ?? 'N/A' }}</a></p>
                        <p class="mb-1"><i class="fa fa-envelope me-1"></i> {{ $user->email ?? 'N/A' }}</p>
                        <p><i class="fa fa-phone me-1"></i> {{ $user->phone ?? 'N/A' }}</p>
                        <p class="small text-muted">Role: <span class="fw-bold">{{ $user->role  }}</span></p>
                        <p class="small text-muted">Member Since: <span class="fw-bold">{{ $user->created_at ?? 'N/A' }}</span>

                        </p>
                        <p class="small text-muted">Last Updated: <span class="fw-bold">{{ $user->updated_at ?? 'N/A' }} </span>
                        </p>

                        <div class="mb-4 pb-2">
                            <button type="button" class="btn btn-outline-primary btn-floating"><i
                                    class="fab fa-facebook-f fa-lg"></i></button>
                            <button type="button" class="btn btn-outline-primary btn-floating"><i
                                    class="fab fa-twitter fa-lg"></i></button>
                            <button type="button" class="btn btn-outline-primary btn-floating"><i
                                    class="fab fa-skype fa-lg"></i></button>
                        </div>

                        <button type="button" class="btn btn-primary btn-rounded btn-lg" id="edit-profile">Edit
                            Profile</button>


                    </div>
                </div>
            </div>

            <!-- Main Tabs Section -->
            <div class="col-md-8 animate__animated animate__fadeInRight rounded-4">
                <ul class="nav nav-tabs mb-3" id="profileTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#personal" type="button"
                            role="tab">
                            <i class="fa fa-user"></i> Personal
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#bank" type="button"
                            role="tab">
                            <i class="fa-solid fa-building-columns"></i> Bank Details
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
                @php
                    if (isset($profile->date_of_birth)) {
                        $dob = date('Y-m-d', strtotime($profile->date_of_birth));
                    }
                @endphp
                <div class="tab-content bg-white shadow rounded-4 p-4">
                    <!-- Personal Details Tab -->
                    <div class="tab-pane fade show active" id="personal" role="tabpanel">
                        <h5 class="mb-3">Personal Details</h5>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label>Date of Birth:</label>
                                <p class="form-control-plaintext">{{ $dob ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label>Gender:</label>
                                <p class="form-control-plaintext">{{ $profile->gender ?? 'N/A' }}</p>
                            </div>

                            <div class="col-md-12">
                                <label>Address:</label>
                                <p class="form-control-plaintext">{{ $profile->current_address ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label>Permanent Address:</label>
                                <p class="form-control-plaintext">{{ $profile->permanent_address ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label>Locality:</label>
                                <p class="form-control-plaintext">{{ $profile->locality ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label>City:</label>
                                <p class="form-control-plaintext">{{ $profile->city ?? 'N/A' }}</p>
                            </div>



                            <div class="col-md-6">
                                <label>State:</label>
                                <p class="form-control-plaintext">{{ $profile->state ?? 'N/A' }}</p>
                            </div>
                            <div class="col-md-6">
                                <label>Country:</label>
                                <p class="form-control-plaintext">{{ $profile->country ?? 'N/A' }}</p>
                            </div>


                            <div class="col-md-6">
                                <label>Pincode:</label>
                                <p class="form-control-plaintext">{{ $profile->pincode ?? 'N/A' }}</p>
                            </div>


                            <div class="col-md-12">
                                <label>Aadhar Number:</label>
                                <p class="form-control-plaintext">{{ $profile->aadhar ?? 'N/A' }}</p>


                            </div>

                        </div>
                    </div>

                    <!-- Education Tab -->
                    {{-- <div class="tab-pane fade" id="education" role="tabpanel">
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
                                <a href="{{ asset($profile->id_card_url) ?? '#' }}"
                                    class="btn btn-sm btn-outline-secondary">View /
                                    Download</a>
                            </div>
                        </div>
                    </div> --}}

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
                        <form method="post" action="{{ route('owner.profile.update-password') }}"
                            enctype="multipart/form-data">
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
@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('js/user.profile.js') }}"></script>

    <script>
        const editButton = document.getElementById('edit-profile');
        editButton.addEventListener('click', function() {
            window.location.href = "{{ route('owner.profile.edit') }}";
        });
    </script>
@endpush
