@extends('layouts.owner')
@section('title', 'Add Room')
@push('styles')
    <style>
        .room-form-section {
            margin-bottom: 30px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .amenities-list {
            list-style: none;
            padding: 0;
        }

        .amenity-item {
            margin-bottom: 10px;
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 30px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            transition: .4s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 22px;
            width: 22px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            transition: .4s;
            border-radius: 50%;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:checked+.slider:before {
            transform: translateX(30px);
        }

        .alert-success {
            background-color: #d4edda !important;
            border: 1px solid #28a745 !important;
        }

        .alert-success .alert-heading {
            color: #155724;
            font-weight: 600;
        }

        .icon {
            width: 40px;
            height: 40px;
            background-color: rgba(40, 167, 69, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        .btn-close {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            color: #28a745;
        }

        .btn-close:hover {
            color: #155724;
        }

        .alert-dismissible {
            padding-right: 40px;
        }

        .alert {
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px;
            margin-bottom: 20px;
        }
    </style>
@endpush
@section('content')


    <h2 class="mb-4">Room Details Form</h2>
    @forelse ($errors->all() as $error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>

    @empty
    @endforelse

    @if (isset($success))
        <div class="alert alert-success">
            {{ $success }}
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex align-items-center">
                <div class="icon">
                    <i class="fas fa-check-circle text-success"></i>
                </div>
                <div class="ms-3">
                    <h4 class="alert-heading">{{ session('success') }}</h4>
                </div>
            </div>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif


    <form id="roomForm" class="needs-validation" novalidate action="{{ route('owner.rooms.store') }}" method="POST"
        enctype="multipart/form-data">
        @csrf
        <!-- Basic Info Section -->
        <div class="room-form-section">
            <h4 class="mb-3">Basic Information</h4>
            <div class="row justify-content-between">
                <div class="col-md-4 form-group">
                    <label for="room_number">Room Number</label>
                    <input type="text" class="form-control" id="room_number" name="room_number"
                        value="{{ old('room_number') }}">
                    <small class="alert-danger">
                        @error('room_number')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
                <div class="col-md-4 form-group">
                    <label for="room_title">Room Title</label>
                    <input type="text" class="form-control" id="room_title" name="room_title"
                        value="{{ old('room_title') }}">
                    <small class="alert-danger">
                        @error('room_title')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
                <div class="col-md-4 form-group">
                    <label for="room_description">Description</label>
                    <textarea class="form-control" id="room_description" rows="2" name="room_description">{{ old('room_description') }}</textarea>
                    <small class="alert-danger">
                        @error('room_description')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
            </div>
        </div>

        <!-- Pricing Section -->
        <div class="room-form-section">
            <h4 class="mb-3">Pricing Details</h4>
            <div class="row justify-content-between">
                <div class="col-md-3 form-group">
                    <label for="room_price">Room Price (₹)</label>
                    <input type="number" class="form-control" id="room_price" step="0.01" name="room_price"
                        value="{{ old('room_price') }}">
                    <small class="alert-danger">
                        @error('room_price')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
                <div class="col-md-3 form-group">
                    <label for="security_deposit">Security Deposit (₹)</label>
                    <input type="number" class="form-control" id="security_deposit" name="security_deposit"
                        value="{{ old('security_deposit') }}">
                    <small class="alert-danger">
                        @error('security_deposit')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
                <div class="col-md-3 form-group">
                    <label for="min_stay_months">Minimum Stay (Months)</label>
                    <input type="number" class="form-control" id="min_stay_months" value="1" name="min_stay_months"
                        value="{{ old('min_stay_months') }}">
                    <small class="alert-danger">
                        @error('min_stay_months')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
            </div>
        </div>
        <!-- Sharing Prices Section -->
        <div class="room-form-section">
            <h4 class="mb-3">Sharing Prices</h4>
            <div class="row">
                <div class="col-md-4 form-group">
                    <label for="single_price">Single Occupancy Price (₹)</label>
                    <input type="number" class="form-control" id="single_price" name="single_price"
                        value="{{ old('single_price') }}">
                    <small class="alert-danger">
                        @error('single_price')
                            {{ $message }}
                        @enderror

                    </small>
                </div>
                <div class="col-md-4 form-group">
                    <label for="double_price">Double Occupancy Price (₹)</label>
                    <input type="number" class="form-control" id="double_price" name="double_price"
                        value="{{ old('double_price') }}">
                    <small class="alert-danger">
                        @error('double_price')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
                <div class="col-md-4 form-group">
                    <label for="triple_price">Triple Occupancy Price (₹)</label>
                    <input type="number" class="form-control" id="triple_price" name="triple_price"
                        value="{{ old('triple_price') }}">
                    <small class="alert-danger">
                        @error('triple_price')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
            </div>


        </div>



        <!-- Capacity Section -->
        <div class="room-form-section">
            <h4>Capacity & Specifications</h4>
            <div class="row justify-content-between">
                <div class="col-md-3 form-group">
                    <label for="room_capacity">Room Capacity</label>
                    <input type="number" class="form-control" id="room_capacity" name="room_capacity"
                        value="{{ old('room_capacity') }}">
                    <small class="alert-danger">
                        @error('room_capacity')
                            {{ $message }}
                        @enderror
                    </small>

                </div>
                <div class="col-md-3 form-group">
                    <label for="total_beds">Total Beds</label>
                    <input type="number" class="form-control" id="total_beds" name="total_beds"
                        value="{{ old('total_beds') }}">
                    <small class="alert-danger">
                        @error('total_beds')
                            {{ $message }}
                        @enderror
                    </small>
                </div>

                <div class="col-md-3 form-group">
                    <label for="floor">Floor</label>
                    <input type="number" class="form-control" id="floor" name="floor"
                        value="{{ old('floor') }}">
                    <small class="alert-danger">
                        @error('floor')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
            </div>
        </div>

        <!-- Amenities Section -->
        <div class="room-form-section">
            <h4 class="mb-3">Amenities</h4>
            <div class="row justify-content-between">
                <div class="col-md-3 form-group d-flex justify-content-between">
                    <label class="form-check-label">AC</label>
                    <label class="switch">
                        <input type="checkbox" class="form-check-input" name="ac">

                        <span class="slider"></span>
                    </label>

                </div>
                <small class="alert-danger">
                    @error('ac')
                        {{ $message }}
                    @enderror
                </small>
                <div class="col-md-3 form-group d-flex justify-content-between">
                    <label class="form-check-label">Lift</label>
                    <label class="switch">
                        <input type="checkbox" class="form-check-input" name="lift">
                        <span class="slider"></span>
                    </label>

                </div>
                <small class="alert-danger">
                    @error('lift')
                        {{ $message }}
                    @enderror
                </small>
                <div class="col-md-3 form-group d-flex justify-content-between">
                    <label class="form-check-label">Parking</label>
                    <label class="switch">
                        <input type="checkbox" class="form-check-input" name="parking">
                        <span class="slider"></span>
                    </label>
                </div>
                <small class="alert-danger">
                    @error('parking')
                        {{ $message }}
                    @enderror
                </small>
                <div class="col-md-3 form-group d-flex justify-content-between">
                    <label class="form-check-label">Kitchen</label>
                    <label class="switch">
                        <input type="checkbox" class="form-check-input" id="kitchen" name="kitchen">
                        <span class="slider"></span>
                    </label>
                </div>
                <small class="alert-danger">
                    @error('kitchen')
                        {{ $message }}
                    @enderror
                </small>


            </div>
        </div>
        <!-- Room Specifications Section -->
        <div class="room-form-section">
            <h4 class="mb-3">Room Specifications</h4>
            <div class="row">
                <div class="col-md-4 form-group kitchen-type-container" style="display: none;">
                    <label for="kitchen_type">Kitchen Type</label>
                    <select class="form-select form-control" id="kitchen_type" name="kitchen_type">
                        <option value="">Select Kitchen Type</option>
                        <option value="personal">Personal</option>
                        <option value="shared">Shared</option>
                    </select>
                    <small class="alert-danger">
                        @error('kitchen_type')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
                <div class="col-md-4 form-group">
                    <label for="bathroom_type">Bathroom Type</label>
                    <select class="form-select form-control" id="bathroom_type" name="bathroom_type">
                        <option value="">Select Bathroom Type</option>
                        <option value="attached">Attached</option>
                        <option value="shared">Shared</option>
                    </select>
                    <small class="alert-danger">
                        @error('bathroom_type')
                            {{ $message }}
                        @enderror
                    </small>
                </div>


            </div>
        </div>


        <!-- Amenities List Section -->
        <!-- Amenities List Section -->
        <div class="room-form-section">
            <h4>Amenities List</h4>
            <div class="amenities-list">
                <div class="amenity-item">
                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="amenity_name">Amenity Name</label>
                            <select class="form-select form-control" id="amenity_name" name="amenity_name[]">
                                <option value="">Select Amenity</option>
                                <option value="wifi">WiFi</option>
                                <option value="laundry">Laundry</option>
                                <option value="tv">TV</option>
                                <option value="ro">RO</option>
                            </select>
                            <small class="alert-danger">
                                @error('amenity_name')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="amenity_status">Status</label>
                            <select class="form-select form-control" id="amenity_status" name="amenity_status[]"
                                onchange="handleAmenityStatusChange(this)">
                                <option value="free">Free</option>
                                <option value="paid">Paid</option>
                                <option value="not_available">Not Available</option>
                            </select>
                            <small class="alert-danger">
                                @error('amenity_status')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="amenity_price">Price (if paid)</label>
                            <input type="number" class="form-control" id="amenity_price" name="amenity_price[]"
                                onchange="handleAmenityPriceChange(this)">
                            <small class="alert-danger">
                                @error('amenity_price')
                                    {{ $message }}
                                @enderror
                            </small>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn btn-primary" onclick="addAmenity()">Add More Amenities</button>
        </div>

        <!-- Location Section -->
        <div class="room-form-section">
            <h4 class="mb-3">Location Details</h4>
            <div class="row justify-content-between">
                <div class="col-md-4 form-group">
                    <label for="address_line1">Address Line 1</label>
                    <input type="text" class="form-control" id="address_line1" name="address_line1"
                        value="{{ old('address_line1') }}">
                    <small class="alert-danger">
                        @error('address_line1')
                            {{ $message }}
                        @enderror
                    </small>

                </div>
                <div class="col-md-4 form-group">
                    <label for="address_line2">Address Line 2</label>
                    <input type="text" class="form-control" id="address_line2" name="address_line2"
                        value="{{ old('address_line2') }}">
                    <small class="alert-danger">
                        @error('address_line2')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
                <div class="col-md-4 form-group">
                    <label for="locality">Locality</label>
                    <input type="text" class="form-control" id="locality" name="locality"
                        value="{{ old('locality') }}">
                    <small class="alert-danger">
                        @error('locality')
                            {{ $message }}
                        @enderror
                    </small>

                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-md-3 form-group">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city"
                        value="{{ old('city') }}">
                    <small class="alert-danger">
                        @error('city')
                            {{ $message }}
                        @enderror
                    </small>

                </div>
                <div class="col-md-3 form-group">
                    <label for="state">State</label>
                    <input type="text" class="form-control" id="state" name="state"
                        value="{{ old('state') }}">
                    <small class="alert-danger">
                        @error('state')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
                <div class="col-md-3 form-group">
                    <label for="pincode">Pincode</label>
                    <input type="text" value="{{ old('pincode') }}" class="form-control" id="pincode"
                        name="pincode">
                    <small class="alert-danger">
                        @error('pincode')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
            </div>
        </div>
        {{-- <div class="room-form-section">
                <h4>Location Coordinates</h4>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="latitude">Latitude</label>
                        <input type="number" class="form-control" id="latitude" step="0.0000001"
                            placeholder="Enter latitude coordinate">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="longitude">Longitude</label>
                        <input type="number" class="form-control" id="longitude" step="0.0000001"
                            placeholder="Enter longitude coordinate">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div id="map" style="height: 300px; width: 100%;"></div>
                    </div>
                </div>
            </div> --}}



        <!-- Images Section -->
        <div class="room-form-section">
            <h4>Room Images</h4>
            <div class="form-group">
                <input type="file" class="form-control" multiple accept="image/*" id="room_images"
                    name="room_images[]">
            </div>
            <small class="alert-danger">
                @error('room_images')
                    {{ $message }}
                @enderror
            </small>
            <div id="imagePreview"></div>
        </div>
        <!-- Restrictions Section -->
        <div class="room-form-section">
            <h4 class="mb-3">Restrictions & Timings</h4>
            <div class="row justify-content-between">
                <div class="col-md-3 form-group">
                    <label for="entry_time">Entry Time</label>
                    <input type="time" class="form-control" id="entry_time" name="entry_time"
                        value="{{ old('entry_time') }}">
                    <small class="alert-danger">
                        @error('entry_time')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
                <div class="col-md-3 form-group">
                    <label for="exit_time">Exit Time</label>
                    <input type="time" class="form-control" id="exit_time" name="exit_time"
                        value="{{ old('exit_time') }}">
                    <small class="alert-danger">
                        @error('exit_time')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
            </div>
            <div class="row justify-content-between">
                <div class="col-md-6 form-group">
                    <label for="restrictions">Special Restrictions</label>
                    <textarea class="form-control" id="restrictions" rows="2" name="restrictions"></textarea>
                    <small class="alert-danger">
                        @error('restrictions')
                            {{ $message }}
                        @enderror
                    </small>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>

@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap&libraries=places"></script>
    <script>
        // Custom JavaScript
        function handleAmenityStatusChange(select) {
            const row = select.parentElement.parentElement;
            const priceInput = row.querySelector('input[name="amenity_price[]"]');

            if (select.value === 'free') {
                priceInput.disabled = true;
                priceInput.value = '';
            } else {
                priceInput.disabled = false;
            }
        }

        function handleAmenityPriceChange(input) {
            const row = input.parentElement.parentElement;
            const statusSelect = row.querySelector('select[name="amenity_status[]"]');

            if (input.value === '' && statusSelect.value === 'paid') {
                alert('Please enter a price for paid amenities.');
                input.focus();
            }
        }

        function addAmenity() {
            const amenitiesList = document.querySelector('.amenities-list');
            const amenityHTML = `
        <div class="amenity-item">
            <div class="row">
                <div class="col-md-4 form-group">
                    <select class="form-select form-control" name="amenity_name[]" onchange="handleAmenityStatusChange(this)">
                        <option value="">Select Amenity</option>
                        <option value="wifi">WiFi</option>
                        <option value="laundry">Laundry</option>
                        <option value="tv">TV</option>
                        <option value="ro">RO</option>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <select class="form-select form-control" name="amenity_status[]" onchange="handleAmenityStatusChange(this)">
                        <option value="free">Free</option>
                        <option value="paid">Paid</option>
                        <option value="not_available">Not Available</option>
                    </select>
                </div>
                <div class="col-md-4 form-group">
                    <input type="number" class="form-control" name="amenity_price[]" onchange="handleAmenityPriceChange(this)">
                </div>
            </div>
        </div>
    `;
            amenitiesList.insertAdjacentHTML('beforeend', amenityHTML);

            // Attach event listeners to the newly added elements
            const newAmenityItem = amenitiesList.lastElementChild;
            const statusSelect = newAmenityItem.querySelector('select[name="amenity_status[]"]');
            const priceInput = newAmenityItem.querySelector('input[name="amenity_price[]"]');

            // Initial state setup
            handleAmenityStatusChange(statusSelect);
        }
        // Initialize existing amenities
        document.querySelectorAll('select[name="amenity_status[]"]').forEach(select => {
            handleAmenityStatusChange(select);
        });

        // Image Preview
        document.getElementById('room_images').addEventListener('change', function(e) {
            const imagePreview = document.getElementById('imagePreview');
            imagePreview.innerHTML = '';

            const files = e.target.files;
            for (let i = 0; i < files.length; i++) {
                const file = files[i];
                const reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.innerHTML += `
                    <img src="${e.target.result}" class="img-thumbnail me-2 mb-2" style="max-width: 100px;">
                `;
                };

                reader.readAsDataURL(file);
            }
        });



        document.getElementById('kitchen').addEventListener('change', function() {
            const kitchenTypeContainer = document.querySelector('.kitchen-type-container');
            if (this.checked) {
                kitchenTypeContainer.style.display = 'block';
            } else {
                kitchenTypeContainer.style.display = 'none';
            }
        });


        let map;
        let marker;

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat: 28.7040602,
                    lng: 77.1024932
                }, // Default location (Delhi)
                zoom: 13,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });

            marker = new google.maps.Marker({
                position: map.getCenter(),
                draggable: true,
                map: map
            });

            // Update coordinates when marker is dragged
            google.maps.event.addListener(marker, 'dragend', function() {
                document.getElementById('latitude').value = marker.getPosition().lat();
                document.getElementById('longitude').value = marker.getPosition().lng();
            });
        }

        // Initialize map when the page loads
        google.maps.event.addDomListener(window, 'load', initMap);
    </script>
@endpush
