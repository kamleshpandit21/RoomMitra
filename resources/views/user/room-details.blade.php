@extends('layouts.app')
@section('title', 'Room Details')

@push('styles')
    <style>
        .amenity-card {
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
            min-width: 120px;
        }

        .badge-free {
            background-color: #d4edda;
            color: #155724;
        }

        .badge-paid {
            background-color: #f8d7da;
            color: #721c24;
        }

        .spec-item i {
            color: #0d6efd;
        }

        .hover-shadow:hover {
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .sticky-action {
            position: sticky;
            top: 90px;
            z-index: 1000;
            background: #fff;
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .amenity-card {
            padding: 10px;
            border: 1px solid #e2e2e2;
            border-radius: 8px;
            width: 120px;
            background: #f9f9f9;
        }
    </style>
@endpush

@section('content')

    <div class="container py-4">
        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('rooms') }}">Rooms</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $room->room_title }}</li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="mb-4">
            <h2 class="fw-bold">{{ $room->room_title }} <span class="badge bg-success"><i class="fa fa-check-circle"></i>
                    {{ $room->status }} </span></h2>
            <p><i class="fa fa-map-marker-alt text-danger"></i> {{ $room->locality }}, {{ $room->city }}</p>
        </div>

        <div class="row g-4">
            <!-- Left Column -->
            <div class="col-lg-8">
                <!-- Image Gallery -->
                <div id="roomGallery" class="carousel slide mb-4" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset($room->images->first()->image_url) }}" class="d-block w-100"
                                alt="..." height="400px">
                        </div>
                        @foreach ($room->images->skip(1) as $image)
                        <div class="carousel-item">
                            <img src="{{ asset($image->image_url) }}" class="d-block w-100" alt="Room Image" height="400px">
                        </div>
                    @endforeach
                    
                     
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#roomGallery" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#roomGallery" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

             <!-- Basic Info -->
<div class="card p-3 mb-4">
    <h5><i class="fas fa-info-circle me-2"></i> Room Information</h5>
    <p><strong>Room No.:</strong> {{ $room->room_number }}</p>
    <p><strong>Capacity:</strong> {{ $room->room_capacity }} People</p>
    <p><strong>Total Beds:</strong> {{ $room->total_beds }} Beds</p>
    <p><strong>Description:</strong> {{ $room->room_description }}</p>
</div>

<!-- Specifications -->
<div class="card p-3 mb-4">
    <h5><i class="fas fa-cogs me-2"></i> Specifications</h5>
    <div class="row g-3">
        <div class="col-md-6 spec-item">
            <i class="fa fa-bath me-2"></i> <strong>Bathroom Type:</strong> {{ ucfirst($room->bathroom_type) }}
        </div>

        <div class="col-md-6 spec-item">
            <i class="fa fa-utensils me-2"></i> <strong>Kitchen Type:</strong> {{ ucfirst($room->kitchen_type) }}
        </div>

        <div class="col-md-6 spec-item">
            <i class="fa fa-building me-2"></i> <strong>Floor:</strong>
            @if ($room->floor == 1)
                Ground Floor
            @elseif ($room->floor == 2)
                1st Floor
            @elseif ($room->floor == 3)
                2nd Floor
            @elseif ($room->floor == 4)
                3rd Floor
            @else
                {{ $room->floor }}th Floor
            @endif
        </div>

        <div class="col-md-6 spec-item">
            <i class="fa fa-elevator me-2"></i> <strong>Lift:</strong> {{ $room->lift ? 'Available' : 'Not Available' }}
        </div>

        <div class="col-md-6 spec-item">
            <i class="fa fa-car me-2"></i> <strong>Parking:</strong> {{ $room->parking ? 'Available' : 'Not Available' }}
        </div>

        <div class="col-md-6 spec-item">
            <i class="fa fa-bolt me-2"></i> <strong>Light:</strong> {{ ucfirst($room->light ?? 'Normal') }}
        </div>
    </div>
