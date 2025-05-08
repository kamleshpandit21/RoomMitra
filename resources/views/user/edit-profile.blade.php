@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

    <div class="container "  style="padding: 160px 0 80px 0;">
        <section class="text-center bg-light">
            <div class="container">
                <h1 class="display-5 fw-bold  heading">Edit Profile</h1>
         
            </div>
        </section>
        <div class="row">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>Whoops! Something went wrong:</strong>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @php
                $avatar = null;

                if ($user->profile) {
                    $avatar = $user->profile->avatar;
                }

                $isValidAvatar = $avatar && trim($avatar) !== 'N/A';
            @endphp


            <!-- Sidebar/Profile Summary -->
            <div class="col-md-4">
                <div class="card text-center" style="border-radius: 15px">
                    <div class="card-body">
                        <div class="mt-3 mb-4">
                            <img src="{{ $isValidAvatar ? asset($avatar) : asset('img/avatar/avatar.png') }}"
                                alt="User Avatar" class="rounded-circle img-fluid" style="width: 100px;" />
                        </div>
                        <h4 class="mb-2">{{ $user->full_name ?? 'N/A' }}</h4>
                        @php
                            $verified = $user->is_verified;
                        @endphp

                        <span class="badge mb-2 {{ $verified ? 'bg-success' : 'bg-danger' }}">
                            {{ $verified ? 'Verified' : 'Not Verified' }}
                            <i class="fa {{ $verified ? 'fa-check-circle' : 'fa-times-circle' }}"></i>
                        </span>

                        <p class="text-muted mb-4">{{ $user->username ?? 'N/A' }} <span class="mx-2">|</span> <a
                                href="#!">{{ $user->provider ?? 'N/A' }}</a></p>
                        <p class="mb-1"><i class="fa fa-envelope me-1"></i> {{ $user->email ?? 'N/A' }}</p>
                        <p><i class="fa fa-phone me-1"></i> {{ $user->phone ?? 'N/A' }}</p>

                        <p class="small text-muted">Role: <span class="fw-bold">{{ $user->role ?? 'N/A' }}</span></p>

                        <div class="mb-4 pb-2">
                            <button type="button" class="btn  btn-floating"><i
                                    class="fab fa-facebook-f fa-lg"></i></button>
                            <button type="button" class="btn  btn-floating"><i
                                    class="fab fa-twitter fa-lg"></i></button>
                            <button type="button" class="btn  btn-floating"><i
                                    class="fab fa-skype fa-lg"></i></button>
                        </div>

                        <button type="button" class="btn submit-btn btn-lg" id="upload_profile_picture">Upload
                            Photo</button>

                      
                    </div>
                </div>
            </div>


            <!-- Editable Form Tabs -->
            <div class="col-md-8 animate__animated animate__fadeInRight">
                <form action="{{ route('user.profile.update', $user->user_id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="file" class="form-control d-none" name="avatar" id="profile_picture_input">
                    <ul class="nav nav-tabs mb-3" id="profileTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#personal" type="button"
                                role="tab"><i class="fa fa-user"></i> Personal</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#education" type="button"
                                role="tab"><i class="fa fa-graduation-cap"></i> Education</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#bio" type="button"
                                role="tab"><i class="fa fa-info-circle"></i> Bio</button>
                        </li>
                  
                    </ul>

                    <div class="tab-content bg-white shadow rounded-4 p-4">

                        <!-- Personal Tab -->
                        <div class="tab-pane fade show active" id="personal" role="tabpanel">
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="fw-bold">Full Name:</label>
                                    <input type="text" class="form-control" name="full_name" value="{{ $user->full_name ?? '' }}" placeholder="{{ $user->full_name ?? 'Enter Full Name' }}" />
                                    <small class="text-muted">
                                        @error('full_name')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-bold">Phone:</label>
                                    <input type="text" class="form-control" name="phone"
                                        value="{{ $user->phone ?? '' }}" placeholder="{{ $user->phone ?? 'Enter Phone Number' }}"/>
                                    <small class="text-muted">
                                        @error('phone')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>


                                <div class="col-md-6">
                                    <label class="fw-bold">Date of Birth:</label>
                                    <input type="date" class="form-control" name="date_of_birth"
                                    value="{{ optional($user->profile->date_of_birth)->format('Y-m-d') }}"
                                    placeholder="{{ $user->profile->date_of_birth ?? 'Enter Date of Birth' }}"/>
                                    <small class="text-muted">
                                        @error('date_of_birth')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>


                                <div class="col-md-6">
                                    <label class="fw-bold">Gender:</label>
                                    <select class="form-select" name="gender">
                                        <option value=""
                                            {{ old('gender', $user->profile->gender) == null ? 'selected' : 'N/A' }}>Select
                                            Gender</option>
                                        <option value="Male"
                                            {{ old('gender', $user->profile->gender) == 'Male' ? 'selected' : 'N/A' }}>
                                            Male
                                        </option>
                                        <option value="Female"
                                            {{ old('gender', $user->profile->gender) == 'Female' ? 'selected' : 'N/A' }}>
                                            Female
                                        </option>
                                        <option value="Other"
                                            {{ old('gender', $user->profile->gender) == 'Other' ? 'selected' : 'N/A' }}>
                                            Other
                                        </option>
                                    </select>
                                    <small class="text-muted mt-1">
                                        @error('gender')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>

                                <div class="col-md-12">
                                    <label class="fw-bold">Current Address:</label>
                                    <textarea class="form-control" name="address" rows="2" placeholder="{{ $user->profile->current_address ?? 'Enter Current Address' }}">{{ $user->profile->current_address ?? '' }}</textarea>
                                    <small class="text-muted mt-1">
                                        @error('address')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                                <div class="col-md-6">
                                    <label class="fw-bold">Permanent Address:</label>
                                    <textarea class="form-control" name="permanent_address" placeholder="{{ $user->profile->permanent_address ?? 'Enter Permanent Address' }}">{{ $user->profile->permanent_address ?? '' }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="fw-bold">Locality:</label>
                                    <input type="text" class="form-control" name="locality" placeholder="{{ $user->profile->locality ?? 'Enter Locality' }}" value="{{ $user->profile->locality ?? '' }}">
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="fw-bold">Country:</label>
                                    <input type="text" class="form-control" name="country" placeholder="{{ $user->profile->country ?? 'Enter Country' }}" value="{{ $user->profile->country ?? '' }}">
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="fw-bold">State:</label>
                                    <input type="text" class="form-control" name="state" placeholder="{{ $user->profile->state ?? 'Enter State' }}" value="{{ $user->profile->state ?? '' }}">
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="fw-bold">City:</label>
                                    <input type="text" class="form-control" name="city" placeholder="{{ $user->profile->city ?? 'Enter City' }}" value="{{ $user->profile->city ?? '' }}">
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="fw-bold">Pincode:</label>
                                    <input type="text" class="form-control" name="pincode" placeholder="{{ $user->profile->pincode ?? 'Enter Pincode' }}" value="{{ $user->profile->pincode ?? '' }}">
                                </div>
                                

                                <div class="col-md-12">
                                    <label class="fw-bold">Aadhar Number:</label>
                                    <input type="text" class="form-control" name="aadhar"
                                        value="{{ $user->profile->aadhar ?? '' }}" placeholder="{{ $user->profile->aadhar ?? 'Enter Aadhar Number' }}"/>
                                    <small class="text-muted mt-1">
                                        @error('aadhar')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>

                            </div>
                        </div>

                        <!-- Education Tab -->
                        <div class="tab-pane fade" id="education" role="tabpanel">
                            <h5 class="mb-3">Edit Education Info</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="fw-bold">College:</label>
                                    <input type="text" class="form-control" name="college"
                                        value="{{ $user->profile->college_name ?? '' }}" placeholder="{{ $user->profile->college_name ?? 'Enter College Name' }}"/>

                                    <small class="text-muted mt-1">
                                        @error('college')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-bold">Course:</label>
                                    <input type="text" class="form-control" name="course"
                                        value="{{ $user->profile->course ?? '' }}" placeholder="{{ $user->profile->course ?? 'Enter Course' }}" />
                                    <small class="text-muted mt-1">
                                        @error('course')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-bold">Year:</label>
                                    <input type="text" class="form-control" name="study_year" placeholder="{{ $user->profile->study_year ?? 'Enter Year' }}" value="{{ $user->profile->study_year ?? '' }}" />
                                    <small class="text-muted mt-1">
                                        @error('year')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>

                                <div class="col-md-6">
                                    <label class="fw-bold">ID Card:</label>
                                    <input type="file" class="form-control" name="id_card"   />
                                </div>
                            </div>
                        </div>

                        <!-- Bio Tab -->
                        <div class="tab-pane fade" id="bio" role="tabpanel">
                            <h5 class="mb-3">Edit Bio & Social Links</h5>
                            <div class="mb-3">
                                <label class="fw-bold">About Me:</label>
                                <textarea class="form-control" name="bio" rows="3" placeholder="{{ $user->profile->bio ?? 'Enter Bio' }}">{{ $user->profile->bio ?? '' }}</textarea>
                            </div>
                           
                            @php
                                $social_links = json_decode($user->profile->social_links, true) ?? [];
                            @endphp

                            <div class="mb-3">
                                <label class="fw-bold">Facebook:</label>
                                <input type="url" class="form-control" name="social_links[facebook]"
                                    value="{{ $social_links['facebook'] ?? '' }}" placeholder="https://facebook.com/yourname" />
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">Twitter:</label>
                                <input type="url" class="form-control" name="social_links[twitter]"
                                    value="{{ $social_links['twitter'] ?? '' }}" placeholder="https://twitter.com/yourhandle" />
                            </div>
                            <div class="mb-3">
                                <label class="fw-bold">LinkedIn:</label>
                                <input type="url" class="form-control" name="social_links[linkedin]"
                                    value="{{ $social_links['linkedin'] ?? '' }}"
                                    placeholder="https://linkedin.com/in/yourprofile" />
                            </div>





                        </div>

                    </div>

                    <!-- Submit -->
                    <div class="text-end mt-4">
                        <button class="btn submit-btn btn-lg" type="submit">Save All Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.getElementById('upload_profile_picture').addEventListener('click', function() {
            document.getElementById('profile_picture_input').click();
        });
    </script>
@endpush
