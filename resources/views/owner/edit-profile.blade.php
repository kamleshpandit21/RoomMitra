@extends('layouts.owner')

@section('title', 'Edit Profile')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/user.profile.css') }}">
    <style>
  .custom-modal {
    width: 80vw;       /* 80% of viewport width */
    max-width: 80vw;
    height: 80vh;       /* 80% of viewport height */
    max-height: 80vh;
    margin: auto;       /* center it */
  }

  .custom-modal .modal-content {
    height: 100%;
    overflow: hidden; /* cropper ke liye important */
  }

  .custom-modal .modal-body {
    overflow-y: auto;
    max-height: calc(100% - 120px); /* leave room for header & footer */
  }
</style>

@endpush
@section('content')

    <div class="container py-5">
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
            if(Auth::check()):
                $user = Auth::user();
                $profile = $user->profile;
            endif;

                if ($profile) {
                    $avatar = $profile->avatar;
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
                            <button type="button" class="btn btn-outline-primary btn-floating"><i
                                    class="fab fa-facebook-f fa-lg"></i></button>
                            <button type="button" class="btn btn-outline-primary btn-floating"><i
                                    class="fab fa-twitter fa-lg"></i></button>
                            <button type="button" class="btn btn-outline-primary btn-floating"><i
                                    class="fab fa-skype fa-lg"></i></button>
                        </div>

                        <button type="button" class="btn btn-primary btn-rounded btn-lg" data-toggle="modal" data-target="#cropperModal">Upload
                            Photo</button>

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
                                <p class="text-muted mb-0">
                                    @session('success')
                                        {{ session('success') }}
                                    @endsession
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Editable Form Tabs -->
            <div class="col-md-8 animate_animated animate_fadeInRight">
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
                            <h5 class="mb-3">Edit Personal Details</h5>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label>Full Name:</label>
                                    <input type="text" class="form-control" name="full_name"
                                        value="{{ $user->full_name ?? 'N/A' }}" />
                                    <small class="text-muted">
                                        @error('full_name')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>

                                <div class="col-md-6">
                                    <label>Phone:</label>
                                    <input type="text" class="form-control" name="phone"
                                        value="{{ $user->phone ?? 'N/A' }}" />
                                    <small class="text-muted">
                                        @error('phone')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>


                                <div class="col-md-6">
                                    <label>Date of Birth:</label>
                                    <input type="date" class="form-control" name="date_of_birth"
                                        value="{{ $profile->date_of_birth ?? '' }}" />
                                    <small class="text-muted">
                                        @error('date_of_birth')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>


                                <div class="col-md-6">
                                    <label>Gender:</label>
                                    <select class="form-select form-control" name="gender">
                                        <option value=""
                                            {{ old('gender', $profile->gender) == null ? 'selected' : 'N/A' }}>Select
                                            Gender</option>
                                        <option value="Male"
                                            {{ old('gender', $profile->gender) == 'Male' ? 'selected' : 'N/A' }}>
                                            Male
                                        </option>
                                        <option value="Female"
                                            {{ old('gender', $profile->gender) == 'Female' ? 'selected' : 'N/A' }}>
                                            Female
                                        </option>
                                        <option value="Other"
                                            {{ old('gender', $profile->gender) == 'Other' ? 'selected' : 'N/A' }}>
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
                                    <label>Current Address:</label>
                                    <textarea class="form-control" name="address" rows="2">{{ $profile->current_address ?? '' }}</textarea>
                                    <small class="text-muted mt-1">
                                        @error('address')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>
                                <div class="col-md-6">
                                    <label>Permanent Address:</label>
                                    <textarea class="form-control" name="permanent_address">{{ $profile->permanent_address ?? '' }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label>Locality:</label>
                                    <input type="text" class="form-control" name="locality" value="{{ $profile->locality ?? '' }}">
                                </div>
                                
                                <div class="col-md-6">
                                    <label>Country:</label>
                                    <input type="text" class="form-control" name="country" value="{{ $profile->country ?? '' }}">
                                </div>
                                
                                <div class="col-md-6">
                                    <label>State:</label>
                                    <input type="text" class="form-control" name="state" value="{{ $profile->state ?? '' }}">
                                </div>
                                
                                <div class="col-md-6">
                                    <label>City:</label>
                                    <input type="text" class="form-control" name="city" value="{{ $profile->city ?? '' }}">
                                </div>
                                
                                <div class="col-md-6">
                                    <label>Pincode:</label>
                                    <input type="text" class="form-control" name="pincode" value="{{ $profile->pincode ?? '' }}">
                                </div>
                                

                                <div class="col-md-12">
                                    <label>Aadhar Number:</label>
                                    <input type="text" class="form-control" name="aadhar"
                                        value="{{ $profile->aadhar ?? '' }}" />
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
                                    <label>College:</label>
                                    <input type="text" class="form-control" name="college"
                                        value="{{ $profile->college_name ?? 'N/A' }}" />

                                    <small class="text-muted mt-1">
                                        @error('college')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>

                                <div class="col-md-6">
                                    <label>Course:</label>
                                    <input type="text" class="form-control" name="course"
                                        value="{{ $profile->course ?? 'N/A' }}" />
                                    <small class="text-muted mt-1">
                                        @error('course')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>

                                <div class="col-md-6">
                                    <label>Year:</label>
                                    <input type="text" class="form-control" name="study_year" value="{{ $profile->study_year ?? 'N/A' }}" />
                                    <small class="text-muted mt-1">
                                        @error('year')
                                            {{ $message }}
                                        @enderror
                                    </small>
                                </div>

                                <div class="col-md-6">
                                    <label>ID Card:</label>
                                    <input type="file" class="form-control" name="id_card" />
                                </div>
                            </div>
                        </div>

                        <!-- Bio Tab -->
                        <div class="tab-pane fade" id="bio" role="tabpanel">
                            <h5 class="mb-3">Edit Bio & Social Links</h5>
                            <div class="mb-3">
                                <label>About Me:</label>
                                <textarea class="form-control" name="bio" rows="3">{{ $profile->bio ?? 'N/A' }}</textarea>
                            </div>
                           
                            @php
                                $social_links = json_decode($profile->social_links, true) ?? [];
                            @endphp

                            <div class="mb-3">
                                <label>Facebook:</label>
                                <input type="url" class="form-control" name="social_links[facebook]"
                                    value="{{ $social_links['facebook'] ?? '' }}" placeholder="https://facebook.com/yourname" />
                            </div>
                            <div class="mb-3">
                                <label>Twitter:</label>
                                <input type="url" class="form-control" name="social_links[twitter]"
                                    value="{{ $social_links['twitter'] ?? '' }}" placeholder="https://twitter.com/yourhandle" />
                            </div>
                            <div class="mb-3">
                                <label>LinkedIn:</label>
                                <input type="url" class="form-control" name="social_links[linkedin]"
                                    value="{{ $social_links['linkedin'] ?? '' }}"
                                    placeholder="https://linkedin.com/in/yourprofile" />
                            </div>





                        </div>

                    </div>

                    <!-- Submit -->
                    <div class="text-end mt-4">
                        <button class="btn btn-success btn-lg" type="submit">Save All Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Cropper Modal -->
<div class="modal fade" id="cropperModal" tabindex="-1" aria-labelledby="cropperModalLabel" aria-hidden="true">
  <div class="modal-dialog custom-modal modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Crop Image</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>

      </div>

      <div class="modal-body text-center">
        <input type="file" id="uploadImageInput" accept="image/*" class="form-control mb-3">
        <div>
          <img id="imagePreview" style="max-width: 100%; display: none;" />
        </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="saveCroppedImage" class="btn btn-success">Save</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="{{ asset('js/user.profile.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.13/cropper.min.js"></script>    

<script>

let cropper;
    const input = document.getElementById('uploadImageInput');
    const image = document.getElementById('imagePreview');
    const hiddenInput = document.getElementById('croppedImageInput');
    const previewOutput = document.getElementById('previewOutput');
const model=document.getElementById('cropperModal/')
    input.addEventListener('change', function (e) {
      const file = e.target.files[0];
      if (file && /^image\//.test(file.type)) {
        const reader = new FileReader();
        reader.onload = function (event) {
          image.src = event.target.result;
          image.style.display = 'block';
          input.style.display = 'none'
           image.style.width = '100%';
      image.style.maxWidth = '100%';
      image.style.maxHeight = '400px';
      image.style.objectFit = 'contain';
          image.onload = function () {
            if (cropper) cropper.destroy();
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 1,
                autoCropArea: 1,
                responsive: true,
                background: false
            });
          };
        };
        reader.readAsDataURL(file);
      }
    });

    document.getElementById('saveCroppedImage').addEventListener('click', function () {
      if (cropper) {
        const canvas = cropper.getCroppedCanvas({
          width: 300,
          height: 300,
          imageSmoothingQuality: 'high'
        });

        const base64Image = canvas.toDataURL('image/jpeg', 0.9);
        hiddenInput.value = base64Image;
        previewOutput.src = base64Image;

      }
    });
    

</script>

    <script>
        document.getElementById('upload_profile_picture').addEventListener('click', function() {
            document.getElementById('profile_picture_input').click();
        });
    </script>
@endpush