</div>

                <div class="card p-3 mb-4">
                    <h5>Amenities</h5>
                    <div class="d-flex flex-wrap gap-3">
                        @php
                            $icons = [
                                'WiFi' => 'fa-wifi',
                                'wifi' => 'fa-wifi',
                                'Laundry' => 'fa-tshirt',
                                'laundry' => 'fa-tshirt',
                                'RO Water' => 'fa-tint',
                                'ro' => 'fa-tint',
                                'Fridge' => 'fa-snowflake',
                                'TV' => 'fa-tv',
                                'tv' => 'fa-tv',
                                'Microwave' => 'fa-mitten', // Use 'fa-microwave' if you have Font Awesome Pro
                            ];
                        @endphp

                        @forelse ($room->amenities as $amenity)
                            @php
                                $iconClass = $icons[$amenity->amenity_name] ?? 'fa-concierge-bell';
                            @endphp

                            <div class="amenity-card text-center mb-3">
                                <i class="fas {{ $iconClass }} fa-lg mb-1"></i>
                                <div>{{ $amenity->amenity_name }}</div>
                                <div
                                    class="badge bg-{{ $amenity->status == 'free' ? 'success' : ($amenity->status == 'paid' ? 'warning' : 'secondary') }}">
                                    {{ ucfirst($amenity->status) }}
                                </div>

                                @if ($amenity->status == 'paid')
                                    <div>₹{{ number_format($amenity->price) }}/month</div>
                                @endif
                            </div>
                        @empty
                            <p>No amenities listed.</p>
                        @endforelse

                    </div>
                </div>


                <!-- Location -->
                <div class="card p-3 mb-4">
                    <h5>Location</h5>
                    <p>{{ $room->address_line1 }}</p>
                    <p>{{ $room->address_line2 }}</p>
                    <p><strong>City:</strong> {{ $room->city }}</p>
                    <p><strong>State:</strong> {{ $room->state }}</p>
                    <p><strong>Pincode:</strong> {{ $room->pincode }}</p>                    
                    <p><strong>Landmarks:</strong>{{ $room->nearby_landmarks }}</p>
                    <iframe src="https://maps.google.com/maps?q=Salt%20Lake,%20Kolkata&t=&z=13&ie=UTF8&iwloc=&output=embed"
                        width="100%" height="300" frameborder="0" style="border:0;"></iframe>
                </div>

                <!-- Timings & Restrictions -->
                <div class="card p-3 mb-4">
                    <h5>Timings & Restrictions</h5>
                    <p>
                        <strong>Entry Time:</strong> {{ date('h:i A', strtotime($room->entry_time)) }} |
                        <strong>Exit Time:</strong> {{ date('h:i A', strtotime($room->exit_time)) }}
                    </p>                    <p><strong>Restrictions:</strong>{{ $room->restrictions }}</p>
                </div>
            </div>

            <!-- Right Column -->
            <div class="col-lg-4">
                <div class="sticky-action">
                    <!-- Pricing -->
                    <div class="card p-3 mb-4">
                        <h5>Pricing</h5>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Room Price: ₹{{ intval($room->room_price) }}/month</li>

                            <li class="list-group-item">Security Deposit: ₹{{ intval($room->security_deposit) }}/month</li>
                            @forelse ($room->sharing_prices as $key => $price)
                                <li class="list-group-item">{{ ucwords($key) }}: ₹{{ intval($price) }}/month</li>

                            @empty
                            @endforelse
                        </ul>
                    </div>

                    <!-- Owner Info -->
                    <div class="card p-3 mb-4">
                        <h5>Owner Info</h5>
                        <p><strong>Name:</strong> {{ ucwords($room->owner->full_name) }}</p>
                        <p><strong>Contact:</strong> {{ substr($room->owner->phone, 0, 4) . '********' }}</p>

                        <p><strong>Rating:</strong> <span class="text-warning"><i class="fa fa-star"></i> 4.5</span></p>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-grid gap-2">
                        {{-- <button class="btn btn-outline-primary"><i class="fa fa-shopping-cart"></i> Add to Cart</button> --}}
                        <button id="bookNow" class="btn btn-primary"><i class="fa fa-calendar-check"></i> Book
                            Now</button>
                        {{-- <button class="btn btn-light"><i class="fa fa-heart"></i> Add to Wishlist</button> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.getElementById('bookNow').addEventListener('click', function() {
        window.location.href = "{{route('user.booking.checkout', $room->room_id)}}";
    });
</script>

@endpush
