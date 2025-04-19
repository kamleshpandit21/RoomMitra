@extends('layouts.owner')

@section('title', 'View Room')

@section('content')

    <div class="container-fluid px-4 py-5">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <h1 class="mb-0">Room Details</h1>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('owner.rooms.edit', $room->room_id) }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-edit"></i>
                </a>
                <a href="{{ route('owner.rooms.index') }}" class="btn btn-secondary btn-sm">
                    <i class="fas fa-arrow-left"></i>
                </a>
            </div>
        </div>

        <!-- 1. Room Basic Info -->
        <div class="card mb-4 shadow-lg">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Room Basic Info</h5>
            </div>
            <div class="card-body">
                <div class="row g-4">
                    <div class="col-md-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-circle">
                                <i class="fas fa-home"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Room Title:</h5>
                                <p class="text-muted">{{ $room->room_title }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-circle">
                                <i class="fas fa-door-number"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Room Number:</h5>
                                <p class="text-muted">{{ $room->room_number }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-circle">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Status:</h5>
                                <span class="badge badge-{{ $room->status === 'available' ? 'success' : ($room->status === 'booked' ? 'danger' : ($room->status === 'pending' ? 'warning' : 'secondary')) }}">
                                    {{ ucfirst($room->status) }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row g-4 mt-4">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-circle">
                                <i class="fas fa-info-circle"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Description:</h5>
                                <p class="text-muted">{{ $room->room_description }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="d-flex align-items-center gap-3">
                            <div class="icon-circle">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <h5 class="mb-0">Verification:</h5>
                                <span class="badge badge-{{ $room->is_verified ? 'success' : 'danger' }}">
                                    {{ $room->is_verified ? 'Verified' : 'Not Verified' }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 2. Price & Stay Info -->
        <div class="card mb-4 shadow-lg">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Price & Stay Info</h5>
            </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle">
                                    <i class="fas fa-rupee-sign"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Room Price:</h5>
                                    <p class="text-muted">₹{{ $room->room_price }}/month</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle">
                                    <i class="fas fa-shield-alt"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Security Deposit:</h5>
                                    <p class="text-muted">₹{{ $room->security_deposit }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle">
                                    <i class="fas fa-calendar-alt"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Minimum Stay:</h5>
                                    <p class="text-muted">{{ $room->min_stay_months }} months</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- 3. Sharing Options -->
            <div class="card mb-4 shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Sharing Options</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($room->sharing_prices as $key => $price)
                                    <tr>
                                        <td>{{ ucfirst($key) }}</td>
                                        <td>₹{{ $price }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        
            <!-- 4. Room Capacity & Floor -->
            <div class="card mb-4 shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Room Capacity & Floor</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle">
                                    <i class="fas fa-bed"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Total Beds:</h5>
                                    <p class="text-muted">{{ $room->total_beds }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Capacity:</h5>
                                    <p class="text-muted">{{ $room->room_capacity }} people</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Floor Number:</h5>
                                    <p class="text-muted">
                                        @if ($room->floor == 1)
                                            Ground
                                        @elseif ($room->floor == 2)
                                            1st
                                        @elseif ($room->floor == 3)
                                            2nd
                                        @elseif ($room->floor == 4)
                                            3rd
                                        @else
                                            {{ $room->floor }}th
                                        @endif
                                        Floor
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- 5. Facilities -->
            <div class="card mb-4 shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Facilities</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle">
                                    <i class="fas fa-snowflake"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">AC:</h5>
                                    <i class="fas fa-check-circle text-success"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle">
                                    <i class="fas fa-building"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Lift:</h5>
                                    <i class="fas fa-check-circle text-success"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle">
                                    <i class="fas fa-parking"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Parking:</h5>
                                    <i class="fas fa-check-circle text-success"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle">
                                    <i class="fas fa-utensils"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Kitchen:</h5>
                                    <i class="fas fa-check-circle text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 mt-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle">
                                    <i class="fas fa-utensils"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Kitchen Type:</h5>
                                    <p class="text-muted">{{ ucfirst($room->kitchen_type) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle">
                                    <i class="fas fa-bath"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Bathroom Type:</h5>
                                    <p class="text-muted">{{ ucfirst($room->bathroom_type) }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- 6. Address -->
            <div class="card mb-4 shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Address</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Address Line 1:</h5>
                                    <p class="text-muted">{{ ucwords($room->address_line1) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Address Line 2:</h5>
                                    <p class="text-muted">Area, society name</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 mt-4">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle">
                                    <i class="fas fa-city"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">City:</h5>
                                    <p class="text-muted">Mumbai</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle">
                                    <i class="fas fa-map-signs"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">State:</h5>
                                    <p class="text-muted">Maharashtra</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle">
                                    <i class="fas fa-mail-bulk"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Pincode:</h5>
                                    <p class="text-muted">400001</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-4 mt-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle">
                                    <i class="fas fa-map-pin"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Locality:</h5>
                                    <p class="text-muted">Andheri East</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle">
                                    <i class="fas fa-landmark"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Nearby Landmarks:</h5>
                                    <p class="text-muted">Near Metro Station</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- 7. Entry & Exit Timings -->
            <div class="card mb-4 shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Entry & Exit Timings</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle">
                                    <i class="fas fa-sign-in-alt"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Entry Time:</h5>
                                    <p class="text-muted">10:00 AM</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex align-items-center gap-3">
                                <div class="icon-circle">
                                    <i class="fas fa-sign-out-alt"></i>
                                </div>
                                <div>
                                    <h5 class="mb-0">Exit Time:</h5>
                                    <p class="text-muted">10:00 PM</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        
            <!-- 8. Restrictions -->
            <div class="card mb-4 shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Restrictions</h5>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        <a href="#" class="list-group-item list-group-item-action d-flex gap-3">
                            <i class="fas fa-smoking-ban"></i>
                            <div>
                                <h6 class="mb-0">Smoking not allowed</h6>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex gap-3">
                            <i class="fas fa-volume-mute"></i>
                            <div>
                                <h6 class="mb-0">No loud music</h6>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action d-flex gap-3">
                            <i class="fas fa-paw"></i>
                            <div>
                                <h6 class="mb-0">Pets not allowed</h6>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        
            <!-- 9. Amenities -->
            <div class="card mb-4 shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Amenities</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Amenity Name</th>
                                    <th>Type (Paid/Free)</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>WiFi</td>
                                    <td>Free</td>
                                    <td>₹0</td>
                                </tr>
                                <tr>
                                    <td>Laundry</td>
                                    <td>Paid</td>
                                    <td>₹300</td>
                                </tr>
                                <tr>
                                    <td>Housekeeping</td>
                                    <td>Free</td>
                                    <td>₹0</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            <!-- 10. Images -->
            <div class="card mb-4 shadow-lg">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Images</h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        @foreach ($room->images as $image)
                            <div class="col-md-4">
                                <div class="card">
                                    <img src="{{ $image->image_url }}" class="card-img-top img-thumbnail" alt="Room Image" data-bs-toggle="modal" data-bs-target="#imageModal{{ $loop->index + 1 }}">
                                    <div class="card-body">
                                        <h5 class="card-title">Room Image {{ $loop->index + 1 }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            
            <!-- Image Modals -->
            @foreach ($room->images as $image)
                <div class="modal fade" id="imageModal{{ $loop->index + 1 }}" tabindex="-1" aria-labelledby="imageModalLabel{{ $loop->index + 1 }}" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="imageModalLabel{{ $loop->index + 1 }}">Room Image</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <img src="{{ $image->image_url }}" alt="Room Image" class="img-fluid">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            
            <!-- 11. Action Buttons -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{ route('owner.rooms.edit', $room->room_id) }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-edit"></i> Edit Room
                </a>
                <a href="{{ route('owner.rooms.index') }}" class="btn btn-secondary btn-lg">
                    <i class="fas fa-arrow-left"></i> Back to My Rooms
                </a>
                <form action="{{ route('owner.rooms.destroy', $room->room_id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this room?');" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-lg">
                        <i class="fas fa-trash"></i> Delete Room
                    </button>
                </form>
            </div>
            </div>
            
            @endsection
            
            @push('styles')
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
            <style>
                :root {
                    --primary-color: #0d6efd;
                    --secondary-color: #6c757d;
                    --success-color: #28a745;
                    --danger-color: #dc3545;
                    --warning-color: #ffc107;
                    --background-color: #f8f9fa;
                    --text-muted-color: #6c757d;
                }
            
                body {
                    font-family: 'Roboto', sans-serif;
                    background-color: var(--background-color);
                }
            
                .card {
                    border: none;
                    border-radius: 15px;
                    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-header {
        background-color: var(--primary-color);
        color: white;
        border-radius: 15px 15px 0 0;
        padding: 15px;
    }

    .card-body {
        padding: 20px;
    }

    .badge {
        border-radius: 20px;
        padding: 8px;
        font-size: 0.9rem;
    }

    .btn {
        border-radius: 8px;
        transition: background-color 0.3s, transform 0.3s;
    }

    .btn:hover {
        transform: scale(1.05);
    }

    .btn-primary {
        background-color: var(--primary-color);
        border: none;
    }

    .btn-secondary {
        background-color: var(--secondary-color);
        border: none;
    }

    .btn-danger {
        background-color: var(--danger-color);
        border: none;
    }

    .icon-circle {
        background-color: var(--primary-color);
        border-radius: 50%;
        padding: 10px;
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
    }

    .fas {
        margin-right: 8px;
    }

    .text-muted {
        color: var(--text-muted-color) !important;
    }

    .list-group-item {
        border: none;
        margin-bottom: 10px;
        border-radius: 10px;
        transition: background-color 0.3s;
    }

    .list-group-item:hover {
        background-color: var(--background-color);
    }

    .img-thumbnail {
        border-radius: 10px;
        cursor: pointer;
        transition: transform 0.3s;
    }

    .img-thumbnail:hover {
        transform: scale(1.05);
    }

    .modal-xl {
        max-width: 90%;
    }
</style>
@endpush

@push('scripts')
<script>
    // Initialize modals
    var myModal = document.querySelectorAll('.modal');
    myModal.forEach(mdl => {
        mdl.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget;
            var recipient = button.getAttribute('data-bs-target');
            var title = button.getAttribute('aria-label');
            mdl.querySelector('.modal-title').textContent = title;
        });
    });

    // Image zoom effect
    document.querySelectorAll('.img-thumbnail').forEach(img => {
        img.addEventListener('mouseover', function() {
            this.style.transform = 'scale(1.05)';
        });
        img.addEventListener('mouseout', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // Copy to clipboard functionality
    document.querySelectorAll('.copy-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            var text = this.previousElementSibling.textContent;
            navigator.clipboard.writeText(text).then(function() {
                btn.textContent = 'Copied!';
                setTimeout(function() {
                    btn.textContent = 'Copy';
                }, 2000);
            });
        });
    });
</script>
@endpush    